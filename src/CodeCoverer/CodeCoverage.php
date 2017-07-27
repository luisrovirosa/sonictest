<?php

namespace JlDojo\SonicTest;

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