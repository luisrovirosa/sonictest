<?php

namespace JlDojo\SonicTest\Tests;

class Developer
{
    const SIMPLE_PRODUCTION_CODE_PATH = __DIR__ . '/data/src/SimpleProductionCode.php';

    public function changeSimpleProductionCode()
    {
        $content = file_get_contents(self::SIMPLE_PRODUCTION_CODE_PATH);
        $changedContent = str_replace('return true;', "echo 'hello';\nreturn true;", $content);
        file_put_contents(self::SIMPLE_PRODUCTION_CODE_PATH, $changedContent);
    }

    public function revertProductionCode()
    {
        $content = file_get_contents(self::SIMPLE_PRODUCTION_CODE_PATH);
        $changedContent = str_replace("echo 'hello';\nreturn true;", 'return true;', $content);
        file_put_contents(self::SIMPLE_PRODUCTION_CODE_PATH, $changedContent);
    }

}