<?php  (defined('BASEPATH')) || exit('No direct script access allowed');

// You can find dbforge usage examples here: http://ellislab.com/codeigniter/user-guide/database/forge.html


class Migration_Create_ion_auth extends CI_Migration
{
    // use config file variables
    private $use_config     = true;

    // whether to drop table if exists
    private $drop_table     = false;

    // Table names
    private $users          = '';
    private $groups         = '';
    private $users_groups   = '';
    private $login_attempts = '';
    
    // Join names
    private $groups_join    = '';
    private $users_join     = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();

        $this->use_config();
    }
    
    public function up() 
    {
        $this->groups_up();
        $this->users_up();
        $this->users_groups_up();
        $this->login_attempts_up();
    }
    
    public function down()
    {
        $this->dbforge->drop_table($this->groups);
        $this->dbforge->drop_table($this->users);
        $this->dbforge->drop_table($this->users_groups);
        $this->dbforge->drop_table($this->login_attempts);
    }

    private function use_config() 
    {
        /*
        * If you have the parameter set to use the config table and join names
        * this will change them for you
        */
        if ($this->use_config) {
            $this->config->load('ion_auth', TRUE);
            $tables     = $this->config->item('tables', 'ion_auth');
            $joins      = $this->config->item('join', 'ion_auth');
            
            // table names
            $this->users            = $tables['users']; 
            $this->groups           = $tables['groups'];
            $this->users_groups     = $tables['users_groups'];
            $this->login_attempts   = $tables['login_attempts'];
            
            // join names                          
            $this->groups_join  = $joins['groups'];
            $this->users_join   = $joins['users'];
        }
    }

    private function groups_up()
    {
        // Drop table 'groups' if it exists
        if ($this->db->table_exists($this->groups)) {
            if ($drop_table === false) {
                return;
            }
            $this->dbforge->drop_table($this->groups, TRUE);
        }

        // Table structure for table 'groups'
        $this->dbforge->add_field([
            'id' => [
                'type' => 'MEDIUMINT',
                'constraint' => '8',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table($this->groups);

        log_message('info', 'Auth Groups Table Created in Database.');

        // Dumping data for table 'groups'
        $data = [
            [
                'id' => '1',
                'name' => 'admin',
                'description' => 'Administrator'
            ],
            [
                'id' => '2',
                'name' => 'members',
                'description' => 'General User'
            ]
        ];
        $this->db->insert_batch($this->groups, $data);
    }

    private function users_up()
    {
        // Drop table 'users' if it exists
        if ($this->db->table_exists($this->users)) {
            if ($drop_table === false) {
                return;
            }
            $this->dbforge->drop_table($this->users, TRUE);
        }

        // Table structure for table 'users'
        $this->dbforge->add_field([
            'id' => [
                'type' => 'MEDIUMINT',
                'constraint' => '8',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => '16'
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '80',
            ],
            'salt' => [
                'type' => 'VARCHAR',
                'constraint' => '40'
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'activation_code' => [
                'type' => 'VARCHAR',
                'constraint' => '40',
                'null' => TRUE
            ],
            'forgotten_password_code' => [
                'type' => 'VARCHAR',
                'constraint' => '40',
                'null' => TRUE
            ],
            'forgotten_password_time' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'null' => TRUE
            ],
            'remember_code' => [
                'type' => 'VARCHAR',
                'constraint' => '40',
                'null' => TRUE
            ],
            'created_on' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
            ],
            'last_login' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'null' => TRUE
            ],
            'active' => [
                'type' => 'TINYINT',
                'constraint' => '1',
                'unsigned' => TRUE,
                'null' => TRUE
            ],
            'first_name' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE
            ],
            'last_name' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE
            ],
            'company' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => TRUE
            ]

        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table($this->users);

        log_message('info', 'Auth Users Table Created in Database.');

        // Dumping data for table 'users'
        $data = [
            'id' => '1',
            'ip_address' => '127.0.0.1',
            'username' => 'admin',
            'password' => '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36',
            'salt' => '',
            'email' => 'admin@admin.com',
            'activation_code' => '',
            'forgotten_password_code' => NULL,
            'created_on' => '1268889823',
            'last_login' => '1268889823',
            'active' => '1',
            'first_name' => 'Admin',
            'last_name' => 'istrator',
            'company' => 'ADMIN',
            'phone' => '0',
        ];
        $this->db->insert($this->users, $data);
    }

    private function users_groups_up()
    {
        // Drop table 'users_groups' if it exists
        if ($this->db->table_exists($this->users_groups)) {
            if ($drop_table === false) {
                return;
            }
            $this->dbforge->drop_table($this->users_groups, TRUE);
        }

        // Table structure for table 'users_groups'
        $this->dbforge->add_field([
            'id' => [
                'type' => 'MEDIUMINT',
                'constraint' => '8',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            "$this->users_join" => [
                'type' => 'MEDIUMINT',
                'constraint' => '8',
                'unsigned' => TRUE
            ],
            "$this->groups_join" => [
                'type' => 'MEDIUMINT',
                'constraint' => '8',
                'unsigned' => TRUE
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field("CONSTRAINT fk_users_groups_user_id FOREIGN KEY (`{$this->users_join}`) REFERENCES {$this->users}(`id`)");
        $this->dbforge->add_field("CONSTRAINT fk_users_groups_group_id FOREIGN KEY (`{$this->groups_join}`) REFERENCES {$this->groups}(`id`)");
        $this->dbforge->create_table($this->users_groups);

        log_message('info', 'Auth Users Groups Table Created in Database.');

        // Dumping data for table 'users_groups'
        $data = [
            [
                'id' => '1',
                "$this->users_join" => '1',
                "$this->groups_join" => '1',
            ],
            [
                'id' => '2',
                "$this->users_join" => '1',
                "$this->groups_join" => '2',
            ]
        ];
        $this->db->insert_batch($this->users_groups, $data);
    }

    private function login_attempts_up()
    {
        // Drop table 'login_attempts' if it exists
        if ($this->db->table_exists($this->login_attempts)) {
            if ($drop_table === false) {
                return;
            }
            $this->dbforge->drop_table($this->login_attempts, TRUE);
        }

        // Table structure for table 'login_attempts'
        $this->dbforge->add_field([
            'id' => [
                'type' => 'MEDIUMINT',
                'constraint' => '8',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => '16'
            ],
            'login' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ],
            'time' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'null' => TRUE
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('ip_address');
        $this->dbforge->add_key('login');
        $this->dbforge->create_table($this->login_attempts);

        log_message('info', 'Auth User Login Attempts Table Created in Database.');
    }
}
/* End of file '20161119164511_create_ion_auth' */
/* Location: ./E:\dev-zone\Computer\web-dev\localhost\freelancing\yalaresearch\application\migrations/20161119164511_create_ion_auth.php */
