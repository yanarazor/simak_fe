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

if (isset($masterruangan))
{
	$masterruangan = (array) $masterruangan;
}
$id = isset($masterruangan['id']) ? $masterruangan['id'] : '';

?>
<br>
<div class="admin-box">
	<h3>Master Kelas / Ruangan </h3> 
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>
			<div class="control-group <?php echo form_error('tahun_akademik') ? 'error' : ''; ?>">
				  <?php echo form_label('Tahun Akademik'. lang('bf_form_label_required'), 'tahun_akademik', array('class' => 'control-label') ); ?>
				  <div class='controls'>
				  <select name="tahun_akademik" id="tahun_akademik" class="chosen-select-deselect">
					  <option value=""></option>
					  <?php if (isset($pilihantahuns) && is_array($pilihantahuns) && count($pilihantahuns)):?>
					  <?php foreach($pilihantahuns as $record):?>
						  <option value="<?php echo $record->value?>" <?php if(isset($masterruangan['tahun_akademik']))  echo  ($record->value==$masterruangan['tahun_akademik']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
						  <?php endforeach;?>
					  <?php endif;?>
				  </select>
   
					  <span class='help-inline'><?php echo form_error('tahun_akademik'); ?></span>
				  </div>
			  </div>  
			 
			<div class="control-group <?php echo form_error('masterruangan_kode_ruangan') ? 'error' : ''; ?>">
				<?php echo form_label('Kode Ruangan'. lang('bf_form_label_required'), 'masterruangan_kode_ruangan', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterruangan_kode_ruangan' type='text' name='masterruangan_kode_ruangan' maxlength="5" value="<?php echo set_value('masterruangan_kode_ruangan', isset($masterruangan['kode_ruangan']) ? $masterruangan['kode_ruangan'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('masterruangan_kode_ruangan'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('masterruangan_Nama_ruangan') ? 'error' : ''; ?>">
				<?php echo form_label('Nama Ruangan'. lang('bf_form_label_required'), 'masterruangan_Nama_ruangan', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterruangan_Nama_ruangan' type='text' name='masterruangan_Nama_ruangan' maxlength="50" value="<?php echo set_value('masterruangan_Nama_ruangan', isset($masterruangan['Nama_ruangan']) ? $masterruangan['Nama_ruangan'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('masterruangan_Nama_ruangan'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('status') ? 'error' : ''; ?>">
				<?php echo form_label('status', 'masterruangan_status', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterruangan_status' type='text' name='masterruangan_status' maxlength="5" value="<?php echo set_value('masterruangan_status', isset($masterruangan['status']) ? $masterruangan['status'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('status'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('waktu_awal') ? 'error' : ''; ?>">
				<?php echo form_label('Waktu Awal', 'masterruangan_waktu_awal', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterruangan_waktu_awal' type='text' name='masterruangan_waktu_awal' maxlength="10" value="<?php echo set_value('masterruangan_waktu_awal', isset($masterruangan['waktu_awal']) ? $masterruangan['waktu_awal'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('waktu_awal'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('waktu_akhir') ? 'error' : ''; ?>">
				<?php echo form_label('Waktu Akhir', 'masterruangan_waktu_akhir', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterruangan_waktu_akhir' type='text' name='masterruangan_waktu_akhir' maxlength="10" value="<?php echo set_value('masterruangan_waktu_akhir', isset($masterruangan['waktu_akhir']) ? $masterruangan['waktu_akhir'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('waktu_akhir'); ?></span>
				</div>
			</div>
 
			<div class="control-group <?php echo form_error('keterangan') ? 'error' : ''; ?>">
				<?php echo form_label('Keterangan', 'masterruangan_keterangan', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterruangan_keterangan' type='text' name='masterruangan_keterangan' maxlength="255" value="<?php echo set_value('masterruangan_keterangan', isset($masterruangan['keterangan']) ? $masterruangan['keterangan'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('keterangan'); ?></span>
				</div>
			</div>


			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('masterruangan_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/master/masterruangan', lang('masterruangan_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('MasterRuangan.Master.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('masterruangan_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('masterruangan_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>