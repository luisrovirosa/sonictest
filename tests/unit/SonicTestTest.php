<?php

namespace JlDojo\SonicTest\Tests\Unit;

use JlDojo\SonicTest\ChangeDetector;
use JlDojo\SonicTest\Changes;
use JlDojo\SonicTest\ExecutionResult;
use JlDojo\SonicTest\Output;
use JlDojo\SonicTest\Printer;
use JlDojo\SonicTest\SonicTest;
use JlDojo\SonicTest\TestMatcher;
use JlDojo\SonicTest\TestRunner;
use JlDojo\SonicTest\Tests;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

class SonicTestTest extends TestCase
{
    /**
     * @var ObjectProphecy
     */
    private $outputProphecy;
    /**
     * @var ObjectProphecy
     */
    private $testRunnerProphecy;
    /**
     * @var ObjectProphecy
     */
    private $printerProphecy;
    /**
     * @var ObjectProphecy
     */
    private $testMatcherProphecy;
    /**
     * @var ObjectProphecy
     */
    private $changeDetectorProphecy;

    protected function setUp()
    {
        parent::setUp();
        $this->changeDetectorProphecy = $this->prophesize(ChangeDetector::class);
        $this->changeDetectorProphecy->detectChanges()->willReturn(new Changes([]));
        $this->testMatcherProphecy = $this->prophesize(TestMatcher::class);
        $this->testMatcherProphecy->matchTests(Argument::any())->willReturn(new Tests([]));
        $this->printerProphecy = $this->prophesize(Printer::class);
        $this->testRunnerProphecy = $this->prophesize(TestRunner::class);
        $this->testRunnerProphecy->runTests(Argument::any())->willReturn(new ExecutionResult(true, 1));
        $this->outputProphecy = $this->prophesize(Output::class);
    }

    /** @test */
    public function run_uses_change_detector()
    {
        $sonicTest = $this->createSonicTest();

        $this->changeDetectorProphecy->detectChanges()
                                     ->shouldBeCalled();

        $sonicTest->run();
    }

    /** @test */
    public function run_uses_test_matcher_with_change_detector_output()
    {
        $changes = new Changes([]);
        $this->changeDetectorProphecy->detectChanges()->willReturn($changes);
        $sonicTest = $this->createSonicTest();

        $this->testMatcherProphecy->matchTests(Argument::is($changes))
                                  ->shouldBeCalled();

        $sonicTest->run();
    }

    /** @test */
    public function run_uses_test_runner_with_tests()
    {
        $tests = new Tests([]);
        $this->testMatcherProphecy->matchTests(Argument::any())->willReturn($tests);
        $sonicTest = $this->createSonicTest();

        $this->testRunnerProphecy->runTests(Argument::is($tests))
                                 ->shouldBeCalled();

        $sonicTest->run();
    }

    /** @test */
    public function run_uses_output_with_execution_result()
    {
        $executionResult = new ExecutionResult(true, 1);
        $this->testRunnerProphecy->runTests(Argument::any())->willReturn($executionResult);
        $sonicTest = $this->createSonicTest();

        $this->outputProphecy->printResult(Argument::is($executionResult))
                             ->shouldBeCalled();

        $sonicTest->run();
    }

    /**
     * @return SonicTest
     */
    private function createSonicTest(): SonicTest
    {
        return new SonicTest(
            $this->changeDetectorProphecy->reveal(),
            $this->testMatcherProphecy->reveal(),
            $this->testRunnerProphecy->reveal(),
            $this->outputProphecy->reveal(),
            $this->printerProphecy->reveal()
        );
    }
}