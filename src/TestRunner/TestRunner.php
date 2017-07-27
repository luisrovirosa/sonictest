<?php

namespace JlDojo\SonicTest;

interface TestRunner
{
    public function runTests(Tests $tests) : ExecutionResult;
}