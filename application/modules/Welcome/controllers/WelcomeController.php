<?php (defined('BASEPATH')) || exit('No direct script access allowed');

class WelcomeController extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->model('welcome_model');
		$data['content'] = $this->welcome_model->get_all();
		$this->load->view('welcome', $data);
	}
}
/* End of file '/Welcome.php' */
/* Location: ./application/controllers//Welcome.php */
