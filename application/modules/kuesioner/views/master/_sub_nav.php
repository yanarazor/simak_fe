<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/master/kuesioner') ?>" id="list"><?php echo lang('kuesioner_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Kuesioner.Master.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/master/kuesioner/create') ?>" id="create_new"><?php echo lang('kuesioner_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>