<?php

(defined('BASEPATH')) || exit('No direct script access allowed');

/**
* Admin Controller
*/
class Admin_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

        // load auth model
        $this->load->model('auth/authModel');

        // check for user logged in or not
        $this->authModel->isUserLoggedIn();
    }
}