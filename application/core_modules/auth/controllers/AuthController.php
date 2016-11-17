<?php (defined('BASEPATH')) || exit('No direct script access allowed');

class AuthController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

        $this->load->model('authModel');
	}
	
	public function index()
	{
		if (! $this->authModel->isUserLoggedIn(false)) {
            admin_redirect('login', 'refresh');
        } else if (! $this->ion_auth->is_admin()) {
            show_error($this->lang->line('admin_only'));
        } else {
            admin_redirect('dashboard', 'refresh');
        }
	}

    public function login()
    {
        if ($this->authModel->isUserLoggedIn(FALSE)) {
            // if loggged in, redirect them to the dashboard page
            admin_redirect('dashboard', 'refresh');
        }

        $data['pageInfo'] = (object)[
            'title' => $this->lang->line('login_module')
        ];
        $this->load->admintheme(null, $data, 'login.index');
    }
}
/* End of file 'AuthController.php' */
/* Location: ./controllers/AuthController.php */
