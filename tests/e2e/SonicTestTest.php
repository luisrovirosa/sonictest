<?php

namespace JlDojo\SonicTest\Tests\e2e;

use JlDojo\SonicTest\Printer;
use JlDojo\SonicTest\SonicTest;
use JlDojo\SonicTest\Tests\Developer;
use PHPUnit\Framework\TestCase;

class SonicTestTest extends TestCase
{
    /** @test */
    public function an_execution_without_any_change_should_not_run_any_test()
    {
        $printer = $this->prophesize(Printer::class);
        $lib = SonicTest::withPrinter($printer->reveal());

        $printer->report("There is no test affected by changes")->shouldBeCalled();

        $lib->run();
    }

    /** @test */
    public function an_execution_with_one_change_covered_with_one_test_should_run_only_that_test()
    {
        $this->markTestIncomplete('Not yet');
        $printer = $this->prophesize(Printer::class);
        $lib = SonicTest::withPrinter($printer->reveal());
        $this->makeOneChange();

        $printer->report("OK (1 test)")->shouldBeCalled();

        $lib->run();
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->rollbackChanges();
    }

    private function makeOneChange()
    {
        (new Developer())->changeSimpleProductionCode();
    }

    private function rollbackChanges()
    {
        (new Developer())->revertProductionCode();
    }
}