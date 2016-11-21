<?php  (defined('BASEPATH')) || exit('No direct script access allowed');

// You can find dbforge usage examples here: http://ellislab.com/codeigniter/user-guide/database/forge.html

class Migration_Add_field_auth_user extends CI_Migration
{
    // use config file variables
    private $use_config     = true;

    // Table names
    private $users          = '';

    public function __construct()
	{
	    parent::__construct();
		$this->load->dbforge();

        $this->use_config();
	}
	
	public function up()
	{
	    $fields = [
            'name_prefix' => [
                'type'          => 'VARCHAR',
                'constraint'    => 20,
                'null'          => TRUE,
                'after'         => 'active'
            ],
            'name_suffix' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
                'null'          => TRUE,
                'after'         => 'last_name'
            ],
            'middle_name' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
                'null'          => TRUE,
                'after'         => 'first_name'
            ],
            'gender' => [
                'type'          => 'ENUM',
                'constraint'    => ['male','female'],
                'null'          => TRUE,
                'after'         => 'name_suffix'
            ],
            'designation' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
                'null'          => TRUE,
                'after'         => 'company'
            ],
            'profile_pic' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
                'null'          => TRUE
            ],
        ];
        $this->dbforge->add_column($this->users, $fields);
    }
    
	public function down()
	{
        $this->dbforge->drop_column($this->users, [
            'middle_name',
            'gender',
            'designation',
            'profile_pic'
        ]);
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
            
            // table names
            $this->users            = $tables['users'];
        }
    }
}
/* End of file '20161121155549_add_field_auth_user' */
/* Location: ./E:\dev-zone\Computer\web-dev\localhost\freelancing\yalaresearch\application\migrations/20161121155549_add_field_auth_user.php */
