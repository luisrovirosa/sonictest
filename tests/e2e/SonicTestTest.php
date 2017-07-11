<?php

namespace JlDojo\SonicTest\Tests\e2e;

use JlDojo\SonicTest\Printer;
use JlDojo\SonicTest\SonicTest;
use PHPUnit\Framework\TestCase;

class SonicTestTest extends TestCase
{
    /** @test */
    public function an_execution_without_any_change_should_not_run_any_test()
    {
        $this->markTestIncomplete('Not yet');
        $printer = $this->prophesize(Printer::class);
        $lib = SonicTest::withPrinter($printer->reveal());

        $lib->run();

        $printer->report("There is no test affected by changes")->shouldHaveBeenCalled();
    }

    /** @test */
    public function an_execution_with_one_change_covered_with_one_test_should_run_only_that_test()
    {
        $this->markTestIncomplete('Not yet');
        $printer = $this->prophesize(Printer::class);
        $lib = SonicTest::withPrinter($printer->reveal());
        $this->makeOneChange();

        $lib->run();

        $printer->report("OK (1 test, 1 assertion)")->shouldHaveBeenCalled();
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