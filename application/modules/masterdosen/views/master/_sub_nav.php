<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/master/masterdosen') ?>" id="list"><?php echo lang('masterdosen_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('MasterDosen.Master.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/master/masterdosen/create') ?>" id="create_new"><?php echo lang('masterdosen_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>