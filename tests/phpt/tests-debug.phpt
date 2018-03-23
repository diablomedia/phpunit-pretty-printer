--FILE--
<?php
$_SERVER['argv'][1] = '--configuration=tests';
$_SERVER['argv'][2] = '--debug';

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';
\PHPUnit\TextUI\Command::main();
--EXPECTF--
%a
. [%s] DiabloMedia\PHPUnit\Printer\Tests\PrinterTest::testSuccess
F [%s] DiabloMedia\PHPUnit\Printer\Tests\PrinterTest::testFail
E [%s] DiabloMedia\PHPUnit\Printer\Tests\PrinterTest::testError
S [%s] DiabloMedia\PHPUnit\Printer\Tests\PrinterTest::testSkip
I [%s] DiabloMedia\PHPUnit\Printer\Tests\PrinterTest::testIncomplete
%a
There was 1 error:

1) DiabloMedia\PHPUnit\Printer\Tests\PrinterTest::testError
Exception: error

%s/tests/PrinterTest.php:20

--

There was 1 failure:

1) DiabloMedia\PHPUnit\Printer\Tests\PrinterTest::testFail
Failed asserting that false is true.

%s/tests/PrinterTest.php:15
%a
