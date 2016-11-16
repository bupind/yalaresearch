<?php  (defined('BASEPATH')) || exit('No direct script access allowed');

// You can find dbforge usage examples here: http://ellislab.com/codeigniter/user-guide/database/forge.html


class Migration_Create_ion_auth extends CI_Migration
{
    // use config file variables
    private $use_config     = TRUE;

    // Table names
    private $users          = TBL_AUTH_USERS;
    private $groups         = TBL_AUTH_GROUPS;
    private $users_groups   = TBL_AUTH_USERS_GROUPS;
    private $login_attempts = TBL_AUTH_LOGIN_ATTEMPTS;
    
    // Join names
    private $groups_join    = 'group_id';
    private $users_join     = 'user_id';

    public function __construct()
	{
	    parent::__construct();
		$this->load->dbforge();

        // Function to use config variables if 
        $this->use_config();
	}

    private function use_config() 
    {
        /*
        * If you have the parameter set to use the config table and join names
        * this will change them for you
        */
        if ($this->use_config) {
            $this->config->load('ion_auth', TRUE);
            $tables = $this->config->item('tables', 'ion_auth');
            $joins = $this->config->item('join', 'ion_auth');
            // table names
            $this->users        = $tables['users']; 
            $this->groups       = $tables['groups'];
            $this->users_groups = $tables['users_groups'];
            $this->login_attempts = $tables['login_attempts'];
            // join names                          
            $this->groups_join  = $joins['groups'];
            $this->users_join   = $joins['users'];
        }
    }
	
