<?php

namespace JlDojo\SonicTest;


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
        $gitResponse = $this->gitRepository->status();
        return array_values(array_filter($gitResponse, function($line){
           return strpos($line, "modif") !== false;
        }));
    }
}