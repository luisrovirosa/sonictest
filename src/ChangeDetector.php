<?php

namespace JlDojo\SonicTest;

interface ChangeDetector
{
    public function detectChanges() : Changes;
}