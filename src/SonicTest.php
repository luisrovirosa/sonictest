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
     * SonicTest constructor.
     * @param ChangeDetector $changeDetector
     * @param TestMatcher $testMatcher
     * @param Printer $printer
     */
    public function __construct(
        ChangeDetector $changeDetector,
        TestMatcher $testMatcher,
        Printer $printer
    ) {
        $this->changeDetector = $changeDetector;
        $this->printer = $printer;
        $this->testMatcher = $testMatcher;
    }

    public static function withPrinter(Printer $printer): SonicTest
    {
        return new SonicTest(null, null, $printer);
    }

    public function run(): void
    {
        $changes = $this->changeDetector->detectChanges();
        $this->testMatcher->matchTests($changes);
    }
}