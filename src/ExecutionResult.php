<?php

namespace JlDojo\SonicTest;

class ExecutionResult
{
    /** @var bool */
    private $hasPassed;

    /** @var  int */
    private $numberOfTests;

    /**
     * ExecutionResult constructor.
     * @param bool $hasPassed
     * @param int $numberOfTests
     */
    public function __construct(bool $hasPassed, int $numberOfTests)
    {
        $this->hasPassed = $hasPassed;
        $this->numberOfTests = $numberOfTests;
    }

    /**
     * @return bool
     */
    public function hasPassed(): bool
    {
        return $this->hasPassed;
    }

    /**
     * @return int
     */
    public function numberOfTests(): int
    {
        return $this->numberOfTests;
    }
}