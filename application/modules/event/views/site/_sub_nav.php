<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/site/event') ?>" id="list"><?php echo lang('event_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Event.Site.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/site/event/create') ?>" id="create_new"><?php echo lang('event_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>