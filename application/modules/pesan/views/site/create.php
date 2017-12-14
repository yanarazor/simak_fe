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

if (isset($pesan))
{
	$pesan = (array) $pesan;
}
$id = isset($pesan['id']) ? $pesan['id'] : '';

?>
<div class="admin-box">
	<h3>pesan</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('dari') ? 'error' : ''; ?>">
				<?php echo form_label('Dari', 'pesan_dari', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='pesan_dari' type='text' name='pesan_dari' maxlength="10" value="<?php echo set_value('pesan_dari', isset($pesan['dari']) ? $pesan['dari'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('dari'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('untuk') ? 'error' : ''; ?>">
				<?php echo form_label('Untuk', 'pesan_untuk', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='pesan_untuk' type='text' name='pesan_untuk' maxlength="10" value="<?php echo set_value('pesan_untuk', isset($pesan['untuk']) ? $pesan['untuk'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('untuk'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('pesan') ? 'error' : ''; ?>">
				<?php echo form_label('Pesan', 'pesan_pesan', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'pesan_pesan', 'id' => 'pesan_pesan', 'rows' => '5', 'cols' => '80', 'value' => set_value('pesan_pesan', isset($pesan['pesan']) ? $pesan['pesan'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('pesan'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('id_materi') ? 'error' : ''; ?>">
				<?php echo form_label('Id Materi', 'pesan_id_materi', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='pesan_id_materi' type='text' name='pesan_id_materi' maxlength="10" value="<?php echo set_value('pesan_id_materi', isset($pesan['id_materi']) ? $pesan['id_materi'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('id_materi'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('pesan_action_create'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/site/pesan', lang('pesan_cancel'), 'class="btn btn-warning"'); ?>
				
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>