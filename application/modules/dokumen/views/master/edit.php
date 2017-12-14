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

if (isset($dokumen))
{
	$dokumen = (array) $dokumen;
}
$id = isset($dokumen['id']) ? $dokumen['id'] : '';

?>
<div class="admin-box">
	<h3>dokumen</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('nama_dokumen') ? 'error' : ''; ?>">
				<?php echo form_label('Nama Dokumen'. lang('bf_form_label_required'), 'dokumen_nama_dokumen', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='dokumen_nama_dokumen' type='text' name='dokumen_nama_dokumen' maxlength="100" value="<?php echo set_value('dokumen_nama_dokumen', isset($dokumen['nama_dokumen']) ? $dokumen['nama_dokumen'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('nama_dokumen'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('file') ? 'error' : ''; ?>">
				<?php echo form_label('file', 'dokumen_file', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='dokumen_file' type='text' name='dokumen_file' maxlength="100" value="<?php echo set_value('dokumen_file', isset($dokumen['file']) ? $dokumen['file'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('file'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('keterangan') ? 'error' : ''; ?>">
				<?php echo form_label('Keterangan', 'dokumen_keterangan', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'dokumen_keterangan', 'id' => 'dokumen_keterangan', 'rows' => '5', 'cols' => '80', 'value' => set_value('dokumen_keterangan', isset($dokumen['keterangan']) ? $dokumen['keterangan'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('keterangan'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('dokumen_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/master/dokumen', lang('dokumen_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('Dokumen.Master.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('dokumen_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('dokumen_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>