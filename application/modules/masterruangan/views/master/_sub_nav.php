<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/master/masterruangan') ?>" id="list"><?php echo lang('masterruangan_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('MasterRuangan.Master.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/master/masterruangan/create') ?>" id="create_new"><?php echo lang('masterruangan_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>