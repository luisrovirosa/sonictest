<?php

namespace JlDojo\SonicTest;

class PhpUnitTestRunner implements TestRunner
{
    public function runTests(Tests $tests): ExecutionResult
    {
        return new ExecutionResult(true, 0);
    }
}