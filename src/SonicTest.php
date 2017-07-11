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
     * SonicTest constructor.
     * @param ChangeDetector $changeDetector
     * @param TestMatcher $testMatcher
     * @param TestRunner $testRunner
     * @param Printer $printer
     */
    public function __construct(
        ChangeDetector $changeDetector,
        TestMatcher $testMatcher,
        TestRunner $testRunner,
        Printer $printer
    ) {
        $this->changeDetector = $changeDetector;
        $this->testMatcher = $testMatcher;
        $this->testRunner = $testRunner;
        $this->printer = $printer;
    }

    public static function withPrinter(Printer $printer): SonicTest
    {
        return new SonicTest(null, null, null, $printer);
    }

    public function run(): void
    {
        $changes = $this->changeDetector->detectChanges();
        $tests = $this->testMatcher->matchTests($changes);
        $this->testRunner->runTests($tests);
    }
}