<?php

namespace JlDojo\SonicTest\Tests\Unit;

use JlDojo\SonicTest\ChangeDetector;
use JlDojo\SonicTest\Changes;
use JlDojo\SonicTest\Printer;
use JlDojo\SonicTest\SonicTest;
use PHPUnit\Framework\TestCase;

class SonicTestTest extends TestCase
{
    /** @test */
    public function run_uses_change_detector()
    {
        $changeDetectorPropechy = $this->prophesize(ChangeDetector::class);
        $printer = $this->prophesize(Printer::class)->reveal();
        $sonic = new SonicTest($changeDetectorPropechy->reveal(), $printer);

        $changeDetectorPropechy->detectChanges()
                               ->willReturn(new Changes())
                               ->shouldBeCalled();

        $sonic->run();
    }
}