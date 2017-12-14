<?php echo theme_view('_header_login'); ?>
<style>body { background: #fff; }</style>


    <?php
        echo isset($content) ? $content : Template::content();
    ?>

<?php echo theme_view('_footer_login', array('show' => false)); ?>