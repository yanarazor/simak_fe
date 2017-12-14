<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/nilai/nilai_mhs') ?>" id="list">Tabel</a>
	</li>
	<!--
	<?php if ($this->auth->has_permission('DataKrs.Krs.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/nilai/nilai_mhs/create') ?>" id="create_new">Input Nilai</a>
	</li>
	<?php endif; ?>
-->
	<?php if ($this->auth->has_permission('DataKrs.Krs.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/nilai/nilai_mhs/input') ?>" id="create_new">Input Nilai Perkelas</a>
	</li>
	<?php endif; ?>
	 <?php if ($this->auth->has_permission('DataKrs.Krs.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'upload' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/nilai/nilai_mhs/upload'); ?>">Upload</a>
	</li>
	 <?php endif; ?>
</ul>