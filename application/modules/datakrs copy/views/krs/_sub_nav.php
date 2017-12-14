<ul class="nav nav-pills">
	<?php if ($this->auth->has_permission('DataKrs.Krs.View')) : ?>
		<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
			<a href="<?php echo site_url(SITE_AREA .'/krs/datakrs') ?>" id="list"><?php echo lang('datakrs_list'); ?></a>
		</li>
	<?php endif; ?>
	<?php if ($this->auth->has_permission('DataKrs.Krs.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/krs/datakrs/create') ?>" id="create_new"><?php echo lang('datakrs_new'); ?></a>
	</li>
	<?php endif; ?>
	<?php if ($this->auth->has_permission('DataKrs.Krs.Input')) : ?>
		<li <?php echo $this->uri->segment(4) == 'input' ? 'class="active"' : '' ?> >
			<a href="<?php echo site_url(SITE_AREA .'/krs/datakrs/input') ?>" id="create_new">Pengisian KRS</a>
		</li>
	 <?php endif; ?>
	 <?php if ($this->auth->has_permission('DataKrs.Krs.Input') and isset($sms)) : ?>
	<li <?php echo $this->uri->segment(4) == 'printjob' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/krs/datakrs/printkrs'); echo isset($sms)? "/".$sms:""; ?>">Cetak KRS</a>
	</li>
	 <?php endif; ?>
</ul>