<?php

namespace JlDojo\SonicTest\TestRunner;

use JlDojo\SonicTest\TestMatcher\Tests;

interface TestRunner
{
    public function runTests(Tests $tests) : ExecutionResult;
}
