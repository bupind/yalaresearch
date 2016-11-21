<?php

(defined('BASEPATH')) || exit('No direct script access allowed');

/**
* Authentication Class
*
* Base class for ion_auth
*/
class Authentication
{
    protected $CI;

    /*
     * Current User Info
     */
    private $user = [];

    /*
     * Current User's Group Info
     */
    private $userGroup = [];

    /*
     * User's File Upload Dir
     */
    private $uploadDir = [];

    /*
     *  Constructor
     */
    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('ion_auth');

        $this->user         = $this->CI->ion_auth->user()->row();
        $this->userGroup    = $this->CI->ion_auth->get_users_groups()->result();
        $this->uploadDir    = config_item('file_upload_dir_user');
    }

    /*
     * Get Users' file upload directory
     */
    public function getUploadDir($type)
    {
        return isset($this->uploadDir[$type]) ? $this->uploadDir[$type] : '';
    }

    /*
     * Get Users' Information
     */
    public function getUser($id = null)
    {
        if (is_null($id)) {
            return $this->user;
        }
        $user = $this->ion_auth->user($id);
        return $user->num_rows() > 0 ? $user->row() : false;
    }

    /*
     * Get Current Users' Group Information
     */
    public function getUserGroup()
    {
        return $this->userGroup;
    }

    /*
     * Check for currents user in groups
     */
    public function userIn($group_id)
    {
        $groupArr = [];
        foreach ($this->userGroup as $group) {
            $groupArr[] = $group->id;
        }

        return in_array($group_id, $groupArr) ? true : false;
    }

    /*
     * Check whether user is logged in or not
     */
    public function isUserLoggedIn()
    {
        return $this->CI->ion_auth->logged_in() ? true : false;
    }

    /*
     * Login User
     */
    public function login($identity, $password, $rememberme = false)
    {
        if (empty($identity) || empty($password)) {
            return false;
        }

        return $this->CI->ion_auth->login($identity, $password, $rememberme);
    }

    /*
     * Logout User
     */
    public function logout()
    {
        return $this->CI->ion_auth->logout();
    }

    /*
     * Error List
     */
    public function errors()
    {
        return $this->CI->ion_auth->errors();
    }

    /*
     * Messages
     */
    public function messages()
    {
        return $this->CI->ion_auth->messages();
    }
}