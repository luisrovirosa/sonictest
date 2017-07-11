<?php

namespace JlDojo\SonicTest;

class SonicTest
{
    /**
     * @var ChangeDetector
     */
    private $changeDetector;
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
     */
    public function __construct(
        ChangeDetector $changeDetector,
        TestMatcher $testMatcher,
        TestRunner $testRunner,
        Output $output
    ) {
        $this->changeDetector = $changeDetector;
        $this->testMatcher = $testMatcher;
        $this->testRunner = $testRunner;
        $this->output = $output;
    }

    public static function withPrinter(Printer $printer): SonicTest
    {
        return new SonicTest(null, null, null, null);
    }

    public function run(): void
    {
        $changes = $this->changeDetector->detectChanges();
        $tests = $this->testMatcher->matchTests($changes);
        $executionResult = $this->testRunner->runTests($tests);
        $this->output->printResult($executionResult);
    }
}