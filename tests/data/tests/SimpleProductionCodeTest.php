<?php

namespace JlDojo\Tests\Data\Tests;

use JlDojo\Tests\Data\SimpleProductionCode;
use PHPUnit\Framework\TestCase;

class SimpleProductionCodeTest extends TestCase
{
    /** @test */
    public function execute_simple_production_code_returns_true()
    {
        $productionCode = new SimpleProductionCode();

        $this->assertTrue($productionCode->execute());
    }
}