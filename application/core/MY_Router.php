<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Router class */
require APPPATH."third_party/MX/Router.php";

class MY_Router extends MX_Router {

    protected function _set_default_controller()
    {
        if (empty($this->directory))
        {
            /* set the default controller module path */
            $this->_set_module_path($this->default_controller);
        }
        parent::_set_default_controller();
    
        if(empty($this->class))
        {
            // check for default controller with suffix in controller
            $this->_set_default_controller_with_suffix();
            if(empty($this->class)) {
                $this->_set_404override_controller();
            }
        }
    }

    private function _set_default_controller_with_suffix()
    {
        $ext = $this->config->item('controller_suffix').EXT;

        // Is the method being specified?
        if (sscanf($this->default_controller, '%[^/]/%s', $class, $method) !== 2) {
            $method = 'index';
        }

        if ( ! file_exists(APPPATH.'controllers/'.$this->directory.ucfirst($class).$ext)) {
            // This will trigger 404 later
            return;
        }

        $this->set_class($class);
        $this->set_method($method);

        // Assign routed segments, index starting from 1
        $this->uri->rsegments = array(
            1 => $class,
            2 => $method
        );

        log_message('debug', 'No URI present. Default controller with suffix set.');
    }

}