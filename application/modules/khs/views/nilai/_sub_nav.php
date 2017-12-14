<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/nilai/khs') ?>" id="list"><?php echo lang('khs_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Khs.Nilai.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/nilai/khs/create') ?>" id="create_new">Hitung</a>
	</li>
	<?php endif; ?>
</ul>