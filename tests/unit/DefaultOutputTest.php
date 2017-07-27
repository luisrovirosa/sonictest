<?php

namespace JlDojo\SonicTest\Tests\Unit;

use JlDojo\SonicTest\Output\DefaultOutput;
use JlDojo\SonicTest\Output\Printer\Printer;
use JlDojo\SonicTest\TestRunner\ExecutionResult;
use PHPUnit\Framework\TestCase;

class DefaultOutputTest extends TestCase
{

    /** @test */
    public function report_there_is_no_test_affected_by_changes_when_there_is_no_tests_executed()
    {
        $printerProphecy = $this->prophesize(Printer::class);
        $output = new DefaultOutput($printerProphecy->reveal());

        $printerProphecy->report("There is no test affected by changes")->shouldBeCalled();

        $output->printResult(new ExecutionResult(true, 0));
    }

    /** @test */
    public function report_everything_has_passed_when_the_tests_succeed()
    {
        $printerProphecy = $this->prophesize(Printer::class);
        $output = new DefaultOutput($printerProphecy->reveal());

        $printerProphecy->report("OK (1 test)")->shouldBeCalled();

        $output->printResult(new ExecutionResult(true, 1));
    }

    /** @test */
    public function report_that_has_been_an_error_when_some_test_has_failed()
    {
        $printerProphecy = $this->prophesize(Printer::class);
        $output = new DefaultOutput($printerProphecy->reveal());

        $printerProphecy->report("ERROR (1 test)")->shouldBeCalled();

        $output->printResult(new ExecutionResult(false, 1));
    }
}
