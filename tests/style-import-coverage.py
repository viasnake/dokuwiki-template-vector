#!/usr/bin/env python3
"""Check that bundled DokuWiki component styles track the current template."""

from pathlib import Path
import sys


REPO = Path(__file__).resolve().parents[1]
CORE_LAYOUT_STYLES = {
    "css/basic.less",
    "css/structure.less",
    "css/design.less",
    "css/usertools.less",
    "css/pagetools.less",
    "css/content.less",
    "css/mobile.less",
}


def parse_stylesheets(path):
    stylesheets = []
    in_stylesheets = False
    for line in Path(path).read_text(encoding="utf-8").splitlines():
        stripped = line.strip()
        if not stripped or stripped.startswith(";"):
            continue
        if stripped == "[stylesheets]":
            in_stylesheets = True
            continue
        if stripped.startswith("["):
            in_stylesheets = False
            continue
        if in_stylesheets and "=" in stripped:
            stylesheets.append(stripped.split("=", 1)[0].strip())
    return stylesheets


def vector_import_for_core_style(core_style):
    if core_style in CORE_LAYOUT_STYLES:
        return None
    if not core_style.startswith("css/"):
        return None

    name = core_style.removeprefix("css/")
    if not (name.startswith("_") or name == "print.css"):
        return None

    return "static/3rd/dokuwiki/" + Path(name).with_suffix(".css").name


def main():
    if len(sys.argv) != 3:
        print(
            "Usage: tests/style-import-coverage.py <dokuwiki-style.ini> <vector-style.ini>",
            file=sys.stderr,
        )
        return 2

    core_style_ini = Path(sys.argv[1])
    vector_style_ini = Path(sys.argv[2])
    vector_stylesheets = set(parse_stylesheets(vector_style_ini))

    required = []
    for core_style in parse_stylesheets(core_style_ini):
        vector_style = vector_import_for_core_style(core_style)
        if vector_style is not None:
            required.append(vector_style)

    errors = []
    for vector_style in required:
        if vector_style not in vector_stylesheets:
            errors.append(f"style.ini does not import {vector_style}")
        if not (REPO / vector_style).is_file():
            errors.append(f"imported DokuWiki component is missing: {vector_style}")

    for vector_style in sorted(
        style for style in vector_stylesheets if style.startswith("static/3rd/dokuwiki/")
    ):
        if vector_style not in required:
            errors.append(f"style.ini imports a DokuWiki component no longer present upstream: {vector_style}")

    if errors:
        for error in errors:
            print(error, file=sys.stderr)
        return 1

    print("DokuWiki style import coverage passed")
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
