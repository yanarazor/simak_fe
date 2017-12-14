
	<div class="row">
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa  fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">JML MATAKULIAH</span>
              <span class="info-box-number"><span id="jmlmk"></span</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Jml Mahasiswa</span>
              <span class="info-box-number"><span id="jmlmhs"></span> Mahasiswa</small></span>
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
              <span class="info-box-text">Jml SKS</span>
               <span class="info-box-number"><span id="jmlsks"></span> SKS</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-bar-chart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Rara-rata Evaluasi</span>
               <span class="info-box-number"><span id="jmlevaluasi"><?php echo $rataratakuesdosen; ?></span> </small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
	</div>
	 <div class="box box-warning direct-chat direct-chat-warning">
	   <div class="box-header with-border">
		 <h3 class="box-title">Jadwal Mengajar</h3>
			   
				   <a href="<?php echo site_url(SITE_AREA .'/settings/jadwal/printjadwaldosen/'); echo isset($tahun_akademik)? "/".$tahun_akademik:""; ?>?tahun_akademik=<?php echo isset($tahun_akademik)?$tahun_akademik:""; ?>&mk=<?php echo isset($mk)?$mk:""; ?>&prodi=<?php echo isset($prodi)?$prodi:""; ?>" target="_blank" class="pull-right">
				   	<button class="btn btn-xs btn-warning" id="clear-completed-tasks"><i class="fa fa-print text-success"></i> Print</button>
				   </a>
		   </div> <!-- / .panel-heading -->
		   <div class="box-body">
			   <table class="table table-bordered table-striped">
			   <thead>
				   <tr>
					   <th width="10px">#</th>
					   <th width="20%"> Kelas</th>
					   <th width="50%">Mata Kuliah</th>
					   <th width="5%">SKS</th>
					   <th>Hari</th>
					   <th>Jam</th>
					   <th width="40%">Prodi</th>
					   <th width="">Jml</th>
					   <th width="20px" align="right" colspan="4">#</th>
				   
				   </tr>
			   </thead>
			   <tbody class="valign-middle">
			   
				   <?php 
					   $jmlmk = 0;
					   $namamk = "";
					   $jmlmhs = 0;
					   $jmlsks = 0;
					   if(isset($jadwalngajars) && is_array($jadwalngajars) && count($jadwalngajars)):
					   $i=1;
					   foreach ($jadwalngajars as $recordjadwal) : 
					   if($namamk != $recordjadwal->nama_mata_kuliah)
					   {	
						   $namamk = $recordjadwal->nama_mata_kuliah;
						   $jmlmk = $jmlmk + 1;
						   //echo $jmlmk;
					   }
					   $jmlmhs = $jmlmhs + (int)$recordjadwal->jumlah;
					   $jmlsks = $jmlsks + (int)$recordjadwal->sks;
					   ?>
						   <tr>
							   <td>
								   <?php echo $i; ?>.
							   </td>
								<td><?php echo $recordjadwal->kelas; ?>
								<td>
								[<?php echo $recordjadwal->kode_mk; ?>] 
								<?php echo $recordjadwal->nama_mata_kuliah; ?>
							   </td>
							   <td><?php echo $recordjadwal->sks; ?></td> 
							   <td>
								   <strong><?php echo ucwords($recordjadwal->hari); ?></strong>
							   </td>
							   <td><?php echo $recordjadwal->jam; ?></td> 
							   <td><?php echo $recordjadwal->nama_prodi; ?></td> 
							   <td><?php echo $recordjadwal->jumlah; ?></td> 
							   <td>
								   <a href="<?php echo base_url() ?>admin/settings/jadwal/addmateri/simple/<?php echo $recordjadwal->id; ?>?kode_mk=<?php echo $recordjadwal->kode_mk; ?>&tahun=<?php echo $recordjadwal->tahun_akademik; ?>&kelas=<?php echo $recordjadwal->kelas; ?>&sms=<?php echo $recordjadwal->semester; ?>&filljurusan=<?php echo $recordjadwal->kode_prodi; ?>" tooltip="Materi" class='show-modal' target="_blank">
									   <span class="label label-success pull-right">Materi</span>
								   </a>
							   </td>
							   <td>
								   <a href="<?php echo base_url() ?>admin/nilai/nilai_mahasiswa/absenharian/simple/<?php echo $recordjadwal->id; ?>?kode_mk=<?php echo $recordjadwal->kode_mk; ?>&tahun=<?php echo $recordjadwal->tahun_akademik; ?>&kelas=<?php echo $recordjadwal->kelas; ?>&sms=<?php echo $recordjadwal->semester; ?>&filljurusan=<?php echo $recordjadwal->kode_prodi; ?>" tooltip="Absensi Harian" class='show-modal' target="_blank">
									   <span class="label label-danger pull-right">Absen</span>
								   </a>
							   </td>
							   <td>
								   <a href="<?php echo base_url() ?>admin/nilai/nilai_mahasiswa/viewmahasiswa/simple/<?php echo $recordjadwal->id; ?>?kode_mk=<?php echo $recordjadwal->kode_mk; ?>&tahun=<?php echo $recordjadwal->tahun_akademik; ?>&kelas=<?php echo $recordjadwal->kelas; ?>&sms=<?php echo $recordjadwal->semester; ?>&filljurusan=<?php echo $recordjadwal->kode_prodi; ?>" tooltip="Nilai Mahasiswa" class='show-modal' target="_blank">
									   <span class="label label-warning pull-right">Nilai</span>
								   </a>
							   </td>
							   <td>
								   <a href="<?php echo base_url() ?>admin/master/kuesioner/hasil/<?php echo $recordjadwal->id; ?>?kode_mk=<?php echo $recordjadwal->kode_mk; ?>&tahun=<?php echo $recordjadwal->tahun_akademik; ?>&kelas=<?php echo $recordjadwal->kelas; ?>&sms=<?php echo $recordjadwal->semester; ?>&filljurusan=<?php echo $recordjadwal->kode_prodi; ?>" class='fancy show-modal' tooltip="Evaluasi Proses Pembelajaran" target="_blank">
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
		   </div> <!-- / .panel -->
	   </div>

<script type="text/javascript">
$("#jmlmk").html("<?php echo $jmlmk; ?>");
$("#jmlmhs").html("<?php echo $jmlmhs; ?>");
$("#jmlsks").html("<?php echo $jmlsks; ?>");
</script> 
 