# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Telefonkatalog is a Laravel package for scraping Norwegian phone directory data from websites like 1881.no, 1890.no, and Gulesider.no. It's designed for small-scale usage to auto-fill forms with person information based on phone numbers or names.

## Key Commands

### Development (using justfile)

```bash
# Install dependencies
just install

# Run static analysis
just analyse

# Format code with Laravel Pint (PSR-12 style)
just format

# Run tests
just test

# Run all quality checks (format, analyse, test)
just check

# Run a specific test
just test-filter "test name"
```

### Alternative: Composer Scripts

```bash
composer install
composer analyse
composer format
composer test
composer test-coverage
```

## Architecture

### Core Components

1. **DataSource Contract** (`src/Contracts/DataSource.php`): Interface that all scrapers must implement
    - `search(string $query): Collection` - Search by name
    - `find(string $phoneNumber): ?Person` - Lookup by phone number

2. **Data Sources** (`src/DataSources/`): Concrete implementations for each phone directory
    - `Gulesider.php` - Scrapes gulesider.no
    - `Opplysningen1881.php` - Scrapes 1881.no
    - `Opplysningen1890.php` - Scrapes 1890.no

3. **Person DTO** (`src/Data/Person.php`): Data transfer object using spatie/laravel-data
    - Properties: phone, name, address, city, postalCode, url, source

4. **Main Service** (`src/Telefonkatalog.php`): Orchestrates searches across all data sources
    - Aggregates results from multiple sources
    - Provides unified API

5. **Facade** (`src/Facades/Telefonkatalog.php`): Laravel facade for easy static access

### Package Structure

- Uses Laravel Package Tools by Spatie for auto-discovery
- Service provider registers the main service as a singleton
- No configuration files needed - works out of the box

### Testing Approach

- Uses Pest v3 with Laravel plugin
- Architecture tests ensure code structure compliance
- Sanity tests verify basic functionality with real API calls
- Edge case tests verify handling of empty/non-existent results
- Test coverage reports generated in `build/` directory

## Important Considerations

1. **No Anti-Bot Protection**: This package doesn't handle CAPTCHAs, rate limiting, or IP blocking
2. **Norwegian-Specific**: Only works with Norwegian phone directories
3. **Small-Scale Usage**: Not designed for bulk operations or high-traffic scenarios
4. **Web Scraping**: Relies on HTML structure of external websites - may break if sites change
5. **Laravel Integration**: Requires Laravel 11.x or 12.x and PHP 8.2+

## Common Development Tasks

### Adding a New Data Source

1. Create new class in `src/DataSources/` implementing `DataSource` contract
2. Implement `search()` and `find()` methods using Guzzle for HTTP requests and Symfony DOM Crawler for parsing
3. Add the new source to the `$sources` array in `src/Telefonkatalog.php`
4. Write tests in `tests/` to verify functionality

### Modifying Person Data Structure

1. Update `src/Data/Person.php` with new properties
2. Update all data source implementations to populate new fields
3. Consider backward compatibility for existing users
