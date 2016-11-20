<?php

(defined('BASEPATH')) || exit('No direct script access allowed');

/**
* Authentication Class
*
* Base class for ion_auth
*/
class Authentication
{
    private $CI;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('ion_auth');
    }

    /*
     * Check whether user is logged in or not
     */
    public function isUserLoggedIn()
    {
        return $this->CI->ion_auth->logged_in() ? true : false;
    }

    public function login($identity, $password, $rememberme = false)
    {
        if (empty($identity) || empty($password)) {
            return false;
        }

        return $this->CI->ion_auth->login($identity, $password, $rememberme);
    }

    public function logout()
    {
        return $this->CI->ion_auth->logout();
    }

    public function errors()
    {
        return $this->CI->ion_auth->errors();
    }

    public function messages()
    {
        return $this->CI->ion_auth->messages();
    }
}