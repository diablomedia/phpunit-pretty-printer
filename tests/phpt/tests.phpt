--FILE--
<?php
$_SERVER['argv'][1] = '--configuration=tests';

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';
\PHPUnit\TextUI\Command::main();
--EXPECTF--
%a
     DiabloMedia\PHPUnit\Printer\Tests\PrinterTest .FESI
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
