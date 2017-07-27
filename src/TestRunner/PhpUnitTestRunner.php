<?php

namespace JlDojo\SonicTest;

class PhpUnitTestRunner implements TestRunner
{
    public function runTests(Tests $tests): ExecutionResult
    {
        $hasPassedAllTests = true;
        $numberOfTests = 0;
        /** @var Test $test */
        foreach ($tests->getTests() as $test) {
            $command = "./vendor/bin/phpunit -c ./tests/a_project_to_test --filter '" . $this->classNameForTest($test) . "'";
            exec($command, $output);
            $lastOutput = $output[count($output) - 1];
            $hasPassed = strpos($lastOutput, 'OK') !== false;
            $numberOfTests += $hasPassed
                ? $this->numberOfTestWhenTestPassed($lastOutput)
                : $this->numberOfTestWhenTestFailed($lastOutput);
            $hasPassedAllTests = $hasPassedAllTests && $hasPassed;
        }
        return new ExecutionResult($hasPassedAllTests, $numberOfTests);
    }

    /**
     * @param Test $test
     * @return mixed
     */
    private function classNameForTest(Test $test)
    {
        return str_replace('\\', '\\\\', $test->fullyQualifyClassName());
    }

    /**
     * @param $lastOutput
     * @return int
     */
    private function numberOfTestWhenTestPassed($lastOutput): int
    {
        preg_match('/.*\(([^\ ]*)\ .*/', $lastOutput, $matches);
        return $matches[1];
    }

    private function numberOfTestWhenTestFailed($lastOutput)
    {
        preg_match('/.*Tests: ([^,]*),.*/', $lastOutput, $matches);
        return $matches[1];
    }
}