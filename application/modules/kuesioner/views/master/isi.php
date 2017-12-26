<script src="<?php echo base_url(); ?>themes/admin/js/sweetalert.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/css/sweetalert.css">

<?php

$num_columns	= 3;
$can_delete	= $this->auth->has_permission('Kuesioner.Master.Delete');
$can_edit		= $this->auth->has_permission('Kuesioner.Master.Edit');
?>
<div class="box box-warning">
	<div class="box-body">
	
	<?php echo form_open($this->uri->uri_string(), 'id="frm"'); ?>
	<input type='hidden' name='kode_jadwal' maxlength="3" value="<?php e($idjadwal) ?>" />
		<table class="table table-bordered">
			<thead>
				<tr>
					<th rowspan="3">No</th> 
					<th rowspan="3">Unsur</th>
					<th colspan="5">Kriteria Penilaian</th>
				</tr>
				<tr>
					<th>
						SB
					</th>
					<th>
						B
					</th>
					<th>
						C
					</th>
					<th>
						K
					</th>
					<th>
						SK
					</th>
				</tr>
				 
			</thead>
			 
			<tbody>
				 
				<?php
				$no = 1;
				if (isset($records) && is_array($records) && count($records)) :
					foreach ($records as $record) :
					$nilai = isset($jsonjawaban['id'][$record->kode]) ? $jsonjawaban['id'][$record->kode] : "";
				?>
				
				<tr>
					<td><?php e($no); ?>.</td>
					<td><?php e($record->pertanyaan) ?></td>
					<td align="center">
						<input type='hidden' name='soal[]' maxlength="3" value="<?php e($record->kode) ?>" />
						<input type="radio" required name="nilai[<?php e($record->kode); ?>]" <?php echo $nilai == "5" ? "checked" : ""; ?> value="5"/>
					</td>
					<td align="center">
						<input type="radio" required name="nilai[<?php e($record->kode); ?>]" <?php echo $nilai == "4" ? "checked" : ""; ?> value="4"/>
					</td>
					<td align="center">
						<input type="radio" required name="nilai[<?php e($record->kode); ?>]" <?php echo $nilai == "3" ? "checked" : ""; ?> value="3"/>
					</td>
					<td align="center">
						<input type="radio" required name="nilai[<?php e($record->kode); ?>]" <?php echo $nilai == "2" ? "checked" : ""; ?> value="2"/>
					</td>
					<td align="center">
						<input type="radio" required name="nilai[<?php e($record->kode); ?>]" <?php echo $nilai == "1" ? "checked" : ""; ?> value="1"/>
					</td>
				</tr>
				<?php
					$no++;
					endforeach;
				 endif; ?>
				 
			</tbody>
		</table>
		<div class="callout callout-warning">
		   <h4>Perhatian!</h4>
		   <p>Pengisian saran harus menggunakan bahasa yang baik dan sopan, karena Hasil quisioner ini merupakan penilaian kinerja dosen yang akan diserahkan ke Menristekdikti</p>
		 </div>
		<div class="input-group">
			<textarea name="saran" id="saran" cols="120" rows="4" placeholder="saran anda ..." class="form-control"><?php echo isset($jsonjawaban['id']["srn"]) ? $jsonjawaban['id']["srn"] : ""; ?></textarea>
		 </div>
		
		<br>
		Saran anda sangat berarti bagi kemajuan FEB UMJ, Rahasia anda dijamin <br>
		<b>Keterangan</b><br>
		SB = Sangat Baik<br>
		B = Baik<br>
		C = Cukup<br>
		K = Kurang<br>
		SK = Sangat Kurang<br>
		 
	</div>
    <div class="box-footer">
   	 <input type="button" id="btnsave" name="save" class="btn btn-primary" value="Kirim"  />
	
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