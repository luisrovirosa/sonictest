<?php

namespace JlDojo\SonicTest;

class DefaultOutput implements Output
{
    /** @var  Printer */
    private $printer;

    /**
     * DefaultOutput constructor.
     * @param Printer $printer
     */
    public function __construct(Printer $printer)
    {
        $this->printer = $printer;
    }

    public function printResult(ExecutionResult $executionResult): void
    {
        if ($executionResult->numberOfTests() == 0){
            $this->printer->report("There is no test affected by changes");
        } elseif ($executionResult->hasPassed()) {
            $this->printer->report("OK ({$executionResult->numberOfTests()} test)");
        } else {
            $this->printer->report("ERROR ({$executionResult->numberOfTests()} test)");
        }
    }
}