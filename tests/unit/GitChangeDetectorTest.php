<?php

namespace JlDojo\SonicTest\Tests\Unit;

use JlDojo\SonicTest\GitChangeDetector;
use PHPUnit\Framework\TestCase;

class GitChangeDetectorTest extends TestCase
{
    /** @test */
    public function does_not_detect_any_change_in_a_unmodified_git_repository()
    {
        $gitChangeDetector = new GitChangeDetector();

        $changes = $gitChangeDetector->detectChanges();

        $this->assertEquals([], $changes->getChanges());
    }
}