<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/krs/krs_mahasiswa') ?>" id="list"><?php echo lang('datakrs_list'); ?></a>
	</li>
	<li <?php echo $this->uri->segment(4) == 'print' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/krs/krs_mahasiswa/printlist/')?>?tahun=<?php echo isset($tahun) ? $tahun : ""; ?>&filfakultas=<?php echo isset($filfakultas) ? $filfakultas : ""; ?>&filljurusan=<?php echo isset($filljurusan) ? $filljurusan : ""; ?>&status=<?php echo isset($status) ? $status :""; ?>&angkatan=<?php echo isset($angkatan) ? $angkatan : ""; ?>&mhs=<?php echo isset($mhs) ? $mhs : ""; ?>&Act=Cari+') ?>" target="_blank" id="list">Print List</a>
	</li>
	 <?php if($this->uri->segment(4) != 'printkhs' and $this->uri->segment(4) == 'khs'){ ?>
		<li <?php echo $this->uri->segment(4) == 'printkhsall' ? 'class="active"' : '' ?>>
			<a href="<?php echo site_url(SITE_AREA .'/krs/krs_mahasiswa/cetakkhs/'); echo isset($mhs)? "/".$mhs:""; ?>">Cetak KHS</a>
		</li>
	<?php } ?>
	<?php if ($this->auth->has_permission('Krs_Mahasiswa.Krs.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/krs/krs_mahasiswa/create') ?>" id="create_new"><?php echo lang('datakrs_new'); ?></a>
	</li>
	<?php endif; ?>
	<?php if($this->uri->segment(5) != '' and $this->uri->segment(4) != "cetakkhs"){ ?>
		<li <?php echo $this->uri->segment(4) == 'printkrs' ? 'class="active"' : '' ?> >
		   <a href="<?php echo site_url(SITE_AREA .'/krs/krs_mahasiswa/printkrs/'); echo isset($sms)? "/".$sms:""; echo isset($mhs)? "/".$mhs:""; ?>">Cetak KRS</a>
	   </li>
	<?php } ?>
	
	 <?php if($this->uri->segment(5) != '' and $this->uri->segment(4) != "cetakkhs"){ ?>
		<li <?php echo $this->uri->segment(4) == 'printkhs' ? 'class="active"' : '' ?> >
		   <a href="<?php echo site_url(SITE_AREA .'/krs/krs_mahasiswa/printkhs/'); echo isset($sms)? "/".$sms:""; echo isset($mhs)? "/".$mhs:""; ?>">Cetak KHS</a>
	   </li>
	<?php } ?>
	<?php if($this->uri->segment(5) != '' and $this->uri->segment(4) != "cetakkhs"){ ?>
		<li <?php echo $this->uri->segment(4) == 'printkartu' ? 'class="active"' : '' ?> >
			<a href="<?php echo site_url(SITE_AREA .'/krs/krs_mahasiswa/printkartu/'); echo isset($sms)? "/".$sms:""; echo isset($mhs)? "/".$mhs:""; ?>">Cetak Kartu</a>
		</li>
	<?php } ?>
	<?php if ($this->auth->has_permission('Krs_Mahasiswa.Krs.Create')) : ?>
		<li <?php echo $this->uri->segment(4) == 'upload' ? 'class="active"' : '' ?> >
			<a href="<?php echo site_url(SITE_AREA .'/krs/krs_mahasiswa/upload/'); ?>">Upload KRS</a>
		</li>
	<?php endif; ?>	 
</ul>