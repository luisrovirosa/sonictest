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

    public function run() : void
    {
    }
}