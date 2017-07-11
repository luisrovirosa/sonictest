<?php

namespace JlDojo\SonicTest\Tests\Unit;

use JlDojo\SonicTest\Change;
use JlDojo\SonicTest\GitChangeDetector;
use JlDojo\SonicTest\GitRepository;
use PHPUnit\Framework\TestCase;

class GitChangeDetectorTest extends TestCase
{
    /** @test */
    public function does_not_detect_any_change_in_a_unmodified_git_repository()
    {
        $gitRepositoryProphecy = $this->prophesize(GitRepository::class);
        $gitRepositoryProphecy->shortStatus()->willReturn([]);
        $gitChangeDetector = new GitChangeDetector($gitRepositoryProphecy->reveal());

        $changes = $gitChangeDetector->detectChanges();

        $this->assertEquals([], $changes->getChanges());
    }

    /** @test */
    public function detects_a_change_in_a_modified_git_repository()
    {
        $gitRepositoryProphecy = $this->prophesize(GitRepository::class);
        $gitRepositoryProphecy->shortStatus()->willReturn([
            ' M tests/data/src/SimpleProductionCode.php',
        ]);
        $gitChangeDetector = new GitChangeDetector($gitRepositoryProphecy->reveal());

        $changes = $gitChangeDetector->detectChanges();

        $this->assertCount(1, $changes->getChanges());
        /** @var Change $change */
        $change = $changes->getChanges()[0];
        $this->assertEquals("tests/data/src/SimpleProductionCode.php", $change->filePath());
    }
}