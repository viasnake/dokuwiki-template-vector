#!/usr/bin/env python3
"""Flag common PHP 8+ syntax and APIs while the template supports PHP 7.4."""

from pathlib import Path
import re
import sys


REPO = Path(__file__).resolve().parents[1]
PHP8_FUNCTIONS = {
    "array_is_list",
    "enum_exists",
    "str_contains",
    "str_ends_with",
    "str_starts_with",
}


def php_files():
    for path in sorted(REPO.rglob("*")):
        if ".git" in path.parts:
            continue
        if path.suffix == ".php" or path.name.endswith(".php.dist"):
            yield path


def strip_comments_and_strings(source):
    output = []
    i = 0
    length = len(source)
    state = "code"
    heredoc_label = None

    while i < length:
        char = source[i]
        nxt = source[i + 1] if i + 1 < length else ""

        if state == "code":
            if char == "/" and nxt == "/":
                state = "line_comment"
                output.append("  ")
                i += 2
                continue
            if char == "#":
                state = "line_comment"
                output.append(" ")
                i += 1
                continue
            if char == "/" and nxt == "*":
                state = "block_comment"
                output.append("  ")
                i += 2
                continue
            if char == "'":
                state = "single"
                output.append(" ")
                i += 1
                continue
            if char == '"':
                state = "double"
                output.append(" ")
                i += 1
                continue
            if source.startswith("<<<", i):
                match = re.match(r"<<<['\"]?([A-Za-z_][A-Za-z0-9_]*)['\"]?", source[i:])
                if match:
                    heredoc_label = match.group(1)
                    state = "heredoc"
                    output.append(" " * match.end())
                    i += match.end()
                    continue
            output.append(char)
            i += 1
            continue

        if state == "line_comment":
            if char == "\n":
                state = "code"
                output.append("\n")
            else:
                output.append(" ")
            i += 1
            continue

        if state == "block_comment":
            if char == "*" and nxt == "/":
                state = "code"
                output.append("  ")
                i += 2
            else:
                output.append("\n" if char == "\n" else " ")
                i += 1
            continue

        if state == "single":
            if char == "\\":
                output.append("  ")
                i += 2
                continue
            if char == "'":
                state = "code"
            output.append("\n" if char == "\n" else " ")
            i += 1
            continue

        if state == "double":
            if char == "\\":
                output.append("  ")
                i += 2
                continue
            if char == '"':
                state = "code"
            output.append("\n" if char == "\n" else " ")
            i += 1
            continue

        if state == "heredoc":
            line_end = source.find("\n", i)
            if line_end == -1:
                line = source[i:]
                line_end = length
            else:
                line = source[i:line_end]

            if heredoc_label is not None and re.fullmatch(r"\s*" + re.escape(heredoc_label) + r";?\s*", line):
                state = "code"
                heredoc_label = None
            output.append(" " * len(line))
            if line_end < length:
                output.append("\n")
            i = line_end + 1

    return "".join(output)


def line_number(source, position):
    return source.count("\n", 0, position) + 1


def check_file(path):
    source = path.read_text(encoding="utf-8-sig")
    code = strip_comments_and_strings(source)
    errors = []

    checks = [
        (r"\?->", "nullsafe operator requires PHP 8.0"),
        (r"\#\[", "attributes require PHP 8.0"),
        (r"\bmatch\s*\(", "match expression requires PHP 8.0"),
        (r"\benum\s+[A-Za-z_]", "enums require PHP 8.1"),
        (r"\breadonly\s+(?:class|\$|[A-Za-z_])", "readonly requires PHP 8.1 or 8.2"),
        (r"\b[a-zA-Z_][A-Za-z0-9_]*\s*\(\s*\.\.\.\s*\)", "first-class callable syntax requires PHP 8.1"),
        (r"\b[A-Za-z_][A-Za-z0-9_]*\s*\([^;{}()]*\b[A-Za-z_][A-Za-z0-9_]*\s*:", "named arguments require PHP 8.0"),
        (r"\)\s*:\s*static\b", "static return type requires PHP 8.0"),
        (r"\)\s*:\s*mixed\b|\bmixed\s+\$", "mixed type requires PHP 8.0"),
        (r"\)\s*:\s*never\b", "never return type requires PHP 8.1"),
    ]
    for pattern, message in checks:
        for match in re.finditer(pattern, code):
            errors.append((line_number(code, match.start()), message))

    for function_name in sorted(PHP8_FUNCTIONS):
        pattern = r"(?<!->)(?<!::)\b" + re.escape(function_name) + r"\s*\("
        for match in re.finditer(pattern, code):
            errors.append((line_number(code, match.start()), f"{function_name}() requires PHP 8.0+"))

    union_type_pattern = re.compile(
        r"(?:function\s+[A-Za-z_][A-Za-z0-9_]*\s*\([^)]*|"
        r"\)\s*:\s*|"
        r"(?:public|protected|private)\s+)"
        r"[^;{()}]*\|[^;{()}]*[$A-Za-z_]"
    )
    for match in union_type_pattern.finditer(code):
        errors.append((line_number(code, match.start()), "union types require PHP 8.0"))

    return errors


def main():
    failed = False
    for path in php_files():
        errors = check_file(path)
        if not errors:
            continue
        failed = True
        relpath = path.relative_to(REPO)
        for line, message in errors:
            print(f"{relpath}:{line}: {message}", file=sys.stderr)

    if failed:
        return 1

    print("PHP 7.4 compatibility policy passed")
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
