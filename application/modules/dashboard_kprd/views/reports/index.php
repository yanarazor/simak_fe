<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminlte/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminlte/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css">
<!-- sweet alert -->
<script src="<?php echo base_url(); ?>themes/adminlte/js/sweetalert.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminlte/css/sweetalert.css">
<?php
	$this->load->library('convert');
	$convert = new convert();
	$mainmenu = $this->uri->segment(2);
	$menu = $this->uri->segment(3);
	$submenu = $this->uri->segment(4);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa  fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Jumlah Jadwal</span>
              <span class="info-box-number"><?php echo isset($jumlahjadwal) ? $jumlahjadwal : ""; ?> <small> Kali</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Jml Mahasiswa</span>
              <span class="info-box-number"><?php echo isset($jmlmahasiswa) ? $jmlmahasiswa : ""; ?> <small> Mahasiswa</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->

        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Jml Dosen</span>
               <span class="info-box-number"><?php echo isset($jumlahdosen) ? $jumlahdosen : "0"; ?> <small> Orang</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Mahasiswa Beasiswa</span>
              <span class="info-box-number"><?php echo isset($mahasiswabeasiswa) ? $convert->ToRpnosimbol((Double)$mahasiswabeasiswa) : "0"; ?> <small>Mahasiswa</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      
<div class='box box-primary'>
    <div class="box-body">
	<script src="<?php echo base_url(); ?>themes/admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
	  <div class="row">
	  	<center><h3>Jadwal</h3></center>
		  <div class="col-xs-12">
			 <table class="table table-bordered table-striped table-responsive dt-responsive table-data">
						<thead>
							<tr>
								<th width="10px">#</th>
								<th> Kelas</th>
								<th>Dosen</th>
								<th width="50%">Mata Kuliah</th>
								<th width="5%">SKS</th>
								<th>Hari</th>
								<th>Jam</th>
								<th>Persentase Pertemuan</th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody class="valign-middle">
							 
							<?php 
								if(isset($jadwalngajars) && is_array($jadwalngajars) && count($jadwalngajars)):
								$i=1;
								foreach ($jadwalngajars as $recordjadwal) : ?>
									<tr>
										<td>
											<?php echo $i; ?>.
										</td>
										 <td><?php echo $recordjadwal->kelas; ?>
										 <td><?php echo $recordjadwal->nama_dosen; ?></td> 
										 <td>
										 [<?php echo $recordjadwal->kode_mk; ?>] 
										 <?php echo $recordjadwal->nama_mata_kuliah; ?>
										</td>
										<td align="center"><?php echo $recordjadwal->sks; ?></td> 
										<td>
											<strong><?php echo ucwords($recordjadwal->hari); ?></strong>
										</td>
										<td><?php echo $recordjadwal->jam; ?></td> 
										<td align="center">
											<?php //echo isset($recordjadwal->jml_pertemuan) ? $recordjadwal->jml_pertemuan : ""; ?>
											<?php echo isset($recordjadwal->maxpertemuan) ? $recordjadwal->maxpertemuan : ""; ?>
											<?php 
											$persentase = 0;
											$jml_pertemuan = isset($recordjadwal->jml_pertemuan) ? (int)$recordjadwal->jml_pertemuan : 0;
											$maxpertemuan = isset($recordjadwal->maxpertemuan) ? (int)$recordjadwal->maxpertemuan : 0;
											if($jml_pertemuan > 0 and $maxpertemuan > 0)
												$persentase =  $maxpertemuan/$jml_pertemuan*100;
											
											echo "(".round($persentase,2)."%)";
											?>
										</td> 
										<td>
											<?php if(isset($record->materi) and $record->materi !="") { ?>
										   <a href="<?php echo $this->settings_lib->item('site.urluploaded'); ?><?php echo isset($record->materi) ? $record->materi : '';?>" tooltip="Materi" class='show-modal' target="_blank">
											   <span class="label label-success pull-right">Materi</span>
										   </a>
										   <?php }else{ ?>
											  <span class="label label-danger pull-right">Materi</span>
										   <?php } ?>
										</td>
										<td>
											<a href="<?php echo base_url() ?>admin/reports/dashboard_kprd/absenharian/simple/<?php echo $recordjadwal->id; ?>?kode_mk=<?php echo $recordjadwal->kode_mk; ?>&tahun=<?php echo $recordjadwal->tahun_akademik; ?>&kelas=<?php echo $recordjadwal->kelas; ?>&sms=<?php echo $recordjadwal->semester; ?>&filljurusan=<?php echo $kode_prodi; ?>" tooltip="Absen" class='show-modal'>
												<span class="label label-success pull-right">Absen</span>
											</a>
										</td>
										<td>
											 
											<a href="<?php echo base_url() ?>admin/reports/dashboard_kprd/viewmahasiswa/simple/<?php echo $recordjadwal->id; ?>?kode_mk=<?php echo $recordjadwal->kode_mk; ?>&tahun=<?php echo $recordjadwal->tahun_akademik; ?>&kelas=<?php echo $recordjadwal->kelas; ?>&sms=<?php echo $recordjadwal->semester; ?>&filljurusan=<?php echo $kode_prodi; ?>" tooltip="Nilai" class='show-modal' target="_blank">
												<span class="label label-success pull-right">Nilai</span>
											</a>
										</td>
										<td>
											<a href="<?php echo base_url() ?>admin/master/kuesioner/hasil/<?php echo $recordjadwal->id; ?>?kode_mk=<?php echo $recordjadwal->kode_mk; ?>&tahun=<?php echo $recordjadwal->tahun_akademik; ?>&kelas=<?php echo $recordjadwal->kelas; ?>&sms=<?php echo $recordjadwal->semester; ?>&filljurusan=<?php echo $kode_prodi; ?>" class='fancy show-modal' tooltip="Evaluasi Proses Pembelajaran" target="_blank">
												<span class="label label-info pull-right">Kuesioner</span>
											</a>
										</td>
										
									</tr>
								<?php 
								$i++;
								endforeach; 
								endif;?>
						</tbody>
					</table>
		  </div>	
	  </div>
	</div>
</div>
<script src="<?php echo base_url(); ?>themes/adminlte/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url(); ?>themes/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>themes/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>themes/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>themes/adminlte/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>themes/adminlte/plugins/datatables/extensions/Responsive/js/dataTables.responsive.js"></script>
<script type="text/javascript">
//alert("<?php echo base_url() ?>admin/masters/pak/ambil_datanew");
$(".table-data").DataTable({
	ordering: false,
	processing: false 
});
 

</script>