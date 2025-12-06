# Changelog

All notable changes to this project will be documented in this file.

## [1.3.0] - 2024-12-06

### Added

- Laravel 12 support
- Edge case tests for empty/non-existent search results
- `justfile` for development commands (`just test`, `just format`, `just analyse`, etc.)

### Changed

- Upgraded to Pest v3 for testing
- Upgraded Orchestra Testbench to ^9.0|^10.0 for Laravel 11/12 compatibility
- Gulesider scraper now uses JSON-LD structured data instead of `__NEXT_DATA__`
- Improved error handling in Opplysningen1890 for results missing phone numbers

### Fixed

- Gulesider scraper compatibility with new website structure
- Test file naming (`SanityTests.php` → `SanityTest.php`) for Pest v3 compatibility

### Removed

- Dropped Laravel 10 support (use v1.2.x for Laravel 10)
- Removed `nunomaduro/collision` (now included in Pest 3)
- Removed `pestphp/pest-plugin-arch` (now built into Pest 3)
