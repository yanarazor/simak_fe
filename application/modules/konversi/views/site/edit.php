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

if (isset($konversi))
{
	$konversi = (array) $konversi;
}
$id = isset($konversi['id']) ? $konversi['id'] : '';

?>
<div class="admin-box">
	<h3>Konversi</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('huruf') ? 'error' : ''; ?>">
				<?php echo form_label('Nilai Huruf'. lang('bf_form_label_required'), 'konversi_huruf', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='konversi_huruf' type='text' name='konversi_huruf' maxlength="2" value="<?php echo set_value('konversi_huruf', isset($konversi['huruf']) ? $konversi['huruf'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('huruf'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('angka') ? 'error' : ''; ?>">
				<?php echo form_label('Angka'. lang('bf_form_label_required'), 'konversi_angka', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='konversi_angka' type='text' name='konversi_angka' maxlength="3" value="<?php echo set_value('konversi_angka', isset($konversi['angka']) ? $konversi['angka'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('angka'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('konversi_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/site/konversi', lang('konversi_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('Konversi.Site.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('konversi_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('konversi_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>