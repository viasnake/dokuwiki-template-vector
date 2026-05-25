#!/usr/bin/env python3
"""Check rendered Vector HTML for structural regressions."""

from html.parser import HTMLParser
from pathlib import Path
import sys


class RenderedHtmlParser(HTMLParser):
    def __init__(self):
        super().__init__()
        self.body_attrs = {}
        self.html_attrs = {}
        self.ids = []
        self.image_sources = []
        self.main_count = 0
        self.skip_targets = []
        self.url_attrs = []

    def handle_starttag(self, tag, attrs):
        attr_map = dict(attrs)
        if "id" in attr_map:
            self.ids.append(attr_map["id"])
        for attr_name in ["action", "href", "src"]:
            if attr_name in attr_map:
                self.url_attrs.append((tag, attr_name, attr_map[attr_name]))
        if tag == "a" and "skiplink" in attr_map.get("class", "").split():
            self.skip_targets.append(attr_map.get("href", ""))
        if tag == "img":
            self.image_sources.append(attr_map.get("src", ""))
        if tag == "main":
            self.main_count += 1
        if tag == "html":
            self.html_attrs = attr_map
        if tag == "body":
            self.body_attrs = attr_map


def check_file(path):
    parser = RenderedHtmlParser()
    parser.feed(Path(path).read_text(encoding="utf-8", errors="replace"))

    errors = []
    seen = set()
    duplicates = []
    for html_id in parser.ids:
        if html_id in seen:
            duplicates.append(html_id)
        seen.add(html_id)

    if duplicates:
        errors.append("duplicate id values: " + ", ".join(sorted(set(duplicates))))

    double_escaped_urls = [
        f"{tag}[{attr_name}]={value!r}"
        for tag, attr_name, value in parser.url_attrs
        if "&amp;" in value
    ]
    if double_escaped_urls:
        errors.append("double-escaped URL attributes: " + ", ".join(double_escaped_urls[:5]))

    for target in parser.skip_targets:
        if not target.startswith("#") or target[1:] not in seen:
            errors.append(f"skiplink target is missing: {target!r}")

    body_classes = set(parser.body_attrs.get("class", "").split())
    if "skin-vector" in body_classes:
        if parser.main_count != 1:
            errors.append(f"expected exactly one <main> element, found {parser.main_count}")
        for required_id in ["content", "dokuwiki__content", "screen__mode"]:
            if required_id not in seen:
                errors.append(f"missing required id: {required_id}")
        if not any("taskrunner.php" in src for src in parser.image_sources):
            errors.append("missing DokuWiki taskrunner image from tpl_indexerWebBug()")

    if parser.html_attrs.get("dir") not in {"ltr", "rtl"}:
        errors.append("html dir must be ltr or rtl")
    if not parser.html_attrs.get("lang"):
        errors.append("html lang must be present")

    return errors


def main():
    if len(sys.argv) < 2:
        print("Usage: tests/rendered-html-smoke.py <html> [...]", file=sys.stderr)
        return 2

    failed = False
    for path in sys.argv[1:]:
        errors = check_file(path)
        if errors:
            failed = True
            print(f"{path}:", file=sys.stderr)
            for error in errors:
                print(f"  - {error}", file=sys.stderr)

    if failed:
        return 1

    print("Rendered HTML structure smoke passed")
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
