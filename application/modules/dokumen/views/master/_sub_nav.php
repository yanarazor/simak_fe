<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/master/dokumen') ?>" id="list"><?php echo lang('dokumen_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Dokumen.Master.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/master/dokumen/create') ?>" id="create_new"><?php echo lang('dokumen_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>