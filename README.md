# phpunit-pretty-printer
[![Build Status](https://api.travis-ci.com/diablomedia/phpunit-pretty-printer.svg?branch=master)](https://travis-ci.com/diablomedia/phpunit-pretty-printer)
[![Latest Stable Version](https://poser.pugx.org/diablomedia/phpunit-pretty-printer/v/stable)](https://packagist.org/packages/diablomedia/phpunit-pretty-printer)
[![Total Downloads](https://poser.pugx.org/diablomedia/phpunit-pretty-printer/downloads)](https://packagist.org/packages/diablomedia/phpunit-pretty-printer)
[![License](https://poser.pugx.org/diablomedia/phpunit-pretty-printer/license)](https://packagist.org/packages/diablomedia/phpunit-pretty-printer)

A PHPUnit result printer that shows per-file test progress and execution times.

## Installation

```bash
composer.phar require --dev diablomedia/phpunit-pretty-printer
```

## Usage

**It's suggested to use the phpunit installed by composer.**

You can specify the printer to use on the phpunit command line:

```bash
php vendor/bin/phpunit --printer 'DiabloMedia\PHPUnit\Printer\PrettyPrinter' tests/
```

To see per-test execution times, use the `--debug` flag:

```bash
php vendor/bin/phpunit --printer 'DiabloMedia\PHPUnit\Printer\PrettyPrinter' --debug tests/
```

Optionally, you can add it to your project's `phpunit.xml` file instead:

```xml
<phpunit bootstrap="bootstrap.php" colors="true" printerClass="DiabloMedia\PHPUnit\Printer\PrettyPrinter">
```

## Screenshots

Default output:

![phpunit-pretty-printer](https://cloud.githubusercontent.com/assets/1278449/13678034/d76eda8a-e6a9-11e5-8c6b-04b6ec9976eb.png "Default output")


Debug output showing time to run:

![phpunit-pretty-printer-debug](https://cloud.githubusercontent.com/assets/1278449/13678037/e0a09986-e6a9-11e5-891a-08c7b6389fca.png "Debug output showing time to run")

## Acknowledgements

Inspiration for the default output was taken from https://github.com/adm-husker/kujira-phpunit-printer.
