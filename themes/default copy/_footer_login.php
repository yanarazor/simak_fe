</div>

<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo js_path(); ?>jquery-1.7.2.min.js"><\/script>')</script>

<!-- This would be a good place to use a CDN version of jQueryUI if needed -->
<?php echo Assets::js(); ?>

</body>
</html>