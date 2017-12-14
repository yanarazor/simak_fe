<ul class="nav nav-pills">
<?php if ($this->auth->has_permission('Transkip.Krs.View')) : ?>
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/krs/transkip') ?>" id="list">Mahasiswa</a>
	</li>
	<li <?php echo $this->uri->segment(4) == 'cari' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/krs/transkip/cari') ?>" id="list">Cari Transkip</a>
	</li>
<?php endif; ?>	 
<?php if ($this->auth->has_permission('MasterMahasiswa.Master.Upload')) : ?>
	<li <?php echo $this->uri->segment(4) == 'upload' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/krs/transkip/upload') ?>" id="list">Upload Transkip</a>
	</li>
<?php endif; ?>	
</ul>