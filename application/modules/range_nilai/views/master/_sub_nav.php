<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/master/range_nilai') ?>" id="list"><?php echo lang('range_nilai_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Range_Nilai.Master.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/master/range_nilai/create') ?>" id="create_new"><?php echo lang('range_nilai_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>