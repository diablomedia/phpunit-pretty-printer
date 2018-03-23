<?php
namespace DiabloMedia\PHPUnit\Printer\Tests;

use Exception;

class PrinterTest extends \PHPUnit\Framework\TestCase
{
    public function testSuccess(): void
    {
        $this->assertTrue(true);
    }

    public function testFail(): void
    {
        $this->assertTrue(false);
    }

    public function testError(): void
    {
        throw new Exception('error');
    }

    public function testSkip(): void
    {
        $this->markTestSkipped('skipped');
    }

    public function testIncomplete(): void
    {
        $this->markTestIncomplete('incomplete');
    }
}
