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

if (isset($masterprogramstudi))
{
	$masterprogramstudi = (array) $masterprogramstudi;
}
$id = isset($masterprogramstudi['id']) ? $masterprogramstudi['id'] : '';

?>
<br/>
<div class="admin-box">
	 <h3>Master Program Studi</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>


			<div class="control-group <?php echo form_error('masterprogramstudi_kode_fakultas') ? 'error' : ''; ?>">
				<?php echo form_label('Kode Fakultas'. lang('bf_form_label_required'), 'masterprogramstudi_kode_fakultas', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<select name="masterprogramstudi_kode_fakultas" id="masterprogramstudi_kode_fakultas" class="chosen-select-deselect" style="width:300px;">
						<option value=""></option>
						<?php if (isset($masterfakultass) && is_array($masterfakultass) && count($masterfakultass)):?>
						<?php foreach($masterfakultass as $record):?>
							<option value="<?php echo $record->kode_fakultas?>" <?php if(isset($masterprogramstudi['kode_fakultas']))  echo  ($record->kode_fakultas==$masterprogramstudi['kode_fakultas']) ? "selected" : ""; ?>><?php echo $record->nama_fakultas; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
					<span class='help-inline'><?php echo form_error('masterprogramstudi_kode_fakultas'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('kode_prodi') ? 'error' : ''; ?>">
				<?php echo form_label('Kode Program Studi'. lang('bf_form_label_required'), 'masterprogramstudi_kode_prodi', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterprogramstudi_kode_prodi' type='text' name='masterprogramstudi_kode_prodi' maxlength="15" value="<?php echo set_value('masterprogramstudi_kode_prodi', isset($masterprogramstudi['kode_prodi']) ? $masterprogramstudi['kode_prodi'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('kode_prodi'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('kode_jenjang_studi') ? 'error' : ''; ?>">
				<?php echo form_label('Kode Jenjang Studi'. lang('bf_form_label_required'), 'masterprogramstudi_kode_jenjang_studi', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<select name="masterprogramstudi_kode_jenjang_studi" id="masterprogramstudi_kode_jenjang_studi" class="chosen-select-deselect">
						<option value=""></option>
						<?php if (isset($pilihans) && is_array($pilihans) && count($pilihans)):?>
						<?php foreach($pilihans as $record):?>
							<option value="<?php echo $record->value?>" <?php if(isset($masterprogramstudi['kode_jenjang_studi']))  echo  ($record->value==$masterprogramstudi['kode_jenjang_studi']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
					<span class='help-inline'><?php echo form_error('kode_jenjang_studi'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('nama_prodi') ? 'error' : ''; ?>">
				<?php echo form_label('Nama Program Studi'. lang('bf_form_label_required'), 'masterprogramstudi_nama_prodi', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterprogramstudi_nama_prodi' type='text' name='masterprogramstudi_nama_prodi' maxlength="5" value="<?php echo set_value('masterprogramstudi_nama_prodi', isset($masterprogramstudi['nama_prodi']) ? $masterprogramstudi['nama_prodi'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('nama_prodi'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('semester_awal') ? 'error' : ''; ?>">
				<?php echo form_label('Semester Awal', 'masterprogramstudi_semester_awal', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterprogramstudi_semester_awal' type='text' name='masterprogramstudi_semester_awal' maxlength="5" value="<?php echo set_value('masterprogramstudi_semester_awal', isset($masterprogramstudi['semester_awal']) ? $masterprogramstudi['semester_awal'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('semester_awal'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('no_sk_dikti') ? 'error' : ''; ?>">
				<?php echo form_label('No SK DIKTI', 'masterprogramstudi_no_sk_dikti', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterprogramstudi_no_sk_dikti' type='text' name='masterprogramstudi_no_sk_dikti' maxlength="50" value="<?php echo set_value('masterprogramstudi_no_sk_dikti', isset($masterprogramstudi['no_sk_dikti']) ? $masterprogramstudi['no_sk_dikti'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('no_sk_dikti'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('tgl_sk_dikti') ? 'error' : ''; ?>">
				<?php echo form_label('Tanggal SK DIKTI', 'masterprogramstudi_tgl_sk_dikti', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterprogramstudi_tgl_sk_dikti' type='text' name='masterprogramstudi_tgl_sk_dikti'  value="<?php echo set_value('masterprogramstudi_tgl_sk_dikti', isset($masterprogramstudi['tgl_sk_dikti']) ? $masterprogramstudi['tgl_sk_dikti'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('tgl_sk_dikti'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('tgl_akhir_sk_dikti') ? 'error' : ''; ?>">
				<?php echo form_label('Tanggal Akhir SK DIKTI', 'masterprogramstudi_tgl_akhir_sk_dikti', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterprogramstudi_tgl_akhir_sk_dikti' type='text' name='masterprogramstudi_tgl_akhir_sk_dikti'  value="<?php echo set_value('masterprogramstudi_tgl_akhir_sk_dikti', isset($masterprogramstudi['tgl_akhir_sk_dikti']) ? $masterprogramstudi['tgl_akhir_sk_dikti'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('tgl_akhir_sk_dikti'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('jml_sks_lulus') ? 'error' : ''; ?>">
				<?php echo form_label('Jumlah SKS Lulus', 'masterprogramstudi_jml_sks_lulus', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterprogramstudi_jml_sks_lulus' type='text' name='masterprogramstudi_jml_sks_lulus' maxlength="5" value="<?php echo set_value('masterprogramstudi_jml_sks_lulus', isset($masterprogramstudi['jml_sks_lulus']) ? $masterprogramstudi['jml_sks_lulus'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('jml_sks_lulus'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('kode_status') ? 'error' : ''; ?>">
				<?php echo form_label('Kode Status', '', array('class' => 'control-label', 'id' => 'masterprogramstudi_kode_status_label') ); ?>
				<div class='controls' aria-labelled-by='masterprogramstudi_kode_status_label'>
					<label class='radios' for='masterprogramstudi_kode_status_option1'>
						<input id='masterprogramstudi_kode_status_option1' name='masterprogramstudi_kode_status' type='radio' class='' value='A' <?php echo set_radio('masterprogramstudi_kode_status', 'A', TRUE); ?> />
						Aktif
					</label>
					<label class='radios' for='masterprogramstudi_kode_status_option2'>
						<input id='masterprogramstudi_kode_status_option2' name='masterprogramstudi_kode_status' type='radio' class='' value='H' <?php echo set_radio('masterprogramstudi_kode_status', 'H'); ?> />
						Hapus
					</label>
					<span class='help-inline'><?php echo form_error('kode_status'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('tahun_semester_mulai') ? 'error' : ''; ?>">
				<?php echo form_label('Tahun Semester Mulai', 'masterprogramstudi_tahun_semester_mulai', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterprogramstudi_tahun_semester_mulai' type='text' name='masterprogramstudi_tahun_semester_mulai' maxlength="5" value="<?php echo set_value('masterprogramstudi_tahun_semester_mulai', isset($masterprogramstudi['tahun_semester_mulai']) ? $masterprogramstudi['tahun_semester_mulai'] : ''); ?>" />
					<span class="help-inline">diisi bila status <strong>H</strong>-hapus </span>
					<span class='help-inline'><?php echo form_error('tahun_semester_mulai'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('email_prodi') ? 'error' : ''; ?>">
				<?php echo form_label('E-Mail Program Studi', 'masterprogramstudi_email_prodi', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterprogramstudi_email_prodi' type='text' name='masterprogramstudi_email_prodi' maxlength="50" value="<?php echo set_value('masterprogramstudi_email_prodi', isset($masterprogramstudi['email_prodi']) ? $masterprogramstudi['email_prodi'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('email_prodi'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('tgl_pendirian_program_studi') ? 'error' : ''; ?>">
				<?php echo form_label('Tanggal Pendirian Prodi', 'masterprogramstudi_tgl_pendirian_program_studi', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterprogramstudi_tgl_pendirian_program_studi' type='text' name='masterprogramstudi_tgl_pendirian_program_studi'  value="<?php echo set_value('masterprogramstudi_tgl_pendirian_program_studi', isset($masterprogramstudi['tgl_pendirian_program_studi']) ? $masterprogramstudi['tgl_pendirian_program_studi'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('tgl_pendirian_program_studi'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('no_sk_akreditasi') ? 'error' : ''; ?>">
				<?php echo form_label('No SK Akreditasi', 'masterprogramstudi_no_sk_akreditasi', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterprogramstudi_no_sk_akreditasi' type='text' name='masterprogramstudi_no_sk_akreditasi' maxlength="25" value="<?php echo set_value('masterprogramstudi_no_sk_akreditasi', isset($masterprogramstudi['no_sk_akreditasi']) ? $masterprogramstudi['no_sk_akreditasi'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('no_sk_akreditasi'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('tgl_sk_akreditasi') ? 'error' : ''; ?>">
				<?php echo form_label('Tanggal SK Akeditasi', 'masterprogramstudi_tgl_sk_akreditasi', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterprogramstudi_tgl_sk_akreditasi' type='text' name='masterprogramstudi_tgl_sk_akreditasi'  value="<?php echo set_value('masterprogramstudi_tgl_sk_akreditasi', isset($masterprogramstudi['tgl_sk_akreditasi']) ? $masterprogramstudi['tgl_sk_akreditasi'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('tgl_sk_akreditasi'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('tgl_akhir_sk_akreditasi') ? 'error' : ''; ?>">
				<?php echo form_label('Tanggal Akhir SK Akreditasi', 'masterprogramstudi_tgl_akhir_sk_akreditasi', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterprogramstudi_tgl_akhir_sk_akreditasi' type='text' name='masterprogramstudi_tgl_akhir_sk_akreditasi'  value="<?php echo set_value('masterprogramstudi_tgl_akhir_sk_akreditasi', isset($masterprogramstudi['tgl_akhir_sk_akreditasi']) ? $masterprogramstudi['tgl_akhir_sk_akreditasi'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('tgl_akhir_sk_akreditasi'); ?></span>
				</div>
			</div>

		<div class="control-group <?php echo form_error('kode_status_akreditasi') ? 'error' : ''; ?>">
				<?php echo form_label('Kode Status Akreditasi', 'masterprogramstudi_kode_status_akreditasi', array('class' => 'control-label') ); ?>
				<div class='controls' style="padding-bottom:5px;padding-top:5px">
					<select name="masterprogramstudi_kode_status_akreditasi" id="masterprogramstudi_kode_status_akreditasi" class="chosen-select-deselect">
						<option value=""></option>
						<?php if (isset($pilihans07) && is_array($pilihans07) && count($pilihans07)):?>
						<?php foreach($pilihans07 as $record):?>
							<option value="<?php echo $record->value?>" <?php if(isset($masterprogramstudi['kode_status_akreditasi']))  echo  ($record->value==$masterprogramstudi['kode_status_akreditasi']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
					<span class='help-inline'><?php echo form_error('kode_status_akreditasi'); ?></span>
				</div>
			</div>
			
					<div class="control-group <?php echo form_error('frekuensi_kurikulum') ? 'error' : ''; ?>">
				<?php echo form_label('Frekuensi Pemuktahiran Kurikulum', 'masterprogramstudi_frekuensi_kurikulum', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<select name="masterprogramstudi_frekuensi_kurikulum" id="masterprogramstudi_frekuensi_kurikulum" class="chosen-select-deselect" style="width:300px;">
						<option value=""></option>
						<?php if (isset($pilihans29) && is_array($pilihans29) && count($pilihans29)):?>
						<?php foreach($pilihans29 as $record):?>
							<option value="<?php echo $record->value?>" <?php if(isset($masterprogramstudi['frekuensi_kurikulum']))  echo  ($record->value==$masterprogramstudi['frekuensi_kurikulum']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
					<span class='help-inline'><?php echo form_error('frekuensi_kurikulum'); ?></span>
				</div>
			</div>


				<div class="control-group <?php echo form_error('pelaksanaan_kurikulum') ? 'error' : ''; ?>">
				<?php echo form_label('Pelaksanaan Frekuensi Pemuktahiran Kurikulum', 'masterprogramstudi_pelaksanaan_kurikulum', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<select name="masterprogramstudi_pelaksanaan_kurikulum" id="masterprogramstudi_pelaksanaan_kurikulum" class="chosen-select-deselect" style="width:300px;">
						<option value=""></option>
						<?php if (isset($pilihans30) && is_array($pilihans30) && count($pilihans30)):?>
						<?php foreach($pilihans30 as $record):?>
							<option value="<?php echo $record->value?>" <?php if(isset($masterprogramstudi['pelaksanaan_kurikulum']))  echo  ($record->value==$masterprogramstudi['pelaksanaan_kurikulum']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
					<span class='help-inline'><?php echo form_error('pelaksanaan_kurikulum'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('nidn_ketua_prodi') ? 'error' : ''; ?>">
				<?php echo form_label('NIDN Ketua Program Studi', 'masterprogramstudi_nidn_ketua_prodi', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterprogramstudi_nidn_ketua_prodi' type='text' name='masterprogramstudi_nidn_ketua_prodi' maxlength="25" value="<?php echo set_value('masterprogramstudi_nidn_ketua_prodi', isset($masterprogramstudi['nidn_ketua_prodi']) ? $masterprogramstudi['nidn_ketua_prodi'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('nidn_ketua_prodi'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('telp_ketua_prodi') ? 'error' : ''; ?>">
				<?php echo form_label('Telepon Ketua Prodi', 'masterprogramstudi_telp_ketua_prodi', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterprogramstudi_telp_ketua_prodi' type='text' name='masterprogramstudi_telp_ketua_prodi' maxlength="25" value="<?php echo set_value('masterprogramstudi_telp_ketua_prodi', isset($masterprogramstudi['telp_ketua_prodi']) ? $masterprogramstudi['telp_ketua_prodi'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('telp_ketua_prodi'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('fax_prodi') ? 'error' : ''; ?>">
				<?php echo form_label('Fax Program Studi', 'masterprogramstudi_fax_prodi', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterprogramstudi_fax_prodi' type='text' name='masterprogramstudi_fax_prodi' maxlength="25" value="<?php echo set_value('masterprogramstudi_fax_prodi', isset($masterprogramstudi['fax_prodi']) ? $masterprogramstudi['fax_prodi'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('fax_prodi'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('nama_operator') ? 'error' : ''; ?>">
				<?php echo form_label('Nama Operator', 'masterprogramstudi_nama_operator', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterprogramstudi_nama_operator' type='text' name='masterprogramstudi_nama_operator' maxlength="50" value="<?php echo set_value('masterprogramstudi_nama_operator', isset($masterprogramstudi['nama_operator']) ? $masterprogramstudi['nama_operator'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('nama_operator'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('hp_operator') ? 'error' : ''; ?>">
				<?php echo form_label('Handphone Operator', 'masterprogramstudi_hp_operator', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterprogramstudi_hp_operator' type='text' name='masterprogramstudi_hp_operator' maxlength="25" value="<?php echo set_value('masterprogramstudi_hp_operator', isset($masterprogramstudi['hp_operator']) ? $masterprogramstudi['hp_operator'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('hp_operator'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('telepon_program_studi') ? 'error' : ''; ?>">
				<?php echo form_label('Telepon Program Studi', 'masterprogramstudi_telepon_program_studi', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterprogramstudi_telepon_program_studi' type='text' name='masterprogramstudi_telepon_program_studi' maxlength="25" value="<?php echo set_value('masterprogramstudi_telepon_program_studi', isset($masterprogramstudi['telepon_program_studi']) ? $masterprogramstudi['telepon_program_studi'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('telepon_program_studi'); ?></span>
				</div>
			</div>


			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('masterprogramstudi_action_create'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/master/masterprogramstudi', lang('masterprogramstudi_cancel'), 'class="btn btn-warning"'); ?>
				
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>
