<?php
    // PHP variables
    $viewData = [];
?>
<?php $this->load->view(ADMIN_TMPL.'/partials/dashboard.htmlhead.php', $viewData) ?>

<body class="fixed-navbar fixed-sidebar fixed-footer">

    <!--[if lt IE 7]>
    <p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <noscript><p class="alert alert-danger">You must enable <strong>javascript</strong> for better experiences.</p></noscript>

    <?php $this->load->view(ADMIN_TMPL.'/partials/dashboard.splashscreen.php', $viewData) ?>

    <div class="boxed-wrapper">

        <!-- Header -->
        <?php $this->load->view(ADMIN_TMPL.'/partials/dashboard.header.php', $viewData) ?>

        <!-- Navigation -->
        <?php $this->load->view(ADMIN_TMPL.'/partials/dashboard.navigation.php', $viewData) ?>
    </div>

    <!--
    // SCRIPTS
    -->
    <?php $this->load->view(ADMIN_TMPL.'/partials/scripts/dashboard.scripts.php', $viewData) ?>

</body>
</html>