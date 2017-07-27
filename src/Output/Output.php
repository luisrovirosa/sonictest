<?php

namespace JlDojo\SonicTest;

interface Output
{
    public function printResult(ExecutionResult $executionResult): void;
}