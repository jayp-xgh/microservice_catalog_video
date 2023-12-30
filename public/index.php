<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Test;

$test = new Test();
var_dump($test->foo());
