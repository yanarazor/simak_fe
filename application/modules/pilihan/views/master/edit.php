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

if (isset($pilihan))
{
	$pilihan = (array) $pilihan;
}
$id = isset($pilihan['id']) ? $pilihan['id'] : '';

?>
<br/>
<div class="admin-box">
	<h3>Pilihan</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('kode') ? 'error' : ''; ?>">
				<?php echo form_label('Kode'. lang('bf_form_label_required'), 'pilihan_kode', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='pilihan_kode' type='text' name='pilihan_kode' maxlength="10" value="<?php echo set_value('pilihan_kode', isset($pilihan['kode']) ? $pilihan['kode'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('kode'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('nama') ? 'error' : ''; ?>">
				<?php echo form_label('Nama'. lang('bf_form_label_required'), 'pilihan_nama', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='pilihan_nama' type='text' name='pilihan_nama' maxlength="100" value="<?php echo set_value('pilihan_nama', isset($pilihan['nama']) ? $pilihan['nama'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('nama'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('value') ? 'error' : ''; ?>">
				<?php echo form_label('Value'. lang('bf_form_label_required'), 'pilihan_value', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='pilihan_value' type='text' name='pilihan_value' maxlength="10" value="<?php echo set_value('pilihan_value', isset($pilihan['value']) ? $pilihan['value'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('value'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('label') ? 'error' : ''; ?>">
				<?php echo form_label('Label'. lang('bf_form_label_required'), 'pilihan_label', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='pilihan_label' type='text' name='pilihan_label' maxlength="100" value="<?php echo set_value('pilihan_label', isset($pilihan['label']) ? $pilihan['label'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('label'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('pilihan_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/master/pilihan', lang('pilihan_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('Pilihan.Master.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('pilihan_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('pilihan_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>