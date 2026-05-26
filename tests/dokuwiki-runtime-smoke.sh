#!/usr/bin/env bash
set -eu

if [ "${1:-}" = "-h" ] || [ "${1:-}" = "--help" ]; then
    printf '%s\n' \
        'Usage: tests/dokuwiki-runtime-smoke.sh' \
        '' \
        'Environment:' \
        '  DOKUWIKI_VERSION  DokuWiki release version to test, default: 2025-05-14b' \
        '  DOKUWIKI_TAG      DokuWiki git ref name to download, default: release-${DOKUWIKI_VERSION}' \
        '  DOKUWIKI_REF_TYPE GitHub archive ref namespace: tags or heads, default: tags' \
        '  PHP_BIN           PHP binary to run, default: php' \
        '  SMOKE_PORT        local PHP server port, default: 8765' \
        '  SMOKE_WORKDIR     temporary work directory, default: /tmp/vector-dokuwiki-smoke' \
        '  VECTOR_SKIP_JS_SMOKE=1  skip the jsdom/jquery mobile menu smoke' \
        '  NODE_PATH         path containing jsdom and jquery for the mobile menu smoke'
    exit 0
fi

DOKUWIKI_VERSION="${DOKUWIKI_VERSION:-2025-05-14b}"
DOKUWIKI_TAG="${DOKUWIKI_TAG:-release-${DOKUWIKI_VERSION}}"
DOKUWIKI_REF_TYPE="${DOKUWIKI_REF_TYPE:-tags}"
PHP_BIN="${PHP_BIN:-php}"
SMOKE_PORT="${SMOKE_PORT:-8765}"
SMOKE_WORKDIR="${SMOKE_WORKDIR:-/tmp/vector-dokuwiki-smoke}"

case "$DOKUWIKI_REF_TYPE" in
    tags|heads) ;;
    *)
        printf 'Unsupported DOKUWIKI_REF_TYPE: %s\n' "$DOKUWIKI_REF_TYPE" >&2
        printf '%s\n' 'Use "tags" for releases or "heads" for branches.' >&2
        exit 2
        ;;
esac

if [ "${VECTOR_SKIP_JS_SMOKE:-0}" != "1" ]; then
    node -e "require.resolve('jsdom'); require.resolve('jquery');" >/dev/null 2>&1 || {
        printf '%s\n' \
            'Missing JS smoke dependencies: jsdom and jquery.' \
            'Install them and expose them through NODE_PATH, for example:' \
            '  npm install --prefix /tmp/vector-js-smoke jsdom jquery' \
            '  NODE_PATH=/tmp/vector-js-smoke/node_modules tests/dokuwiki-runtime-smoke.sh' >&2
        exit 1
    }
fi

rm -rf "$SMOKE_WORKDIR"
mkdir -p "$SMOKE_WORKDIR"

curl -fsSL \
    "https://github.com/dokuwiki/dokuwiki/archive/refs/${DOKUWIKI_REF_TYPE}/${DOKUWIKI_TAG}.zip" \
    -o "$SMOKE_WORKDIR/dokuwiki.zip"
unzip -q "$SMOKE_WORKDIR/dokuwiki.zip" -d "$SMOKE_WORKDIR"
dokuwiki_dir="$(find "$SMOKE_WORKDIR" -maxdepth 1 -type d -name "dokuwiki-*" | head -n 1)"
test -n "$dokuwiki_dir"

python3 tests/style-import-coverage.py "$dokuwiki_dir/lib/tpl/dokuwiki/style.ini" style.ini

rm -rf "$dokuwiki_dir/lib/tpl/modernizedvector"
mkdir -p "$dokuwiki_dir/lib/tpl/modernizedvector"
tar --exclude=".git" -cf - . | tar -xf - -C "$dokuwiki_dir/lib/tpl/modernizedvector"

DOKU_INC_SMOKE="$dokuwiki_dir/" VECTOR_VERSION="$(cat VERSION)" "$PHP_BIN" <<'PHP'
<?php
define('DOKU_INC', getenv('DOKU_INC_SMOKE'));
require DOKU_INC.'inc/init.php';

