<?php

namespace JlDojo\SonicTest;

class PhpUnitXdebugCodeCoverer implements CodeCoverer
{
    const PROJECT_TO_TEST = '/tests/a_project_to_test';
    const RELATIVE_PATH   = '.' . self::PROJECT_TO_TEST;
    const COVERAGE_FILE   = './file.php';

    public function cover(): CodeCoverage
    {
        exec('./vendor/bin/phpunit -c ' . self::RELATIVE_PATH. ' --whitelist ' . self::RELATIVE_PATH. '/src  --coverage-php ' . self::COVERAGE_FILE . '');
        /** @var \SebastianBergmann\CodeCoverage\CodeCoverage $coverage */
        $coverage = include self::COVERAGE_FILE;
        $rawCodeCoverage = $coverage->getData();
        $coveredFiles = $this->removeWorkingDirectoryFromFilePath($rawCodeCoverage);
        return new CodeCoverage($this->calculateTestToExecute($coveredFiles));
    }

    /**
     * @param $rawCodeCoverage
     * @return array
     */
    private function removeWorkingDirectoryFromFilePath($rawCodeCoverage): array
    {
        $keys = array_map(function ($path) {
            return str_replace(dirname(__DIR__) . self::PROJECT_TO_TEST, '.', $path);
        }, array_keys($rawCodeCoverage));
        return array_combine($keys, $rawCodeCoverage);
    }

    /**
     * @param $cleanedKeys
     * @return array
     */
    private function calculateTestToExecute($cleanedKeys): array
    {
        return array_map(function ($listOfTests) {
            if (count($listOfTests) == 0) {
                return $listOfTests;
            }
            $testNotNull = array_filter($listOfTests, function ($elements) {
                return is_array($elements);
            });
            $elements = [];
            foreach ($testNotNull as $tests) {
                $elements = array_merge($elements, $tests);
            }

            $files = array_unique($elements);

            return array_map(function($file){
                return new Test($file);
            }, $files);
        }, $cleanedKeys);
    }
}