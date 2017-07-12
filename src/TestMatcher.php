<?php

namespace JlDojo\SonicTest;

class TestMatcher
{
    /** @var  CodeCoverer */
    private $codeCoverer;

    /**
     * TestMatcher constructor.
     * @param CodeCoverer $codeCoverer
     */
    public function __construct(CodeCoverer $codeCoverer)
    {
        $this->codeCoverer = $codeCoverer;
    }

    public function matchTests(Changes $changes): Tests
    {
        $tests = $this->codeCoverer->cover();
        $matchedTests = [];
        foreach ($changes->getChanges() as $change){
            $matchedTests = array_merge($matchedTests, $tests->testsRelatedTo($change->filePath()));
        }

        return new Tests(array_unique($matchedTests));
    }
}