$extension = \dokuwiki\plugin\extension\Extension::createFromDirectory(DOKU_INC.'lib/tpl/modernizedvector');
$checks = array(
    'base' => array($extension->getBase(), 'modernizedvector'),
    'display name' => array($extension->getDisplayName(), 'Modernized Vector Template'),
    'installed version' => array($extension->getInstalledVersion(), getenv('VECTOR_VERSION')),
);
foreach ($checks as $label => $values) {
    if ($values[0] !== $values[1]) {
        fwrite(STDERR, 'Unexpected template metadata '.$label.': '.$values[0].PHP_EOL);
        exit(1);
    }
}
PHP

cat > "$dokuwiki_dir/conf/local.php" <<'PHP'
<?php
$conf['title'] = 'Vector CI';
$conf['template'] = 'modernizedvector';
$conf['useacl'] = 0;
$conf['breadcrumbs'] = 1;
$conf['youarehere'] = 1;
$conf['tpl']['modernizedvector']['vector_copyright_default'] = 0;
$conf['plugin']['translation']['translations'] = 'en de';
PHP

mkdir -p "$dokuwiki_dir/data/pages"
cat > "$dokuwiki_dir/data/pages/start.txt" <<'EOF'
====== Vector Smoke Page ======

This page exists so Vector-only print and citation views can exercise their
real page paths in the runtime smoke test.

===== First Section =====

Content for the table of contents.

===== Second Section =====

More content for the table of contents.

===== Third Section =====

Additional content for the table of contents.
EOF
mkdir -p "$dokuwiki_dir/data/pages/en" "$dokuwiki_dir/data/pages/wiki"
cat > "$dokuwiki_dir/data/pages/en/start.txt" <<'EOF'
====== Translated Vector Smoke Page ======

This page exercises translation plugin integration.
EOF
cat > "$dokuwiki_dir/data/pages/wiki/navigation.txt" <<'EOF'
  * [[start|Default Navigation]]
EOF
cat > "$dokuwiki_dir/data/pages/wiki/navigation_en.txt" <<'EOF'
  * [[en:start|Translated Navigation]]
EOF
cat > "$dokuwiki_dir/data/pages/wiki/site_notice_en.txt" <<'EOF'
Translated Site Notice
EOF
cat > "$dokuwiki_dir/data/pages/wiki/copyright_en.txt" <<'EOF'
Translated Copyright
EOF
cat > "$dokuwiki_dir/conf/acl.auth.php" <<'EOF'
* @ALL 1
EOF
cat > "$dokuwiki_dir/conf/users.auth.php" <<'EOF'
# users.auth.php
EOF
mkdir -p "$dokuwiki_dir/lib/plugins/translation"
cat > "$dokuwiki_dir/lib/plugins/translation/helper.php" <<'PHP'
<?php
use dokuwiki\Extension\Plugin;

class helper_plugin_translation extends Plugin
{
    public function getLangPart($id)
    {
        $translations = preg_split('/[\s,]+/', strtolower(trim((string)$this->getConf('translations'))), -1, PREG_SPLIT_NO_EMPTY);
        $parts = explode(':', cleanID($id), 2);
        if (count($parts) === 2 && in_array($parts[0], $translations, true)) {
            return $parts[0];
        }
        return '';
    }

    public function showTranslations($checkage = true)
    {
        return '<div class="plugin_translation"><ul><li><a href="/doku.php?id=en:start">English</a></li></ul></div>';
    }
}
PHP

