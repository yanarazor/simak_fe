<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/master/mastermahasiswa') ?>" id="list"><?php echo lang('mastermahasiswa_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('MasterMahasiswa.Master.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/master/mastermahasiswa/create') ?>" id="create_new"><?php echo lang('mastermahasiswa_new'); ?></a>
	</li>
	<?php endif; ?>
	<?php if ($this->auth->has_permission('MasterMahasiswa.Master.Upload')) : ?>
	<li <?php echo $this->uri->segment(4) == 'upload' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/master/mastermahasiswa/upload') ?>" id="create_new">Upload</a>
	</li>
	<?php endif; ?>
</ul>