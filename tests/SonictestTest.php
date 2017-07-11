<?php

namespace JlDojo\Tests;

use JlDojo\Printer;
use JlDojo\SonicTest;
use PHPUnit\Framework\TestCase;

class SonictestTest extends TestCase
{
    /** @test */
    public function an_execution_without_any_change_should_not_run_any_test()
    {
        $this->markTestIncomplete('Not yet');
        $printer = $this->prophesize(Printer::class);
        $lib = new SonicTest($printer->reveal());

        $lib->run();

        $printer->report("There is no test affected by changes")->shouldHaveBeenCalled();
    }
    // An execution with one change covered with one test should run only that test
}