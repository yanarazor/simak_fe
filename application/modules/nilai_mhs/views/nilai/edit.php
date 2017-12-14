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

			<div class="control-group <?php echo form_error('kode_mk') ? 'error' : ''; ?>">
				<?php echo form_label('Mata Kuliah'. lang('bf_form_label_required'), 'datakrs_kode_mk', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='datakrs_kode_mk' readonly type='text' name='datakrs_kode_mk' maxlength="20" value="<?php echo set_value('datakrs_kode_mk', isset($datakrs['kode_mk']) ? $datakrs['kode_mk'] : ''); ?>" />
					<input id='namamk' readonly type='hidden' name='namamk' maxlength="200" value="<?php echo set_value('nama_mk', isset($datakrs['nama_mk']) ? $datakrs['nama_mk'] : ''); ?>" />
					<input id='namadosen' readonly type='hidden' name='namadosen' maxlength="200" value="<?php echo set_value('namadosen', isset($datakrs['namadosen']) ? $datakrs['namadosen'] : ''); ?>" />
					
					<span class='help-inline'><?php echo form_error('kode_mk'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('sks') ? 'error' : ''; ?>">
				<?php echo form_label('Sks', 'datakrs_sks', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='datakrs_sks' readonly type='text' name='datakrs_sks' maxlength="5" value="<?php echo set_value('datakrs_sks', isset($datakrs['sks']) ? $datakrs['sks'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('sks'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('mahasiswa') ? 'error' : ''; ?>">
				<?php echo form_label('Mahasiswa'. lang('bf_form_label_required'), 'datakrs_mahasiswa', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='datakrs_mahasiswa' readonly type='text' name='datakrs_mahasiswa' maxlength="20" value="<?php echo set_value('datakrs_mahasiswa', isset($datakrs['mahasiswa']) ? $datakrs['mahasiswa'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('mahasiswa'); ?></span>
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
					 <select name="kode_dosen" id="kode_dosen" class="chosen-select-deselect">
						 <option value=""></option>
						 <?php if (isset($dosens) && is_array($dosens) && count($dosens)):?>
						 <?php foreach($dosens as $record):?>
							  <option value="<?php echo $record->id?>" <?php if(isset($datakrs['kode_dosen']))  echo  ($record->id==$datakrs['kode_dosen']) ? "selected" : ""; ?>><?php echo $record->nama_dosen; ?></option>
						  <?php endforeach;?>
						 <?php endif;?>
					 </select>
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

			<div class="control-group <?php echo form_error('semester') ? 'error' : ''; ?>">
				<?php echo form_label('Semester'. lang('bf_form_label_required'), 'datakrs_semester', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='datakrs_semester' type='text' name='datakrs_semester' maxlength="10" value="<?php echo set_value('datakrs_semester', isset($datakrs['semester']) ? $datakrs['semester'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('semester'); ?></span>
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
				<?php 
				if($msgdouble!=""){
				?>
					<div class="alert alert-block alert-warning fade in">
						<a class="close" data-dismiss="alert">&times;</a>
						<h4 class="alert-heading"><?php echo $msgdouble; ?></h4>
				  
					</div>
				<?php
				}
				?>
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
				<input type="submit" name="save" class="btn btn-primary" value="Simpan"  />
				atau
				<input type="submit" name="publis" class="btn btn-warning" value="Posting"  />
				atau
				<?php echo anchor(SITE_AREA .'/nilai/nilai_mhs', "Batal", 'class="btn btn-warning"'); ?>
			 
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>
<script type="text/javascript">
  
$("#datakrs_kode_mk").change(function(){ 
 	 
	var namamk = $("#datakrs_kode_mk option:selected").text();
	$("#namamk").val(namamk);
});
$("#kode_dosen").change(function(){ 
	var namadosen = $("#kode_dosen option:selected").text();
	$("#namadosen").val(namadosen);
});
 
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