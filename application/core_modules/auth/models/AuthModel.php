<?php  (defined('BASEPATH')) || exit('No direct script access allowed');

class AuthModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    /*
     * Check whether user is logged in or not
     *
     * @param redirectToLogin(bool): Whether redirect to login page or not
     */
    public function isUserLoggedIn($redirectToLogin = true)
    {
        if ($this->ion_auth->logged_in()) {
            return true;
        }

        if ($redirectToLogin === false) {
            return false;
        }

        if ($this->input->is_ajax_request()) {
            $this->output->json(['status'=>'error', 'data'=>null, 'message'=>$this->lang->line('user_expired')]);
        }

        // redirect to login page
        $this->session->set_alert('warning', $this->lang->line('must_login'));

        $requested_url = explode('/', uri_string());
        if (isset($requested_url[0]) && $requested_url[0] == $this->config->item('admin_url')) {
            array_shift($requested_url);
        }
        $requested_url = empty($requested_url) ? 'dashboard' : implode('/', $requested_url);
        admin_redirect('login?requested_url='.$requested_url, 'refresh');
    }
}
/* End of file '/AuthModel.php' */
/* Location: ./models/AuthModel.php */