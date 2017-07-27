<?php

namespace JlDojo\SonicTest;

use JlDojo\SonicTest\ChangeDetector\ChangeDetector;
use JlDojo\SonicTest\ChangeDetector\GitChangeDetector;
use JlDojo\SonicTest\ChangeDetector\GitRepository;
use JlDojo\SonicTest\CodeCoverer\PhpUnitXdebugCodeCoverer;
use JlDojo\SonicTest\Output\DefaultOutput;
use JlDojo\SonicTest\Output\Output;
use JlDojo\SonicTest\Output\Printer\Printer;
use JlDojo\SonicTest\TestMatcher\TestMatcher;
use JlDojo\SonicTest\TestRunner\PhpUnitTestRunner;
use JlDojo\SonicTest\TestRunner\TestRunner;

class SonicTest
{
    /**
     * @var ChangeDetector
     */
    private $changeDetector;
    /**
     * @var TestMatcher
     */
    private $testMatcher;
    /**
     * @var TestRunner
     */
    private $testRunner;
    /**
     * @var Output
     */
    private $output;

    /**
     * SonicTest constructor.
     * @param ChangeDetector $changeDetector
     * @param TestMatcher $testMatcher
     * @param TestRunner $testRunner
     * @param Output $output
     */
    public function __construct(
        ChangeDetector $changeDetector,
        TestMatcher $testMatcher,
        TestRunner $testRunner,
        Output $output
    ) {
        $this->changeDetector = $changeDetector;
        $this->testMatcher = $testMatcher;
        $this->testRunner = $testRunner;
        $this->output = $output;
    }

    public static function withPrinter(Printer $printer): SonicTest
    {
        return new SonicTest(
            new GitChangeDetector(new GitRepository()),
            new TestMatcher(new PhpUnitXdebugCodeCoverer()),
            new PhpUnitTestRunner(),
            new DefaultOutput($printer)
        );
    }

    public function run(): void
    {
        $changes = $this->changeDetector->detectChanges();
        $tests = $this->testMatcher->matchTests($changes);
        $executionResult = $this->testRunner->runTests($tests);
        $this->output->printResult($executionResult);
    }
}
