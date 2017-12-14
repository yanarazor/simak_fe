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

if (isset($masterperguruantinggi))
{
	$masterperguruantinggi = (array) $masterperguruantinggi;
}
$id = isset($masterperguruantinggi['id']) ? $masterperguruantinggi['id'] : '';

?>
<div class="admin-box">
	<h3>MasterPerguruanTinggi</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('kode_badan_hukum') ? 'error' : ''; ?>">
				<?php echo form_label('Kode Badan Hukum'. lang('bf_form_label_required'), 'masterperguruantinggi_kode_badan_hukum', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterperguruantinggi_kode_badan_hukum' type='text' name='masterperguruantinggi_kode_badan_hukum' maxlength="7" value="<?php echo set_value('masterperguruantinggi_kode_badan_hukum', isset($masterperguruantinggi['kode_badan_hukum']) ? $masterperguruantinggi['kode_badan_hukum'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('kode_badan_hukum'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('kode_pt') ? 'error' : ''; ?>">
				<?php echo form_label('Kode Perguruan Tinggi'. lang('bf_form_label_required'), 'masterperguruantinggi_kode_pt', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterperguruantinggi_kode_pt' type='text' name='masterperguruantinggi_kode_pt' maxlength="6" value="<?php echo set_value('masterperguruantinggi_kode_pt', isset($masterperguruantinggi['kode_pt']) ? $masterperguruantinggi['kode_pt'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('kode_pt'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('nama_pt') ? 'error' : ''; ?>">
				<?php echo form_label('Nama Perguruan Tinggi'. lang('bf_form_label_required'), 'masterperguruantinggi_nama_pt', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterperguruantinggi_nama_pt' type='text' name='masterperguruantinggi_nama_pt' maxlength="100" value="<?php echo set_value('masterperguruantinggi_nama_pt', isset($masterperguruantinggi['nama_pt']) ? $masterperguruantinggi['nama_pt'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('nama_pt'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('alamat_pt_1') ? 'error' : ''; ?>">
				<?php echo form_label('Alamat 1'. lang('bf_form_label_required'), 'masterperguruantinggi_alamat_pt_1', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'masterperguruantinggi_alamat_pt_1', 'id' => 'masterperguruantinggi_alamat_pt_1', 'rows' => '5', 'cols' => '80', 'value' => set_value('masterperguruantinggi_alamat_pt_1', isset($masterperguruantinggi['alamat_pt_1']) ? $masterperguruantinggi['alamat_pt_1'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('alamat_pt_1'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('alamat_pt_2') ? 'error' : ''; ?>">
				<?php echo form_label('Alamat 2', 'masterperguruantinggi_alamat_pt_2', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'masterperguruantinggi_alamat_pt_2', 'id' => 'masterperguruantinggi_alamat_pt_2', 'rows' => '5', 'cols' => '80', 'value' => set_value('masterperguruantinggi_alamat_pt_2', isset($masterperguruantinggi['alamat_pt_2']) ? $masterperguruantinggi['alamat_pt_2'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('alamat_pt_2'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('kota_pt') ? 'error' : ''; ?>">
				<?php echo form_label('Kota', 'masterperguruantinggi_kota_pt', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterperguruantinggi_kota_pt' type='text' name='masterperguruantinggi_kota_pt' maxlength="50" value="<?php echo set_value('masterperguruantinggi_kota_pt', isset($masterperguruantinggi['kota_pt']) ? $masterperguruantinggi['kota_pt'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('kota_pt'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('kodepos_pt') ? 'error' : ''; ?>">
				<?php echo form_label('Kode Pos', 'masterperguruantinggi_kodepos_pt', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterperguruantinggi_kodepos_pt' type='text' name='masterperguruantinggi_kodepos_pt' maxlength="5" value="<?php echo set_value('masterperguruantinggi_kodepos_pt', isset($masterperguruantinggi['kodepos_pt']) ? $masterperguruantinggi['kodepos_pt'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('kodepos_pt'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('telepon_pt') ? 'error' : ''; ?>">
				<?php echo form_label('Telepon', 'masterperguruantinggi_telepon_pt', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterperguruantinggi_telepon_pt' type='text' name='masterperguruantinggi_telepon_pt' maxlength="25" value="<?php echo set_value('masterperguruantinggi_telepon_pt', isset($masterperguruantinggi['telepon_pt']) ? $masterperguruantinggi['telepon_pt'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('telepon_pt'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('fax_pt') ? 'error' : ''; ?>">
				<?php echo form_label('Faksimili', 'masterperguruantinggi_fax_pt', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterperguruantinggi_fax_pt' type='text' name='masterperguruantinggi_fax_pt' maxlength="25" value="<?php echo set_value('masterperguruantinggi_fax_pt', isset($masterperguruantinggi['fax_pt']) ? $masterperguruantinggi['fax_pt'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('fax_pt'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('tgl_akta_pt') ? 'error' : ''; ?>">
				<?php echo form_label('Tanggal Akta Perguruan Tinggi', 'masterperguruantinggi_tgl_akta_pt', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterperguruantinggi_tgl_akta_pt' type='text' name='masterperguruantinggi_tgl_akta_pt'  value="<?php echo set_value('masterperguruantinggi_tgl_akta_pt', isset($masterperguruantinggi['tgl_akta_pt']) ? $masterperguruantinggi['tgl_akta_pt'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('tgl_akta_pt'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('no_akta_pt') ? 'error' : ''; ?>">
				<?php echo form_label('No Akta Perguruan Tinggi', 'masterperguruantinggi_no_akta_pt', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterperguruantinggi_no_akta_pt' type='text' name='masterperguruantinggi_no_akta_pt' maxlength="50" value="<?php echo set_value('masterperguruantinggi_no_akta_pt', isset($masterperguruantinggi['no_akta_pt']) ? $masterperguruantinggi['no_akta_pt'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('no_akta_pt'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('email_pt') ? 'error' : ''; ?>">
				<?php echo form_label('E-Mail Perguruan Tinggi'. lang('bf_form_label_required'), 'masterperguruantinggi_email_pt', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterperguruantinggi_email_pt' type='text' name='masterperguruantinggi_email_pt' maxlength="255" value="<?php echo set_value('masterperguruantinggi_email_pt', isset($masterperguruantinggi['email_pt']) ? $masterperguruantinggi['email_pt'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('email_pt'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('website_pt') ? 'error' : ''; ?>">
				<?php echo form_label('Website Perguruan Tinggi', 'masterperguruantinggi_website_pt', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterperguruantinggi_website_pt' type='text' name='masterperguruantinggi_website_pt' maxlength="255" value="<?php echo set_value('masterperguruantinggi_website_pt', isset($masterperguruantinggi['website_pt']) ? $masterperguruantinggi['website_pt'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('website_pt'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('tgl_pendirian_pt') ? 'error' : ''; ?>">
				<?php echo form_label('Tanggal Pendirian Perguruan Tinggi', 'masterperguruantinggi_tgl_pendirian_pt', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterperguruantinggi_tgl_pendirian_pt' type='text' name='masterperguruantinggi_tgl_pendirian_pt'  value="<?php echo set_value('masterperguruantinggi_tgl_pendirian_pt', isset($masterperguruantinggi['tgl_pendirian_pt']) ? $masterperguruantinggi['tgl_pendirian_pt'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('tgl_pendirian_pt'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('masterperguruantinggi_action_create'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/master/masterperguruantinggi', lang('masterperguruantinggi_cancel'), 'class="btn btn-warning"'); ?>
				
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>