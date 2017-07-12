<?php

require './vendor/autoload.php';

$sonicTest = \JlDojo\SonicTest\SonicTest::withPrinter(new \JlDojo\SonicTest\ConsolePrinter());

$sonicTest->run();