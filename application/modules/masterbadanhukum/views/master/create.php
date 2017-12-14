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

if (isset($masterbadanhukum))
{
	$masterbadanhukum = (array) $masterbadanhukum;
}
$id = isset($masterbadanhukum['id']) ? $masterbadanhukum['id'] : '';

?>
<div class="admin-box">
	<h3>MasterBadanHukum</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('kode_badan_hukum') ? 'error' : ''; ?>">
				<?php echo form_label('Kode Badan Hukum'. lang('bf_form_label_required'), 'masterbadanhukum_kode_badan_hukum', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterbadanhukum_kode_badan_hukum' type='text' name='masterbadanhukum_kode_badan_hukum' maxlength="7" value="<?php echo set_value('masterbadanhukum_kode_badan_hukum', isset($masterbadanhukum['kode_badan_hukum']) ? $masterbadanhukum['kode_badan_hukum'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('kode_badan_hukum'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('nama_badan_hukum') ? 'error' : ''; ?>">
				<?php echo form_label('Nama Badan Hukum'. lang('bf_form_label_required'), 'masterbadanhukum_nama_badan_hukum', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterbadanhukum_nama_badan_hukum' type='text' name='masterbadanhukum_nama_badan_hukum' maxlength="75" value="<?php echo set_value('masterbadanhukum_nama_badan_hukum', isset($masterbadanhukum['nama_badan_hukum']) ? $masterbadanhukum['nama_badan_hukum'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('nama_badan_hukum'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('alamat1') ? 'error' : ''; ?>">
				<?php echo form_label('Alamat 1', 'masterbadanhukum_alamat1', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterbadanhukum_alamat1' type='text' name='masterbadanhukum_alamat1' maxlength="255" value="<?php echo set_value('masterbadanhukum_alamat1', isset($masterbadanhukum['alamat1']) ? $masterbadanhukum['alamat1'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('alamat1'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('alamat2') ? 'error' : ''; ?>">
				<?php echo form_label('Alamat 2', 'masterbadanhukum_alamat2', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterbadanhukum_alamat2' type='text' name='masterbadanhukum_alamat2' maxlength="255" value="<?php echo set_value('masterbadanhukum_alamat2', isset($masterbadanhukum['alamat2']) ? $masterbadanhukum['alamat2'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('alamat2'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('kota') ? 'error' : ''; ?>">
				<?php echo form_label('Kota', 'masterbadanhukum_kota', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterbadanhukum_kota' type='text' name='masterbadanhukum_kota' maxlength="25" value="<?php echo set_value('masterbadanhukum_kota', isset($masterbadanhukum['kota']) ? $masterbadanhukum['kota'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('kota'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('kode_pos') ? 'error' : ''; ?>">
				<?php echo form_label('Kode Pos', 'masterbadanhukum_kode_pos', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterbadanhukum_kode_pos' type='text' name='masterbadanhukum_kode_pos' maxlength="5" value="<?php echo set_value('masterbadanhukum_kode_pos', isset($masterbadanhukum['kode_pos']) ? $masterbadanhukum['kode_pos'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('kode_pos'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('telepon') ? 'error' : ''; ?>">
				<?php echo form_label('Telepon', 'masterbadanhukum_telepon', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterbadanhukum_telepon' type='text' name='masterbadanhukum_telepon' maxlength="25" value="<?php echo set_value('masterbadanhukum_telepon', isset($masterbadanhukum['telepon']) ? $masterbadanhukum['telepon'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('telepon'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('fax') ? 'error' : ''; ?>">
				<?php echo form_label('Fax', 'masterbadanhukum_fax', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterbadanhukum_fax' type='text' name='masterbadanhukum_fax' maxlength="25" value="<?php echo set_value('masterbadanhukum_fax', isset($masterbadanhukum['fax']) ? $masterbadanhukum['fax'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('fax'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('tgl_akta') ? 'error' : ''; ?>">
				<?php echo form_label('Tanggal Akta', 'masterbadanhukum_tgl_akta', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterbadanhukum_tgl_akta' type='text' name='masterbadanhukum_tgl_akta'  value="<?php echo set_value('masterbadanhukum_tgl_akta', isset($masterbadanhukum['tgl_akta']) ? $masterbadanhukum['tgl_akta'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('tgl_akta'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('no_akta') ? 'error' : ''; ?>">
				<?php echo form_label('No Akta', 'masterbadanhukum_no_akta', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterbadanhukum_no_akta' type='text' name='masterbadanhukum_no_akta' maxlength="50" value="<?php echo set_value('masterbadanhukum_no_akta', isset($masterbadanhukum['no_akta']) ? $masterbadanhukum['no_akta'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('no_akta'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('tgl_pengesahan') ? 'error' : ''; ?>">
				<?php echo form_label('Tanggal Pengesahan', 'masterbadanhukum_tgl_pengesahan', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterbadanhukum_tgl_pengesahan' type='text' name='masterbadanhukum_tgl_pengesahan'  value="<?php echo set_value('masterbadanhukum_tgl_pengesahan', isset($masterbadanhukum['tgl_pengesahan']) ? $masterbadanhukum['tgl_pengesahan'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('tgl_pengesahan'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('no_pengesahan') ? 'error' : ''; ?>">
				<?php echo form_label('No Pengesahan', 'masterbadanhukum_no_pengesahan', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterbadanhukum_no_pengesahan' type='text' name='masterbadanhukum_no_pengesahan' maxlength="50" value="<?php echo set_value('masterbadanhukum_no_pengesahan', isset($masterbadanhukum['no_pengesahan']) ? $masterbadanhukum['no_pengesahan'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('no_pengesahan'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('email_badan_hukum') ? 'error' : ''; ?>">
				<?php echo form_label('E-Mail', 'masterbadanhukum_email_badan_hukum', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterbadanhukum_email_badan_hukum' type='text' name='masterbadanhukum_email_badan_hukum' maxlength="50" value="<?php echo set_value('masterbadanhukum_email_badan_hukum', isset($masterbadanhukum['email_badan_hukum']) ? $masterbadanhukum['email_badan_hukum'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('email_badan_hukum'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('website_badan_hukum') ? 'error' : ''; ?>">
				<?php echo form_label('Website Badan Hukum', 'masterbadanhukum_website_badan_hukum', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterbadanhukum_website_badan_hukum' type='text' name='masterbadanhukum_website_badan_hukum' maxlength="50" value="<?php echo set_value('masterbadanhukum_website_badan_hukum', isset($masterbadanhukum['website_badan_hukum']) ? $masterbadanhukum['website_badan_hukum'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('website_badan_hukum'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('tgl_pendirian') ? 'error' : ''; ?>">
				<?php echo form_label('Tanggal Pendirian', 'masterbadanhukum_tgl_pendirian', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterbadanhukum_tgl_pendirian' type='text' name='masterbadanhukum_tgl_pendirian'  value="<?php echo set_value('masterbadanhukum_tgl_pendirian', isset($masterbadanhukum['tgl_pendirian']) ? $masterbadanhukum['tgl_pendirian'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('tgl_pendirian'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('masterbadanhukum_action_create'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/master/masterbadanhukum', lang('masterbadanhukum_cancel'), 'class="btn btn-warning"'); ?>
				
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>