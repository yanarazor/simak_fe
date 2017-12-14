<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/content/pengumuman') ?>" id="list"><?php echo lang('pengumuman_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Pengumuman.Content.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/content/pengumuman/create') ?>" id="create_new"><?php echo lang('pengumuman_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>