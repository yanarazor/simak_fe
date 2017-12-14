<?php

$validation_errors = validation_errors();

if ($validation_errors) :
?>
<br>
<div class="alert alert-block alert-error fade in">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Please fix the following errors:</h4>
	<?php echo $validation_errors; ?>
</div>
<?php
endif;

if (isset($datakrs))
{
	$datakrs = (array) $datakrs;
}
$id = isset($datakrs['id']) ? $datakrs['id'] : '';

?>
<br>
<div class="admin-box">
<h3>Pengelolaan Nilai Mahasiswa</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('datakrs_kode_mk') ? 'error' : ''; ?>">
				<?php echo form_label('Mata Kuliah'. lang('bf_form_label_required'), 'datakrs_kode_mk', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<select name="datakrs_kode_mk" id="datakrs_kode_mk" class="chosen-select-deselect" style="width:400px">
						 <option value="">Pilih Matakuliah</option>
						 <?php if (isset($matakuliahs) && is_array($matakuliahs) && count($matakuliahs)):?>
						 <?php foreach($matakuliahs as $record):?>
							  <option value="<?php echo $record->kode_mata_kuliah;?>" <?php if(isset($datakrs['kode_mk']))  echo  ($record->kode_mata_kuliah==$datakrs['kode_mk']) ? "selected" : ""; ?>><?php echo $record->nama_mata_kuliah; ?></option>
						  <?php endforeach;?>
						 <?php endif;?>
					 </select>
					<input id='namamk' type='hidden' name='namamk' maxlength="100" value="<?php echo set_value('namamk', isset($datakrs['nama_mk']) ? $datakrs['nama_mk'] : ''); ?>" />
					
					<span class='help-inline'><?php echo form_error('datakrs_kode_mk'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('sks') ? 'error' : ''; ?>">
				<?php echo form_label('Sks', 'datakrs_sks', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='datakrs_sks' type='text' name='datakrs_sks' maxlength="5" value="<?php echo set_value('datakrs_sks', isset($datakrs['sks']) ? $datakrs['sks'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('sks'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('mahasiswa') ? 'error' : ''; ?>">
				<?php echo form_label('Mahasiswa'. lang('bf_form_label_required'), 'datakrs_mahasiswa', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='datakrs_mahasiswa' type='text' name='datakrs_mahasiswa' maxlength="20" value="<?php echo set_value('datakrs_mahasiswa', isset($datakrs['mahasiswa']) ? $datakrs['mahasiswa'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('mahasiswa'); ?></span>
					 <p class="help-block">Isi Dengan NIM Mahasiswa</p>
				</div>
			</div>
			 
			<div class="control-group <?php echo form_error('semester') ? 'error' : ''; ?>">
						<?php echo form_label('Semester', 'semester', array('class' => 'control-label') ); ?>
						<div class='controls'>
						<select name="datakrs_semester" id="datakrs_semester" class="chosen-select-deselect">
							<option value=""></option>
							<?php if (isset($pilihansemesters) && is_array($pilihansemesters) && count($pilihansemesters)):?>
							<?php foreach($pilihansemesters as $record):?>
								<option value="<?php echo $record->value?>" <?php if(isset($datakrs['semester']))  echo  ($record->value==$datakrs['semester']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
								<?php endforeach;?>
							<?php endif;?>
						</select>
		 
							<span class='help-inline'><?php echo form_error('masterdosen_kode_jenjang_studi_option1'); ?></span>
						</div>
					</div>  
			<div class="control-group <?php echo form_error('kode_dosen') ? 'error' : ''; ?>">
				<?php echo form_label('Dosen'. lang('bf_form_label_required'), 'kode_dosen', array('class' => 'control-label') ); ?>
				<div class='controls'>
					 <select name="kode_dosen" id="kode_dosen" class="chosen-select-deselect" style="width:400px">
						 <option value=""></option>
						 <?php if (isset($dosens) && is_array($dosens) && count($dosens)):?>
						 <?php foreach($dosens as $record):?>
							  <option value="<?php echo $record->id?>" <?php if(isset($datakrs['kode_dosen']))  echo  ($record->id==$datakrs['kode_dosen']) ? "selected" : ""; ?>><?php echo $record->nama_dosen; ?></option>
						  <?php endforeach;?>
						 <?php endif;?>
					 </select>
					 <input id='namadosen' type='hidden' name='namadosen' maxlength="100" value="<?php echo set_value('namadosen', isset($datakrs['namadosen']) ? $datakrs['namadosen'] : ''); ?>" />
					
					<span class='help-inline'><?php echo form_error('kode_dosen'); ?></span>
				</div>
			</div>
<!--
			<div class="control-group <?php echo form_error('kode_dosen') ? 'error' : ''; ?>">
				<?php echo form_label('Dosen'. lang('bf_form_label_required'), 'datakrs_kode_dosen', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='datakrs_kode_dosen' type='text' name='datakrs_kode_dosen' maxlength="20" value="<?php echo set_value('datakrs_kode_dosen', isset($datakrs['kode_dosen']) ? $datakrs['kode_dosen'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('kode_dosen'); ?></span>
				</div>
			</div>

			

			<div class="control-group <?php echo form_error('kode_jadwal') ? 'error' : ''; ?>">
				<?php echo form_label('Jadwal', 'datakrs_kode_jadwal', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='datakrs_kode_jadwal' type='text' name='datakrs_kode_jadwal' maxlength="10" value="<?php echo set_value('datakrs_kode_jadwal', isset($datakrs['kode_jadwal']) ? $datakrs['kode_jadwal'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('kode_jadwal'); ?></span>
				</div>
			</div>
-->
			<div class="control-group <?php echo form_error('nilai_angka') ? 'error' : ''; ?>">
				<?php echo form_label('Nilai Angka', 'datakrs_nilai_angka', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='datakrs_nilai_angka' type='text' name='datakrs_nilai_angka' maxlength="10" value="<?php echo set_value('datakrs_nilai_angka', isset($datakrs['nilai_angka']) ? $datakrs['nilai_angka'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('nilai_angka'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('nilai_huruf') ? 'error' : ''; ?>">
				<?php echo form_label('Nilai Huruf', 'datakrs_nilai_huruf', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='datakrs_nilai_huruf' type='text' name='datakrs_nilai_huruf' maxlength="5" value="<?php echo set_value('datakrs_nilai_huruf', isset($datakrs['nilai_huruf']) ? $datakrs['nilai_huruf'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('nilai_huruf'); ?></span>
				</div>
			</div>
 			</fieldset>
			 
				<fieldset>
				<legend>Perhatian</legend>
				 
					<div class="alert alert-block alert-warning fade in">
						<a class="close" data-dismiss="alert">&times;</a>
						<h4 class="alert-heading divinfo"> </h4>
				  
					</div>
				 
				<div class="control-group <?php echo form_error('jml_diambil') ? 'error' : ''; ?>">
				<?php echo form_label('Jumlah diambil', 'datakrs_nilai_huruf', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='jml_diambil' type='text' name='jml_diambil' maxlength="5" value="<?php echo set_value('jml_diambil', isset($datakrs['jml_diambil']) ? $datakrs['jml_diambil'] : ''); ?>" />
					<span class='help-inline'>Berapa kali diambil untuk matakuliah ini?</span>
				</div>
			</div>
				<div class="control-group <?php echo form_error('status_atasan') ? 'error' : ''; ?>">
					<?php echo form_label('Perbaharui Nilai', '', array('class' => 'control-label', 'id' => 'surat_izin_status_atasan_label') ); ?>
					<div class='controls'>
						<label class='checkbox' for='summary_of_test'>
							<input type='checkbox' id='perbaharui' name='perbaharui' value='1'>
							<span class='help-inline'>Checklist jika ingin memperbaharui nilai yang lama</span>
						</label>
					</div>
				</div>
			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="Save"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/nilai/nilai_mahasiswa', "Cancel", 'class="btn btn-warning"'); ?>
				
			 
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>
<script type="text/javascript">
  
   $("#datakrs_kode_mk").change(function(){ 
	 
	   var namamk = $("#datakrs_kode_mk option:selected").text();
	   $("#namamk").val(namamk);
	   cekdata();
   });
   $("#kode_dosen").change(function(){ 
	   var namadosen = $("#kode_dosen option:selected").text();
	   $("#namadosen").val(namadosen);
   });
   $("#datakrs_mahasiswa").change(function(){ 
   		cekdata();
   });
   function cekdata(){
		var kode_mk = $("#datakrs_kode_mk option:selected").val();
   		var mahasiswa = $("#datakrs_mahasiswa").val();
   		if(kode_mk != "" && mahasiswa != ""){
   			var json_url = "<?php echo base_url() ?>index.php/admin/nilai/nilai_mhs/cekexist/";
			var post_data = "kode_mk="+kode_mk+"&mahasiswa="+mahasiswa;
			$.ajax({    type: "POST",
			url:json_url,
			data: post_data,
			success: function(data){
				if(data != ""){
					alert(data);
			   		$('.divinfo').append(data);
			   }
		   }});
   		}
		
   }
$(document).ready(function() {	  
  
	});
</script>
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