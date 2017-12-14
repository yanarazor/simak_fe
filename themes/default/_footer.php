<?php if (!isset($show) || $show==true) : ?>

<hr />

<div id="outer_footer">
    <div id="outer_footer_sec">
        <div id="footer">
            <div class="left_footer">
                <div class="footer_tags">
                    <ul>
                        <li>
                            <h2>Tentang Kami</h2>
                            <ul>
                                <li><a href="#">Beranda</a></li>
                                <li><a href="#">Site map</a></li>
                                <li><a href="#">Tentang FE-UMJ</a></li>
                            </ul>
                        </li>
                        <li>
                            <h2>Akademik</h2>
                            <ul>
                                <li><a href="#">Kalender Akademik</a></li>
                                <li><a href="#">Jurusan</a></li>
                            </ul>
                        </li>
                        <li>
                            <h2>Portals</h2>
                            <ul>
                                <li><a href="#">Downloads</a></li>
                                <li><a href="#">SIMAK</a></li>
                                <li><a href="#">Quick Links</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
                <div class="footer_nav">
                    <p>&copy; 2014 FE-UMJ</p>
                    <ul>
                        <li><a href="#">Terms and conditions</a></li>
                        <li><a href="#">Accessibility</a></li>
                        <li><a href="#">Privacy</a></li>
                    </ul>
                </div>
            </div>
            <div class="right_footer">
                <div class="contact_area">
                    <h2>Kontak Kami</h2>
                    <p>Telp: 021-7402623 Fax: 021 – 76718530</p>
                    <p>E:mail: fe@umj.ac.id</p>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<div id="debug"></div>
<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo js_path(); ?>jquery-1.7.2.min.js"><\/script>')</script>

<!-- This would be a good place to use a CDN version of jQueryUI if needed -->
<?php echo Assets::js(); ?>

</body>
</html>