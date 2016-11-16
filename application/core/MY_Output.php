<?php (defined('BASEPATH')) || exit('No direct script access allowed');

/**
* 
*/
class MY_Output extends CI_Output
{
    
    public function __construct()
    { 
        parent::__construct();
    }

    /*
     * Display the json output with termination
     */
    public function outputJson($arr = []) {
        $this->set_status_header(200)
             ->set_content_type('application/json', 'utf-8')
             ->set_output(json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
             ->_display();
        exit();
    }
}