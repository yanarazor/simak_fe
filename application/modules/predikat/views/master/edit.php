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

if (isset($predikat))
{
	$predikat = (array) $predikat;
}
$id = isset($predikat['id']) ? $predikat['id'] : '';

?>
<div class="admin-box">
	<h3>predikat</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('ipk_dari') ? 'error' : ''; ?>">
				<?php echo form_label('IPK Dari'. lang('bf_form_label_required'), 'predikat_ipk_dari', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='predikat_ipk_dari' type='text' name='predikat_ipk_dari' maxlength="10" value="<?php echo set_value('predikat_ipk_dari', isset($predikat['ipk_dari']) ? $predikat['ipk_dari'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('ipk_dari'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('ipk_sampai') ? 'error' : ''; ?>">
				<?php echo form_label('IPK Sampai'. lang('bf_form_label_required'), 'predikat_ipk_sampai', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='predikat_ipk_sampai' type='text' name='predikat_ipk_sampai' maxlength="10" value="<?php echo set_value('predikat_ipk_sampai', isset($predikat['ipk_sampai']) ? $predikat['ipk_sampai'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('ipk_sampai'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('predikat') ? 'error' : ''; ?>">
				<?php echo form_label('Predikat'. lang('bf_form_label_required'), 'predikat_predikat', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='predikat_predikat' type='text' name='predikat_predikat' maxlength="50" value="<?php echo set_value('predikat_predikat', isset($predikat['predikat']) ? $predikat['predikat'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('predikat'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('predikat_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/master/predikat', lang('predikat_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('Predikat.Master.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('predikat_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('predikat_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>