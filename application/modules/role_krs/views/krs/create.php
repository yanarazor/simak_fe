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

if (isset($role_krs))
{
	$role_krs = (array) $role_krs;
}
$id = isset($role_krs['id']) ? $role_krs['id'] : '';

?>
<div class="admin-box">
	<h3>Role KRS</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('dari') ? 'error' : ''; ?>">
				<?php echo form_label('Dari'. lang('bf_form_label_required'), 'role_krs_dari', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='role_krs_dari' type='text' name='role_krs_dari' maxlength="5" value="<?php echo set_value('role_krs_dari', isset($role_krs['dari']) ? $role_krs['dari'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('dari'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('sampai') ? 'error' : ''; ?>">
				<?php echo form_label('Sampai'. lang('bf_form_label_required'), 'role_krs_sampai', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='role_krs_sampai' type='text' name='role_krs_sampai' maxlength="5" value="<?php echo set_value('role_krs_sampai', isset($role_krs['sampai']) ? $role_krs['sampai'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('sampai'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('maksimal_sks') ? 'error' : ''; ?>">
				<?php echo form_label('Maksimal SKS'. lang('bf_form_label_required'), 'role_krs_maksimal_sks', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='role_krs_maksimal_sks' type='text' name='role_krs_maksimal_sks' maxlength="5" value="<?php echo set_value('role_krs_maksimal_sks', isset($role_krs['maksimal_sks']) ? $role_krs['maksimal_sks'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('maksimal_sks'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('role_krs_action_create'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/krs/role_krs', lang('role_krs_cancel'), 'class="btn btn-warning"'); ?>
				
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>