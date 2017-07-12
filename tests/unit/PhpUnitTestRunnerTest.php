<?php

namespace JlDojo\SonicTest\Tests\Unit;

use JlDojo\SonicTest\PhpUnitTestRunner;
use JlDojo\SonicTest\Tests;
use PHPUnit\Framework\TestCase;

class PhpUnitTestRunnerTest extends TestCase
{
    /** @test */
    public function the_tests_pass_when_there_is_no_test_to_execute()
    {
        $runner = new PhpUnitTestRunner();

        $executionResult = $runner->runTests(new Tests([]));

        $this->assertTrue($executionResult->hasPassed());
        $this->assertEquals(0, $executionResult->numberOfTests());
    }
}