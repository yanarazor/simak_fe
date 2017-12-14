<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/master/konversi') ?>" id="list"><?php echo lang('konversi_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Konversi.Master.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/master/konversi/create') ?>" id="create_new"><?php echo lang('konversi_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>