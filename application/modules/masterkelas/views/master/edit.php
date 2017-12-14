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

if (isset($masterkelas))
{
	$masterkelas = (array) $masterkelas;
}
$id = isset($masterkelas['id']) ? $masterkelas['id'] : '';

?>
<br>
<div class="admin-box">
	<h3>Master Kelas</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>			
				<div class="control-group <?php echo form_error('tahun_akademik') ? 'error' : ''; ?>">
				<?php echo form_label('Tahun Akademik'. lang('bf_form_label_required'), 'masterkelas_tahun_akademik', array('class' => 'control-label') ); ?>
				<div class='controls'>		
				
				<select name="masterkelas_tahun_akademik" id="masterkelas_tahun_akademik" class="chosen-select-deselect" placeholder="masterkelas_tahun_akademik">
				<option value="<?php echo $masterkelas['tahun_akademik']?>"><?php echo $masterkelas['tahun_akademik']?></option>
				
				<option value="20141">2014 Ganjil</option>
				<option value="20142">2014 Genap</option>
				<option value="20151">2015 Ganjil</option>
				<option value="20152">2015 Genap</option>
				<option value="20161">2016 Ganjil</option>
				<option value="20162">2016 Genap</option>
				<option value="20171">2017 Ganjil</option>
				<option value="20172">2017 Genap</option>
				<option value="20181">2018 Ganjil</option>
				<option value="20182">2018 Genap</option>
				<option value="20191">2019 Ganjil</option>
				<option value="20192">2019 Genap</option>
				<option value="20201">2020 Ganjil</option>
				<option value="20202">2020 Genap</option>
				</select>
		
					<span class='help-inline'><?php echo form_error('tahun_akademik'); ?></span>
				</div>
			</div>
			

			<div class="control-group <?php echo form_error('kd_kelas') ? 'error' : ''; ?>">
				<?php echo form_label('Kode Kelas'. lang('bf_form_label_required'), 'masterkelas_kd_kelas', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterkelas_kd_kelas' type='text' name='masterkelas_kd_kelas' maxlength="10" value="<?php echo set_value('masterkelas_kd_kelas', isset($masterkelas['kd_kelas']) ? $masterkelas['kd_kelas'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('kd_kelas'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('nama_kelas') ? 'error' : ''; ?>">
				<?php echo form_label('Nama Kelas'. lang('bf_form_label_required'), 'masterkelas_nama_kelas', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterkelas_nama_kelas' type='text' name='masterkelas_nama_kelas' maxlength="10" value="<?php echo set_value('masterkelas_nama_kelas', isset($masterkelas['nama_kelas']) ? $masterkelas['nama_kelas'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('nama_kelas'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('kuota') ? 'error' : ''; ?>">
				<?php echo form_label('Kuota', 'masterkelas_kuota', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterkelas_kuota' type='text' name='masterkelas_kuota' maxlength="10" value="<?php echo set_value('masterkelas_kuota', isset($masterkelas['kuota']) ? $masterkelas['kuota'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('kuota'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('keterangan') ? 'error' : ''; ?>">
				<?php echo form_label('Keterangan', 'masterkelas_keterangan', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterkelas_keterangan' type='text' name='masterkelas_keterangan' maxlength="255" value="<?php echo set_value('masterkelas_keterangan', isset($masterkelas['keterangan']) ? $masterkelas['keterangan'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('keterangan'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('masterkelas_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/master/masterkelas', lang('masterkelas_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('MasterKelas.Master.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('masterkelas_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('masterkelas_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>