<?php

namespace JlDojo\SonicTest\Output;

use JlDojo\SonicTest\TestRunner\ExecutionResult;

interface Output
{
    public function printResult(ExecutionResult $executionResult): void;
}
