<script src="<?php echo base_url(); ?>themes/admin/js/sweetalert.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/css/sweetalert.css">

<?php

$num_columns	= 3;
$can_delete	= $this->auth->has_permission('Kuesioner.Master.Delete');
$can_edit		= $this->auth->has_permission('Kuesioner.Master.Edit');
$totalnilai = 0;
$pembagiall = 0;
?>
<div class="box box-warning">
	<div class="box-body">
	<?php echo form_open($this->uri->uri_string(), 'id="frm"'); ?>
	<input type='hidden' name='kode_jadwal' maxlength="3" value="<?php e($idjadwal) ?>" />
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th> 
					<th>Unsur</th>
					<th>Rata-rata <br>Kriteria Penilaian</th>
				</tr>
				 
			</thead>
			 
			<tbody>
				 
				<?php
				$no = 1;
				if (isset($records) && is_array($records) && count($records)) :
					foreach ($records as $record) :
					$nilai = isset($jsonjawaban['id'][$record->kode]) ? $jsonjawaban['id'][$record->kode] : "";
					if($nilai > 0){
						$totalnilai = $totalnilai + $nilai;
						$pembagiall++;
					}
				?>
				
				<tr>
					<td><?php e($no); ?>.</td>
					<td><?php e($record->pertanyaan) ?></td>
					<td align="center">
						<?php echo $nilai; ?>
					</td>
				</tr>
				<?php
					$no++;
					endforeach;
				 endif; ?>
				 
				<tr>
					<td></td>
					<td><b>Rata-rata</b></td>
					<td align="center">
						<?php 
						if($totalnilai != "" and $pembagiall != "")
						echo round($totalnilai/$pembagiall,2). "<br>"; 
						//echo $totalnilai. "<br>";
						//echo $pembagiall;
						?>
					</td>
				</tr>
			</tbody>
		</table>
		
		<div class="input-group">
			<b>Saran</b> <br>
			<?php
			$no = 1;
			if (isset($recordsaran) && is_array($recordsaran) && count($recordsaran)) :
				foreach ($recordsaran as $record) : 
					 echo $no.". ".$record->saran."<br>";
					 $no++;
				endforeach;
			endif;
			?>
		 </div>
		
		<br>
		<b>Keterangan</b><br>
		SB = Sangat Baik<br>
		B = Baik<br>
		C = Cukup<br>
		K = Kurang<br>
		SK = Sangat Kurang<br>
		 
	</div>
    
	<?php echo form_close(); ?>
</div>
<script>
	$("#btnsave").click(function(){
		submitdata();
		return false; 
	});	
	 
	function submitdata(){
		var json_url = "<?php echo base_url() ?>admin/master/kuesioner/save";
		 $.ajax({    
		 	type: "POST",
			url: json_url,
			data: $("#frm").serialize(),
            dataType: "json",
			success: function(data){ 
				//alert("masuk");
                if(data.success){
                    swal("Pemberitahuan!", data.msg, "success");
					 $("#modal-global").modal("hide");
                }
                
			}});
		return false; 
	}
</script>