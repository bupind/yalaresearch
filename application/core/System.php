<?php

(defined('BASEPATH')) || exit('No direct script access allowed');

/**
* System Class
*/
class System
{
    private static $CI;

    public function __construct() {}

    public static function init()
    {
        self::$CI =& get_instance();
        
        log_message('info', 'System Initialized.');
        self::$CI->benchmark->mark('system_init_end');
    }
}