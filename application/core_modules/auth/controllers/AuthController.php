<?php (defined('BASEPATH')) || exit('No direct script access allowed');

class AuthController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

        // load auth model
        $this->load->model('authModel');
	}
	
	public function index()
	{
		if (! $this->authModel->isUserLoggedIn(false)) {
            //redirect them to the login page
            admin_redirect('login', 'refresh');
        } else if (! $this->ion_auth->is_admin()) {
            //redirect them to the dashboard because they must be an administrator to view this
            show_error($this->lang->line('admin_only'));
        } else {
            admin_redirect('dashboard', 'refresh');
        }
	}

    /*
     *  Login Page
     */
    public function login()
    {
        // check for logged in or not
        if ($this->authModel->isUserLoggedIn(false)) {
            // if loggged in, redirect them to the dashboard page
            admin_redirect('dashboard', 'refresh');
        }
        echo 'login page';
    }
}
/* End of file 'AuthController.php' */
/* Location: ./controllers/AuthController.php */
