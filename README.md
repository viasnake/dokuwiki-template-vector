# Modernized Vector Template

Modernized Vector brings the legacy MediaWiki/Wikipedia Vector 2010 look and
feel to current DokuWiki releases. It is a mostly optical port of the original
MediaWiki Vector skin and intentionally tracks Vector 2010, not the newer
MediaWiki Vector 2022 skin.

## Requirements

This maintained version targets actively maintained DokuWiki releases and
supports PHP 7.4 or newer. The repository smoke test currently verifies DokuWiki
2025-05-14b "Librarian" with PHP 7.4, 8.2, and 8.4.

Legacy Internet Explorer workarounds have been removed. The template targets
current evergreen browsers supported by current DokuWiki.

## Installation

Install the template as described on the DokuWiki template documentation:
<https://www.dokuwiki.org/template>.

1. Download a release archive.
2. Extract it into your DokuWiki `lib/tpl/` directory.
3. Make sure the final path is `lib/tpl/modernizedvector/`.
4. Select `modernizedvector` in DokuWiki's Config Manager by changing the
   `template` option.

If you install from a GitHub source archive, rename the extracted directory to
`modernizedvector` before enabling it.

## Updating

Keep site-local customizations in `lib/tpl/modernizedvector/user/`. Files in
that directory are meant to survive template updates, while bundled template
files can be replaced by the next release.

Before publishing a release, maintainers should keep `template.info.txt` and
`VERSION` in sync. DokuWiki Extension Manager uses those fields for release
detection.

## Customization

The template includes `.dist` examples in `user/`. Remove the `.dist` suffix to
turn an example into an active local customization.

### Include Hooks

DokuWiki include hooks are supported through `tpl_includeFile()`. For
upgrade-safe site-local markup, place optional files in your DokuWiki `conf`
directory or in `lib/tpl/modernizedvector`.

Supported hook file names are `meta.html`, `topheader.html`, `header.html`,
`pageheader.html`, `pagefooter.html`, `sidebarheader.html`,
`sidebarfooter.html`, and `footer.html`.

### Logo and Icons

To replace the default logo, create one of these files in
`modernizedvector/user/`:

- `logo.svg`
- `logo.png`
- `logo.gif`
- `logo.jpg`

If no user logo exists, the template also checks DokuWiki media files at
`:wiki:logo.[svg|png|gif|jpg]` and `:logo.[svg|png|gif|jpg]`.

To replace the favicon, create `favicon.svg`, `favicon.png`, or `favicon.ico`
in `modernizedvector/user/`. If no user favicon exists, the template also
checks `:wiki:favicon.[svg|png|ico]` and `:favicon.[svg|png|ico]`.

To replace the Apple Touch Icon, create `apple-touch-icon.png` in
`modernizedvector/user/`. If no user icon exists, the template also checks
`:wiki:apple-touch-icon.png` and `:apple-touch-icon.png`.

Clear your browser cache if a replaced image does not appear immediately.

## CSS and JavaScript

Use these files for site-local styling:

- `modernizedvector/user/screen.css` for the normal layout.
- `modernizedvector/user/print.css` for print styles.
- `modernizedvector/user/rtl.css` for right-to-left languages.
- `modernizedvector/lang/<language>/style.css` for language-specific styles.

User CSS is loaded after the bundled template styles, so it can override the
default rules.

To load custom JavaScript, create `modernizedvector/user/user.js`. When
DokuWiki's `defer_js` option is enabled, this file is loaded with `defer` as
well, preserving the normal DokuWiki JavaScript execution order.

Custom JavaScript is disabled by default. Enable the `vector_loaduserjs` option
in DokuWiki's Config Manager before relying on `user/user.js`.

## PHP Customization Files

The files in `modernizedvector/user/*.php` are trusted administrator-provided
PHP snippets. Do not copy untrusted user input into them.

Available customization files:

- `user/tabs.php` for page tabs.
- `user/buttons.php` for footer buttons.
- `user/boxes.php` for sidebar boxes.
- `user/tracker.php` for analytics snippets such as Matomo or Google Analytics.

For tabs and footer buttons, keep element IDs, labels, URLs, image paths, CSS
classes, access keys, widths, and heights as simple scalar values. Malformed
values are ignored by the template.

