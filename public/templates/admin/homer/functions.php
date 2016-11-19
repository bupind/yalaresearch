<?php (defined('BASEPATH')) || exit('No direct script access allowed');

if (!function_exists('alert')) {
    function alert()
    {
        $CI =& get_instance();
        $success_alert  = $CI->session->get_alert('success');
        $warning_alert  = $CI->session->get_alert('warning');
        $info_alert     = $CI->session->get_alert('info');
        $error_alert    = $CI->session->get_alert('error');

        $alert_type = (
            (!empty($success_alert)) ? 'success' : (
                (!empty($warning_alert)) ? 'warning' : (
                    (!empty($info_alert)) ? 'info' : (
                        (!empty($error_alert)) ? 'danger' : ''
                    )
                )
            )
        );

        $alertmsg = '';
        switch ($alert_type) {
            case 'success':
                $alertmsg .= <<<__HTML__
<div class="alert alert-success" role="alert">
    <strong>Success!</strong> {$success_alert}
</div>
__HTML__;
            break;
            
            case 'info':
                $alertmsg .= <<<__HTML__
<div class="alert alert-info" role="alert">
    <strong>Info!</strong> {$info_alert}
</div>
__HTML__;
            break;

            case 'danger':
                $alertmsg .= <<<__HTML__
<div class="alert alert-danger" role="alert">
    <strong>Error!</strong> {$error_alert}
</div>
__HTML__;
            break;

            case 'warning':
                $alertmsg .= <<<__HTML__
<div class="alert alert-warning" role="alert">
    <strong>Warning!</strong> {$warning_alert}
</div>
__HTML__;
            break;
        }

        return $alertmsg;
    }
}