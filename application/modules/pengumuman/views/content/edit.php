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

if (isset($pengumuman))
{
	$pengumuman = (array) $pengumuman;
}
$id = isset($pengumuman['id']) ? $pengumuman['id'] : '';

?>
<div class="admin-box">
	<h3>pengumuman</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('tgl_pengumuman') ? 'error' : ''; ?>">
				<?php echo form_label('Tanggal Pengumuman'. lang('bf_form_label_required'), 'pengumuman_tgl_pengumuman', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='pengumuman_tgl_pengumuman' type='text' name='pengumuman_tgl_pengumuman'  value="<?php echo set_value('pengumuman_tgl_pengumuman', isset($pengumuman['tgl_pengumuman']) ? $pengumuman['tgl_pengumuman'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('tgl_pengumuman'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('tgl_awal') ? 'error' : ''; ?>">
				<?php echo form_label('Tanggal Awal', 'pengumuman_tgl_awal', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='pengumuman_tgl_awal' type='text' name='pengumuman_tgl_awal'  value="<?php echo set_value('pengumuman_tgl_awal', isset($pengumuman['tgl_awal']) ? $pengumuman['tgl_awal'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('tgl_awal'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('tgl_akhir') ? 'error' : ''; ?>">
				<?php echo form_label('Tanggal Akhir', 'pengumuman_tgl_akhir', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='pengumuman_tgl_akhir' type='text' name='pengumuman_tgl_akhir'  value="<?php echo set_value('pengumuman_tgl_akhir', isset($pengumuman['tgl_akhir']) ? $pengumuman['tgl_akhir'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('tgl_akhir'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('judul') ? 'error' : ''; ?>">
				<?php echo form_label('Judul'. lang('bf_form_label_required'), 'pengumuman_judul', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'pengumuman_judul', 'id' => 'pengumuman_judul', 'rows' => '5', 'cols' => '80', 'value' => set_value('pengumuman_judul', isset($pengumuman['judul']) ? $pengumuman['judul'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('judul'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('content') ? 'error' : ''; ?>">
				<?php echo form_label('Isi Pengumuman'. lang('bf_form_label_required'), 'pengumuman_content', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'pengumuman_content', 'id' => 'pengumuman_content', 'rows' => '5', 'cols' => '80', 'value' => set_value('pengumuman_content', isset($pengumuman['content']) ? $pengumuman['content'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('content'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('user_id') ? 'error' : ''; ?>">
				<?php echo form_label('User ID', 'pengumuman_user_id', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='pengumuman_user_id' type='text' name='pengumuman_user_id' maxlength="255" value="<?php echo set_value('pengumuman_user_id', isset($pengumuman['user_id']) ? $pengumuman['user_id'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('user_id'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('files') ? 'error' : ''; ?>">
				<?php echo form_label('Files', 'pengumuman_files', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='pengumuman_files' type='text' name='pengumuman_files' maxlength="255" value="<?php echo set_value('pengumuman_files', isset($pengumuman['files']) ? $pengumuman['files'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('files'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('pengumuman_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/content/pengumuman', lang('pengumuman_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('Pengumuman.Content.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('pengumuman_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('pengumuman_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>