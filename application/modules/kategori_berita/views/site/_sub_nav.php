<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/site/kategori_berita') ?>" id="list"><?php echo lang('kategori_berita_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Kategori_Berita.Site.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/site/kategori_berita/create') ?>" id="create_new"><?php echo lang('kategori_berita_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>