<?php

namespace JlDojo\SonicTest\ChangeDetector;


class GitChangeDetector implements ChangeDetector
{
    /** @var  GitRepository */
    private $gitRepository;

    /**
     * GitChangeDetector constructor.
     * @param GitRepository $gitRepository
     */
    public function __construct(GitRepository $gitRepository)
    {
        $this->gitRepository = $gitRepository;
    }

    public function detectChanges(): Changes
    {
        $modifiedFiles = $this->getModifiedFiles();
        $changes = array_map(function($file){
            return new Change($file);
        }, $modifiedFiles);
        return new Changes($changes);
    }

    /**
     * @return mixed
     */
    private function getModifiedFiles()
    {
        $gitResponse = $this->gitRepository->shortStatus();

        return array_map(function($line){
            return substr($line, 3);
        }, $gitResponse);
    }
}
