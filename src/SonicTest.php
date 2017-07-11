<?php

namespace JlDojo;

class SonicTest
{
    /** @var Printer */
    private $printer;

    /**
     * SonicTest constructor.
     * @param Printer $printer
     */
    public function __construct(Printer $printer)
    {
        $this->printer = $printer;
    }

    public static function withPrinter(Printer $printer) : SonicTest
    {
        return new SonicTest($printer);
    }

    public function run() : void
    {
    }
}