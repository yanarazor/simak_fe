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

if (isset($masterfakultas))
{
	$masterfakultas = (array) $masterfakultas;
}
$id = isset($masterfakultas['id']) ? $masterfakultas['id'] : '';

?>
<br/>
<div class="admin-box">
	<h3>Master Fakultas</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>
			<div class="control-group <?php echo form_error('masterfakultas_kode_fakultas') ? 'error' : ''; ?>">
				<?php echo form_label('Kode Fakultas'. lang('bf_form_label_required'), 'masterfakultas_kode_fakultas', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterfakultas_kode_fakultas' type='text' name='masterfakultas_kode_fakultas' maxlength="5" value="<?php echo set_value('masterfakultas_kode_fakultas', isset($masterfakultas['kode_fakultas']) ? $masterfakultas['kode_fakultas'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('masterfakultas_kode_fakultas'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('masterfakultas_nama_fakultas') ? 'error' : ''; ?>">
				<?php echo form_label('Nama Fakultas'. lang('bf_form_label_required'), 'masterfakultas_nama_fakultas', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterfakultas_nama_fakultas' type='text' name='masterfakultas_nama_fakultas' maxlength="100" value="<?php echo set_value('masterfakultas_nama_fakultas', isset($masterfakultas['nama_fakultas']) ? $masterfakultas['nama_fakultas'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('masterfakultas_nama_fakultas'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('tgl_pendirian') ? 'error' : ''; ?>">
				<?php echo form_label('Tanggal Pendirian', 'masterfakultas_tgl_pendirian', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterfakultas_tgl_pendirian' type='text' name='masterfakultas_tgl_pendirian'  value="<?php echo set_value('masterfakultas_tgl_pendirian', isset($masterfakultas['tgl_pendirian']) ? $masterfakultas['tgl_pendirian'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('tgl_pendirian'); ?></span>
				</div>
			</div>
			<div class="control-group <?php echo form_error('dekan') ? 'error' : ''; ?>">
				<?php echo form_label('Dekan', 'dekan', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='dekan' type='text' name='dekan'  value="<?php echo set_value('dekan', isset($masterfakultas['dekan']) ? $masterfakultas['dekan'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('dekan'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('masterfakultas_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/master/masterfakultas', lang('masterfakultas_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('MasterFakultas.Master.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('masterfakultas_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('masterfakultas_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>