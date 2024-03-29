<!--
// BASIC SITES INFO
-->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title><?=$pageInfo->title.' || '.$this->lang->line('software_acronym') ?></title>

<?php
$metaData = array(
            array(
                'name'      => 'robots',
                'content'   => 'noindex, nofollow'
            ),
            array(
                'name'      => 'keywords',
                'content'   => $this->lang->line('software_acronym')
            ),
            array(
                'name'      => 'description',
                'content'   => $this->lang->line('software_name')
            ),
            array(
                'name'      => 'application-name',
                'content'   => $this->lang->line('software_acronym')
            ),
            array(
                'name'      => 'author',
                'content'   => $this->lang->line('software_author')
            )
        );
echo meta($metaData);
?>

<!--
// FAVICONS
-->
<link rel="shortcut icon" href="<?=assets('res/sites-general/favicons/favicon.ico') ?>" type="image/x-icon">
<link rel="icon" href="<?=assets('res/sites-general/favicons/favicon.ico') ?>" type="image/x-icon">
<link rel="apple-touch-icon" sizes="57x57" href="<?=assets('res/sites-general/favicons/apple-icon-57x57.png') ?>">
<link rel="apple-touch-icon" sizes="60x60" href="<?=assets('res/sites-general/favicons/apple-icon-60x60.png') ?>">
<link rel="apple-touch-icon" sizes="72x72" href="<?=assets('res/sites-general/favicons/apple-icon-72x72.png') ?>">
<link rel="apple-touch-icon" sizes="76x76" href="<?=assets('res/sites-general/favicons/apple-icon-76x76.png') ?>">
<link rel="apple-touch-icon" sizes="114x114" href="<?=assets('res/sites-general/favicons/apple-icon-114x114.png') ?>">
<link rel="apple-touch-icon" sizes="120x120" href="<?=assets('res/sites-general/favicons/apple-icon-120x120.png') ?>">
<link rel="apple-touch-icon" sizes="144x144" href="<?=assets('res/sites-general/favicons/apple-icon-144x144.png') ?>">
<link rel="apple-touch-icon" sizes="152x152" href="<?=assets('res/sites-general/favicons/apple-icon-152x152.png') ?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?=assets('res/sites-general/favicons/apple-icon-180x180.png') ?>">
<link rel="icon" type="image/png" sizes="192x192"  href="<?=assets('res/sites-general/favicons/android-icon-192x192.png') ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?=assets('res/sites-general/favicons/favicon-32x32.png') ?>">
<link rel="icon" type="image/png" sizes="96x96" href="<?=assets('res/sites-general/favicons/favicon-96x96.png') ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?=assets('res/sites-general/favicons/favicon-16x16.png') ?>">
<link rel="manifest" href="<?=assets('res/sites-general/favicons/manifest.json') ?>">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?=assets('res/sites-general/favicons/ms-icon-144x144.png') ?>">
<meta name="theme-color" content="#ffffff">