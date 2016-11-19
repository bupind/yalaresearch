(function($) {

    $(document).off("click", "#reset-password-link").on("click", "#reset-password-link", function(event) {
        event.preventDefault();
        $("#form-title").html('PASSWORD RESET');
        $("#loginForm").hide();
        $("#password-reset").show();
    });

    $(document).off("click", "#login-link").on("click", "#login-link", function(event) {
        event.preventDefault();
        $("#form-title").html('ADMIN LOGIN');
        $("#password-reset").hide();
        $("#loginForm").show();
    });

    // Validation
    $("#loginForm").validate({
        rules: {
            identity: "required",
            password: {
                required: true
            },
        },
        errorClass: "form-error"
    });
    $("#password-reset").validate({
        rules: {
            email   : {
                required: true,
                email: true
            }
        },
        errorClass: "form-error"
    });

    $(document).off('submit', '#loginForm').on('submit', '#loginForm', function(event) {
        event.preventDefault();
        var form = $(this);

        if (form.valid()) {
            var action  = form.attr('action'),
                data    = form.serialize();

            $.fn.ajaxCall(action, data, form);
        }
    });

    $(document).off('submit', '#password-reset').on('submit', '#password-reset', function(event) {
        event.preventDefault();
        var form = $(this);

        if (form.valid()) {
            var action  = form.attr('action'),
                data    = form.serialize();

            $.fn.ajaxCall(action, data, form);
        }
    });

    $.fn.ajaxCall = function($url, $data, $form) {
        $form.find('input[type=submit]').data('loading-text', 'Loading, please wait...');
        $.ajax({
            url: $url,
            data: $data,
            method: 'post',
            beforeSend: function() {
                $form.find('input[type=submit]').button('loading');
            },
            success: function(resp) {
                $.fn.updateCSRF(resp.data.csrf);
                if (resp.status == 'success') {
                    $.fn.success_msg(resp.message);
                    window.location.replace(resp.data.url);
                } else {
                    $.fn.error_msg(resp.message);
                    $form.find('input[type=submit]').button('reset');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                $.fn.error_msg(errorThrown);
                $form.find('input[type=submit]').button('reset');
            }
        });
    }

    $.fn.updateCSRF = function($csrf) {
        csrf_token_name = $csrf.id;
        csrf_token = $csrf.value;
        $("input[name="+$csrf.id+"]").val($csrf.value);
    }

    $.fn.success_msg = function($message) {
        var tmpl = `<div class="alert alert-success" role="alert">
                        <strong>Success!</strong> `+$message+`
                    </div>`;
        $("#alert-message").html(tmpl);
    }

    $.fn.error_msg = function($message) {
        var tmpl = `<div class="alert alert-danger" role="alert">
                        <strong>Error!</strong> `+$message+`
                    </div>`;
        $("#alert-message").html(tmpl);
    }

})(jQuery);