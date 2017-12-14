<?php
    Assets::add_js( array('bootstrap.min.js','jquery.royalslider.min.js'));
    Assets::add_css( array('bootstrap.min.css', 'bootstrap-responsive.min.css','style.css','style1.css'
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
<script type="text/javascript" src="/themes/default/js/jquery.js"></script>
<script type="text/javascript" src="/themes/default/js/cufon-yui.js"></script>
<script type="text/javascript" src="/themes/default/js/arial.js"></script>
<script type="text/javascript" src="/themes/default/js/chilli.js"></script>
<script type="text/javascript" src="/themes/default/js/cycle.js"></script>
<script type="text/javascript" src="/themes/default/js/functions.js"></script>
<script type="text/javascript" src="/themes/default/js/fancybox.js"></script>
<script type="text/javascript"  src="/themes/default/js/modernizr.custom.86080.js"></script>

	
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">
</head>
<body>
