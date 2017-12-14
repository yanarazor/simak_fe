<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/site/pesan') ?>" id="list"><?php echo lang('pesan_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Pesan.Site.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/site/pesan/create') ?>" id="create_new"><?php echo lang('pesan_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>