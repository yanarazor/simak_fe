<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/master/predikat') ?>" id="list"><?php echo lang('predikat_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Predikat.Master.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/master/predikat/create') ?>" id="create_new"><?php echo lang('predikat_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>