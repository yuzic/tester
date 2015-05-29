<?php
require_once "App/Tester.php";
require "App/Helper/Console.php";
require "App/Config.php";

$path = realpath('./acceptance');

$config = new Config();
$config->setServerKey('stage');

$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path),
    RecursiveIteratorIterator::SELF_FIRST);

foreach($objects as $name => $object) {
    if (!is_dir($name)) {
        Helper_Console::stdoutColor("Start test ------------------------------- $name \n", 37);
        require_once $name;
    }
}
