<?php

namespace JlDojo\SonicTest;

class Test
{
    private $fullyQualifyClassName;

    /**
     * Test constructor.
     * @param string $fullyQualifyClassName example: JlDojo\SonicTest\Tests\ProjectToTest\Tests\SimpleProductionCodeTest
     */
    public function __construct($fullyQualifyClassName)
    {
        $this->fullyQualifyClassName = $fullyQualifyClassName;
    }

    /**
     * @return mixed
     */
    public function fullyQualifyClassName()
    {
        return $this->fullyQualifyClassName;
    }

    function __toString()
    {
        return $this->fullyQualifyClassName();
    }
}