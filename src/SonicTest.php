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
     * SonicTest constructor.
     * @param ChangeDetector $changeDetector
     * @param Printer $printer
     */
    public function __construct(ChangeDetector $changeDetector, Printer $printer)
    {
        $this->changeDetector = $changeDetector;
        $this->printer = $printer;
    }

    public static function withPrinter(Printer $printer): SonicTest
    {
        return new SonicTest(null, $printer);
    }

    public function run(): void
    {
        $this->changeDetector->detectChanges();
    }
}