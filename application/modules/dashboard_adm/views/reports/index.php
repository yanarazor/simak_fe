<?php
	$this->load->library('convert');
	$convert = new convert();
?>
	<br> 
   <div class="row">
	   <div class="col-md-8">
		   <div class="row">
			   <div class="col-xs-4">
				   <!-- Centered text -->
				   <div class="stat-panel text-center">
					   <div class="stat-row">
						   <!-- Dark gray background, small padding, extra small text, semibold text -->
						   <div class="stat-cell bg-dark-orange padding-sm text-xs text-semibold">
							   <i class="fa fa-user"></i>&nbsp;&nbsp;<b>Mahasiswa Aktif</b>
						   </div>
					   </div> <!-- /.stat-row -->
					   <div class="stat-row">
						   <!-- Bordered, without top border, without horizontal padding -->
						   <div class="stat-cell bordered no-border-t no-padding-hr">
						   <!-- <div class="pie-chart" data-percent="43" id="easy-pie-chart-1">-->
							   <div class="pie-chart"  id="easy-pie-chart-1">
								   <div class="pie-chart-label"><?php e($convert->Addseparator($jmlmahasiswaaktif)); ?></div>
							   <canvas height="90" width="90"></canvas>
							   </div>
							   
						   </div>
					   </div> <!-- /.stat-row -->
				   </div> <!-- /.stat-panel -->
			   </div>
			   <div class="col-xs-4">
				   <div class="stat-panel text-center">
					   <div class="stat-row">
						   <!-- Dark gray background, small padding, extra small text, semibold text -->
						   <div class="stat-cell bg-dark-orange padding-sm text-xs text-semibold">
							   <i class="fa fa-check"></i>&nbsp;&nbsp; <b>Konfirmasi Pembayaran</b>
						   </div>
					   </div> <!-- /.stat-row -->
					   <div class="stat-row">
						   <!-- Bordered, without top border, without horizontal padding -->
						   <div class="stat-cell bordered no-border-t no-padding-hr">
						   <!-- <div class="pie-chart" data-percent="93" id="easy-pie-chart-2">-->
							   <div class="pie-chart" id="easy-pie-chart-2">
								   <div class="pie-chart-label">
									   
								   <a href="<?php echo base_url().'admin/pembayaran/konfirmasipembayaran/nover'; ?>"><?php e($convert->Addseparator($jmlkonfirmasipembayaran)); ?> </a></div>
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
							   <i class="fa fa-user"></i>&nbsp;&nbsp;<b>Mahasiswa Beasiswa</b>
						   </div>
					   </div> <!-- /.stat-row -->
					   <div class="stat-row">
						   <!-- Bordered, without top border, without horizontal padding -->
						   <div class="stat-cell bordered no-border-t no-padding-hr">
							   <div class="pie-chart" id="easy-pie-chart-3">
							   <!-- <div class="pie-chart" data-percent="75" id="easy-pie-chart-3">-->
								   <div class="pie-chart-label"></div>
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
							   <div class="text-xs" style="margin-bottom: 5px;"><b>Pembelajaran</b></div>
							   <div class="stats-sparklines" id="stats-sparklines-3" style="width: 100%"><canvas width="313" height="45" style="display: inline-block; width: 313px; height: 45px; vertical-align: top;"></canvas></div>
						   </div>
					   </div> <!-- /.stat-row -->
					   <div class="stat-row">
						   <!-- Bordered, without top border, horizontally centered text -->
						   <div class="stat-counters bordered no-border-t text-center">
							   <!-- Small padding, without horizontal padding -->
							   <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
								   <!-- Big text -->
								   <span class="text-bg">
									   <strong>
									   <a href="<?php echo base_url().'admin/krs/krs_mahasiswa/lihat'; ?>">
										   <?php e($convert->Addseparator($jmlsubmitkrs)); ?>
									   </a>
									   </strong>
								   </span><br>
								   <!-- Extra small text -->
								   <span class="text-xs text-muted">SUBMIT KRS</span>
							   </div>
							   <!-- Small padding, without horizontal padding -->
							   <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
								   <!-- Big text -->
								   <span class="text-bg"><strong><?php e($convert->Addseparator($jmlkrsgakadanilai)); ?></strong></span><br>
								   <!-- Extra small text -->
								   <span class="text-xs text-muted">BELUM ADA NILAI</span>
							   </div>
							   <!-- Small padding, without horizontal padding -->
							   <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
								   <!-- Big text -->
								   <span class="text-bg"><strong><a href="<?php echo base_url().'admin/reports/dashboard_kprd/adm'; ?>"><?php echo isset($jumlahjadwal) ? $jumlahjadwal : ""; ?></a></strong></span><br>
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

   <div class="row">
	   <div class="col-md-12">
		   <div class="panel widget-tasks panel-dark-gray">
			   <div class="panel-heading">
				   <span class="panel-title"><i class="panel-title-icon fa fa-tasks"></i>Jumlah Mahasiswa</span>
					  <div class="pull-right">
						  <select name="filfakultas" id="filfakultas" class="chosen-select-deselect" style="width:300px;">
							  <option value="">Pilih Fakultas</option>
							  <?php if (isset($masterfakultass) && is_array($masterfakultass) && count($masterfakultass)):?>
							  <?php foreach($masterfakultass as $record):?>
								  <option value="<?php echo $record->kode_fakultas;?>" <?php if(isset($filfakultas))  echo  ($record->kode_fakultas==$filfakultas) ? "selected" : ""; ?>><?php echo $record->nama_fakultas; ?></option>
								  <?php endforeach;?>
							  <?php endif;?>
						  </select>
						  <select name="prodi" id="slcprodi" onchange="showstatmahasiswa()" class="chosen-select-deselect">
							 <option value="">Pilih Program Studi</option>
							 <?php if (isset($masterprogramstudis) && is_array($masterprogramstudis) && count($masterprogramstudis)):?>
							  <?php foreach($masterprogramstudis as $record):?>
								   <option value="<?php echo $record->kode_prodi?>" <?php if(isset($filljurusan))  echo  ($record->kode_prodi==$filljurusan) ? "selected" : ""; ?>><?php echo $record->nama_prodi; ?></option>
							   <?php endforeach;?>
							  <?php endif;?>
						   </select>
					  </div>
			   </div> <!-- / .panel-heading -->
			   <div class="panel-body no-padding-vr ui-sortable" id="statmahasiswacontent">
				   
			   </div>
		   </div> <!-- / .panel -->
	   </div>
		<div class="col-md-12">
		   <div class="panel widget-tasks panel-dark-gray">
			   <div class="panel-heading">
				   <span class="panel-title"><i class="panel-title-icon fa fa-tasks"></i>Dosen PA</span>
					  <div class="pull-right">
						  <select name="filfakultas" id="filfakultasdosen" class="chosen-select-deselect" style="width:300px;">
							  <option value="">Pilih Fakultas</option>
							  <?php if (isset($masterfakultass) && is_array($masterfakultass) && count($masterfakultass)):?>
							  <?php foreach($masterfakultass as $record):?>
								  <option value="<?php echo $record->kode_fakultas;?>" <?php if(isset($filfakultas))  echo  ($record->kode_fakultas==$filfakultas) ? "selected" : ""; ?>><?php echo $record->nama_fakultas; ?></option>
								  <?php endforeach;?>
							  <?php endif;?>
						  </select>
						  <select name="prodi" id="slcprodidosen" class="chosen-select-deselect">
							 <option value="">Pilih Program Studi</option>
							 <?php if (isset($masterprogramstudis) && is_array($masterprogramstudis) && count($masterprogramstudis)):?>
							  <?php foreach($masterprogramstudis as $record):?>
								   <option value="<?php echo $record->kode_prodi?>" <?php if(isset($filljurusan))  echo  ($record->kode_prodi==$filljurusan) ? "selected" : ""; ?>><?php echo $record->nama_prodi; ?></option>
							   <?php endforeach;?>
							  <?php endif;?>
						   </select>
					  </div>
			   </div> <!-- / .panel-heading -->
			   <div class="panel-body no-padding-vr ui-sortable" id="statdosenpacontent" style="min-height:50px;">
				   
			   </div>
		   </div> <!-- / .panel -->
	   </div>
	   <div class="col-md-5">
		   <div class="panel widget-tasks panel-dark-gray">
			   <div class="panel-heading">
				   <span class="panel-title"><i class="panel-title-icon fa fa-power-off"></i>Aktifitas Terakhir</span>
				   <div class="panel-heading-controls">
					   <a href="<?php echo base_url().'admin/reports/activities/activity_user'; ?>" class='fancy'>
						   
						
					   <i class="fa fa-trash text-success"></i>
						   <button class="btn btn-xs btn-primary btn-outline dark" id="clear-completed-tasks"><i class="fa fa-trash text-success"></i>Lihat Semua</button>
					   </button>
					   </a>
				   </div>
			   </div> <!-- / .panel-heading -->
			   <!-- Without vertical padding -->
			   <div class="panel-body no-padding-vr ui-sortable">

				   <table class="table">
				   <thead>
					   <tr>
						   <th width="10px">#</th>

						   <th> Nama</th>
							
						   <th>Aksi</th>
					   </tr>
				   </thead>
				   <tbody class="valign-middle">
						
					   <?php 
						   if(isset($activities) && is_array($activities) && count($activities)):
						   $i=1;
						   foreach ($activities as $activity) : ?>
							   <tr>
								   <td>
									   <?php echo $i; ?>
								   </td>
									
								   <td>
									   <strong><?php echo ucwords($activity->display_name); ?></strong>
								   </td>
								   <td><?php echo $activity->activity; ?>
								   <br />On<?php echo date('M j, Y g:i A', strtotime($activity->created_on)); ?>
								   </td> 
									 
							   </tr>
						   <?php 
						   $i++;
						   endforeach; 
						   endif;?>
				   </tbody>
			   </table>
			   </div> <!-- / .panel-body -->
		   </div> <!-- / .panel -->
	   </div>
