<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/master/mastermatakuliah') ?>" id="list"><?php echo lang('mastermatakuliah_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('MasterMataKuliah.Master.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/master/mastermatakuliah/create') ?>" id="create_new"><?php echo lang('mastermatakuliah_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>