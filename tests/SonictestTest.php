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
        $printer = $this->prophesize(Printer::class);
        $lib = SonicTest::withPrinter($printer->reveal());

        $lib->run();

        $this->markTestIncomplete('Not yet');
        $printer->report("There is no test affected by changes")->shouldHaveBeenCalled();
    }

    /** @test */
    public function an_execution_with_one_change_covered_with_one_test_should_run_only_that_test()
    {
        $printer = $this->prophesize(Printer::class);
        $lib = SonicTest::withPrinter($printer->reveal());
        $this->makeOneChange();

        $lib->run();

        $this->markTestIncomplete('Not yet');
        $printer->report("OK (1 test, 1 assertion)")->shouldHaveBeenCalled();
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->rollbackChanges();
    }

    private function makeOneChange()
    {
        $productionCodePath = __DIR__ .'/data/src/SimpleProductionCode.php';
        $content = file_get_contents($productionCodePath);
        $changedContent = str_replace('return true;', "echo 'hello';\nreturn true;", $content);
        file_put_contents($productionCodePath, $changedContent);
    }

    private function rollbackChanges()
    {
        $productionCodePath = __DIR__ .'/data/src/SimpleProductionCode.php';
        $content = file_get_contents($productionCodePath);
        $changedContent = str_replace("echo 'hello';\nreturn true;", 'return true;', $content);
        file_put_contents($productionCodePath, $changedContent);
    }
}