	function up() 
    {   
        /*
        * In order to  add default data with migrations 
        */
        
        // groups
        if (!$this->db->table_exists($this->groups)) 
        {   
            // Setup Keys
            $this->dbforge->add_key('id', TRUE);
            
            $this->dbforge->add_field(array(
                'id' => array('type' => 'MEDIUMINT', 'constraint' => 8, 'unsigned' => TRUE, 'null' => FALSE, 'auto_increment' => TRUE),
                'name' => array('type' => 'VARCHAR', 'constraint' => '20', 'null' => FALSE),
                'description' => array('type' => 'VARCHAR', 'constraint' => '100', 'null' => FALSE)
            ));
            // create table
            $this->dbforge->create_table($this->groups, TRUE);
            
            // default data
            $this->db->insert($this->groups, array('id'=>null,'name'=>'admin','description'=>'Administrator'));
            $this->db->insert($this->groups, array('id'=>null,'name'=>'members','description'=>'General User'));
        }

        // users
        if (!$this->db->table_exists($this->users)) 
        {   
            // Setup Keys
            $this->dbforge->add_key('id', TRUE);
            
            $this->dbforge->add_field(array(
                'id' => array('type' => 'MEDIUMINT', 'constraint' => 8, 'unsigned' => TRUE, 'null' => FALSE, 'auto_increment' => TRUE),
                'ip_address' => array('type' => 'VARBINARY', 'constraint' => '16', 'null' => FALSE),
                'username' => array('type' => 'VARCHAR', 'constraint' => '100', 'null' => FALSE),
                'password' => array('type' => 'VARCHAR', 'constraint' => '80', 'null' => FALSE),
                'salt' => array('type' => 'VARCHAR', 'constraint' => '40', 'null' => TRUE),
                'email' => array('type' => 'VARCHAR', 'constraint' => '100', 'null' => FALSE),
                'activation_code' => array('type' => 'VARCHAR', 'constraint' => '40', 'null' => TRUE),
                'forgotten_password_code' => array('type' => 'VARCHAR', 'constraint' => '40', 'null' => TRUE),
                'forgotten_password_time' => array('type' => 'int', 'constraint' => '11', 'unsigned' => TRUE, 'null' => TRUE),
                'remember_code' => array('type' => 'VARCHAR', 'constraint' => '40', 'null' => TRUE),
                'created_on' => array('type' => 'int', 'constraint' => '11', 'unsigned' => TRUE, 'null' => FALSE),
                'last_login' => array('type' => 'int', 'constraint' => '11', 'unsigned' => TRUE, 'null' => TRUE),
                'active' => array('type' => 'tinyint', 'constraint' => '1', 'unsigned' => TRUE, 'null' => TRUE),
                'first_name' => array('type' => 'VARCHAR', 'constraint' => '50', 'null' => TRUE),
                'last_name' => array('type' => 'VARCHAR', 'constraint' => '100', 'null' => TRUE),
                'company' => array('type' => 'VARCHAR', 'constraint' => '100', 'null' => TRUE),
                'phone' => array('type' => 'VARCHAR', 'constraint' => '50', 'null' => TRUE)
            ));
            // create table
            $this->dbforge->create_table($this->users, TRUE);
            
            // default data
            $data = array(
                'ip_address'=> inet_pton('127.0.0.1'),
                'username'=>'administrator',
                'password'=>'59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4',
                'salt'=>'9462e8eee0',
                'email'=>'admin@admin.com',
                'activation_code'=>'',
                'forgotten_password_code'=>NULL,
                'forgotten_password_time'=>NULL,
                'created_on'=>'1268889823',
                'last_login'=>'1268889823',
                'active'=>'1',
                'first_name' => 'Admin',
                'last_name' => 'istrator',
                'company' => 'ADMIN',
                'phone' => '0'
            );
            $this->db->insert($this->users, $data);
        }
        
        // users_groups 
        if (!$this->db->table_exists($this->users_groups)) 
        {
            // Setup keys
            $this->dbforge->add_key('id', TRUE);
            
            // Build Schema 
            $this->dbforge->add_field(array(
                'id' => array('type' => 'MEDIUMINT', 'constraint' => 8, 'unsigned' => TRUE, 'null' => FALSE, 'auto_increment' => TRUE),
                "$this->users_join" => array('type' => 'MEDIUMINT', 'constraint' => 8, 'unsigned' => TRUE, 'null' => FALSE),
                "$this->groups_join" => array('type' => 'MEDIUMINT', 'constraint' => 8, 'unsigned' => TRUE, 'null' => FALSE)
            ));
            $this->dbforge->add_field("CONSTRAINT fk_users_groups_user_id FOREIGN KEY (`{$this->users_join}`) REFERENCES {$this->users}(`id`)");
            $this->dbforge->add_field("CONSTRAINT fk_users_groups_group_id FOREIGN KEY (`{$this->groups_join}`) REFERENCES {$this->groups}(`id`)");
            // create table
            $this->dbforge->create_table($this->users_groups, TRUE);
            
            // define default data
            $data = array(
                array(
                    "$this->users_join"  => 1,
                    "$this->groups_join" => 1
                ),
                array(
                    "$this->users_join"  => 1,
                    "$this->groups_join" => 2
                )
            );
            // Insert data
            $this->db->insert_batch($this->users_groups, $data);
        }

        // Login attempts
        if (!$this->db->table_exists($this->login_attempts)) 
        {
            // Setup Keys
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->add_key('ip_address');
            $this->dbforge->add_key('login');
            
            $this->dbforge->add_field(array(
                'id' => array('type' => 'MEDIUMINT', 'constraint' => 8, 'unsigned' => TRUE, 'null' => FALSE, 'auto_increment' => TRUE),
                'ip_address' => array('type' => 'VARBINARY', 'constraint' => '16', 'null' => FALSE),
                'login' => array('type' => 'VARCHAR', 'constraint' => '100', 'null' => FALSE),
                'time' => array('type' => 'int', 'constraint' => '11', 'unsigned' => TRUE, 'null' => FALSE)
            ));
            // create table
            $this->dbforge->create_table($this->login_attempts, TRUE);
        }
    }
    
	public function down()
	{        
        $this->dbforge->drop_table($this->groups);
        $this->dbforge->drop_table($this->users);
        $this->dbforge->drop_table($this->users_groups);
        $this->dbforge->drop_table($this->login_attempts);
    }
}
/* End of file '20161116151733_create_ion_auth' */
/* Location: ./E:\dev-zone\Computer\web-dev\localhost\freelancing\yalaresearch-orm\application\migrations/20161116151733_create_ion_auth.php */
