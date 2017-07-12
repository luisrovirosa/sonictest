<?php

namespace JlDojo\SonicTest;

class TestMatcher
{
    public function matchTests(Changes $changes): Tests
    {
        return new Tests();
    }
}