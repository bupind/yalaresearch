<?php

use Symfony\Component\EventDispatcher\EventDispatcher;

(defined('BASEPATH')) || exit('No direct script access allowed');

/**
* 
*/
class MY_Controller extends MX_Controller
{
    
    public function __construct()
    { 
        parent::__construct();

        \CI::$APP->eventDispatcher = new EventDispatcher();

        // Setup the theme
        // get the active theme settings
        $active_templates = $this->config->item('active_template');
        $active_template_admin = $active_templates['admin'];
        $active_template_front = $active_templates['front'];
        defined('ADMIN_TMPL') OR define('ADMIN_TMPL', $active_template_admin);
        defined('FRONT_TMPL') OR define('FRONT_TMPL', $active_template_front);
        $admin_template_path = './templates/admin/'.$active_template_admin.'/';
        $front_template_path = './templates/front/'.$active_template_front.'/';
        if (file_exists($admin_template_path.'functions'.EXT)) {
            Modules::load_file('functions'.EXT, $admin_template_path);
        }
        if (file_exists($front_template_path.'functions'.EXT)) {
            Modules::load_file('functions'.EXT, $front_template_path);
        }

        foreach (Modules::$locations as $location => $offset) {
            $dh = opendir($location);
            while ($file = readdir($dh)) {
                $path = $location.$file;
                if ($file != '.' && $file != '..' && is_dir($path)) {
                    $module = $file;
                    if (file_exists($path.'/setup.php')) {
                        Modules::load_file('setup.php', $path.'/');
                    }
                }
            }
        }
    }
}