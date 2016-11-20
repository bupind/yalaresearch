<?php
    // PHP variables
    $viewData = [];
?>
<?php $this->load->view(ADMIN_TMPL.'/partials/login.htmlhead.php', $viewData) ?>

<body class="blank">
    <div class="color-line"></div>

    <!--[if lt IE 7]>
    <p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <noscript><p class="alert alert-danger">You must enable <strong>javascript</strong> for better experiences.</p></noscript>

    <div class="login-container">
        <div class="row">
            <div class="col-sm-12">
                
                <div class="text-center m-b-md login-title">
                    <h1 class="logo">Yala<span>Research</span></h1>
                    <h4 id="form-title"><?=($isForgetPassword ? 'PASSWORD RESET' : 'ADMIN LOGIN')?></h4>
                </div>

                <div class="hpanel">
                    <div class="panel-body">

                        <div id="alert-message"><?=alert()?></div>

                        <?php
                        $attributes = [
                            'class' => 'loginForm animated custom-flipInX',
                            'role'  => 'form',
                            'name'  => 'loginForm',
                            'id'    => 'loginForm',
                            'style' => 'display:'.($isForgetPassword ? 'none' : 'block')

                        ];
                        $action = admin_url('login');
                        $hidden = array('requested_url'=>$requested_url);
                        echo form_open($action, $attributes, $hidden);
                        ?>

                            <div class="form-group">
                                <input type="text" autofocus="" placeholder="username" title="Please enter you username" required="" value="" name="identity" id="identity" class="form-control">
                            </div>

                            <div class="form-group">
                                <input type="password" title="Please enter your password" placeholder="******" required="" value="" name="password" id="password" class="form-control">
                            </div>

                            <div class="checkbox">
                                <label class="control-label">
                                    <input type="checkbox" name="rememberme" id="rememberme" value="1" class="i-checks">
                                    Remember login
                                </label>
                                <p class="help-block small">(if this is a private computer)</p>
                            </div>

                            <input type="submit" class="btn btn-success btn-block" value="Login">
                            <a id="reset-password-link" class="btn btn-text btn-block" href="javascript:;">forget password? reset now</a>
                        
                        <?php echo form_close() ?>

                        <?php
                        $attributes = [
                            'class' => 'loginForm animated custom-flipInX',
                            'role'  => 'form',
                            'name'  => 'password-reset',
                            'id'    => 'password-reset',
                            'style' => 'display:'.($isForgetPassword ? 'block' : 'none')
                        ];
                        $action = admin_url('reset-password');
                        echo form_open($action, $attributes, $hidden);
                        ?>

                            <p class="help-block text-muted small">Please fill in your registered email address, we will send you instructions on how to reset your password.</p>
                            
                            <div class="form-group">
                                <input type="email" autofocus="" placeholder="email address" title="Please enter your registered email address"  value="" name="email" id="email" class="form-control">
                            </div>

                            <input type="submit" class="btn btn-info btn-block" value="Reset">
                            <a id="login-link" class="btn btn-text btn-block" href="javascript:;">already have an account? login here</a>
                        
                        <?php echo form_close() ?>

                        <div class="clearfix"></div>
                    </div> <!-- /.panel-body -->
                </div> <!-- /.hpanel -->

            </div> <!-- /.col -->
        </div> <!-- /.row -->

        <div class="row">
            <div class="col-md-12 text-center login-footer">
                &copy; <?=mdate('%Y')?> <strong>Yala<span>Publishing</span></strong> - Powered by <a href="http://www.puncoz.com/?reference=<?=base_url()?>" target="_blank"><strong>puncoz.com</strong></a>
            </div>
        </div> <!-- /.row -->
    </div> <!-- /.login-controller -->

    <!--
    // SCRIPTS
    -->
    <?php $this->load->view(ADMIN_TMPL.'/partials/scripts/login.scripts.php', $viewData) ?>

</body>
</html>