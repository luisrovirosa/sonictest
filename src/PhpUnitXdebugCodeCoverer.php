<?php

namespace JlDojo\SonicTest;

class PhpUnitXdebugCodeCoverer implements CodeCoverer
{
    public function cover(): CodeCoverage
    {
        return new CodeCoverage([]);
    }
}