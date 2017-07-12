<?php

namespace JlDojo\SonicTest\Tests\ProjectToTest\Tests;

use JlDojo\SonicTest\Tests\ProjectToTest\BuggyProductionCode;
use PHPUnit\Framework\TestCase;

class BuggyProductionCodeTest extends TestCase
{
    /** @test */
    public function failing_test()
    {
        $code = new BuggyProductionCode();
        $this->assertTrue($code->buggyMethod());
    }
}