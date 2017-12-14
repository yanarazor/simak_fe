<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/master/pilihan') ?>" id="list"><?php echo lang('pilihan_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Pilihan.Master.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/master/pilihan/create') ?>" id="create_new"><?php echo lang('pilihan_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>