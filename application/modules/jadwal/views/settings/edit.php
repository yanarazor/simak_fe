<?php

$validation_errors = validation_errors();

if ($validation_errors) :
?>
<br><br>
<div class="alert alert-block alert-error fade in">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Please fix the following errors:</h4>
	<?php echo $validation_errors; ?>
</div>
<?php
endif;

if (isset($jadwal))
{
	$jadwal = (array) $jadwal;
}
$id = isset($jadwal['id']) ? $jadwal['id'] : '';

?>
<br>
<div class="admin-box">
	<h3>Ubah Data Jadwal Kuliah</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>
			<div class="control-group <?php echo form_error('tahun_akademik') ? 'error' : ''; ?>">
				  <?php echo form_label('Tahun Akademik'. lang('bf_form_label_required'), 'tahun_akademik', array('class' => 'control-label') ); ?>
				  <div class='controls'>
				  	<input id='tahun_akademik' type='text' name='tahun_akademik' maxlength="10" value="<?php echo set_value('tahun_akademik', isset($jadwal['tahun_akademik']) ? $jadwal['tahun_akademik'] : ''); ?>" /> ex 20142, 20151
<!--
				  <select name="tahun_akademik" id="tahun_akademik" class="chosen-select-deselect">
					  <option value=""></option>
					  <?php if (isset($pilihantahuns) && is_array($pilihantahuns) && count($pilihantahuns)):?>
					  <?php foreach($pilihantahuns as $record):?>
						  <option value="<?php echo $record->value?>" <?php if(isset($jadwal['tahun_akademik']))  echo  ($record->value==$jadwal['tahun_akademik']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
						  <?php endforeach;?>
					  <?php endif;?>
				  </select>
		-->
   
					  <span class='help-inline'><?php echo form_error('tahun_akademik'); ?></span>
				  </div>
			  </div>  

			  <div class="control-group <?php echo form_error('jadwal_prodi') ? 'error' : ''; ?>">
				 <?php echo form_label('Program Studi'. lang('bf_form_label_required'), 'masterdosen_kode_prodi', array('class' => 'control-label') ); ?>
				 <div class='controls'>
					 <select name="jadwal_prodi" id="jadwal_prodi" class="chosen-select-deselect">
						 <option value=""></option>
						 <?php if (isset($masterprogramstudis) && is_array($masterprogramstudis) && count($masterprogramstudis)):?>
						 <?php foreach($masterprogramstudis as $record):?>
							  <option value="<?php echo $record->kode_prodi?>" <?php if(isset($jadwal['prodi']))  echo  ($record->kode_prodi==$jadwal['prodi']) ? "selected" : ""; ?>><?php echo $record->nama_prodi; ?></option>
						  <?php endforeach;?>
						 <?php endif;?>
					 </select>
					 <span class='help-inline'><?php echo form_error('jadwal_prodi'); ?></span>
				 </div>
			 </div> 

			 	<div class="control-group <?php echo form_error('semester') ? 'error' : ''; ?>">
				  <?php echo form_label('Semester'. lang('bf_form_label_required'), 'semester', array('class' => 'control-label') ); ?>
				  <div class='controls'>
				  <select name="jadwal_semester" id="jadwal_semester" class="chosen-select-deselect">
					  <option value=""></option>
					  <?php if (isset($pilihansemesters) && is_array($pilihansemesters) && count($pilihansemesters)):?>
					  <?php foreach($pilihansemesters as $record):?>
						  <option value="<?php echo $record->value?>" <?php if(isset($jadwal['semester']))  echo  ($record->value==$jadwal['semester']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
						  <?php endforeach;?>
					  <?php endif;?>
				  </select>
   
					  <span class='help-inline'><?php echo form_error('semester'); ?></span>
				  </div>
			  </div>  

			<div class="control-group <?php echo form_error('jadwal_hari') ? 'error' : ''; ?>">
				<?php echo form_label('Hari', 'jadwal_hari', array('class' => 'control-label') ); ?>
				<div class='controls'>		
					 <select name="jadwal_hari" id="jadwal_hari" class="chosen-select-deselect">
						 <option value=""></option>
						 <?php if (isset($pilihanhari) && is_array($pilihanhari) && count($pilihanhari)):?>
						 <?php foreach($pilihanhari as $record):?>
							  <option value="<?php echo $record->value?>" <?php if(isset($jadwal['hari']))  echo  ($record->value==$jadwal['hari']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
						  <?php endforeach;?>
						 <?php endif;?>
					 </select>

					<span class='help-inline'><?php echo form_error('jadwal_hari'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('jadwal_jam') ? 'error' : ''; ?>">
				<?php echo form_label('Jam', 'jadwal_jam', array('class' => 'control-label') ); ?>
				<div class='controls'>			
					 <select name="jadwal_jam" id="jadwal_jam" class="chosen-select-deselect">
						 <option value=""></option>
						 <?php if (isset($pilihansesi) && is_array($pilihansesi) && count($pilihansesi)):?>
						 <?php foreach($pilihansesi as $record):?>
							  <option value="<?php echo $record->value?>" <?php if(isset($jadwal['jam']))  echo  ($record->value==$jadwal['jam']) ? "selected" : ""; ?>> <?php echo $record->label; ?> | <?php echo $record->value ?></option>
						  <?php endforeach;?>
						 <?php endif;?>
					 </select>
					<span class='help-inline'><?php echo form_error('jadwal_jam'); ?></span>
				</div>
			</div>

		
			
			<div class="control-group <?php echo form_error('jadwal_kode_mk') ? 'error' : ''; ?>">
				 <?php echo form_label('Mata Kuliah'. lang('bf_form_label_required'), 'masterdosen_kode_prodi', array('class' => 'control-label') ); ?>
				 <div class='controls'>
					 <select name="jadwal_kode_mk" id="jadwal_kode_mk" class="chosen-select-deselect">
						 <option value=""></option>
						 <?php if (isset($matakuliahs) && is_array($matakuliahs) && count($matakuliahs)):?>
						 <?php foreach($matakuliahs as $record):?>
							  <option value="<?php echo $record->kode_mata_kuliah;?>" <?php if(isset($jadwal['kode_mk']))  echo  ($record->kode_mata_kuliah==$jadwal['kode_mk']) ? "selected" : ""; ?>><?php echo $record->nama_mata_kuliah; ?></option>
						  <?php endforeach;?>
						 <?php endif;?>
					 </select>
					 <span class='help-inline'><?php echo form_error('jadwal_kode_mk'); ?></span>
				 </div>
			 </div> 
			 <div class="control-group <?php echo form_error('jadwal_kode_dosen') ? 'error' : ''; ?>">
				 <?php echo form_label('Dosen', 'masterdosen_kode_prodi', array('class' => 'control-label') ); ?>
				 <div class='controls'>
					 <select name="jadwal_kode_dosen" id="jadwal_kode_dosen" class="chosen-select-deselect">
						 <option value=""></option>
						 <?php if (isset($dosens) && is_array($dosens) && count($dosens)):?>
						 <?php foreach($dosens as $record):?>
							  <option value="<?php echo $record->id?>" <?php if(isset($jadwal['kode_dosen']))  echo  ($record->id==$jadwal['kode_dosen']) ? "selected" : ""; ?>><?php echo $record->nama_dosen; ?></option>
						  <?php endforeach;?>
						 <?php endif;?>
					 </select>
					 <span class='help-inline'><?php echo form_error('jadwal_kode_dosen'); ?></span>
				 </div>
			 </div> 
			 
			
			<div class="control-group <?php echo form_error('jadwal_kelas') ? 'error' : ''; ?>">
				 <?php echo form_label('Kelas', 'masterdosen_kode_prodi', array('class' => 'control-label') ); ?>
				 <div class='controls'>
				 	<input id='jadwal_kelas' type='text' name='jadwal_kelas' maxlength="10" value="<?php echo set_value('jadwal_kelas', isset($jadwal['kelas']) ? $jadwal['kelas'] : ''); ?>" />
					<!--
					 <select name="jadwal_kelas" id="jadwal_kelas" class="chosen-select-deselect">
						 <option value=""></option>
						 <?php if (isset($kelass) && is_array($kelass) && count($kelass)):?>
						 <?php foreach($kelass as $record):?>
							  <option value="<?php echo $record->nama_kelas; ?>" <?php if(isset($jadwal['kelas']))  echo  ($record->nama_kelas==$jadwal['kelas']) ? "selected" : ""; ?>><?php echo $record->nama_kelas; ?></option>
						  <?php endforeach;?>
						 <?php endif;?>
					 </select>
					 -->
					 <span class='help-inline'><?php echo form_error('jadwal_kelas'); ?></span>
				 </div>
			 </div> 
			 <div class="control-group <?php echo form_error('kuota_kelas') ? 'error' : ''; ?>">
				<?php echo form_label('Kuota', 'kuota', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='kuota_kelas' type='text' name='kuota_kelas' maxlength="10" value="<?php echo set_value('kuota_kelas', isset($jadwal['kuota_kelas']) ? $jadwal['kuota_kelas'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('kuota_kelas'); ?></span>
				</div>
			</div>
			 <div class="control-group <?php echo form_error('jadwal_kelas') ? 'error' : ''; ?>">
				 <?php echo form_label('Ruangan', 'masterdosen_kode_prodi', array('class' => 'control-label') ); ?>
				 <div class='controls'>
				 	<input id='jadwal_ruangan' type='text' name='jadwal_ruangan' maxlength="10" value="<?php echo set_value('kd_ruangan', isset($jadwal['kd_ruangan']) ? $jadwal['kd_ruangan'] : ''); ?>" />
					<!--
					 <select name="jadwal_ruangan" id="jadwal_ruangan" class="chosen-select-deselect">
						 <option value=""></option>
						 <?php if (isset($ruangans) && is_array($ruangans) && count($ruangans)):?>
						 <?php foreach($ruangans as $record):?>
							  <option value="<?php echo $record->kode_ruangan; ?>" <?php if(isset($jadwal['kd_ruangan']))  echo  ($record->kode_ruangan==$jadwal['kd_ruangan']) ? "selected" : ""; ?>><?php echo $record->Nama_ruangan; ?></option>
						  <?php endforeach;?>
						 <?php endif;?>
					 </select>
					 -->
					 <span class='help-inline'><?php echo form_error('jadwal_kelas'); ?></span>
				 </div>
			 </div>   
			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('jadwal_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/settings/jadwal', lang('jadwal_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('Jadwal.Settings.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('jadwal_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('jadwal_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>
<script type="text/javascript">	  

	$("#tahun_akademik").change(function(){
		 
			var jadwal_prodi = $("#jadwal_prodi").val();
			var tahun_akademik = $("#tahun_akademik").val();
			$("#jadwal_kode_mk").empty().append("<option>loading...</option>");
			var json_url = "<?php echo base_url(); ?>index.php/admin/master/mastermatakuliah/getbytahun?tahun_akademik=" + encodeURIComponent(tahun_akademik)+"&jadwal_prodi=" + encodeURIComponent(jadwal_prodi);
			//alert(json_url);
			$.getJSON(json_url,function(data){
				$("#jadwal_kode_mk").empty(); 
				if(data==""){
					$("#jadwal_kode_mk").append("<option value=\"\">-- Pilih Matakuliah --</option>");
				}
				else{
					$("#jadwal_kode_mk").append("<option value=\"\">-- Pilih Matakuliah --</option>");
					for(i=0; i<data.id.length; i++){
						$("#jadwal_kode_mk").append("<option value=\"" + data.id[i]  + "\">" + data.nama_mata_kuliah[i] +"</option>");
					}
				}
				
			});
			return false;
		});
	$("#jadwal_prodi").change(function(){
		  
			var jadwal_prodi = $("#jadwal_prodi").val();
			var tahun_akademik = $("#tahun_akademik").val();
			$("#jadwal_kode_mk").empty().append("<option>loading...</option>");
			var json_url = "<?php echo base_url(); ?>index.php/admin/master/mastermatakuliah/getbytahun?tahun_akademik=" + encodeURIComponent(tahun_akademik)+"&jadwal_prodi=" + encodeURIComponent(jadwal_prodi);
			//alert(json_url);
			$.getJSON(json_url,function(data){
				$("#jadwal_kode_mk").empty(); 
				if(data==""){
					$("#jadwal_kode_mk").append("<option value=\"\">-- Pilih Matakuliah --</option>");
				}
				else{
					$("#jadwal_kode_mk").append("<option value=\"\">-- Pilih Matakuliah --</option>");
					for(i=0; i<data.id.length; i++){
						$("#jadwal_kode_mk").append("<option value=\"" + data.id[i]  + "\">" + data.nama_mata_kuliah[i] +"</option>");
					}
				}
				
			});
			
			return false;
		});
 
</script>