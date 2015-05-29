<?php
/**
 * Created by PhpStorm.
 * User: itcoder
 * Date: 29.05.15
 * Time: 10:53
 */

class Config
{
    public static $config = null;
    /**
     * Ключ для тестирования
     * @var string
     */
    public static $serverKey = 'stage';

    public function __construct()
    {
        if (self::$config === null) {
            self::$config  = require_once "config.php";
        }
    }

    public function setServerKey($key)
    {
        self::$serverKey = $key;
    }

    public static  function get($key)
    {
        return self::$config[$key][self::$serverKey];
    }
}