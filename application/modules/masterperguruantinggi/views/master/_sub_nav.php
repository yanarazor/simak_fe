<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/master/masterperguruantinggi') ?>" id="list"><?php echo lang('masterperguruantinggi_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('MasterPerguruanTinggi.Master.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/master/masterperguruantinggi/create') ?>" id="create_new"><?php echo lang('masterperguruantinggi_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>