<script src="<?=assets('bower_components/jquery/dist/jquery.min.js')?>"></script>
<script src="<?=assets('bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>

<script type="text/javascript">
    "use strict";
    
    // Config
    var base_url = "<?=base_url()?>";
    var current_url = "<?=current_url()?>";
    var csrf_token_name = "<?=$this->security->get_csrf_token_name()?>";
    var csrf_token = "<?=$this->security->get_csrf_hash()?>";
    var pageTitle = $(document).find("title").text();

    // message for notification
    var success_notify = "<?=$this->session->get_notification('success')?>";
    var error_msg = "<?=$this->session->get_notification('error')?>";
    var info_msg = "<?=$this->session->get_notification('info')?>";
    var warning_msg = "<?=$this->session->get_notification('warning')?>";
</script>