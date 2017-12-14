	<br><br><br><br>
	<div class="row">
			<div class="col-md-8">
				<div class="row">
					<div class="col-xs-4">
						<!-- Centered text -->
						<div class="stat-panel text-center">
							<div class="stat-row">
								<!-- Dark gray background, small padding, extra small text, semibold text -->
								<div class="stat-cell bg-dark-orange padding-sm text-xs text-semibold">
									<i class="fa fa-user"></i>&nbsp;&nbsp;JUMLAH<br> MATA KULIAH DIAMPU
								</div>
							</div> <!-- /.stat-row -->
							<div class="stat-row">
								<!-- Bordered, without top border, without horizontal padding -->
								<div class="stat-cell bordered no-border-t no-padding-hr">
								<!-- <div class="pie-chart" data-percent="43" id="easy-pie-chart-1">-->
									<div class="pie-chart"  id="easy-pie-chart-1">
										<div class="pie-chart-label">120 <br> Mata Kuliah</div>
									<canvas height="90" width="90"></canvas></div>
								</div>
							</div> <!-- /.stat-row -->
						</div> <!-- /.stat-panel -->
					</div>
					<div class="col-xs-4">
						<div class="stat-panel text-center">
							<div class="stat-row">
								<!-- Dark gray background, small padding, extra small text, semibold text -->
								<div class="stat-cell bg-dark-orange padding-sm text-xs text-semibold">
									<i class="fa fa-check"></i>&nbsp;&nbsp; TOTAL <br> MAHASISWA YANG DIAJAR
								</div>
							</div> <!-- /.stat-row -->
							<div class="stat-row">
								<!-- Bordered, without top border, without horizontal padding -->
								<div class="stat-cell bordered no-border-t no-padding-hr">
								<!-- <div class="pie-chart" data-percent="93" id="easy-pie-chart-2">-->
									<div class="pie-chart" id="easy-pie-chart-2">
										<div class="pie-chart-label">93 Mahasiswa</div>
									<canvas height="90" width="90"></canvas></div>
								</div>
							</div> <!-- /.stat-row -->
						</div> <!-- /.stat-panel -->
					</div>
					<div class="col-xs-4">
						<div class="stat-panel text-center">
							<div class="stat-row">
								<!-- Dark gray background, small padding, extra small text, semibold text -->
								<div class="stat-cell  bg-dark-orange padding-sm text-xs text-semibold">
									<i class="fa fa-user"></i>&nbsp;&nbsp; TOTAL <br> SKS YANG DIAMPU 
								</div>
							</div> <!-- /.stat-row -->
							<div class="stat-row">
								<!-- Bordered, without top border, without horizontal padding -->
								<div class="stat-cell bordered no-border-t no-padding-hr">
									<div class="pie-chart" id="easy-pie-chart-3">
									<!-- <div class="pie-chart" data-percent="75" id="easy-pie-chart-3">-->
										<div class="pie-chart-label">29 SKS</div>
									<canvas height="90" width="90"></canvas></div>
								</div>
							</div> <!-- /.stat-row -->
						</div> <!-- /.stat-panel -->
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="row">

					<div class="col-sm-4 col-md-12">
						<div class="stat-panel">
							<div class="stat-row">
								<!-- Purple background, small padding -->
								<div class="stat-cell bg-pa-orange padding-sm">
									<!-- Extra small text -->
									<div class="text-xs" style="margin-bottom: 5px;">NILAI MAHASISWA</div>
									<div class="stats-sparklines" id="stats-sparklines-3" style="width: 100%"><canvas width="313" height="45" style="display: inline-block; width: 313px; height: 45px; vertical-align: top;"></canvas></div>
								</div>
							</div> <!-- /.stat-row -->
							<div class="stat-row">
								<!-- Bordered, without top border, horizontally centered text -->
								<div class="stat-counters bordered no-border-t text-center">
									<!-- Small padding, without horizontal padding -->
									<div class="stat-cell col-xs-4 padding-sm no-padding-hr">
										<!-- Big text -->
										<span class="text-bg"><strong>312</strong></span><br>
										<!-- Extra small text -->
										<span class="text-xs text-muted">Sudah Di Nilai</span>
									</div>
									<!-- Small padding, without horizontal padding -->
									<div class="stat-cell col-xs-4 padding-sm no-padding-hr">
										<!-- Big text -->
										<span class="text-bg"><strong>1000</strong></span><br>
										<!-- Extra small text -->
										<span class="text-xs text-muted">BELUM ADA NILAI</span>
									</div>
									<!-- Small padding, without horizontal padding -->
									<div class="stat-cell col-xs-4 padding-sm no-padding-hr">
										<!-- Big text -->
										<span class="text-bg"><strong>523</strong></span><br>
										<!-- Extra small text -->
										<span class="text-xs text-muted">JADWAL</span>
									</div>
								</div> <!-- /.stat-counters -->
							</div> <!-- /.stat-row -->
						</div> <!-- /.stat-panel -->
					</div>
				</div>
			</div>
		</div>
	<br>
	<div class="row">
			<div class="col-md-12">
				<div class="panel panel-dark-gray panel-light-green">
					<div class="panel-heading">
						<span class="panel-title"><i class="panel-title-icon fa fa-tasks"></i>Jadwal Mengajar</span>
						<div class="panel-heading-controls">
							
							<a href="<?php echo site_url(SITE_AREA .'/settings/jadwal/printjadwaldosen/'); echo isset($tahun_akademik)? "/".$tahun_akademik:""; ?>?tahun_akademik=<?php echo isset($tahun_akademik)?$tahun_akademik:""; ?>&mk=<?php echo isset($mk)?$mk:""; ?>&prodi=<?php echo isset($prodi)?$prodi:""; ?>" target="_blank"><button class="btn btn-xs btn-warning" id="clear-completed-tasks"><i class="fa fa-print text-success"></i> Print</button></a>
						</div>
					</div> <!-- / .panel-heading -->
					<table class="table">
						<thead>
							<tr>
								<th width="10px">#</th>
								<th width="20%"> Kelas</th>
								<th width="50%">Mata Kuliah</th>
								<th>Hari</th>
								<th>Jam</th>
								<th width="40%">Prodi</th>
								<th width="20px" align="right">#</th>
								<th width="30px"></th>
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
										 <td>
										 [<?php echo $recordjadwal->kode_mk; ?>] 
										 <?php echo $recordjadwal->nama_mata_kuliah; ?>
										<td>
											<strong><?php echo ucwords($recordjadwal->hari); ?></strong>
										</td>
										<td><?php echo $recordjadwal->jam; ?></td> 
										<td><?php echo $recordjadwal->nama_prodi; ?></td> 
										<td>
											<a href="<?php echo base_url() ?>admin/nilai/nilai_mahasiswa/absenharian/simple?kode_mk=<?php echo $recordjadwal->kode_mk; ?>&tahun=<?php echo $recordjadwal->tahun_akademik; ?>&kelas=<?php echo $recordjadwal->kelas; ?>&sms=<?php echo $recordjadwal->semester; ?>&filljurusan=<?php echo $recordjadwal->kode_prodi; ?>" class='fancy' target="_blank">
												<span class="label label-danger pull-right">Absen</span>
											</a>
										</td>
										<td>
											 
											<a href="<?php echo base_url() ?>admin/nilai/nilai_mahasiswa/viewmahasiswa/simple?kode_mk=<?php echo $recordjadwal->kode_mk; ?>&tahun=<?php echo $recordjadwal->tahun_akademik; ?>&kelas=<?php echo $recordjadwal->kelas; ?>&sms=<?php echo $recordjadwal->semester; ?>&filljurusan=<?php echo $recordjadwal->kode_prodi; ?>" class='fancy' target="_blank">
												<span class="label label-warning pull-right">Nilai</span>
											</a>
										</td>
										<td>
											<a href="<?php echo base_url() ?>admin/settings/jadwal/addmateri/simple/<?php echo $recordjadwal->id; ?>?kode_mk=<?php echo $recordjadwal->kode_mk; ?>&tahun=<?php echo $recordjadwal->tahun_akademik; ?>&kelas=<?php echo $recordjadwal->kelas; ?>&sms=<?php echo $recordjadwal->semester; ?>&filljurusan=<?php echo $recordjadwal->kode_prodi; ?>" class='fancy' target="_blank">
												<span class="label label-success pull-right">Materi</span>
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
<!-- /13. $RECENT_TASKS -->

		</div>
	</div> <!-- / #content-wrapper -->
	<div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->
<script type="text/javascript">  
$(document).ready(function() {
$(".fancy").fancybox({
			'overlayShow'	: true,
			'transitionIn'	: 'elastic',
			'transitionOut'	: 'elastic', 
			'onClosed'           : function(){},
			'autoSize' : false,
			'minheight':'500',
			'type':'iframe',
			'width':'400',
			'height':'600'
			 
		}); 
		
});
  
</script> 
 