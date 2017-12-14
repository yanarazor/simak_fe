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

if (isset($kuesioner))
{
	$kuesioner = (array) $kuesioner;
}
$id = isset($kuesioner['id']) ? $kuesioner['id'] : '';

?>
<div class="admin-box">
	<h3>kuesioner</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('kode') ? 'error' : ''; ?>">
				<?php echo form_label('Kode'. lang('bf_form_label_required'), 'kuesioner_kode', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='kuesioner_kode' type='text' name='kuesioner_kode' maxlength="5" value="<?php echo set_value('kuesioner_kode', isset($kuesioner['kode']) ? $kuesioner['kode'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('kode'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('pertanyaan') ? 'error' : ''; ?>">
				<?php echo form_label('Pertanyaan'. lang('bf_form_label_required'), 'kuesioner_pertanyaan', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='kuesioner_pertanyaan' type='text' name='kuesioner_pertanyaan' maxlength="255" value="<?php echo set_value('kuesioner_pertanyaan', isset($kuesioner['pertanyaan']) ? $kuesioner['pertanyaan'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('pertanyaan'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('kuesioner_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/master/kuesioner', lang('kuesioner_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('Kuesioner.Master.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('kuesioner_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('kuesioner_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>