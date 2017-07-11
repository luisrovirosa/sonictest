<?php

namespace JlDojo\SonicTest;

class GitRepository
{
    public function shortStatus(): array
    {
        exec("git status --short", $output);
        return $output;
    }
}