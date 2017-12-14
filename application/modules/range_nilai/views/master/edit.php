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

if (isset($range_nilai))
{
	$range_nilai = (array) $range_nilai;
}
$id = isset($range_nilai['id']) ? $range_nilai['id'] : '';

?>
<div class="admin-box">
	<h3>Range Nilai</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('dari') ? 'error' : ''; ?>">
				<?php echo form_label('Dari'. lang('bf_form_label_required'), 'range_nilai_dari', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='range_nilai_dari' type='text' name='range_nilai_dari' maxlength="4" value="<?php echo set_value('range_nilai_dari', isset($range_nilai['dari']) ? $range_nilai['dari'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('dari'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('sampai') ? 'error' : ''; ?>">
				<?php echo form_label('Sampai'. lang('bf_form_label_required'), 'range_nilai_sampai', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='range_nilai_sampai' type='text' name='range_nilai_sampai' maxlength="4" value="<?php echo set_value('range_nilai_sampai', isset($range_nilai['sampai']) ? $range_nilai['sampai'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('sampai'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('nilai_huruf') ? 'error' : ''; ?>">
				<?php echo form_label('Nilai Huruf'. lang('bf_form_label_required'), 'range_nilai_nilai_huruf', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='range_nilai_nilai_huruf' type='text' name='range_nilai_nilai_huruf' maxlength="2" value="<?php echo set_value('range_nilai_nilai_huruf', isset($range_nilai['nilai_huruf']) ? $range_nilai['nilai_huruf'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('nilai_huruf'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('range_nilai_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/master/range_nilai', lang('range_nilai_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('Range_Nilai.Master.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('range_nilai_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('range_nilai_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>