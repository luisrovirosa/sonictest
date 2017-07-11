<?php

namespace JlDojo\SonicTest;

class GitChangeDetector implements ChangeDetector
{
    public function detectChanges(): Changes
    {
        return new Changes([]);
    }
}