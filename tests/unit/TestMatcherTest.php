<?php

namespace JlDojo\SonicTest\Tests\Unit;

use JlDojo\SonicTest\Changes;
use JlDojo\SonicTest\TestMatcher;
use PHPUnit\Framework\TestCase;

class TestMatcherTest extends TestCase
{
    /** @test */
    public function there_is_no_test_to_execute_when_there_are_no_changes()
    {
        $testMatcher = new TestMatcher();

        $testsToExecute = $testMatcher->matchTests(new Changes([]));

        $this->assertEmpty($testsToExecute->getTests());
    }
}