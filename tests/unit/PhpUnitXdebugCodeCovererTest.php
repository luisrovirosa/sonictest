<?php

namespace JlDojo\SonicTest\Tests\Unit;

use JlDojo\SonicTest\PhpUnitXdebugCodeCoverer;
use JlDojo\SonicTest\Test;
use PHPUnit\Framework\TestCase;

class PhpUnitXdebugCodeCovererTest extends TestCase
{
    const UNCOVERED_PRODUCTION_CODE = 'tests/a_project_to_test/src/UncoveredProductionCode.php';
    const SIMPLE_PRODUCTION_CODE    = 'tests/a_project_to_test/src/SimpleProductionCode.php';

    protected function tearDown()
    {
        parent::tearDown();
        unlink('./file.php');
    }

    /** @test */
    public function there_is_no_test_related_to_an_uncovered_file()
    {
        $codeCoverer = new PhpUnitXdebugCodeCoverer();

        $codeCoverage = $codeCoverer->cover();

        $this->assertEquals([], $codeCoverage->testsRelatedTo(self::UNCOVERED_PRODUCTION_CODE));
    }

    /** @test */
    public function the_test_that_covers_a_file_is_returned()
    {
        $codeCoverer = new PhpUnitXdebugCodeCoverer();

        $codeCoverage = $codeCoverer->cover();

        $relatedTests = $codeCoverage->testsRelatedTo(self::SIMPLE_PRODUCTION_CODE);
        $this->assertCount(1, $relatedTests);
        /** @var Test $relatedTest */
        $relatedTest = $relatedTests[0];
        $this->assertInstanceOf(Test::class, $relatedTest);
        $this->assertStringStartsWith('JlDojo\SonicTest\Tests\ProjectToTest\Tests\SimpleProductionCodeTest', $relatedTest->fullyQualifyClassName());
    }
}