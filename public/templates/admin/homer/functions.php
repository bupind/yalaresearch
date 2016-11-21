<?php (defined('BASEPATH')) || exit('No direct script access allowed');

if (!function_exists('breadcrumbConfig')) {
    function breadcrumbConfig()
    {
        return [];
    }
}

if (!function_exists('breadcrumbOutput')) {
    function breadcrumbOutput()
    {
        return get_instance()->breadcrumb->output();
    }
}

if (!function_exists('getUser')) {
    function getUser()
    {
        return get_instance()->authentication->getUser();
    }
}

if (!function_exists('getFullName')) {
    function getFullName($user)
    {
        trim($user->name_prefix.' '
            .$user->first_name.' '
            .$user->middle_name.' '
            .$user->last_name.' '
            .$user->name_suffix);
    }
}

if (!function_exists('userProfilePics')) {
    function userProfilePics($user)
    {
        $pics_dir = get_instance()->authentication->getUploadDir('profile_pics');
        if (empty($user->profile_pic)) {
            return strtolower($user->gender) == 'female' ? assets('custom/img/female-blank.jpg', 'admin') : assets('custom/img/male-blank.png', 'admin');
        }
        return assets($pics_dir.$user->profile_pic);
    }
}

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