`user/tracker.php` is emitted as raw PHP/HTML. Keep it writable only by trusted
administrators.

## Privacy Notes

The QR code box uses an external QR code service and sends the current page URL
to that service. It is disabled by default; enable the `vector_qrcodebox` option
only when this is acceptable for your wiki.

Analytics tools normally require a snippet that contacts a third-party service.
Review your privacy requirements before enabling `user/tracker.php`.

## Support and Contributions

For general DokuWiki template help, start with these resources:

- FAQ: <https://www.dokuwiki.org/template:vector#faq>
- DokuWiki search: <https://www.dokuwiki.org/?do=search>
- DokuWiki forum: <https://forum.dokuwiki.org/>
- DokuWiki IRC: <https://www.dokuwiki.org/irc>

For this maintained fork, use GitHub issues and pull requests:
<https://github.com/viasnake/dokuwiki-template-vector/issues>.

Please follow the DokuWiki coding style when submitting patches:
<https://www.dokuwiki.org/devel:coding_style>.

## License and Credits

This template is distributed under GPL-2.0. See [COPYING](COPYING).

See [CREDITS](CREDITS) for acknowledgements and historical notes.

## Repository Layout

- `conf/`: default template configuration and Config Manager metadata.
- `lang/`: runtime language files, settings labels, and optional
  language-specific CSS.
- `static/3rd/`: third-party files from MediaWiki Vector and DokuWiki
  templates.
- `static/css/`: template-owned CSS.
- `static/img/`: template-owned images.
- `static/mobile.less`: mobile stylesheet source.
- `user/`: upgrade-safe local customization examples.
- `tests/`: maintainer-facing policy and smoke tests.

## Maintainer Checks

Run the narrowest relevant checks for the files you changed:

- `git diff --check`
- `python3 tests/release-metadata.py` after release metadata changes.
- `python3 tests/release-tree-policy.py` before packaging a release.
- `php -l` over changed PHP files, ideally with each PHP version used in CI.
- `python3 tests/php74-compatibility.py` when PHP files change.
- `node --check script.js` and `node --check tests/mobile-menu-smoke.js` when
  JavaScript changes.
- `python3 tests/language-coverage.py` when configuration or language files
  change.
- `python3 tests/rendered-html-smoke.py <rendered-html> [...]` when template
  markup changes.
- `python3 tests/style-import-coverage.py <dokuwiki-style.ini> style.ini` when
  bundled DokuWiki component styles or `style.ini` change.
- `lessc static/mobile.less` with the same replacement variables as CI when
  mobile styles change.
- `bash -n tests/dokuwiki-runtime-smoke.sh` when the runtime smoke script
  changes.
- `tests/dokuwiki-runtime-smoke.sh` against the current stable DokuWiki
  release before publishing.

The runtime smoke test renders normal pages, core action modes, media detail
pages, the media manager popup, `css.php` output, right-to-left language output,
and the mobile menu JavaScript smoke. The JavaScript smoke needs `jsdom` and
`jquery` in Node's module path; CI installs them into `/tmp/vector-js-smoke`.

Useful local environment variables:

- `NODE_PATH=/tmp/vector-js-smoke/node_modules` to point the smoke test at local
  JavaScript dependencies.
- `PHP_BIN` to choose a PHP binary.
- `SMOKE_PORT` or `SMOKE_WORKDIR` when the defaults conflict with your
  environment.
- `VECTOR_SKIP_JS_SMOKE=1` only when you intentionally want to run the
  PHP/runtime checks without the mobile menu JavaScript smoke.
- `DOKUWIKI_REF_TYPE=heads DOKUWIKI_TAG=master` for exploratory future-version
  checks against a branch archive.

Compatibility policy:

- Prefer current DokuWiki template APIs such as `tpl_incdir()`, `tpl_basedir()`,
  `tpl_includeFile()`, `tpl_metaheaders()`, `tpl_content()`, and
  `tpl_getMediaFile()`.
- Do not reintroduce deprecated `DOKU_TPLINC` or `DOKU_TPL` usage.
- Do not reintroduce legacy Internet Explorer conditionals, HTC behaviors, or
  CSS hacks.
- Treat PHP files in `modernizedvector/user` as trusted
  administrator-provided configuration, and validate template-managed scalar
  values before emitting HTML attributes.
