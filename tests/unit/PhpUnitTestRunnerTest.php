<?php

namespace JlDojo\SonicTest\Tests\Unit;

use JlDojo\SonicTest\PhpUnitTestRunner;
use JlDojo\SonicTest\Test;
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

    /** @test */
    public function the_result_has_been_successful_when_there_are_tests_to_execute_with_successful_result()
    {
        $runner = new PhpUnitTestRunner();
        $test = new Test('JlDojo\SonicTest\Tests\ProjectToTest\Tests\SimpleProductionCodeTest');

        $executionResult = $runner->runTests(new Tests([$test]));

        $this->assertTrue($executionResult->hasPassed());
        $this->assertEquals(1, $executionResult->numberOfTests());
    }

    /** @test */
    public function the_result_has_failed_when_there_are_tests_to_execute_with_failing_result()
    {
        $runner = new PhpUnitTestRunner();
        $test = new Test('JlDojo\SonicTest\Tests\ProjectToTest\Tests\BuggyProductionCodeTest');

        $executionResult = $runner->runTests(new Tests([$test]));

        $this->assertFalse($executionResult->hasPassed());
        $this->assertEquals(1, $executionResult->numberOfTests());
    }

    /** @test */
    public function the_result_is_the_aggregation_of_the_execution_results_of_all_tests()
    {
        $runner = new PhpUnitTestRunner();
        $failingTest = new Test('JlDojo\SonicTest\Tests\ProjectToTest\Tests\BuggyProductionCodeTest');
        $successfulTest = new Test('JlDojo\SonicTest\Tests\ProjectToTest\Tests\SimpleProductionCodeTest');

        $executionResult = $runner->runTests(new Tests([$failingTest, $successfulTest]));

        $this->assertFalse($executionResult->hasPassed());
        $this->assertEquals(2, $executionResult->numberOfTests());
    }
}