<?php
    // PHP variables
    $viewData = [];

    $success_alert  = $this->session->get_alert('success');
    $warning_alert  = $this->session->get_alert('warning');
    $info_alert     = $this->session->get_alert('info');
    $error_alert    = $this->session->get_alert('error');
?>
<?php $this->load->view(ADMIN_TMPL.'/partials/login.htmlhead.php', $viewData) ?>