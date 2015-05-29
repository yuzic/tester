<?php
require_once "App/Tester.php";
require "App/Helper/Console.php";
require "App/Config.php";

$config = new Config();
$config->setServerKey('stage');
$nameRun = $argv[1];

$path = realpath('./acceptance');

$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path),
    RecursiveIteratorIterator::SELF_FIRST);

foreach($objects as $name => $object) {
    if (!is_dir($name)) {
        Helper_Console::stdoutColor("Start test ------------------------------- $name \n", 37);
        // запускаем если указана директкория в параметрах
        if (!empty($nameRun) && strpos($name, $nameRun) > 0) {
            require_once $name;
            break;
        } else {
            require_once $name;
        }

    }
}
