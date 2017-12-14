<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/master/masterbadanhukum') ?>" id="list"><?php echo lang('masterbadanhukum_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('MasterBadanHukum.Master.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/master/masterbadanhukum/create') ?>" id="create_new"><?php echo lang('masterbadanhukum_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>