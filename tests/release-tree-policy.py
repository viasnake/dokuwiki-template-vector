#!/usr/bin/env python3
"""Check release tree hygiene and required DokuWiki template files."""

from pathlib import Path
import fnmatch
import re
import sys


REPO = Path(__file__).resolve().parents[1]
FORBIDDEN_NAMES = {"__pycache__", ".DS_Store", "Thumbs.db"}
FORBIDDEN_PATTERNS = ["*.pyc", "*.pyo", "*.bak", "*.orig", "*.rej", "*~"]
FORBIDDEN_TEXT = {
    "style" ".local.ini": "use conf/tpl/modernizedvector/style.ini for local style overrides",
}
REQUIRED_FILES = [
    ".htaccess",
    "COPYING",
    "README",
    "VERSION",
    ".github/workflows/ci.yml",
    "deleted.files",
    "template.info.txt",
    "style.ini",
    "main.php",
    "detail.php",
    "mediamanager.php",
    "script.js",
    "conf/default.php",
    "conf/metadata.php",
    "conf/boxes.php",
    "conf/buttons.php",
    "conf/tabs.php",
    "lang/en/lang.php",
    "lang/en/settings.php",
    "static/css/screen.css",
    "static/css/print.css",
    "static/css/rtl.css",
    "static/mobile.less",
    "user/screen.css.dist",
    "user/print.css.dist",
    "user/rtl.css.dist",
    "user/user.js.dist",
    "user/tracker.php.dist",
    "tests/.htaccess",
    "tests/dokuwiki-runtime-smoke.sh",
    "tests/language-coverage.py",
    "tests/mobile-menu-smoke.js",
    "tests/php74-compatibility.py",
    "tests/release-metadata.py",
    "tests/release-tree-policy.py",
    "tests/rendered-html-smoke.py",
    "tests/style-import-coverage.py",
]
EXECUTABLE_FILES = [
    "tests/dokuwiki-runtime-smoke.sh",
]


def iter_paths():
    for path in REPO.rglob("*"):
        if ".git" in path.parts:
            continue
        yield path


def check_deleted_files(errors):
    deleted = REPO / "deleted.files"
    if not deleted.is_file():
        errors.append("deleted.files is missing")
        return

    for lineno, line in enumerate(deleted.read_text(encoding="utf-8").splitlines(), 1):
        entry = line.strip()
        if not entry:
            continue
        if entry.startswith("/") or ".." in Path(entry).parts:
            errors.append(f"deleted.files:{lineno}: unsafe path {entry!r}")
            continue
        if (REPO / entry).exists():
            errors.append(f"deleted.files:{lineno}: entry still exists in release tree: {entry}")


def check_htaccess_files(errors):
    for path in sorted(REPO.rglob(".htaccess")):
        if ".git" in path.parts:
            continue
        relpath = path.relative_to(REPO)
        text = path.read_text(encoding="utf-8")
        if "Order Deny,Allow" in text:
            errors.append(f"{relpath}: uses obsolete Apache 2.2-only Order Deny,Allow")
        if "Deny from all" in text and "Require all denied" not in text:
            errors.append(f"{relpath}: Deny from all should include Apache 2.4 Require all denied")
        if "Require all denied" in text and "Order allow,deny" not in text:
            errors.append(f"{relpath}: Require all denied should keep Apache 2.2 fallback")


def check_forbidden_text(errors):
    text_suffixes = {".css", ".dist", ".ini", ".js", ".less", ".php", ".py", ".sh", ".txt", ".yml"}
    text_names = {"README", "VERSION", "deleted.files"}
    for path in iter_paths():
        if not path.is_file():
            continue
        relpath = path.relative_to(REPO)
        if path.suffix not in text_suffixes and path.name not in text_names:
            continue
        text = path.read_text(encoding="utf-8")
        for needle, replacement in FORBIDDEN_TEXT.items():
            if needle in text:
                errors.append(f"{relpath}: obsolete text {needle!r}; {replacement}")


def check_php_url_escaping(errors):
    pattern = re.compile(r"hsc\s*\(\s*wl\s*\(")
    for path in iter_paths():
        if not path.is_file() or path.suffix not in {".php", ".dist"}:
            continue
        relpath = path.relative_to(REPO)
        text = path.read_text(encoding="utf-8")
        for match in pattern.finditer(text):
            line = text.count("\n", 0, match.start()) + 1
            errors.append(
                f"{relpath}:{line}: use _vector_wl() before hsc() to avoid double-escaped URL attributes"
            )


def check_php_regex_literals(errors):
    pattern = re.compile(r'preg_match\s*\(\s*"[^"]*\\x00')
    for path in iter_paths():
        if not path.is_file() or path.suffix not in {".php", ".dist"}:
            continue
        relpath = path.relative_to(REPO)
        text = path.read_text(encoding="utf-8")
        for match in pattern.finditer(text):
            line = text.count("\n", 0, match.start()) + 1
            errors.append(
                f"{relpath}:{line}: avoid double-quoted PHP regex strings with \\x00; PHP 7.4 passes a NUL byte to PCRE"
            )


def main():
    errors = []

    for required in REQUIRED_FILES:
        if not (REPO / required).is_file():
            errors.append(f"required release file is missing: {required}")

    for executable in EXECUTABLE_FILES:
        path = REPO / executable
        if not path.is_file():
            errors.append(f"required executable file is missing: {executable}")
        elif path.stat().st_mode & 0o111 == 0:
            errors.append(f"required executable bit is missing: {executable}")

    for path in iter_paths():
        relpath = path.relative_to(REPO)
        if path.name in FORBIDDEN_NAMES:
            errors.append(f"forbidden generated artifact: {relpath}")
        for pattern in FORBIDDEN_PATTERNS:
            if fnmatch.fnmatch(path.name, pattern):
                errors.append(f"forbidden generated artifact: {relpath}")

    check_deleted_files(errors)
    check_htaccess_files(errors)
    check_forbidden_text(errors)
    check_php_url_escaping(errors)
    check_php_regex_literals(errors)

    if errors:
        for error in errors:
            print(error, file=sys.stderr)
        return 1

    print("Release tree policy passed")
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
