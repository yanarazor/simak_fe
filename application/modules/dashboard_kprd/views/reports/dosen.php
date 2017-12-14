<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminlte/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminlte/dist/css/AdminLTE.min.css">   	
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
     
<div class='box box-primary'>
    <div class="box-body">
	<script src="<?php echo base_url(); ?>themes/admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
	  <div class="row">
	  	<center><h3>Dosen</h3></center>
		  <div class="col-xs-12">
			 <table class="table table-bordered table-striped table-responsive dt-responsive table-data">
						<thead>
							<tr>
								<th width="10px">#</th>
								<th width="70%">Dosen</th>
								<th >Rata-rata Nilai Evaluasi</th>
								<th width="10px">#</th>
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
										 <td><?php echo $recordjadwal->nama_dosen; ?>
										 <td><?php echo round($recordjadwal->ratarata,2); ?></td> 
										 <td><a href="<?php echo base_url(); ?>admin/reports/dashboard_kprd/detilevaluasi/simple/?dosen=<?php echo $recordjadwal->kode_dosen; ?>&tahun=<?php echo $tahunakademik; ?>" tooltip="Detil Evaluasi" class="show-modal">
												<span class='fa-stack'>
					   <i class='fa fa-square fa-stack-2x'></i>
					   	<i class='fa fa-eye fa-stack-1x fa-inverse'></i>
					   	</span>
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