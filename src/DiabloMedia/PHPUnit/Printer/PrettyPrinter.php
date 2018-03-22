<?php

namespace DiabloMedia\PHPUnit\Printer;

use PHPUnit\Framework\TestCase;
use PHPUnit\Runner\PhptTestCase;

class PrettyPrinter extends \PHPUnit\TextUI\ResultPrinter implements \PHPUnit\Framework\TestListener
{
    protected $className;
    protected $previousClassName;
    protected $timeColors;

    protected $defaultTimeColors = [
            '1'    => 'fg-red',
            '.400' => 'fg-yellow',
            '0'    => 'fg-green',
    ];

    public function startTestSuite(\PHPUnit\Framework\TestSuite $suite): void
    {
        if ($this->debug && is_null($this->timeColors)) {
            if (defined('DIABLO_PRINTER_TIME_COLORS') && is_array(DIABLO_PRINTER_TIME_COLORS)) {
                $this->timeColors = DIABLO_PRINTER_TIME_COLORS;
                krsort($this->timeColors, SORT_NUMERIC);
            } else {
                $this->timeColors = $this->defaultTimeColors;
            }
        }

        parent::startTestSuite($suite);
    }

    public function startTest(\PHPUnit\Framework\Test $test): void
    {
        $this->className = get_class($test);
        if (!$this->debug) {
            parent::startTest($test);
        }
    }

    public function endTest(\PHPUnit\Framework\Test $test, float $time): void
    {

        if (!$this->debug) {
            parent::endTest($test, $time);
        } else {
            foreach ($this->timeColors as $threshold => $color) {
                if ($time >= $threshold) {
                    $timeColor = $color;
                    break;
                }
            }

            $this->write(' ');
            $this->writeWithColor($timeColor, '['.number_format($time, 3).'s]', false);
            $this->write(' ');

            if (method_exists('\PHPUnit\Util\Test', 'describeAsString')) {
                $msg = \PHPUnit\Util\Test::describeAsString($test);
            } else {
                $msg = \PHPUnit\Util\Test::describe($test); // PHPUnit <= 6
            }

            $this->writeWithColor('fg-cyan', $msg, true);

            // Necessary part from \PHPUnit\TextUI\ResultPrinter::endTest
            if ($test instanceof TestCase) {
                $this->numAssertions += $test->getNumAssertions();
            } elseif ($test instanceof PhptTestCase) {
                $this->numAssertions++;
            }

            $this->lastTestFailed = false;
            if ($test instanceof TestCase) {
                if (!$test->hasExpectationOnOutput()) {
                    $this->write($test->getActualOutput());
                }
            }
        }
    }

    protected function writeProgress($progress): void
    {
        if ($this->debug) {
            $this->write($progress);
            ++$this->numTestsRun;
        } else {
            if ($this->previousClassName !== $this->className) {
                $this->write("\n");
                $this->writeWithColor('fg-cyan', str_pad($this->className, 50, ' ', STR_PAD_LEFT).' ', false);
            }
            $this->previousClassName = $this->className;

            if ($progress == '.') {
                $this->writeWithColor('fg-green', $progress, false);
            } else {
                $this->write($progress);
            }
        }
    }

    protected function printDefectTrace(\PHPUnit\Framework\TestFailure $defect): void
    {
        $this->write($this->formatExceptionMsg($defect->getExceptionAsString()));
        $trace = \PHPUnit\Util\Filter::getFilteredStacktrace(
            $defect->thrownException()
        );
        if (!empty($trace)) {
            $this->write("\n".$trace);
        }
        $exception = $defect->thrownException()->getPrevious();
        while ($exception) {
            $this->write(
            "\nCaused by\n".
            \PHPUnit\Framework\TestFailure::exceptionToString($exception)."\n".
            \PHPUnit\Util\Filter::getFilteredStacktrace($exception)
          );
            $exception = $exception->getPrevious();
        }
    }

    protected function formatExceptionMsg(string $exceptionMessage): string
    {
        $exceptionMessage = str_replace("+++ Actual\n", '', $exceptionMessage);
        $exceptionMessage = str_replace("--- Expected\n", '', $exceptionMessage);
        $exceptionMessage = str_replace('@@ @@', '', $exceptionMessage);

        if ($this->colors) {
            $exceptionMessage = preg_replace('/^(Exception.*)$/m', "\033[01;31m$1\033[0m", $exceptionMessage);
            $exceptionMessage = preg_replace('/(Failed.*)$/m', "\033[01;31m$1\033[0m", $exceptionMessage);
            $exceptionMessage = preg_replace("/(\-+.*)$/m", "\033[01;32m$1\033[0m", $exceptionMessage);
            $exceptionMessage = preg_replace("/(\++.*)$/m", "\033[01;31m$1\033[0m", $exceptionMessage);
        }

        return $exceptionMessage;
    }
}
