# phpunit-pretty-printer
A PHPUnit result printer that shows per-file test progress and execution times.

## Installation

```bash
composer.phar require --dev diablomedia/phpunit-pretty-printer
```

## Usage

You can specify the printer to use on the phpunit command line:

```bash
phpunit --printer 'DiabloMedia\PHPUnit\Printer\PrettyPrinter' tests/
```

To see per-test execution times, use the `--debug` flag:

```bash
phpunit --printer 'DiabloMedia\PHPUnit\Printer\PrettyPrinter' --debug tests/
```

Optionally, you can add it to your project's `phpunit.xml` file instead:

```xml
<phpunit bootstrap="bootstrap.php" colors="true" printerClass="DiabloMedia\PHPUnit\Printer\PrettyPrinter">
```

