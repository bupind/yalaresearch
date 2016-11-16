<?php  (defined('BASEPATH')) || exit('No direct script access allowed');
class Welcome_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_all()
	{
		return ('Welcome to CodeIgniter Public!');
	}
}
/* End of file '/Welcome_model.php_model' */
/* Location: ./application/models//Welcome_model.php */