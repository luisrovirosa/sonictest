<?php

namespace JlDojo\SonicTest\Tests\Unit;

use JlDojo\SonicTest\GitChangeDetector;
use JlDojo\SonicTest\GitRepository;
use PHPUnit\Framework\TestCase;

class GitChangeDetectorTest extends TestCase
{
    /** @test */
    public function does_not_detect_any_change_in_a_unmodified_git_repository()
    {
        $gitRepositoryProphecy = $this->prophesize(GitRepository::class);
        $gitRepositoryProphecy->status()->willReturn([
            '# On branch master',
            'nothing to commit, working directory clean'
        ]);
        $gitChangeDetector = new GitChangeDetector($gitRepositoryProphecy->reveal());

        $changes = $gitChangeDetector->detectChanges();

        $this->assertEquals([], $changes->getChanges());
    }

    /** @test */
    public function detects_a_change_in_a_modified_git_repository()
    {
        $gitRepositoryProphecy = $this->prophesize(GitRepository::class);
        $gitRepositoryProphecy->status()->willReturn([
            '# On branch master',
            '# Changes not staged for commit:',
            '#   (use "git add <file>..." to update what will be committed)',
            '#   (use "git checkout -- <file>..." to discard changes in working directory)',
            '#',
            '#    modified:   tests/data/src/SimpleProductionCode.php',
            '#',
            'no changes added to commit (use "git add" and/or "git commit -a")'
        ]);
        $gitChangeDetector = new GitChangeDetector($gitRepositoryProphecy->reveal());

        $changes = $gitChangeDetector->detectChanges();

        $this->assertCount(1, $changes->getChanges());
    }
}