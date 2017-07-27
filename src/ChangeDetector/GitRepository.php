<?php

namespace JlDojo\SonicTest\ChangeDetector;

class GitRepository
{
    public function shortStatus(): array
    {
        exec("git status --short", $output);
        return $output;
    }
}
