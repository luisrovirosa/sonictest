<?php

namespace JlDojo\SonicTest\ChangeDetector;

interface ChangeDetector
{
    public function detectChanges() : Changes;
}
