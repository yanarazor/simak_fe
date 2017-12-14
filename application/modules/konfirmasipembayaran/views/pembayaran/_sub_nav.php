<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/pembayaran/konfirmasipembayaran') ?>" id="list"><?php echo lang('konfirmasipembayaran_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('KonfirmasiPembayaran.Pembayaran.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/pembayaran/konfirmasipembayaran/create') ?>" id="create_new"><?php echo lang('konfirmasipembayaran_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>