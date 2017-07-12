<?php

namespace JlDojo\SonicTest;

class PhpUnitXdebugCodeCoverer implements CodeCoverer
{
    const PREFIX = '/tests/data';

    public function cover(): CodeCoverage
    {
        exec('./vendor/bin/phpunit -c ' . self::PREFIX . ' --whitelist .' . self::PREFIX . '/src  --coverage-php file.php');
        /** @var \SebastianBergmann\CodeCoverage\CodeCoverage $coverage */
        $coverage = include './file.php';
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
            return str_replace(dirname(__DIR__) . self::PREFIX, '.', $path);
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

            return array_unique($elements);
        }, $cleanedKeys);
    }
}