<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/settings/jadwal') ?>" id="list"><?php echo lang('jadwal_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Jadwal.Settings.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/settings/jadwal/create') ?>" id="create_new"><?php echo lang('jadwal_new'); ?></a>
	</li>
	<?php endif; ?>
	 
	  <li <?php echo $this->uri->segment(4) == 'print' ? 'class="active"' : '' ?> >
		  <a href="<?php echo site_url(SITE_AREA .'/settings/jadwal/printjadwal/'); echo isset($tahun_akademik)? "/".$tahun_akademik:""; ?>?tahun_akademik=<?php echo isset($tahun_akademik)?$tahun_akademik:""; ?>&mk=<?php echo isset($mk)?$mk:""; ?>&prodi=<?php echo isset($prodi)?$prodi:""; ?>">Cetak Jadwal</a>
	  </li>
	 
</ul>