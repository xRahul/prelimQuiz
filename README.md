# PrelimQuiz

PrelimQuiz is an open source, simple and powerful self-hosted quiz platform built with modern Object Oriented PHP (PHP 8.2+). It supports both MySQL and MongoDB.

## Getting Started

### Prerequisites

* Docker & Docker Compose

### Installation (Docker)

1. Clone the repository.
2. Run `docker-compose up -d --build`.
3. Access the application at `http://localhost:8080`.

### Configuration

The application uses environment variables for configuration. These are set in `docker-compose.yml` but you should create a `.env` file for production usage.

| Variable | Description | Default |
|----------|-------------|---------|
| DB_TYPE | Database type | mysql |
| DB_HOST | Database host | db |
| DB_NAME | Database name | prelim_quiz |
| DB_USER | Database user | quizUser |
| DB_PASS | Database password | quizPassword |
| DB_PORT | Database port | 3306 |
| MONGODB_URI | MongoDB Connection URI | mongodb://mongo:27017 |
| MONGODB_DB | MongoDB Database Name | prelim_quiz |

### Development

To run tests locally:

```bash
composer install
vendor/bin/phpunit
```

## CI/CD

This project uses GitHub Actions for CI/CD:
* **CI**: Runs on every push and PR to `master`. Runs tests and checks.
* **CD**: Manual trigger ("Release on click") to build and push the Docker image.

## License

This project is licensed under the AGPL v3.0 License.
