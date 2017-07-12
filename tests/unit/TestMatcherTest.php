<?php

namespace JlDojo\SonicTest\Tests\Unit;

use JlDojo\SonicTest\Change;
use JlDojo\SonicTest\Changes;
use JlDojo\SonicTest\CodeCoverage;
use JlDojo\SonicTest\CodeCoverer;
use JlDojo\SonicTest\Test;
use JlDojo\SonicTest\TestMatcher;
use JlDojo\SonicTest\Tests;
use PHPUnit\Framework\TestCase;

class TestMatcherTest extends TestCase
{
    /** @test */
    public function there_is_no_test_to_execute_when_there_are_no_changes()
    {
        $codeCoverer = $this->prophesize(CodeCoverer::class);
        $codeCoverer->cover()->willReturn(new CodeCoverage([]));
        $testMatcher = new TestMatcher($codeCoverer->reveal());


        $testsToExecute = $testMatcher->matchTests(new Changes([]));

        $this->assertEmpty($testsToExecute->getTests());
    }

    /** @test */
    public function there_is_one_test_to_execute_when_there_is_a_match_between_the_changes_and_one_test_file()
    {
        $codeCoverer = $this->prophesize(CodeCoverer::class);
        $coverage = ['./src/SimpleProductionCode.php' => [new Test('A\ClassName')]];
        $codeCoverer->cover()->willReturn(new CodeCoverage($coverage));
        $testMatcher = new TestMatcher($codeCoverer->reveal());

        $testsToExecute = $testMatcher->matchTests(new Changes([new Change('./src/SimpleProductionCode.php')]));

        $this->assertCount(1, $testsToExecute->getTests());
        /** @var Test $test */
        $test = $testsToExecute->getTests()[0];
        $this->assertInstanceOf(Test::class, $test);
        $this->assertEquals('A\ClassName', $test->fullyQualifyClassName());
    }

    /** @test */
    public function there_is_one_test_to_execute_when_multiple_files_are_covered_by_the_same_test()
    {
        $codeCoverer = $this->prophesize(CodeCoverer::class);
        $coverage = [
            './src/SimpleProductionCode.php' => [new Test('A\ClassName')],
            './src/AnotherProductionCode.php' => [new Test('A\ClassName')],
        ];
        $codeCoverer->cover()->willReturn(new CodeCoverage($coverage));
        $testMatcher = new TestMatcher($codeCoverer->reveal());

        $testsToExecute = $testMatcher->matchTests(new Changes([
            new Change('./src/SimpleProductionCode.php'),
            new Change('./src/AnotherProductionCode.php'),
        ]));

        $this->assertCount(1, $testsToExecute->getTests());
    }

    /** @test */
    public function there_is_more_than_one_test_to_execute_when_the_changes_are_covered_by_the_multiple_tests()
    {
        $codeCoverer = $this->prophesize(CodeCoverer::class);
        $coverage = [
            './src/SimpleProductionCode.php' => [new Test('A\ClassName')],
            './src/AnotherProductionCode.php' => [new Test('A\AnotherClassName')],
        ];
        $codeCoverer->cover()->willReturn(new CodeCoverage($coverage));
        $testMatcher = new TestMatcher($codeCoverer->reveal());

        $testsToExecute = $testMatcher->matchTests(new Changes([
            new Change('./src/SimpleProductionCode.php'),
            new Change('./src/AnotherProductionCode.php'),
        ]));

        $this->assertCount(2, $testsToExecute->getTests());
    }
}