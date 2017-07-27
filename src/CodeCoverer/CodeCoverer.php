<?php

namespace JlDojo\SonicTest\CodeCoverer;

interface CodeCoverer
{
    public function cover() : CodeCoverage;
}