server_pid=""
cleanup() {
    status=$?
    if [ -n "$server_pid" ]; then
        kill "$server_pid" 2>/dev/null || true
    fi
    if [ "$status" -ne 0 ]; then
        for log_file in "$SMOKE_WORKDIR"/*.log; do
            if [ -f "$log_file" ]; then
                printf '\n--- %s ---\n' "$log_file"
                cat "$log_file"
            fi
        done
    fi
    exit "$status"
}
trap cleanup EXIT

assert_no_php_diagnostics() {
    if grep -Ei 'fatal error|parse error|PHP (Warning|Deprecated|Notice|Fatal error)|Warning:|Deprecated:|Notice:' "$@"; then
        return 1
    fi
}

assert_rendered_html() {
    python3 tests/rendered-html-smoke.py "$@"
}

start_server() {
    log_file="$1"
    mkdir -p "$SMOKE_WORKDIR/php-sessions"
    "$PHP_BIN" \
        -d display_errors=1 \
        -d display_startup_errors=1 \
        -d error_reporting=E_ALL \
        -d "session.save_path=$SMOKE_WORKDIR/php-sessions" \
        -S "127.0.0.1:${SMOKE_PORT}" \
        -t "$dokuwiki_dir" >"$log_file" 2>&1 &
    server_pid="$!"
    sleep 2
}

stop_server() {
    if [ -n "$server_pid" ]; then
        kill "$server_pid" 2>/dev/null || true
        server_pid=""
    fi
}

fetch_action() {
    name="$1"
    url="$2"
    output="$SMOKE_WORKDIR/vector-${name}.html"

    curl -fsS "http://127.0.0.1:${SMOKE_PORT}/${url}" -o "$output"
    grep -q 'skin-vector' "$output"
    grep -q 'id="content"' "$output"
    grep -q 'id="dokuwiki__content"' "$output"
    assert_no_php_diagnostics "$output"
}

start_server "$SMOKE_WORKDIR/dokuwiki-server.log"

curl -fsS "http://127.0.0.1:${SMOKE_PORT}/doku.php?id=start" -o "$SMOKE_WORKDIR/vector-page.html"
grep -q 'skin-vector' "$SMOKE_WORKDIR/vector-page.html"
grep -q 'id="content"' "$SMOKE_WORKDIR/vector-page.html"
grep -q 'id="dokuwiki__content"' "$SMOKE_WORKDIR/vector-page.html"
grep -q 'id="p-search"' "$SMOKE_WORKDIR/vector-page.html"
assert_no_php_diagnostics "$SMOKE_WORKDIR/vector-page.html"

if [ "${VECTOR_SKIP_JS_SMOKE:-0}" != "1" ]; then
    node tests/mobile-menu-smoke.js "$SMOKE_WORKDIR/vector-page.html" script.js
fi

fetch_action edit 'doku.php?id=start&do=edit'
grep -q 'id="dw__editform"' "$SMOKE_WORKDIR/vector-edit.html"

fetch_action search 'doku.php?id=start&do=search&q=vector'
grep -Eq 'class="search_result"|id="dw__search"' "$SMOKE_WORKDIR/vector-search.html"

fetch_action recent 'doku.php?id=start&do=recent'
grep -q 'mode_recent' "$SMOKE_WORKDIR/vector-recent.html"

fetch_action index 'doku.php?id=start&do=index'
grep -q 'mode_index' "$SMOKE_WORKDIR/vector-index.html"

fetch_action media 'doku.php?id=start&do=media&ns=wiki'
grep -q 'mode_media' "$SMOKE_WORKDIR/vector-media.html"

fetch_action print 'doku.php?id=start&vecdo=print'
grep -q 'static/3rd/dokuwiki/print.css' "$SMOKE_WORKDIR/vector-print.html"
grep -q 'static/css/print.css' "$SMOKE_WORKDIR/vector-print.html"

fetch_action cite 'doku.php?id=start&vecdo=cite'
grep -q 'id="bibliographic_details"' "$SMOKE_WORKDIR/vector-cite.html"
grep -q 'id="citation_styles_for"' "$SMOKE_WORKDIR/vector-cite.html"
grep -q 'id="bibtex_entry"' "$SMOKE_WORKDIR/vector-cite.html"

fetch_action translation 'doku.php?id=en:start'
grep -q 'Translated Navigation' "$SMOKE_WORKDIR/vector-translation.html"
grep -q 'Translated Site Notice' "$SMOKE_WORKDIR/vector-translation.html"
grep -q 'Translated Copyright' "$SMOKE_WORKDIR/vector-translation.html"
grep -q 'id="p-lang"' "$SMOKE_WORKDIR/vector-translation.html"
grep -q 'plugin_translation' "$SMOKE_WORKDIR/vector-translation.html"

curl -fsS "http://127.0.0.1:${SMOKE_PORT}/lib/exe/mediamanager.php?ns=wiki" -o "$SMOKE_WORKDIR/vector-mediamanager.html"
grep -q 'id="media__manager"' "$SMOKE_WORKDIR/vector-mediamanager.html"
grep -q '<nav id="mediamgr__aside"' "$SMOKE_WORKDIR/vector-mediamanager.html"
grep -q '<main id="mediamgr__content"' "$SMOKE_WORKDIR/vector-mediamanager.html"
assert_no_php_diagnostics "$SMOKE_WORKDIR/vector-mediamanager.html"

curl -fsS "http://127.0.0.1:${SMOKE_PORT}/lib/exe/detail.php?id=start&media=wiki:dokuwiki-128.png" -o "$SMOKE_WORKDIR/vector-detail.html"
grep -q 'skin-vector' "$SMOKE_WORKDIR/vector-detail.html"
grep -q 'id="dokuwiki__detail"' "$SMOKE_WORKDIR/vector-detail.html"
grep -q 'This list might not be complete due to ACL restrictions and hidden pages.' "$SMOKE_WORKDIR/vector-detail.html"
assert_no_php_diagnostics "$SMOKE_WORKDIR/vector-detail.html"

curl -fsS "http://127.0.0.1:${SMOKE_PORT}/lib/exe/css.php?t=modernizedvector" -o "$SMOKE_WORKDIR/vector.css"
grep -q '#content' "$SMOKE_WORKDIR/vector.css"
assert_no_php_diagnostics "$SMOKE_WORKDIR/vector.css"

assert_rendered_html "$SMOKE_WORKDIR"/vector-{page,edit,search,recent,index,media,print,cite,translation,detail}.html

stop_server
assert_no_php_diagnostics "$SMOKE_WORKDIR/dokuwiki-server.log"

cat >> "$dokuwiki_dir/conf/local.php" <<'PHP'
$conf['useacl'] = 1;
$conf['tpl']['modernizedvector']['vector_closedwiki'] = 1;
PHP

start_server "$SMOKE_WORKDIR/dokuwiki-closedwiki-server.log"

curl -fsS "http://127.0.0.1:${SMOKE_PORT}/doku.php?id=start" -o "$SMOKE_WORKDIR/vector-closedwiki-page.html"
grep -q 'skin-vector' "$SMOKE_WORKDIR/vector-closedwiki-page.html"
grep -q 'id="content"' "$SMOKE_WORKDIR/vector-closedwiki-page.html"
grep -Eq "id=['\"]pt-login" "$SMOKE_WORKDIR/vector-closedwiki-page.html"
grep -Eq "id=['\"]p-login" "$SMOKE_WORKDIR/vector-closedwiki-page.html"
! grep -Eq "id=['\"]ca-edit" "$SMOKE_WORKDIR/vector-closedwiki-page.html"
! grep -Eq "id=['\"]p-tb" "$SMOKE_WORKDIR/vector-closedwiki-page.html"
assert_no_php_diagnostics "$SMOKE_WORKDIR/vector-closedwiki-page.html"
assert_rendered_html "$SMOKE_WORKDIR/vector-closedwiki-page.html"

stop_server
assert_no_php_diagnostics "$SMOKE_WORKDIR/dokuwiki-closedwiki-server.log"

cat >> "$dokuwiki_dir/conf/local.php" <<'PHP'
$conf['useacl'] = 0;
$conf['tpl']['modernizedvector']['vector_closedwiki'] = 0;
$conf['lang'] = 'he';
PHP

start_server "$SMOKE_WORKDIR/dokuwiki-rtl-server.log"

curl -fsS "http://127.0.0.1:${SMOKE_PORT}/doku.php?id=start" -o "$SMOKE_WORKDIR/vector-rtl-page.html"
grep -q '<html lang="he" dir="rtl"' "$SMOKE_WORKDIR/vector-rtl-page.html"
grep -q 'class="[^"]*rtl[^"]*skin-vector' "$SMOKE_WORKDIR/vector-rtl-page.html"
grep -q 'static/3rd/vector/main-rtl.css' "$SMOKE_WORKDIR/vector-rtl-page.html"
grep -q 'static/css/rtl.css' "$SMOKE_WORKDIR/vector-rtl-page.html"
assert_no_php_diagnostics "$SMOKE_WORKDIR/vector-rtl-page.html"

curl -fsS "http://127.0.0.1:${SMOKE_PORT}/lib/exe/mediamanager.php?ns=wiki" -o "$SMOKE_WORKDIR/vector-rtl-mediamanager.html"
grep -q '<html lang="he" dir="rtl" class="no-js popup"' "$SMOKE_WORKDIR/vector-rtl-mediamanager.html"
grep -q 'static/3rd/vector/main-rtl.css' "$SMOKE_WORKDIR/vector-rtl-mediamanager.html"
grep -q 'static/css/rtl.css' "$SMOKE_WORKDIR/vector-rtl-mediamanager.html"
assert_no_php_diagnostics "$SMOKE_WORKDIR/vector-rtl-mediamanager.html"
assert_rendered_html "$SMOKE_WORKDIR/vector-rtl-page.html" "$SMOKE_WORKDIR/vector-rtl-mediamanager.html"

stop_server
assert_no_php_diagnostics "$SMOKE_WORKDIR/dokuwiki-rtl-server.log"

cat >> "$dokuwiki_dir/conf/local.php" <<'PHP'
$conf['lang'] = 'en';
$conf['tpl']['modernizedvector']['vector_skin_version'] = '2022';
PHP

start_server "$SMOKE_WORKDIR/dokuwiki-2022-server.log"

curl -fsS "http://127.0.0.1:${SMOKE_PORT}/doku.php?id=start" -o "$SMOKE_WORKDIR/vector-2022-page.html"
grep -q 'skin-vector-2022' "$SMOKE_WORKDIR/vector-2022-page.html"
grep -q 'data-vector-skin-version="2022"' "$SMOKE_WORKDIR/vector-2022-page.html"
grep -q 'vector-header-container' "$SMOKE_WORKDIR/vector-2022-page.html"
grep -q 'class="mw-logo"' "$SMOKE_WORKDIR/vector-2022-page.html"
grep -q 'vector-page-titlebar' "$SMOKE_WORKDIR/vector-2022-page.html"
grep -q 'vector-main-menu-landmark' "$SMOKE_WORKDIR/vector-2022-page.html"
grep -q 'vector-menu mw-portlet mw-portlet-navigation' "$SMOKE_WORKDIR/vector-2022-page.html"
grep -q 'id="p-toc"' "$SMOKE_WORKDIR/vector-2022-page.html"
grep -q 'id="p-appearance"' "$SMOKE_WORKDIR/vector-2022-page.html"
grep -q 'data-vector-appearance' "$SMOKE_WORKDIR/vector-2022-page.html"
assert_no_php_diagnostics "$SMOKE_WORKDIR/vector-2022-page.html"

curl -fsS "http://127.0.0.1:${SMOKE_PORT}/lib/exe/css.php?t=modernizedvector" -o "$SMOKE_WORKDIR/vector-2022.css"
grep -q 'skin-vector-2022' "$SMOKE_WORKDIR/vector-2022.css"
grep -q 'vector-header-container' "$SMOKE_WORKDIR/vector-2022.css"
grep -q 'vector-page-titlebar' "$SMOKE_WORKDIR/vector-2022.css"
grep -q 'vector-feature-color-dark' "$SMOKE_WORKDIR/vector-2022.css"
assert_no_php_diagnostics "$SMOKE_WORKDIR/vector-2022.css"

assert_rendered_html "$SMOKE_WORKDIR/vector-2022-page.html"
if [ "${VECTOR_SKIP_JS_SMOKE:-0}" != "1" ]; then
    node tests/mobile-menu-smoke.js "$SMOKE_WORKDIR/vector-2022-page.html" script.js
fi

stop_server
assert_no_php_diagnostics "$SMOKE_WORKDIR/dokuwiki-2022-server.log"

printf 'DokuWiki %s runtime smoke passed: %s\n' "$DOKUWIKI_VERSION" "$dokuwiki_dir"
