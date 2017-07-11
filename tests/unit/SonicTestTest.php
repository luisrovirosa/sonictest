<?php

namespace JlDojo\SonicTest\Tests\Unit;

use JlDojo\SonicTest\ChangeDetector;
use JlDojo\SonicTest\Changes;
use JlDojo\SonicTest\Printer;
use JlDojo\SonicTest\SonicTest;
use JlDojo\SonicTest\TestMatcher;
use JlDojo\SonicTest\Tests;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

class SonicTestTest extends TestCase
{
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
        $this->testMatcherProphecy = $this->prophesize(TestMatcher::class);
    }

    /** @test */
    public function run_uses_change_detector()
    {
        $this->testMatcherProphecy->matchTests(Argument::any())->willReturn(new Tests());
        $printer = $this->prophesize(Printer::class)->reveal();
        $sonic = new SonicTest($this->changeDetectorProphecy->reveal(), $this->testMatcherProphecy->reveal(), $printer);

        $this->changeDetectorProphecy->detectChanges()
                                     ->willReturn(new Changes())
                                     ->shouldBeCalled();

        $sonic->run();
    }

    /** @test */
    public function run_uses_test_matcher_with_change_detector_input()
    {
        $changes = new Changes();
        $this->changeDetectorProphecy->detectChanges()->willReturn($changes);
        $printer = $this->prophesize(Printer::class)->reveal();
        $sonic = new SonicTest(
            $this->changeDetectorProphecy->reveal(),
            $this->testMatcherProphecy->reveal(),
            $printer
        );

        $this->testMatcherProphecy->matchTests($changes)
                                  ->willReturn(new Tests())
                                  ->shouldBeCalled();

        $sonic->run();
    }
}