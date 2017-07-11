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

class SonicTestTest extends TestCase
{
    /** @test */
    public function run_uses_change_detector()
    {
        $changeDetectorPropechy = $this->prophesize(ChangeDetector::class);
        $testMatcherProphecy = $this->prophesize(TestMatcher::class);
        $testMatcherProphecy->matchTests(Argument::any())->willReturn(new Tests());
        $printer = $this->prophesize(Printer::class)->reveal();
        $sonic = new SonicTest($changeDetectorPropechy->reveal(), $testMatcherProphecy->reveal(), $printer);

        $changeDetectorPropechy->detectChanges()
                               ->willReturn(new Changes())
                               ->shouldBeCalled();

        $sonic->run();
    }

    /** @test */
    public function run_uses_test_matcher_with_change_detector_input()
    {
        $changeDetectorPropechy = $this->prophesize(ChangeDetector::class);
        $changes = new Changes();
        $changeDetectorPropechy->detectChanges()->willReturn($changes);
        $testMatcherProphecy = $this->prophesize(TestMatcher::class);
        $printer = $this->prophesize(Printer::class)->reveal();
        $sonic = new SonicTest(
            $changeDetectorPropechy->reveal(),
            $testMatcherProphecy->reveal(),
            $printer
        );

        $testMatcherProphecy->matchTests($changes)
                            ->willReturn(new Tests())
                            ->shouldBeCalled();

        $sonic->run();
    }
}