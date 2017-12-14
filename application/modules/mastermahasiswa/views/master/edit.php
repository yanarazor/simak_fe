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

if (isset($mastermahasiswa))
{
	$mastermahasiswa = (array) $mastermahasiswa;
}
$id = isset($mastermahasiswa['id']) ? $mastermahasiswa['id'] : '';

?>
<br>
<div class="admin-box">
<h3>Master Mahasiswa</h3>
	<?php echo form_open_multipart($this->uri->uri_string(), 'class="form-horizontal"'); ?>
 <table border="0">
	<tr>
		<td width="60%">
			
					<fieldset>
					<div class="control-group <?php echo form_error('mastermahasiswa_kode_fakultas') ? 'error' : ''; ?>">
						<?php echo form_label('Fakultas', 'mastermahasiswa_kode_fakultas', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<select name="mastermahasiswa_kode_fakultas" id="mastermahasiswa_kode_fakultas" class="chosen-select-deselect" style="width:300px;">
								<option value=""></option>
								<?php if (isset($masterfakultass) && is_array($masterfakultass) && count($masterfakultass)):?>
								<?php foreach($masterfakultass as $record):?>
									<option value="<?php echo $record->kode_fakultas?>" <?php if(isset($mastermahasiswa['kode_fakultas']))  echo  ($record->kode_fakultas==$mastermahasiswa['kode_fakultas']) ? "selected" : ""; ?>><?php echo $record->nama_fakultas; ?></option>
									<?php endforeach;?>
								<?php endif;?>
							</select>
							<span class='help-inline'><?php echo form_error('mastermahasiswa_kode_fakultas'); ?></span>
						</div>
					</div>
					<div class="control-group <?php echo form_error('mastermahasiswa_kode_prodi') ? 'error' : ''; ?>">
						<?php echo form_label('Program Studi'. lang('bf_form_label_required'), 'mastermatakuliah_kode_prodi', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<select name="mastermahasiswa_kode_prodi" id="mastermahasiswa_kode_prodi" class="chosen-select-deselect">
								<option value=""></option>
								<?php if (isset($masterprogramstudis) && is_array($masterprogramstudis) && count($masterprogramstudis)):?>
								<?php foreach($masterprogramstudis as $record):?>
									 <option value="<?php echo $record->kode_prodi?>" <?php if(isset($mastermahasiswa['kode_prodi']))  echo  ($record->kode_prodi==$mastermahasiswa['kode_prodi']) ? "selected" : ""; ?>><?php echo $record->nama_prodi; ?></option>
								 <?php endforeach;?>
								<?php endif;?>
							</select>
							<span class='help-inline'><?php echo form_error('mastermahasiswa_kode_prodi'); ?></span>
						</div>
					</div> 
					<div class="control-group <?php echo form_error('mastermahasiswa_kode_jenjang_studi') ? 'error' : ''; ?>">
						<?php echo form_label('Jenjang Studi', 'data_pengujian_kode_status', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<select name="mastermahasiswa_kode_jenjang_studi" id="mastermahasiswa_kode_jenjang_studi" class="chosen-select-deselect">
								<option value=""></option>
								<?php if (isset($pilihans04) && is_array($pilihans04) && count($pilihans04)):?>
								<?php foreach($pilihans04 as $record):?>
									<option value="<?php echo $record->value?>" <?php if(isset($mastermahasiswa['kode_jenjang_studi']))  echo  ($record->value==$mastermahasiswa['kode_jenjang_studi']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
									<?php endforeach;?>
								<?php endif;?>
							</select>
							<span class='help-inline'><?php echo form_error('mastermahasiswa_kode_jenjang_studi'); ?></span>
						</div>
					</div>
			 
					<div class="control-group <?php echo form_error('mastermahasiswa_nim_mhs') ? 'error' : ''; ?>">
						<?php echo form_label('NIM Mahasiswa', 'mastermahasiswa_nim_mhs', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_nim_mhs' type='text' name='mastermahasiswa_nim_mhs' maxlength="25" value="<?php echo set_value('mastermahasiswa_nim_mhs', isset($mastermahasiswa['nim_mhs']) ? $mastermahasiswa['nim_mhs'] : ''); ?>" />
							<span class='help-inline'><?php echo form_error('mastermahasiswa_nim_mhs'); ?></span>
						</div>
					</div>


					<div class="control-group <?php echo form_error('mastermahasiswa_nama_mahasiswa') ? 'error' : ''; ?>">
						<?php echo form_label('Nama Mahasiswa', 'mastermahasiswa_nama_mahasiswa', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_nama_mahasiswa' type='text' name='mastermahasiswa_nama_mahasiswa' maxlength="200" style="width:400px" value="<?php echo set_value('mastermahasiswa_nama_mahasiswa', isset($mastermahasiswa['nama_mahasiswa']) ? $mastermahasiswa['nama_mahasiswa'] : ''); ?>" />
							<span class='help-inline'><?php echo form_error('mastermahasiswa_nama_mahasiswa'); ?></span>
						</div>
					</div>


					<div class="control-group <?php echo form_error('tempat_lahir') ? 'error' : ''; ?>">
						<?php echo form_label('Tempat Lahir', 'mastermahasiswa_tempat_lahir', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_tempat_lahir' type='text' name='mastermahasiswa_tempat_lahir' maxlength="50" value="<?php echo set_value('mastermahasiswa_tempat_lahir', isset($mastermahasiswa['tempat_lahir']) ? $mastermahasiswa['tempat_lahir'] : ''); ?>" />
							<span class='help-inline'><?php echo form_error('tempat_lahir'); ?></span>
						</div>
					</div>


					<div class="control-group <?php echo form_error('tgl_lahir') ? 'error' : ''; ?>">
						<?php echo form_label('Tanggal Lahir', 'mastermahasiswa_tgl_lahir', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_tgl_lahir' type='text' name='mastermahasiswa_tgl_lahir'  value="<?php echo set_value('mastermahasiswa_tgl_lahir', isset($mastermahasiswa['tgl_lahir']) ? $mastermahasiswa['tgl_lahir'] : ''); ?>" />
							<span class='help-inline'><?php echo form_error('tgl_lahir'); ?></span>
						</div>
					</div>
					
				<div class="control-group <?php echo form_error('jenis_kelamin') ? 'error' : ''; ?>">
					<?php echo form_label('Jenis Kelamin', '', array('class' => 'control-label', 'id' => 'mastermahasiswa_jenis_kelamin_label') ); ?>
					<div class='controls' aria-labelled-by='mastermahasiswa_jenis_kelamin_label'>
						 <label class='radios' for='mastermahasiswa_jenis_kelamin_option1'>
							 <input id='mastermahasiswa_jenis_kelamin_option1' name='mastermahasiswa_jenis_kelamin' type='radio' class='' value='L'

							 <?php if(isset($mastermahasiswa['jenis_kelamin'])) echo ($mastermahasiswa['jenis_kelamin'] == 'L' ) ? set_radio('mastermahasiswa_jenis_kelamin', 'L', true ) : ""; ?> />
							 Laki-laki
						 </label>
						 <label class='radios' for='masterdosen_jenis_kelamin_option2'>
							 <input id='masterdosen_jenis_kelamin_option2' name='mastermahasiswa_jenis_kelamin' type='radio' class='' value='P'

							 <?php if(isset($mastermahasiswa['jenis_kelamin'])) echo ($mastermahasiswa['jenis_kelamin'] == 'P' ) ? set_radio('mastermahasiswa_jenis_kelamin', 'P', true ) : ""; ?> />
						 Perempuan
						 </label>
						 <span class='help-inline'><?php echo form_error('jenis_kelamin'); ?></span>
					 </div>
				 </div>
				 	<div class="control-group <?php echo form_error('nama_ibu_kandung') ? 'error' : ''; ?>">
						<?php echo form_label('Nama Ibu Kandung', 'nama_ibu_kandung', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='nama_ibu_kandung' type='text' name='nama_ibu_kandung' maxlength="100" value="<?php echo set_value('nama_ibu_kandung', isset($mastermahasiswa['nama_ibu_kandung']) ? $mastermahasiswa['nama_ibu_kandung'] : ''); ?>" />
							<span class='help-inline'><?php echo form_error('nama_ibu_kandung'); ?></span>
						</div>
					</div>
					<div class="control-group <?php echo form_error('tahun_masuk') ? 'error' : ''; ?>">
						<?php echo form_label('Tahun Masuk', 'mastermahasiswa_tahun_masuk', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_tahun_masuk' type='text' name='mastermahasiswa_tahun_masuk' maxlength="5" value="<?php echo set_value('mastermahasiswa_tahun_masuk', isset($mastermahasiswa['tahun_masuk']) ? $mastermahasiswa['tahun_masuk'] : ''); ?>" />
							<span class='help-inline'><?php echo form_error('tahun_masuk'); ?></span>
						</div>
					</div>


					<div class="control-group <?php echo form_error('semester_awal') ? 'error' : ''; ?>">
						<?php echo form_label('Semester Awal', 'mastermahasiswa_semester_awal', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_semester_awal' type='text' name='mastermahasiswa_semester_awal' maxlength="5" value="<?php echo set_value('mastermahasiswa_semester_awal', isset($mastermahasiswa['semester_awal']) ? $mastermahasiswa['semester_awal'] : ''); ?>" />
							<span class='help-inline'><?php echo form_error('semester_awal'); ?></span>
						</div>
					</div>
					
						<div class="control-group <?php echo form_error('semester') ? 'error' : ''; ?>">
						<?php echo form_label('Semester', 'mastermahasiswa_semester_awal', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_semester' type='text' name='mastermahasiswa_semester' maxlength="5" value="<?php echo set_value('mastermahasiswa_semester', isset($mastermahasiswa['semester']) ? $mastermahasiswa['semester'] : ''); ?>" />
							<span class='help-inline'><?php echo form_error('semester'); ?></span>
						</div>
					</div>


					<div class="control-group <?php echo form_error('batas_studi') ? 'error' : ''; ?>">
						<?php echo form_label('Batas Studi', 'mastermahasiswa_batas_studi', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_batas_studi' type='text' name='mastermahasiswa_batas_studi' maxlength="5" value="<?php echo set_value('mastermahasiswa_batas_studi', isset($mastermahasiswa['batas_studi']) ? $mastermahasiswa['batas_studi'] : ''); ?>" />
							<span class='help-inline'><?php echo form_error('batas_studi'); ?></span>
						</div>
					</div>


					<div class="control-group <?php echo form_error('asal_propinsi') ? 'error' : ''; ?>">
						<?php echo form_label('Kode Asal Propinsi', 'mastermahasiswa_asal_propinsi', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_asal_propinsi' type='text' name='mastermahasiswa_asal_propinsi' maxlength="50" value="<?php echo set_value('mastermahasiswa_asal_propinsi', isset($mastermahasiswa['asal_propinsi']) ? $mastermahasiswa['asal_propinsi'] : ''); ?>" />
							<span class='help-inline'><?php echo form_error('asal_propinsi'); ?></span>
						</div>
					</div>


					<div class="control-group <?php echo form_error('tgl_masuk') ? 'error' : ''; ?>">
						<?php echo form_label('Tanggal Masuk', 'mastermahasiswa_tgl_masuk', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_tgl_masuk' type='text' name='mastermahasiswa_tgl_masuk'  value="<?php echo set_value('mastermahasiswa_tgl_masuk', isset($mastermahasiswa['tgl_masuk']) ? $mastermahasiswa['tgl_masuk'] : ''); ?>" />
							<span class='help-inline'><?php echo form_error('tgl_masuk'); ?></span>
						</div>
					</div>


					<div class="control-group <?php echo form_error('tgl_lulus') ? 'error' : ''; ?>">
						<?php echo form_label('Tanggal Lulus', 'mastermahasiswa_tgl_lulus', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_tgl_lulus' type='text' name='mastermahasiswa_tgl_lulus'  value="<?php echo set_value('mastermahasiswa_tgl_lulus', isset($mastermahasiswa['tgl_lulus']) ? $mastermahasiswa['tgl_lulus'] : ''); ?>" />
							<span class='help-inline'><?php echo form_error('tgl_lulus'); ?></span>
						</div>
					</div>

					<div class="control-group <?php echo form_error('status_aktivitas') ? 'error' : ''; ?>">
						<?php echo form_label('Status Aktivitas', 'mastermahasiswa_status_aktivitas', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<select name="mastermahasiswa_status_aktivitas" id="mastermahasiswa_status_aktivitas" class="chosen-select-deselect">
								<option value=""></option>
								<?php if (isset($pilihans05) && is_array($pilihans05) && count($pilihans05)):?>
								<?php foreach($pilihans05 as $record):?>
									<option value="<?php echo $record->value?>" <?php if(isset($mastermahasiswa['status_aktivitas']))  echo  ($record->value==$mastermahasiswa['status_aktivitas']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
									<?php endforeach;?>
								<?php endif;?>
							</select>
							<span class='help-inline'><?php echo form_error('status_aktivitas'); ?></span>
						</div>
					</div>
			
					<div class="control-group <?php echo form_error('status_awal') ? 'error' : ''; ?>">
						<?php echo form_label('Status Awal', 'mastermahasiswa_status_awal', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<select name="mastermahasiswa_status_awal" id="mastermahasiswa_status_awal" class="chosen-select-deselect">
								<option value=""></option>
								<?php if (isset($pilihans06) && is_array($pilihans06) && count($pilihans06)):?>
								<?php foreach($pilihans06 as $record):?>
									<option value="<?php echo $record->value?>" <?php if(isset($mastermahasiswa['status_awal']))  echo  ($record->value==$mastermahasiswa['status_awal']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
									<?php endforeach;?>
								<?php endif;?>
							</select>
							<span class='help-inline'><?php echo form_error('status_awal'); ?></span>
						</div>
					</div>


					<div class="control-group <?php echo form_error('jml_sks_diakui') ? 'error' : ''; ?>">
						<?php echo form_label('Jumlah SKS Diakui', 'mastermahasiswa_jml_sks_diakui', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_jml_sks_diakui' type='text' name='mastermahasiswa_jml_sks_diakui' maxlength="45" value="<?php echo set_value('mastermahasiswa_jml_sks_diakui', isset($mastermahasiswa['jml_sks_diakui']) ? $mastermahasiswa['jml_sks_diakui'] : ''); ?>" />
							<span class='help-inline'><?php echo form_error('jml_sks_diakui'); ?></span>
						</div>
					</div>


					<div class="control-group <?php echo form_error('nim_asal') ? 'error' : ''; ?>">
						<?php echo form_label('NIM ASAL', 'mastermahasiswa_nim_asal', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_nim_asal' type='text' name='mastermahasiswa_nim_asal' maxlength="55" value="<?php echo set_value('mastermahasiswa_nim_asal', isset($mastermahasiswa['nim_asal']) ? $mastermahasiswa['nim_asal'] : ''); ?>" />
							<span class='help-inline'><?php echo form_error('nim_asal'); ?></span>
						</div>
					</div>


					<div class="control-group <?php echo form_error('asal_pt') ? 'error' : ''; ?>">
						<?php echo form_label('Asal Perguruan Tinggi', 'mastermahasiswa_asal_pt', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_asal_pt' type='text' name='mastermahasiswa_asal_pt' maxlength="30" value="<?php echo set_value('mastermahasiswa_asal_pt', isset($mastermahasiswa['asal_pt']) ? $mastermahasiswa['asal_pt'] : ''); ?>" />
							<span class='help-inline'><?php echo form_error('asal_pt'); ?></span>
						</div>
					</div>


					<div class="control-group <?php echo form_error('asal_jenjang_studi') ? 'error' : ''; ?>">
						<?php echo form_label('Asal Jenjang Studi', 'mastermahasiswa_asal_jenjang_studi', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_asal_jenjang_studi' type='text' name='mastermahasiswa_asal_jenjang_studi' maxlength="5" value="<?php echo set_value('mastermahasiswa_asal_jenjang_studi', isset($mastermahasiswa['asal_jenjang_studi']) ? $mastermahasiswa['asal_jenjang_studi'] : ''); ?>" />
							<span class='help-inline'><?php echo form_error('asal_jenjang_studi'); ?></span>
						</div>
					</div>


					<div class="control-group <?php echo form_error('asal_prodi') ? 'error' : ''; ?>">
						<?php echo form_label('Asal Prodi', 'mastermahasiswa_asal_prodi', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_asal_prodi' type='text' name='mastermahasiswa_asal_prodi' maxlength="6" value="<?php echo set_value('mastermahasiswa_asal_prodi', isset($mastermahasiswa['asal_prodi']) ? $mastermahasiswa['asal_prodi'] : ''); ?>" />
							<span class='help-inline'><?php echo form_error('asal_prodi'); ?></span>
						</div>
					</div>


					<div class="control-group <?php echo form_error('kode_biaya_studi') ? 'error' : ''; ?>">
						<?php echo form_label('Kode Biaya Studi', 'mastermahasiswa_kode_biaya_studi', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_kode_biaya_studi' type='text' name='mastermahasiswa_kode_biaya_studi' maxlength="55" value="<?php echo set_value('mastermahasiswa_kode_biaya_studi', isset($mastermahasiswa['kode_biaya_studi']) ? $mastermahasiswa['kode_biaya_studi'] : ''); ?>" />
							<span class='help-inline'><?php echo form_error('kode_biaya_studi'); ?></span>
						</div>
					</div>


					<div class="control-group <?php echo form_error('kode_pekerjaan') ? 'error' : ''; ?>">
						<?php echo form_label('Kode Pekerjaan', 'mastermahasiswa_kode_pekerjaan', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_kode_pekerjaan' type='text' name='mastermahasiswa_kode_pekerjaan' maxlength="55" value="<?php echo set_value('mastermahasiswa_kode_pekerjaan', isset($mastermahasiswa['kode_pekerjaan']) ? $mastermahasiswa['kode_pekerjaan'] : ''); ?>" />
							<span class='help-inline'><?php echo form_error('kode_pekerjaan'); ?></span>
						</div>
					</div>


					<div class="control-group <?php echo form_error('tempat_kerja') ? 'error' : ''; ?>">
						<?php echo form_label('Tempat Pekerjaan', 'mastermahasiswa_tempat_kerja', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_tempat_kerja' type='text' name='mastermahasiswa_tempat_kerja' maxlength="55" value="<?php echo set_value('mastermahasiswa_tempat_kerja', isset($mastermahasiswa['tempat_kerja']) ? $mastermahasiswa['tempat_kerja'] : ''); ?>" />
							<span class='help-inline'><?php echo form_error('tempat_kerja'); ?></span>
						</div>
					</div>


					<div class="control-group <?php echo form_error('kode_pt_kerja') ? 'error' : ''; ?>">
						<?php echo form_label('Kode PT Kerja', 'mastermahasiswa_kode_pt_kerja', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_kode_pt_kerja' type='text' name='mastermahasiswa_kode_pt_kerja' maxlength="55" value="<?php echo set_value('mastermahasiswa_kode_pt_kerja', isset($mastermahasiswa['kode_pt_kerja']) ? $mastermahasiswa['kode_pt_kerja'] : ''); ?>" />
							<span class='help-inline'><?php echo form_error('kode_pt_kerja'); ?></span>
						</div>
					</div>


					<div class="control-group <?php echo form_error('kode_ps_kerja') ? 'error' : ''; ?>">
						<?php echo form_label('Kode PS Kerja', 'mastermahasiswa_kode_ps_kerja', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_kode_ps_kerja' type='text' name='mastermahasiswa_kode_ps_kerja' maxlength="44" value="<?php echo set_value('mastermahasiswa_kode_ps_kerja', isset($mastermahasiswa['kode_ps_kerja']) ? $mastermahasiswa['kode_ps_kerja'] : ''); ?>" />
							<span class='help-inline'><?php echo form_error('kode_ps_kerja'); ?></span>
						</div>
					</div>


					<div class="control-group <?php echo form_error('mastermahasiswa_nip_promotor') ? 'error' : ''; ?>">
						<?php echo form_label('Nip/Kode Dosen P.A', 'mastermahasiswa_nip_promotor', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<select name="mastermahasiswa_nip_promotor" id="mastermahasiswa_nip_promotor" class="chosen-select-deselect" style="width:400px">
								<option value=""></option>
								<?php if (isset($dosens) && is_array($dosens) && count($dosens)):?>
								<?php foreach($dosens as $record):?>
									 <option value="<?php echo $record->id?>" <?php if(isset($mastermahasiswa['nip_promotor']))  echo  ($record->id==$mastermahasiswa['nip_promotor']) ? "selected" : ""; ?>><?php echo $record->nama_dosen; ?></option>
								 <?php endforeach;?>
								<?php endif;?>
							</select>
							<span class='help-inline'><?php echo form_error('mastermahasiswa_nip_promotor'); ?></span>
						</div>
					</div>


					<div class="control-group <?php echo form_error('nip_co_promotor1') ? 'error' : ''; ?>">
						<?php echo form_label('NIP Co - Promotor 1', 'mastermahasiswa_nip_co_promotor1', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_nip_co_promotor1' type='text' name='mastermahasiswa_nip_co_promotor1' maxlength="11" value="<?php echo set_value('mastermahasiswa_nip_co_promotor1', isset($mastermahasiswa['nip_co_promotor1']) ? $mastermahasiswa['nip_co_promotor1'] : ''); ?>" />
							<span class='help-inline'><?php echo form_error('nip_co_promotor1'); ?></span>
						</div>
					</div>


					<div class="control-group <?php echo form_error('nip_co_promotor2') ? 'error' : ''; ?>">
						<?php echo form_label('NIP Co - Promotor 2', 'mastermahasiswa_nip_co_promotor2', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_nip_co_promotor2' type='text' name='mastermahasiswa_nip_co_promotor2' maxlength="12" value="<?php echo set_value('mastermahasiswa_nip_co_promotor2', isset($mastermahasiswa['nip_co_promotor2']) ? $mastermahasiswa['nip_co_promotor2'] : ''); ?>" />
							<span class='help-inline'><?php echo form_error('nip_co_promotor2'); ?></span>
						</div>
					</div>


					<div class="control-group <?php echo form_error('nip_co_promotor3') ? 'error' : ''; ?>">
						<?php echo form_label('NIP Co - Promotor 3', 'mastermahasiswa_nip_co_promotor3', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_nip_co_promotor3' type='text' name='mastermahasiswa_nip_co_promotor3' maxlength="33" value="<?php echo set_value('mastermahasiswa_nip_co_promotor3', isset($mastermahasiswa['nip_co_promotor3']) ? $mastermahasiswa['nip_co_promotor3'] : ''); ?>" />
							<span class='help-inline'><?php echo form_error('nip_co_promotor3'); ?></span>
						</div>
					</div>


					<div class="control-group <?php echo form_error('nip_co_promotor4') ? 'error' : ''; ?>">
						<?php echo form_label('NIP Co - Promotor 4', 'mastermahasiswa_nip_co_promotor4', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_nip_co_promotor4' type='text' name='mastermahasiswa_nip_co_promotor4' maxlength="44" value="<?php echo set_value('mastermahasiswa_nip_co_promotor4', isset($mastermahasiswa['nip_co_promotor4']) ? $mastermahasiswa['nip_co_promotor4'] : ''); ?>" />
							<span class='help-inline'><?php echo form_error('nip_co_promotor4'); ?></span>
						</div>
					</div>
					<div class="control-group <?php echo form_error('status_bayar') ? 'error' : ''; ?>">
					<?php echo form_label('ByPass Pembayaran', '', array('class' => 'control-label', 'id' => 'mastermahasiswa_jenis_kelamin_label') ); ?>
					<div class='controls' aria-labelled-by='mastermahasiswa_jenis_kelamin_label'>
						 <label class='radios' for='status_bayar_option1'>
							 <input id='status_bayar_option1' name='status_bayar' type='radio' class='' value='1'

							 <?php if(isset($mastermahasiswa['status_bayar'])) echo ($mastermahasiswa['status_bayar'] == '1' ) ? "checked" : ""; ?> />
							ya
						 </label>
						 <label class='radios' for='status_bayar_option2'>
							 <input id='status_bayar_option2' name='status_bayar' type='radio' class='' value='0'
							 <?php if(isset($mastermahasiswa['status_bayar'])) echo ($mastermahasiswa['status_bayar'] == '0' ) ? "checked" : ""; ?> />
						 	Tidak
						 </label>
						 <span class='help-inline'><?php echo form_error('jenis_kelamin'); ?></span>
					 </div>
				 	</div>
					 <div class="control-group <?php echo form_error('keterangan') ? 'error' : ''; ?>">
						 <?php echo form_label('Keterangan', 'keterangan', array('class' => 'control-label') ); ?>
						 <div class='controls'>
							 <?php echo form_textarea( array( 'name' => 'keterangan', 'id' => 'keterangan','style'=>'width:600px', 'rows' => '5', 'cols' => '80', 'value' => set_value('keterangan', isset($mastermahasiswa['keterangan']) ? $mastermahasiswa['keterangan'] : '') ) ); ?>
							 <span class='help-inline'><?php echo form_error('keterangan'); ?></span>
						 </div>
					 </div>
				<div class="control-group <?php echo form_error('jenis_kelamin') ? 'error' : ''; ?>">
					<?php echo form_label('Status', '', array('class' => 'control-label', 'id' => 'mastermahasiswa_jenis_kelamin_label') ); ?>
					<div class='controls' aria-labelled-by='status_mahasiswa_label'>
						 <label class='radios' for='status_mahasiswa1'>
							 <input id='status_mahasiswa1' name='status_mahasiswa' type='radio' class='' value='1'

							 <?php if(isset($mastermahasiswa['status_mahasiswa'])) echo ($mastermahasiswa['status_mahasiswa'] == '1' ) ? "checked" : ""; ?> />
							Reguler
						 </label>
						 <label class='radios' for='status_mahasiswa2'>
							 <input id='status_mahasiswa2' name='status_mahasiswa' type='radio' class='' value='2'

							 <?php if(isset($mastermahasiswa['status_mahasiswa'])) echo ($mastermahasiswa['status_mahasiswa'] == '2' ) ? "checked" : ""; ?> />
						 		Kelas Sore
						 </label>
						 <span class='help-inline'><?php echo form_error('status_mahasiswa'); ?></span>
					 </div>
				 </div>
					<div class="control-group <?php echo form_error('useradd') ? 'error' : ''; ?>">
						 <?php echo form_label('Tambah User?', '', array('class' => 'control-label', 'id' => 'mastermahasiswa_jenis_kelamin_label') ); ?>
						 <div class='controls' arial-labelled-by='mastermahasiswa_jenis_kelamin_label'>
							 <label class='radios' for='useradd1'>
								 <input id='useradd1' name='useradd' type='radio' class='' value='1'/>
								 Ya
							 </label>
							 <label class='radios' for='useradd2'>
								 <input id='useradd2' name='useradd' type='radio' class='' value='0' />
								 Tidak
							 </label>
							 <span class='help-inline'><?php echo form_error('useradd'); ?></span>
							 <div class="alert alert-block alert-warning fade in">
								 <a class="close" data-dismiss="alert">&times;</a>
								 Jika otomatis tambah user, Username adalah NIM dan password default adalah 123456789
							 </div>
						 </div>
					 </div>
					 
				<div class="control-group <?php echo form_error('useradd') ? 'error' : ''; ?>">
						 <?php echo form_label('Buka KRS', '', array('class' => 'control-label', 'id' => 'buka_krs_label') ); ?>
						 <div class='controls' arial-labelled-by='buka_krs_label'>
							  <label class='radios' for='buka_krs2'>
								 <input id='buka_krs2' name='buka_krs' type='radio' class='' value='2' 
								 <?php if(isset($mastermahasiswa['buka_krs'])) echo ($mastermahasiswa['buka_krs'] == "2" ) ? "checked" : ""; ?> />
								 Buka
							 </label>
							 <label class='radios' for='buka_krs1'>
								 <input id='buka_krs1' name='buka_krs' type='radio' class='' value='1'
								 <?php if(isset($mastermahasiswa['buka_krs'])) echo ($mastermahasiswa['buka_krs'] == "1" ) ? "checked" : ""; ?> />
								 Tutup
							 </label>
							
							 <span class='help-inline'><?php echo form_error('buka_krs'); ?></span>
							 <div class="alert alert-block alert-warning fade in">
								 <a class="close" data-dismiss="alert">&times;</a>
								 Pilih buka untuk membuka inputan KRS meskipun sudah melakukan konfirmasi KRS
							 </div>
						 </div>
					 </div>
					 
				  </fieldset>
                
            </td>
            <td valign="top" align="center"> 
            <?php if(isset($mastermahasiswa) && isset($mastermahasiswa['photo_mahasiswa']) && $mastermahasiswa['photo_mahasiswa']!='no image' && !empty($mastermahasiswa['photo_mahasiswa'])) :
						$foto = $mastermahasiswa['photo_mahasiswa'];
					else:
						$foto = "noimage.jpg";
					endif;
				?>
            	 <fieldset>
            	 	<div class="control-group">
						   <div id="logo">
							   <div class="get-photo" style="z-index: 690;"> 
								   <a href="<?php echo $this->settings_lib->item('site.urlphotomahasiswa').$foto; ?>">
									   <img width="160" height="160" alt="" src="<?php echo $this->settings_lib->item('site.urlphotomahasiswa').$foto; ?>">
								   </a>
								    
							  
									   <input type="file" class="span6" name="file_upload" id="file_upload" /> 
									   <span class="help-block">Photo size: 600 x 600 pixels</span>
								   
							   </div>
						
						   </div>
                        </div>
                     </fieldset>
                      
            </td>
        </tr>
    </table>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('mastermahasiswa_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/master/mastermahasiswa', lang('mastermahasiswa_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('MasterMahasiswa.Master.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('mastermahasiswa_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('mastermahasiswa_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>
<script type="text/javascript">
$(document).ready(function() {	  
	$('#keterangan').wysiwyg();	
	 
	});
  </script>
<link href="<?php echo base_url(); ?>assets/css/chosen/chosen.css" rel="stylesheet" type="text/css" />
<script language='JavaScript' type='text/javascript' src='<?php echo base_url(); ?>assets/js/chosen/chosen.jquery.js'></script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>