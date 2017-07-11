<?php

namespace JlDojo\SonicTest;

class GitRepository
{
    public function status(): array
    {
        exec("git status", $output);
        return $output;
    }
}