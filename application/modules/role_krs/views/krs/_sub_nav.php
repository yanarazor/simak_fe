<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/krs/role_krs') ?>" id="list"><?php echo lang('role_krs_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Role_KRS.Krs.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/krs/role_krs/create') ?>" id="create_new"><?php echo lang('role_krs_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>