<?php

namespace JlDojo\SonicTest\ChangeDetector;

class Change
{
    /** @var  string */
    private $filePath;

    /**
     * Change constructor.
     * @param string $filePath
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function filePath() : string
    {
        return $this->filePath;
    }
}
