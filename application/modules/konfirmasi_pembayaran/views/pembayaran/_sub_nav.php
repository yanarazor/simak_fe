<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/pembayaran/konfirmasi_pembayaran') ?>" id="list">Tabel</a>
	</li>
	<?php if ($this->auth->has_permission('konfirmasi_pembayaran.Pembayaran.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/pembayaran/konfirmasi_pembayaran/create') ?>" id="create_new">Kirim Konfirmasi</a>
	</li>
	<?php endif; ?>
</ul>