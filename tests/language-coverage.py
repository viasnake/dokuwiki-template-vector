#!/usr/bin/env python3
"""Check Vector template language/config key coverage."""

from pathlib import Path
import re
import sys


REPO = Path(__file__).resolve().parents[1]
LANG_MISSING_ALLOWLIST = {
    "he": "Legacy Hebrew language file is intentionally kept empty because the old file was invalid UTF-8.",
}
METADATA_TYPES = {"multichoice", "onoff", "string"}
MULTICHOICE_SETTINGS = {
    "vector_toc_position": ["article", "sidebar"],
    "vector_skin_version": ["2011", "2022"],
    "vector_breadcrumbs_position": ["top", "bottom"],
    "vector_youarehere_position": ["top", "bottom"],
}


def php_array_keys(path, variable):
    text = path.read_text(encoding="utf-8-sig")
    pattern = re.compile(r"\$" + re.escape(variable) + r"\s*\[\s*['\"]([^'\"]+)['\"]\s*\]")
    return set(pattern.findall(text))


def parse_default_values(path):
    defaults = {}
    assignment = re.compile(r"\$conf\s*\[\s*['\"]([^'\"]+)['\"]\s*\]\s*=\s*(.*?);")
    for key, raw_value in assignment.findall(path.read_text(encoding="utf-8-sig")):
        raw_value = raw_value.strip()
        if raw_value in {"0", "1"}:
            defaults[key] = int(raw_value)
            continue
        quoted = re.fullmatch(r'"((?:\\.|[^"\\])*)"', raw_value)
        if quoted:
            defaults[key] = decode_php_string(quoted.group(1))
            continue
        quoted = re.fullmatch(r"'((?:\\.|[^'\\])*)'", raw_value)
        if quoted:
            defaults[key] = decode_php_string(quoted.group(1))
            continue
        defaults[key] = raw_value
    return defaults


def parse_metadata(path):
    metadata = {}
    assignment = re.compile(r"\$meta\s*\[\s*['\"]([^'\"]+)['\"]\s*\]\s*=\s*array\((.*?)\);")
    for key, raw_meta in assignment.findall(path.read_text(encoding="utf-8-sig")):
        type_match = re.match(r"\s*['\"]([^'\"]+)['\"]", raw_meta)
        if not type_match:
            metadata[key] = {"type": ""}
            continue

        details = {"type": type_match.group(1)}

        pattern_match = re.search(r"['_\"]_pattern['_\"]\s*=>\s*(['\"])((?:\\.|(?!\1).)*)\1", raw_meta)
        if pattern_match:
            details["pattern"] = decode_php_string(pattern_match.group(2))

        choices_match = re.search(r"['_\"]_choices['_\"]\s*=>\s*array\((.*?)\)", raw_meta)
        if choices_match:
            details["choices"] = re.findall(r"['\"]([^'\"]+)['\"]", choices_match.group(1))

        metadata[key] = details
    return metadata


def decode_php_string(value):
    escapes = {
        r"\\": "\\",
        r"\'": "'",
        r'\"': '"',
        r"\n": "\n",
        r"\r": "\r",
        r"\t": "\t",
        r"\$": "$",
    }

    return re.sub(r"\\.", lambda match: escapes.get(match.group(0), match.group(0)), value)


def python_regex_from_php_pattern(pattern):
    if len(pattern) >= 2 and pattern[0] == "/" and pattern.rfind("/") > 0:
        pattern = pattern[1:pattern.rfind("/")]
    return pattern.replace(r"\/", "/").replace(r"\"", '"')


def report(message):
    print(message, file=sys.stderr)


def main():
    errors = []
    config_keys = php_array_keys(REPO / "conf/default.php", "conf")
    metadata_keys = php_array_keys(REPO / "conf/metadata.php", "meta")
    defaults = parse_default_values(REPO / "conf/default.php")
    metadata = parse_metadata(REPO / "conf/metadata.php")

    missing_metadata = sorted(config_keys - metadata_keys)
    extra_metadata = sorted(metadata_keys - config_keys)
    if missing_metadata:
        errors.append("metadata.php is missing keys from default.php: " + ", ".join(missing_metadata))
    if extra_metadata:
        errors.append("metadata.php has keys not present in default.php: " + ", ".join(extra_metadata))

    for key in sorted(config_keys & metadata_keys):
        value = defaults.get(key)
        meta = metadata.get(key, {})
        meta_type = meta.get("type")
        if meta_type not in METADATA_TYPES:
            errors.append(f"{key} uses unknown metadata type {meta_type!r}")
            continue

        if meta_type == "onoff" and value not in (0, 1, True, False):
            errors.append(f"{key} default value must be boolean-like for onoff metadata")

        if meta_type in {"string", "multichoice"} and not isinstance(value, str):
            errors.append(f"{key} default value must be a string for {meta_type} metadata")

        if meta_type == "multichoice":
            choices = meta.get("choices", [])
            if not choices:
                errors.append(f"{key} multichoice metadata has no choices")
            elif value not in choices:
                errors.append(f"{key} default value {value!r} is not in choices: {', '.join(choices)}")

        if "pattern" in meta and isinstance(value, str):
            regex = python_regex_from_php_pattern(meta["pattern"])
            try:
                match = re.match(regex, value)
            except re.error as error:
                errors.append(f"{key} metadata pattern is invalid: {error}")
            else:
                if not match:
                    errors.append(f"{key} default value {value!r} does not match metadata pattern {meta['pattern']!r}")

    settings_required = set(config_keys)
    for key, choices in MULTICHOICE_SETTINGS.items():
        for choice in choices:
            settings_required.add(f"{key}_o_{choice}")

    for settings_file in sorted((REPO / "lang").glob("*/settings.php")):
        language = settings_file.parent.name
        settings_keys = php_array_keys(settings_file, "lang")
        missing = sorted(settings_required - settings_keys)
        extra = sorted(settings_keys - settings_required)
        if missing:
            errors.append(f"{language}/settings.php is missing keys: " + ", ".join(missing))
        if extra:
            errors.append(f"{language}/settings.php has keys not tied to settings metadata: " + ", ".join(extra))

    english_keys = php_array_keys(REPO / "lang/en/lang.php", "lang")
    for lang_file in sorted((REPO / "lang").glob("*/lang.php")):
        language = lang_file.parent.name
        if language == "en":
            continue
        lang_keys = php_array_keys(lang_file, "lang")
        missing = sorted(english_keys - lang_keys)
        extra = sorted(lang_keys - english_keys)
        if missing and language not in LANG_MISSING_ALLOWLIST:
            errors.append(f"{language}/lang.php is missing keys: " + ", ".join(missing))
        if extra:
            errors.append(f"{language}/lang.php has keys not present in en/lang.php: " + ", ".join(extra))

    if errors:
        for error in errors:
            report(error)
        return 1

    print("Language/config key coverage passed")
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
