<?php
    Assets::add_js( array('jquery-1.8.2.min.js','supersized.3.2.7.min.js','supersized-init.js','scripts.js'));
    Assets::add_css( array('reset.css', 'supersized.css','style.css'
	));

    $inline  = '$(".dropdown-toggle").dropdown();';
    $inline .= '$(".tooltips").tooltip();';

    Assets::add_js( $inline, 'inline' );
?>
<!doctype html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo isset($page_title) ? $page_title .' : ' : ''; ?> <?php if (class_exists('Settings_lib')) e(settings_item('site.title')); else echo 'Bonfire'; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php echo Assets::css(); ?>
	
<!-- // JavaScript // -->
 
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">
</head>
<body>
