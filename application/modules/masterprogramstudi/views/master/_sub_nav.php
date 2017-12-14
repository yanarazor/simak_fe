<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/master/masterprogramstudi') ?>" id="list"><?php echo lang('masterprogramstudi_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('MasterProgramStudi.Master.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/master/masterprogramstudi/create') ?>" id="create_new"><?php echo lang('masterprogramstudi_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>