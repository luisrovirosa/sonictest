<?php

namespace JlDojo\SonicTest\ChangeDetector;

class Changes
{
    /** @var  Change[] */
    private $changes;

    /**
     * Changes constructor.
     * @param Change[] $changes
     */
    public function __construct(array $changes)
    {
        $this->changes = $changes;
    }

    /**
     * @return Change[] array
     */
    public function getChanges() : array
    {
        return $this->changes;
    }
}
