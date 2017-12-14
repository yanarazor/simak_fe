<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/site/informasi_dan_berita') ?>" id="list"><?php echo lang('informasi_dan_berita_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Informasi_dan_Berita.Site.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/site/informasi_dan_berita/create') ?>" id="create_new"><?php echo lang('informasi_dan_berita_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>