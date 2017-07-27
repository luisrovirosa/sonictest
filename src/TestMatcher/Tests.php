<?php

namespace JlDojo\SonicTest;

class Tests
{
    /** @var  Test[] */
    private $tests;

    /**
     * Tests constructor.
     * @param Test[] $tests
     */
    public function __construct(array $tests)
    {
        $this->tests = $tests;
    }

    public function getTests(): array
    {
        return $this->tests;
    }
}