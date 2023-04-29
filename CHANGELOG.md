# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2023-04-29
### Added
- Changelog
- Readme content
- Requirement for namespace to generate classes
- Psalm for static code analysis 
- CodeSniffer for code style adherence (PSR12)

### Changed
- Used more PHP 8.1 features
- Changed getters to public properties when possible
- Arguments for http_generate.php to required namespace

### Removed
- Unused getters

### Fixed
- Errors from static code analysis

## [1.0.1] - 2023-04-29
### Changed
- Moved generator.php to bin/http_generate.php

### Fixed
- Composer bin declaration

## [1.0.0] - 2023-04-29
### Added
- Initial implementation