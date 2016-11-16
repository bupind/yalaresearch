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

        // see if the sessions table exists
        // if not create it.
        if ($this->config->item('sess_driver') == 'database'
            && ! $this->db->table_exists($this->config->item('sess_save_path'))) {
            $this->_createSessionTable();
        }

        // Setup the theme
        // get the active theme settings
        $active_templates = $this->config->item('active_template');
        $active_template_admin = $active_templates['admin'];
        $active_template_front = $active_templates['front'];
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

    private function _createSessionTable()
    {
        $this->load->dbforge();

        $fields = [
            'id'    => [
                'TYPE'          => 'VARCHAR',
                'constraint'    => '40'
            ],
            'ip_address'    => [
                'TYPE'          => 'VARCHAR',
                'constraint'    => '45'
            ],
            'timestamp'    => [
                'TYPE'          => 'INT',
                'constraint'    => 10,
                'unsigned'      => TRUE,
                'default'       => 0
            ],
            'data'    => [
                'TYPE'          => 'BLOB'
            ],
        ];
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('timestamp');
        $this->dbforge->create_table($this->config->item('sess_save_path'), TRUE);

        if ($this->config->item('sess_match_ip') === TRUE) {
            $this->db->query("ALTER TABLE {$this->config->item('sess_save_path')} ADD CONSTRAINT {$this->config->item('sess_save_path')}_id_ip UNIQUE (id, ip_address); ");
        }

        log_message('info', 'Session Table Created in Database.');
    }
}