<!-- /13. $RECENT_TASKS -->

   </div>
	
	
<script type="text/javascript">  
$(document).ready(function() {	 
	showstatmahasiswa(); 
	showdosenpa();
});
function showstatmahasiswa(){
	var valprodi = $('#slcprodi').val();
	var valfakultas = $('#filfakultas').val();
 		$('#statmahasiswacontent').attr('style', 'background-color: #ecf2f9 !important;height:100px');
		$('#statmahasiswacontent').html("<center><br><br><br>Load data...</center>");
		var post_data = "prodi="+valprodi+"&fakultas="+valfakultas;
		//alert("<?php echo base_url() ?>admin/reports/dashboard_adm/showstatistikmahasiswa/?"+post_data);
	$.ajax({
			url: "<?php echo base_url() ?>admin/reports/dashboard_adm/showstatistikmahasiswa/",
			type:"post",
			data: post_data,
			dataType: "html",
			timeout:180000,
			success: function (result) {
			//alert("<?php echo base_url() ?>admin/reports/dashboard_adm/showstatistikmahasiswa/?"+post_data);
			$('#statmahasiswacontent').html(result);
			$('#statmahasiswacontent').attr('style', 'background-color: transparent !important;height:auto');
			//alert(result);
		},
		error : function(error) {
			alert(error);
		} 
	});  
	  
}  
</script> 
<script type="text/javascript">	 
	$("#slcprodi").live("change", function(){
		 
		showstatmahasiswa();
		
		return false;
	});    
	$("#filfakultas").change(function(){
		  	var valfakultas 	= $("#filfakultas").val();
			var valprodi 	= $("#slcprodi").val();
			
			$("#slcprodi").empty().append("<option>loading...</option>");
			var json_url = "<?php echo base_url(); ?>admin/master/masterprogramstudi/getbyfakultas?fak=" + encodeURIComponent(valfakultas);
			$.getJSON(json_url,function(data){
				$("#slcprodi").empty(); 
				if(data==""){
					$("#slcprodi").append("<option value=\"\">-- Pilih Prodi --</option>");
				}
				else{
					$("#slcprodi").append("<option value=\"\">-- Pilih Prodi --</option>");
					for(i=0; i<data.id.length; i++){
						$("#slcprodi").append("<option value=\"" + data.id[i]  + "\">" + data.nama_prodi[i] +"</option>");
					}
				}
				
			});
			return false;
		});
 	$("#slcprodidosen").live("change", function(){
		showdosenpa();
		return false;
	});   
  
	function showdosenpa(){
		var valprodi = $('#slcprodidosen').val();
		var valfakultas = $('#filfakultasdosen').val();
			$('#statdosenpacontent').attr('style', 'background-color: #ecf2f9 !important;height:100px');
			$('#statdosenpacontent').html("<center><br><br><br>Load data...</center>");
			var post_data = "prodi="+valprodi+"&fakultas="+valfakultas;
			//alert("<?php echo base_url() ?>admin/reports/dashboard_adm/showdosenpa/?"+post_data);
		$.ajax({
				url: "<?php echo base_url() ?>admin/reports/dashboard_adm/showdosenpa/",
				type:"POST",
				data: post_data,
				dataType: "html",
				timeout:180000,
				success: function (result) {
			
				$('#statdosenpacontent').html(result);
				$('#statdosenpacontent').attr('style', 'background-color: transparent !important;height:auto');
			 
			},
			error : function(error) {
				alert(error);
			} 
		});  	 
	}  
</script>
<!--
<link href="<?php echo base_url(); ?>assets/css/chosen/chosen.css" rel="stylesheet" type="text/css" />
<script language='JavaScript' type='text/javascript' src='<?php echo base_url(); ?>assets/js/chosen/chosen.jquery.js'></script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
-->
