<?php

$validation_errors = validation_errors();

if ($validation_errors) :
?>
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
<div class="admin-box">
	<h3>DataKrs</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('kode_mk') ? 'error' : ''; ?>">
				<?php echo form_label('Mata Kuliah'. lang('bf_form_label_required'), 'datakrs_kode_mk', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='datakrs_kode_mk' type='text' name='datakrs_kode_mk' maxlength="20" value="<?php echo set_value('datakrs_kode_mk', isset($datakrs['kode_mk']) ? $datakrs['kode_mk'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('kode_mk'); ?></span>
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
				</div>
			</div>

			<div class="control-group <?php echo form_error('kode_dosen') ? 'error' : ''; ?>">
				<?php echo form_label('Dosen'. lang('bf_form_label_required'), 'datakrs_kode_dosen', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='datakrs_kode_dosen' type='text' name='datakrs_kode_dosen' maxlength="20" value="<?php echo set_value('datakrs_kode_dosen', isset($datakrs['kode_dosen']) ? $datakrs['kode_dosen'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('kode_dosen'); ?></span>
				</div>
			</div> 
			<div class="control-group <?php echo form_error('semester') ? 'error' : ''; ?>">
				  <?php echo form_label('Semester'. lang('bf_form_label_required'), 'semester', array('class' => 'control-label') ); ?>
				  <div class='controls'>
				  <select name="datakrs_semester" id="datakrs_semester" class="chosen-select-deselect">
					  <option value=""></option>
					  <?php if (isset($pilihansemesters) && is_array($pilihansemesters) && count($pilihansemesters)):?>
					  <?php foreach($pilihansemesters as $record):?>
						  <option value="<?php echo $record->value?>" <?php if(isset($datakrs['semester']))  echo  ($record->value==$datakrs['semester']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
						  <?php endforeach;?>
					  <?php endif;?>
				  </select>
   
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

			<div class="control-group <?php echo form_error('created_date') ? 'error' : ''; ?>">
				<?php echo form_label('Tanggal Input', 'datakrs_created_date', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='datakrs_created_date' type='text' name='datakrs_created_date'  value="<?php echo set_value('datakrs_created_date', isset($datakrs['created_date']) ? $datakrs['created_date'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('created_date'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('datakrs_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/krs/datakrs', lang('datakrs_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('DataKrs.Krs.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('datakrs_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('datakrs_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>