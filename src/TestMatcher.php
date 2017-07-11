<?php

namespace JlDojo\SonicTest;

interface TestMatcher
{
    public function matchTests(Changes $changes) : Tests;

}