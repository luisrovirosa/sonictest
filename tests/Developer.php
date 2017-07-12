<?php

namespace JlDojo\SonicTest\Tests;

class Developer
{
    const SIMPLE_PRODUCTION_CODE_PATH = __DIR__ . '/a_project_to_test/src/SimpleProductionCode.php';

    public function changeSimpleProductionCode()
    {
        $content = file_get_contents(self::SIMPLE_PRODUCTION_CODE_PATH);
        $changedContent = str_replace('$result = true;', "echo 'hello';\n\$result = true;", $content);
        file_put_contents(self::SIMPLE_PRODUCTION_CODE_PATH, $changedContent);
    }

    public function revertProductionCode()
    {
        $content = file_get_contents(self::SIMPLE_PRODUCTION_CODE_PATH);
        $changedContent = str_replace("echo 'hello';\n\$result = true;", '$result = true;', $content);
        file_put_contents(self::SIMPLE_PRODUCTION_CODE_PATH, $changedContent);
    }

}