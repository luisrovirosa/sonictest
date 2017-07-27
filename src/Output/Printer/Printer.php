<?php

namespace JlDojo\SonicTest\Output\Printer;

interface Printer
{
    public function report(string $text): void;
}
