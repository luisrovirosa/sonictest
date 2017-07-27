<?php

namespace JlDojo\SonicTest;

class ConsolePrinter implements Printer
{
    public function report(string $text): void
    {
        echo "$text\n";
    }
}