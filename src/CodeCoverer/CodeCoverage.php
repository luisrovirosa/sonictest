<?php

namespace JlDojo\SonicTest\CodeCoverer;

use JlDojo\SonicTest\TestMatcher\Tests;

class CodeCoverage
{
    /** @var  array */
    private $coverage;

    /**
     * CodeCoverage constructor.
     * @param Tests[] $coverage
     */
    public function __construct(array $coverage)
    {
        $this->coverage = $coverage;
    }

    public function testsRelatedTo($path) : array
    {
        return $this->coverage[$path] ?? [];
    }
}
