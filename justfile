# Telefonkatalog - Development Commands
# Run `just` or `just --list` to see available commands

# Default recipe: show available commands
[private]
default:
    @just --list --unsorted

# ─────────────────────────────────────────────────────────────────────────────
# Testing
# ─────────────────────────────────────────────────────────────────────────────

# Run all tests
[group('test')]
test:
    vendor/bin/pest

# Run tests in parallel
[group('test')]
test-parallel:
    vendor/bin/pest --parallel

# Run tests with coverage report
[group('test')]
coverage *args:
    #!/usr/bin/env bash
    if command -v herd &> /dev/null; then
        herd coverage vendor/bin/pest --coverage --coverage-html=coverage {{ args }}
    else
        composer test-coverage
    fi
    open coverage/index.html

# Run a specific test file or filter
[group('test')]
test-filter filter:
    vendor/bin/pest --filter="{{ filter }}"

# ─────────────────────────────────────────────────────────────────────────────
# Code Quality
# ─────────────────────────────────────────────────────────────────────────────

# Run static analysis with PHPStan
[group('quality')]
analyse:
    vendor/bin/phpstan analyse src

# Run code formatter (Laravel Pint)
[group('quality')]
format:
    vendor/bin/pint

# Check code formatting without making changes
[group('quality')]
format-check:
    vendor/bin/pint --test

# Run format + analyse (no tests)
[group('quality')]
lint: format analyse

# Run all quality checks (format, analyse, test)
[group('quality')]
check: format analyse test

# ─────────────────────────────────────────────────────────────────────────────
# Workflows
# ─────────────────────────────────────────────────────────────────────────────

# Simulate CI pipeline (format-check, analyse, all tests)
[group('workflow')]
ci: format-check analyse test

# ─────────────────────────────────────────────────────────────────────────────
# Development
# ─────────────────────────────────────────────────────────────────────────────

# Install composer dependencies
[group('dev')]
install:
    composer install

# Update composer dependencies
[group('dev')]
update:
    composer update

# Clear all caches and generated files
[group('dev')]
clean:
    rm -rf .phpunit.cache
    rm -rf build
    rm -rf vendor
