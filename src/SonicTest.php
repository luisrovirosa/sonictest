<?php

namespace JlDojo\SonicTest;

class SonicTest
{
    /**
     * @var ChangeDetector
     */
    private $changeDetector;
    /**
     * @var Printer
     */
    private $printer;
    /**
     * @var TestMatcher
     */
    private $testMatcher;
    /**
     * @var TestRunner
     */
    private $testRunner;
    /**
     * @var Output
     */
    private $output;

    /**
     * SonicTest constructor.
     * @param ChangeDetector $changeDetector
     * @param TestMatcher $testMatcher
     * @param TestRunner $testRunner
     * @param Output $output
     * @param Printer $printer
     */
    public function __construct(
        ChangeDetector $changeDetector,
        TestMatcher $testMatcher,
        TestRunner $testRunner,
        Output $output,
        Printer $printer
    ) {
        $this->changeDetector = $changeDetector;
        $this->testMatcher = $testMatcher;
        $this->testRunner = $testRunner;
        $this->printer = $printer;
        $this->output = $output;
    }

    public static function withPrinter(Printer $printer): SonicTest
    {
        return new SonicTest(null, null, null, null, $printer);
    }

    public function run(): void
    {
        $changes = $this->changeDetector->detectChanges();
        $tests = $this->testMatcher->matchTests($changes);
        $executionResult = $this->testRunner->runTests($tests);
        $this->output->printResult($executionResult);
    }
}