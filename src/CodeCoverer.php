<?php

namespace JlDojo\SonicTest;

interface CodeCoverer
{
    public function cover() : CodeCoverage;
}