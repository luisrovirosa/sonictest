<?php

namespace JlDojo\SonicTest\Tests\Unit;

use JlDojo\SonicTest\PhpUnitXdebugCodeCoverer;
use PHPUnit\Framework\TestCase;

class PhpUnitXdebugCodeCovererTest extends TestCase
{
    const UNCOVERED_PRODUCTION_CODE = 'src/UncoveredProductionCode.php';

    /** @test */
    public function there_is_no_test_related_to_an_uncovered_file()
    {
        $codeCoverer = new PhpUnitXdebugCodeCoverer();

        $codeCoverage = $codeCoverer->cover();

        $this->assertEquals([], $codeCoverage->testsRelatedTo(self::UNCOVERED_PRODUCTION_CODE));
    }
}