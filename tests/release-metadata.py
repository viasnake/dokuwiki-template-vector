#!/usr/bin/env python3
"""Validate release metadata consumed by DokuWiki Extension Manager."""

from pathlib import Path
import re
import sys


REPO = Path(__file__).resolve().parents[1]
REQUIRED_FIELDS = ["base", "author", "date", "name", "desc", "url"]


def read_info(path):
    info = {}
    for lineno, line in enumerate(path.read_text(encoding="utf-8").splitlines(), 1):
        stripped = line.strip()
        if not stripped:
            continue
        parts = stripped.split(None, 1)
        if len(parts) != 2:
            raise ValueError(f"{path.name}:{lineno}: expected '<key> <value>'")
        info[parts[0]] = parts[1].strip()
    return info


def main():
    errors = []
    try:
        info = read_info(REPO / "template.info.txt")
    except ValueError as error:
        errors.append(str(error))
        info = {}

    missing = [key for key in REQUIRED_FIELDS if not info.get(key)]
    if missing:
        errors.append("template.info.txt is missing fields: " + ", ".join(missing))

    if info.get("base") != "modernizedvector":
        errors.append("template.info.txt base must be modernizedvector")

    if info.get("author") != "viasnake":
        errors.append("template.info.txt author must be viasnake")

    version = (REPO / "VERSION").read_text(encoding="utf-8").strip()
    if info.get("date") != version:
        errors.append(f"template.info.txt date {info.get('date', '')} does not match VERSION {version}")

    if not re.fullmatch(r"\d{4}-\d{2}-\d{2}", version):
        errors.append("VERSION must use YYYY-MM-DD format")

    if "phpmin" in info:
        errors.append("template.info.txt should not declare phpmin")

    if info.get("url") != "https://github.com/viasnake/dokuwiki-template-vector":
        errors.append("url should point to the maintained GitHub project")

    if info.get("desc") and "Vector 2010" not in info["desc"]:
        errors.append("desc should make the legacy Vector 2010 target explicit")

    if errors:
        for error in errors:
            print(error, file=sys.stderr)
        return 1

    print("Release metadata passed")
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
