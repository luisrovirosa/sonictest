<?php

namespace JlDojo\SonicTest\Output\Printer;

class ConsolePrinter implements Printer
{
    public function report(string $text): void
    {
        echo "$text\n";
    }
}
