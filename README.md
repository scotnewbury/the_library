# The Library

A personal library management system built in PHP as a portfolio project demonstrating professional PHP development practices. The application validates ISBN-13 numbers, enriches them with metadata from the Open Library API, and persists the results to a local CSV ledger.

This project is intentionally built incrementally — each stage introducing one core concept — to demonstrate not just the ability to write PHP, but the ability to architect and evolve a codebase over time.

---

## Project Status

**Current version:** v0.4.0 (MVP — CLI application with API integration)

**Next milestone:** PHPUnit integration and GitHub Actions CI/CD

---

## Features

- ISBN-13 validation with full checksum verification (not just length checking)
- Input sanitization — strips dashes, spaces, and non-numeric characters before validation
- Open Library API integration — automatically retrieves book title from a validated ISBN
- Exception-based error handling across all service classes
- CSV ledger with absolute path resolution (`__DIR__`) for cross-environment reliability
- Dockerized development environment for full OS-level isolation
- PSR-4 autoloading via Composer — no manual `require_once` chains
- MIT License

---

## Tech Stack

- PHP 8.2 (CLI)
- Composer (PSR-4 autoloading)
- Docker (PHP 8.2 CLI image)
- Open Library REST API
- CSV flat-file persistence

---

## Architecture

```
the_library/
├── parser.php            # Entry point — orchestrates validation, API fetch, and persistence
├── composer.json         # PSR-4 autoloader config (Library\ → src/)
├── src/
│   ├── IsbnValidator.php    # Validates ISBN-13 format and checksum
│   ├── BookMetadata.php     # Fetches title data from Open Library API
│   └── BookLedger.php       # Persists book records to CSV
├── tests/
│   └── test_validator.php   # Manual test suite for IsbnValidator
└── data/                    # Runtime data directory (gitignored)
    └── books.csv
```

All business logic lives in the `Library\` namespace under `src/`. The `parser.php` entry point is the only file responsible for user interaction — it orchestrates the service classes via a clean `try/catch` "Happy Path":

```php
try {
    $valid_check = $validator->isValidIsbn13($normalizedInput);
    $bookInfo    = $metadata->getBook($valid_check);
    $ledger->writeBook($bookInfo);
    echo "Success! Your book has been added to the ledger." . PHP_EOL;
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
```

---

## Getting Started

### Prerequisites

- Docker installed on your machine
- No local PHP or Composer installation required

### Install Dependencies

```bash
docker run --rm -u $(id -u):$(id -g) -v $(pwd):/app -w /app composer install
```

### Run the Application

```bash
docker run -it --rm -v $(pwd):/app -w /app php:8.2-cli php parser.php
```

You will be prompted to enter an ISBN-13. The application accepts numbers with or without dashes and spaces (e.g., `978-1-60302-022-0` or `9781603020220`). Type `exit` to quit.

### Run the Test Suite

```bash
docker run -it --rm -v $(pwd):/app -w /app php:8.2-cli php tests/test_validator.php
```

The test script validates the ISBN validator against a suite of known inputs, covering correct ISBNs, incorrect lengths, non-numeric inputs, and checksum failures.

---

## Development Roadmap

This project is built as a series of milestones, each focused on one concept:

| Tag | Milestone | Key Concept |
|-----|-----------|-------------|
| v0.1 | CLI ISBN Parser | String manipulation, `preg_replace`, control flow |
| v0.2 | CSV Persistence | File I/O, `fopen`/`fputcsv`, append mode |
| v0.3 | Open Library API Integration | `file_get_contents`, `json_decode`, external HTTP |
| v0.4 | OOP Refactor + Exception Handling | PSR-4, Composer, namespaces, `try/catch`, Docker |
| v0.5 *(planned)* | PHPUnit + GitHub Actions CI/CD | Automated testing, continuous integration |
| v0.6 *(planned)* | MySQL / PDO Migration | Relational database, prepared statements, normalization |
| v0.7 *(planned)* | Web Interface | HTTP, `$_POST`, PHP-in-HTML templating |
| v0.8 *(planned)* | Authentication | `$_SESSION`, `password_hash`, protected routes |

---

## Design Decisions

**Why exceptions instead of return codes?**  
Each service class has one job. `IsbnValidator` validates; `BookMetadata` fetches; `BookLedger` persists. None of them should be responsible for talking to the user. Exceptions allow these classes to signal failure without coupling business logic to UI output — the parser handles messaging, the classes handle logic.

**Why move to OOP before the database?**  
Building the relational data layer on top of procedural spaghetti would have meant rewriting it twice. Introducing classes, namespaces, and Composer at v0.4 creates the infrastructure that makes the upcoming PDO database layer a clean addition rather than a rewrite.

**Why Docker?**  
Multiple projects on one machine. Containers isolate PHP version, dependencies, and runtime — no global installs, no version conflicts, no "works on my machine" debugging.

**Why the Open Library API over Google Books?**  
No API key required. Lower friction for local development, and sufficient metadata for this stage of the project.

---

## License

MIT — see [LICENSE](LICENSE)
