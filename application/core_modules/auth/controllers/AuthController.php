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

        $requested_url = $this->input->get('requested_url');
        $data['requested_url'] = empty($requested_url) ? 'dashboard' : $requested_url;
        
        $this->load->admintheme(null, $data, 'login.index');
    }

    public function logout()
    {
        if($this->authModel->isUserLoggedIn(FALSE)) {
            // log the user out
            $this->ion_auth->logout();

            // redirect them to the login page
            $this->session->set_alert('success', $this->ion_auth->messages());
        } else {
            $this->session->set_alert('warning', $this->lang->line('must_login'));
        }

        admin_redirect('login', 'refresh');
    }

    public function do_login()
    {
        if ($this->input->is_ajax_request()) {
            $csrf = [
                'id'    => $this->security->get_csrf_token_name(),
                'value' => $this->security->get_csrf_hash()
            ];

            try {

                if (!$this->input->post()) {
                    throw new Exception($this->lang->line('invalid_request'));
                }
                $this->form_validation->set_rules('identity', 'Username', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required');
                if (!$this->form_validation->run()) {
                    throw new Exception($this->lang->line('invalid_login'));
                }

                $remember = (bool) $this->input->post('rememberme');
                $identity = $this->input->post('identity');
                $password = $this->input->post('password');

                if (!$this->authModel->isUserLoggedIn(FALSE) && $this->ion_auth->login($identity, $password, $remember) === false) {
                    $error = $this->ion_auth->errors();
                    $error = empty($error) ? $this->lang->line('invalid_login') : $error;
                    throw new Exception($error);
                }

                $redirect_url = $this->input->post('requested_url');
                $redirect_url = empty($redirect_url) ? 'dashboard' : $redirect_url;

                $response = [
                    'status'    => 'success',
                    'data'      => [
                        'csrf'  => $csrf,
                        'url'   => admin_url($redirect_url) 
                    ],
                    'message'   => $this->lang->line('success_login')
                ];
            } catch (Exception $e) {
                $response = [
                    'status'    => 'error',
                    'data'      => [
                        'csrf'  => $csrf
                    ],
                    'message'   => $e->getMessage()
                ];
            }

            $this->output->json($response);
        } else {
            show_error($this->lang->line('direct_scripts_access'));
        }
    }

    public function do_reset_password()
    {
        if ($this->input->is_ajax_request()) {
            $csrf = [
                'id'    => $this->security->get_csrf_token_name(),
                'value' => $this->security->get_csrf_hash()
            ];

            try {

                if (!$this->input->post()) {
                    throw new Exception($this->lang->line('invalid_request'));
                }
                $this->form_validation->set_rules('email', 'email', 'required|valid_email');
                if (!$this->form_validation->run()) {
                    throw new Exception($this->lang->line('invalid_parameters'));
                }

                $email = $this->input->post('email');

                if (true) {
                    throw new Exception($this->lang->line('service_unavail'));
                }

                $redirect_url = $this->input->post('requested_url');
                $redirect_url = empty($redirect_url) ? 'dashboard' : $redirect_url;

                $response = [
                    'status'    => 'success',
                    'data'      => [
                        'csrf'  => $csrf,
                        'url'   => admin_url($redirect_url) 
                    ],
                    'message'   => $this->lang->line('success_login')
                ];
            } catch (Exception $e) {
                $response = [
                    'status'    => 'error',
                    'data'      => [
                        'csrf'  => $csrf
                    ],
                    'message'   => $e->getMessage()
                ];
            }

            $this->output->json($response);
        } else {
            show_error($this->lang->line('direct_scripts_access'));
        }
    }
}
/* End of file 'AuthController.php' */
/* Location: ./controllers/AuthController.php */
