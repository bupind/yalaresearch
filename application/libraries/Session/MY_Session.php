<?php  (defined('BASEPATH')) || exit('No direct script access allowed');

/**
* Extended Session Library
*/
class MY_Session extends CI_Session
{
    
    // function __construct(argument)
    // {
    //     parent::__construct();
    // }

    public function set_notification($type, $text = '')
    {
        $this->set_flashdata(trim($type).'_notify', trim($text));
    }

    public function get_notification($type)
    {
        return $this->flashdata(trim($type).'_notify');
    }

    public function set_alert($type, $text = '')
    {
        $this->set_flashdata(trim($type).'_alert', trim($text));
    }

    public function get_alert($type)
    {
        return $this->flashdata(trim($type).'_alert');
    }
}