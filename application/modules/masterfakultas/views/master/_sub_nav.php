<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/master/masterfakultas') ?>" id="list"><?php echo lang('masterfakultas_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('MasterFakultas.Master.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/master/masterfakultas/create') ?>" id="create_new"><?php echo lang('masterfakultas_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>