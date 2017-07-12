<?php

namespace JlDojo\SonicTest;

class PhpUnitTestRunner implements TestRunner
{
    public function runTests(Tests $tests): ExecutionResult
    {
        $hasPassed = true;
        $numberOfTests = 0;
        /** @var Test $test */
        foreach ($tests->getTests() as $test){
            $command = "./vendor/bin/phpunit --filter '" . $this->classNameForTest($test) . "'";
            exec($command, $output);
            $lastOutput = $output[count($output) - 1];
            $hasPassed = strpos($lastOutput, 'OK') !== false;
            preg_match('/.*\(([^\ ]*)\ .*/',$lastOutput, $matches);
            $numberOfTests = $matches[1];
        }
        return new ExecutionResult($hasPassed, $numberOfTests);
    }

    /**
     * @param Test $test
     * @return mixed
     */
    private function classNameForTest(Test $test)
    {
        return str_replace('\\', '\\\\', $test->fullyQualifyClassName());
    }
}