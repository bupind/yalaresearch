<?php  (defined('BASEPATH')) || exit('No direct script access allowed');

// You can find dbforge usage examples here: http://ellislab.com/codeigniter/user-guide/database/forge.html


class Migration_Create_session extends CI_Migration
{
    // use config file variables
    private $use_config     = true;

    // whether to drop table if exists
    private $drop_table     = false;

    // Table names
    private $session_tbl    = '';
    private $session_driver = '';
    private $sess_match_ip  = false;

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();

        $this->use_config();
    }
    
    public function up() 
    {
        $this->session_up();
    }
    
    public function down()
    {
        if ($this->db->table_exists($this->session_tbl)) {
            $this->dbforge->drop_table($this->session_tbl);
        }
    }

    private function use_config() 
    {
        /*
        * If you have the parameter set to use the config table and join names
        * this will change them for you
        */
        if ($this->use_config) {
            $this->session_driver     = $this->config->item('sess_driver');
            $this->session_tbl        = $this->config->item('sess_save_path');
            $this->sess_match_ip      = $this->config->item('sess_match_ip');
        }
    }

    private function session_up()
    {
        if ($this->session_driver != 'database') {
            return false;
        }

        // Drop table 'session' if it exists
        if ($this->db->table_exists($this->session_tbl)) {
            if ($drop_table === false) {
                return;
            }
            $this->dbforge->drop_table($this->session_tbl, TRUE);
        }

        // Table structure for table 'session'
        $this->dbforge->add_field([
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
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('timestamp');
        $this->dbforge->create_table($this->session_tbl);

        if ($this->sess_match_ip === TRUE) {
            $this->db->query("ALTER TABLE {$this->session_tbl} ADD CONSTRAINT {$this->session_tbl}_id_ip UNIQUE (id, ip_address); ");
        }

        log_message('info', 'Session Table Created in Database.');
    }
}
/* End of file '20161119164503_create_session' */
/* Location: ./E:\dev-zone\Computer\web-dev\localhost\freelancing\yalaresearch\application\migrations/20161119164503_create_session.php */
