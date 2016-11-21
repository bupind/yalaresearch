<?php

(defined('BASEPATH')) || exit('No direct script access allowed');

/**
* Admin Controller
*/
class Admin_Controller extends MY_Controller
{
    protected static $viewData = [];

    public function __construct()
    {
        parent::__construct();

        $this->load->library('authentication');

        if (!$this->authentication->isUserLoggedIn()) {
            if (!$this->input->is_ajax_request()) {
                // redirect to login page
                $this->session->set_alert('warning', $this->lang->line('must_login'));

                $requested_url = explode('/', uri_string());
                if (isset($requested_url[0]) && $requested_url[0] == $this->config->item('admin_url')) {
                    array_shift($requested_url);
                }
                $requested_url = empty($requested_url) ? 'dashboard' : implode('/', $requested_url);
                admin_redirect('login?requested_url='.$requested_url, 'refresh');
            }
            $this->output->json(['status'=>'error', 'data'=>null, 'message'=>$this->lang->line('user_expired')]);
        }

        System::init();

        $this->load->library('breadcrumb');
        $this->breadcrumb->append('Dashboard', admin_url('dashboard'));


        $this->benchmark->mark('admin_controller_end');
    }
}