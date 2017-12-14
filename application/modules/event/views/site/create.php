<?php

$validation_errors = validation_errors();

if ($validation_errors) :
?>
<br>
<div class="alert alert-block alert-error fade in">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Please fix the following errors:</h4>
	<?php echo $validation_errors; ?>
</div>
<?php
endif;

if (isset($event))
{
	$event = (array) $event;
}
$id = isset($event['id']) ? $event['id'] : '';

?>
<br>
<div class="admin-box">
	<h3> Pengelolaan Kegiatan/Event</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('event_tanggal') ? 'error' : ''; ?>">
				<?php echo form_label('Tanggal'. lang('bf_form_label_required'), 'event_tanggal', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='event_tanggal' type='text' name='event_tanggal'  value="<?php echo set_value('event_tanggal', isset($event['tanggal']) ? $event['tanggal'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('event_tanggal'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('judul') ? 'error' : ''; ?>">
				<?php echo form_label('Judul'. lang('bf_form_label_required'), 'event_judul', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='event_judul' type='text' name='event_judul' maxlength="255" value="<?php echo set_value('event_judul', isset($event['judul']) ? $event['judul'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('judul'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('mulai') ? 'error' : ''; ?>">
				<?php echo form_label('Mulai', 'event_mulai', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='event_mulai' type='text' name='event_mulai' maxlength="20" value="<?php echo set_value('event_mulai', isset($event['mulai']) ? $event['mulai'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('mulai'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('selesai') ? 'error' : ''; ?>">
				<?php echo form_label('Selesai', 'event_selesai', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='event_selesai' type='text' name='event_selesai' maxlength="20" value="<?php echo set_value('event_selesai', isset($event['selesai']) ? $event['selesai'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('selesai'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('tempat') ? 'error' : ''; ?>">
				<?php echo form_label('Tempat', 'event_tempat', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='event_tempat' type='text' name='event_tempat' maxlength="255" value="<?php echo set_value('event_tempat', isset($event['tempat']) ? $event['tempat'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('tempat'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('keterangan') ? 'error' : ''; ?>">
				<?php echo form_label('Keterangan', 'event_keterangan', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'event_keterangan', 'id' => 'event_keterangan', 'rows' => '5', 'cols' => '80', 'value' => set_value('event_keterangan', isset($event['keterangan']) ? $event['keterangan'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('keterangan'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('event_action_create'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/site/event', lang('event_cancel'), 'class="btn btn-warning"'); ?>
				
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>