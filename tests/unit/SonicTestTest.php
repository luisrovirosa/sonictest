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
        $this->testMatcherProphecy = $this->prophesize(TestMatcher::class);
        $this->testMatcherProphecy->matchTests(Argument::any())->willReturn(new Tests());
        $this->printerProphecy = $this->prophesize(Printer::class);
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
        $changes = new Changes();
        $this->changeDetectorProphecy->detectChanges()->willReturn($changes);
        $sonicTest = $this->createSonicTest();

        $this->testMatcherProphecy->matchTests(Argument::is($changes))
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
            $this->printerProphecy->reveal()
        );
    }
}