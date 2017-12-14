<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminlte/css/dropzone/dropzone.min.css">
<script src="<?php echo base_url(); ?>themes/admin/js/dropzone/dropzone.min.js"></script>
<!-- sweet alert -->
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminlte/plugins/datepicker/datepicker3.css">
<script src="<?php echo base_url(); ?>themes/adminlte/js/sweetalert.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminlte/css/sweetalert.css">
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

if (isset($mastermatakuliah))
{
	$mastermatakuliah = (array) $mastermatakuliah;
}
$id = isset($mastermatakuliah['id']) ? $mastermatakuliah['id'] : '';

?>
<br>
<div class="admin-box">
	 <h3>Master mata Kuliah</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>
			<div class="control-group <?php echo form_error('mastermatakuliah_kode_pt') ? 'error' : ''; ?>">
				<?php echo form_label('Kode PT'. lang('bf_form_label_required'), 'mastermatakuliah_kode_pt', array('class' => 'control-label') ); ?>
				<div class='controls'>
			
			<input id='mastermatakuliah_kode_pt' readonly type='text' name='mastermatakuliah_kode_pt' maxlength="7" value="<?php echo set_value('mastermatakuliah_kode_pt', isset($mastermatakuliah['kode_pt']) ? $mastermatakuliah['kode_pt'] : ''); ?>" />			
			<span class='help-inline'><?php echo form_error('mastermatakuliah_kode_pt'); ?></span>
				</div>
			</div>
		
			<div class="control-group <?php echo form_error('status') ? 'error' : ''; ?>">
				<?php echo form_label('Status Matakuliah', 'status', array('class' => 'control-label') ); ?>
					<div class='controls'>
					 
						<input id='sms1' name='sms' type='radio' class='' <?php if(isset($mastermatakuliah['sms'])){ if($mastermatakuliah['sms']=="1") echo  "checked"; } ?> value='1' />
						Ganjil
					 
						<input id='sms2' name='sms' type='radio' class='' <?php if(isset($mastermatakuliah['sms'])){ if($mastermatakuliah['sms']=="2") echo  "checked"; }?> value='2'  />
						Genap
					<span class='help-inline'><?php echo form_error('status'); ?></span>
				</div>
				 
			</div>
			<!--
				<div class="control-group <?php echo form_error('mastermatakuliah_tahun_akademik') ? 'error' : ''; ?>">
				<?php echo form_label('Tahun Akademik'. lang('bf_form_label_required'), 'mastermatakuliah_tahun_akademik', array('class' => 'control-label') ); ?>
				<div class='controls'>		
				
				<select name="mastermatakuliah_tahun_akademik" id="mastermatakuliah_tahun_akademik" class="chosen-select-deselect" placeholder="mastermatakuliah_tahun_akademik">
				<option value="<?php echo $mastermatakuliah['tahun_akademik']?>"><?php echo $mastermatakuliah['tahun_akademik']?></option>
				
				<option value="20141">2014 Ganjil</option>
				<option value="20142">2014 Genap</option>
				<option value="20151">2015 Ganjil</option>
				<option value="20152">2015 Genap</option>
				<option value="20161">2016 Ganjil</option>
				<option value="20162">2016 Genap</option>
				<option value="20171">2017 Ganjil</option>
				<option value="20172">2017 Genap</option>
				<option value="20181">2018 Ganjil</option>
				<option value="20182">2018 Genap</option>
				<option value="20191">2019 Ganjil</option>
				<option value="20192">2019 Genap</option>
				<option value="20201">2020 Ganjil</option>
				<option value="20202">2020 Genap</option>
				</select>
		
					<span class='help-inline'><?php echo form_error('mastermatakuliah_tahun_akademik'); ?></span>
				</div>
			</div>
			
			-->

 			<div class="control-group <?php echo form_error('mastermatakuliah_kode_fakultas') ? 'error' : ''; ?>">
				<?php echo form_label('Kode Fakultas', 'data_pengujian_kode_status', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<select name="mastermatakuliah_kode_fakultas" id="mastermatakuliah_kode_fakultas" class="chosen-select-deselect" style="width:300px;">
						<option value=""></option>
						<?php if (isset($masterfakultass) && is_array($masterfakultass) && count($masterfakultass)):?>
						<?php foreach($masterfakultass as $record):?>
							<option value="<?php echo $record->kode_fakultas?>" <?php if(isset($mastermatakuliah['kode_fakultas']))  echo  ($record->kode_fakultas==$mastermatakuliah['kode_fakultas']) ? "selected" : ""; ?>><?php echo $record->nama_fakultas; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
					<span class='help-inline'><?php echo form_error('mastermatakuliah_kode_fakultas'); ?></span>
				</div>
			</div>
			 
			<div class="control-group <?php echo form_error('mastermatakuliah_kode_prodi') ? 'error' : ''; ?>">
				<?php echo form_label('Kode Program Studi'. lang('bf_form_label_required'), 'mastermatakuliah_kode_prodi', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<select name="mastermatakuliah_kode_prodi" id="mastermatakuliah_kode_prodi" class="chosen-select-deselect" style="width:300px;">
						<option value=""></option>
						<?php if (isset($masterprogramstudis) && is_array($masterprogramstudis) && count($masterprogramstudis)):?>
						<?php foreach($masterprogramstudis as $record):?>
							<option value="<?php echo $record->kode_prodi?>" <?php if(isset($mastermatakuliah['kode_prodi']))  echo  ($record->kode_prodi==$mastermatakuliah['kode_prodi']) ? "selected" : ""; ?>><?php echo $record->nama_prodi; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
					<span class='help-inline'><?php echo form_error('mastermatakuliah_kode_prodi'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('mastermatakuliah_kode_jenjang_studi') ? 'error' : ''; ?>">
				<?php echo form_label('Jenjang Studi', 'data_pengujian_kode_status', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<select name="mastermatakuliah_kode_jenjang_studi" id="mastermatakuliah_kode_jenjang_studi" class="chosen-select-deselect">
						<option value=""></option>
						<?php if (isset($pilihans) && is_array($pilihans) && count($pilihans)):?>
						<?php foreach($pilihans as $record):?>
							<option value="<?php echo $record->value?>" <?php if(isset($mastermatakuliah['kode_jenjang_studi']))  echo  ($record->value==$mastermatakuliah['kode_jenjang_studi']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
					<span class='help-inline'><?php echo form_error('mastermatakuliah_kode_jenjang_studi'); ?></span>
				</div>
			</div>
			 

			<div class="control-group <?php echo form_error('mastermatakuliah_kode_mata_kuliah') ? 'error' : ''; ?>">
				<?php echo form_label('Kode Mata Kuliah'. lang('bf_form_label_required'), 'mastermatakuliah_kode_mata_kuliah', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='mastermatakuliah_kode_mata_kuliah' type='text' name='mastermatakuliah_kode_mata_kuliah' maxlength="15" value="<?php echo set_value('mastermatakuliah_kode_mata_kuliah', isset($mastermatakuliah['kode_mata_kuliah']) ? $mastermatakuliah['kode_mata_kuliah'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('mastermatakuliah_kode_mata_kuliah'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('mastermatakuliah_nama_mata_kuliah') ? 'error' : ''; ?>">
				<?php echo form_label('Nama Mata Kuliah'. lang('bf_form_label_required'), 'mastermatakuliah_nama_mata_kuliah', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='mastermatakuliah_nama_mata_kuliah' type='text' name='mastermatakuliah_nama_mata_kuliah' maxlength="50" value="<?php echo set_value('mastermatakuliah_nama_mata_kuliah', isset($mastermatakuliah['nama_mata_kuliah']) ? $mastermatakuliah['nama_mata_kuliah'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('mastermatakuliah_nama_mata_kuliah'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('mastermatakuliah_sks') ? 'error' : ''; ?>">
				<?php echo form_label('SKS'. lang('bf_form_label_required'), 'mastermatakuliah_sks', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='mastermatakuliah_sks' type='text' name='mastermatakuliah_sks' maxlength="5" value="<?php echo set_value('mastermatakuliah_sks', isset($mastermatakuliah['sks']) ? $mastermatakuliah['sks'] : ''); ?>" />
					<span class='help-inline'>ex: 2.00 , 3.00 , 4.00 etc.</span>&nbsp;&nbsp;
					<span class='help-inline'><?php echo form_error('mastermatakuliah_sks'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('sks_tatap_muka') ? 'error' : ''; ?>">
				<?php echo form_label('SKS Tatap Muka', 'mastermatakuliah_sks_tatap_muka', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='mastermatakuliah_sks_tatap_muka' type='text' name='mastermatakuliah_sks_tatap_muka' maxlength="5" value="<?php echo set_value('mastermatakuliah_sks_tatap_muka', isset($mastermatakuliah['sks_tatap_muka']) ? $mastermatakuliah['sks_tatap_muka'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('sks_tatap_muka'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('mastermatakuliah_sks_praktikum') ? 'error' : ''; ?>">
				<?php echo form_label('SKS Praktikum', 'mastermatakuliah_sks_praktikum', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='mastermatakuliah_sks_praktikum' type='text' name='mastermatakuliah_sks_praktikum' maxlength="5" value="<?php echo set_value('mastermatakuliah_sks_praktikum', isset($mastermatakuliah['sks_praktikum']) ? $mastermatakuliah['sks_praktikum'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('mastermatakuliah_sks_praktikum'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('mastermatakuliah_sks_praktek_lap') ? 'error' : ''; ?>">
				<?php echo form_label('SKS Praktek Lapangan', 'mastermatakuliah_sks_praktek_lap', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='mastermatakuliah_sks_praktek_lap' type='text' name='mastermatakuliah_sks_praktek_lap' maxlength="5" value="<?php echo set_value('mastermatakuliah_sks_praktek_lap', isset($mastermatakuliah['sks_praktek_lap']) ? $mastermatakuliah['sks_praktek_lap'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('mastermatakuliah_sks_praktek_lap'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('semester') ? 'error' : ''; ?>">
				<?php echo form_label('Semester', 'mastermatakuliah_semester', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='mastermatakuliah_semester' type='text' name='mastermatakuliah_semester' maxlength="5" value="<?php echo set_value('mastermatakuliah_semester', isset($mastermatakuliah['semester']) ? $mastermatakuliah['semester'] : ''); ?>" />
						<span class='help-inline'>ex: 1, 2, 3 etc.</span>&nbsp;&nbsp;
					<span class='help-inline'><?php echo form_error('semester'); ?></span>
				</div>
			</div>


				<div class="control-group <?php echo form_error('kode_kelompok') ? 'error' : ''; ?>">
				<?php echo form_label('Kode Kelompok', 'mastermatakuliah_kode_kelompok', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<select name="mastermatakuliah_kode_kelompok" id="mastermatakuliah_kode_kelompok" class="chosen-select-deselect" style="width:300px;">
						<option value=""></option>
						<?php if (isset($pilihans10) && is_array($pilihans10) && count($pilihans10)):?>
						<?php foreach($pilihans10 as $record):?>
							<option value="<?php echo $record->value?>" <?php if(isset($mastermatakuliah['kode_kelompok']))  echo  ($record->value==$mastermatakuliah['kode_kelompok']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
					<span class='help-inline'><?php echo form_error('kode_kelompok'); ?></span>
				</div>
			</div>
			
						<div class="control-group <?php echo form_error('kode_kurikulum') ? 'error' : ''; ?>">
				<?php echo form_label('Kode Kurikulum', 'mastermatakuliah_kode_kurikulum', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<select name="mastermatakuliah_kode_kurikulum" id="mastermatakuliah_kode_kurikulum" class="chosen-select-deselect">
						<option value=""></option>
						<?php if (isset($pilihans11) && is_array($pilihans11) && count($pilihans11)):?>
						<?php foreach($pilihans11 as $record):?>
							<option value="<?php echo $record->value?>" <?php if(isset($mastermatakuliah['kode_kurikulum']))  echo  ($record->value==$mastermatakuliah['kode_kurikulum']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
					<span class='help-inline'><?php echo form_error('kode_kurikulum'); ?></span>
				</div>
			</div>

						<div class="control-group <?php echo form_error('kode_matkul') ? 'error' : ''; ?>">
				<?php echo form_label('Kode Matkul', 'mastermatakuliah_kode_matkul', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<select name="mastermatakuliah_kode_matkul" id="mastermatakuliah_kode_matkul" class="chosen-select-deselect">
						<option value=""></option>
						<?php if (isset($pilihans28) && is_array($pilihans28) && count($pilihans28)):?>
						<?php foreach($pilihans28 as $record):?>
							<option value="<?php echo $record->value?>" <?php if(isset($mastermatakuliah['kode_matkul']))  echo  ($record->value==$mastermatakuliah['kode_matkul']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
					<span class='help-inline'><?php echo form_error('kode_matkul'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('nidn') ? 'error' : ''; ?>">
				<?php echo form_label('NO Dosen', 'mastermatakuliah_nidn', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='mastermatakuliah_nidn' type='text' name='mastermatakuliah_nidn' maxlength="25" value="<?php echo set_value('mastermatakuliah_nidn', isset($mastermatakuliah['nidn']) ? $mastermatakuliah['nidn'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('nidn'); ?></span>
				</div>
			</div>

		<div class="control-group <?php echo form_error('jenjang_prodi') ? 'error' : ''; ?>">
				<?php echo form_label('Jenjang Program Studi', 'mastermatakuliah_jenjang_prodi', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<select name="mastermatakuliah_jenjang_prodi" id="mastermatakuliah_jenjang_prodi" class="chosen-select-deselect">
						<option value=""></option>
						<?php if (isset($pilihans04) && is_array($pilihans04) && count($pilihans04)):?>
						<?php foreach($pilihans04 as $record):?>
							<option value="<?php echo $record->value?>" <?php if(isset($mastermatakuliah['jenjang_prodi']))  echo  ($record->value==$mastermatakuliah['jenjang_prodi']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
					<span class='help-inline'><?php echo form_error('jenjang_prodi'); ?></span>
				</div>
			</div>



			<div class="control-group <?php echo form_error('prodi_pengampu') ? 'error' : ''; ?>">
				<?php echo form_label('Program Studi Pengampu', 'mastermatakuliah_prodi_pengampu', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='mastermatakuliah_prodi_pengampu' type='text' name='mastermatakuliah_prodi_pengampu' maxlength="50" value="<?php echo set_value('mastermatakuliah_prodi_pengampu', isset($mastermatakuliah['prodi_pengampu']) ? $mastermatakuliah['prodi_pengampu'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('prodi_pengampu'); ?></span>
				</div>
			</div>

				<div class="control-group <?php echo form_error('status_mata_kuliah') ? 'error' : ''; ?>">
				<?php echo form_label('Status Mata Kuliah', 'mastermatakuliah_status_mata_kuliah', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<select name="mastermatakuliah_status_mata_kuliah" id="mastermatakuliah_status_mata_kuliah" class="chosen-select-deselect">
						<option value=""></option>
						<?php if (isset($pilihans14) && is_array($pilihans14) && count($pilihans14)):?>
						<?php foreach($pilihans14 as $record):?>
							<option value="<?php echo $record->value?>" <?php if(isset($mastermatakuliah['status_mata_kuliah']))  echo  ($record->value==$mastermatakuliah['status_mata_kuliah']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
					<span class='help-inline'><?php echo form_error('status_mata_kuliah'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('silabus') ? 'error' : ''; ?>">
				<?php echo form_label('Silabus', 'mastermatakuliah_silabus', array('class' => 'control-label') ); ?>
				<div class='controls'>
					 
						<input id='status_display1' name='mastermatakuliah_silabus' type='radio' class='' <?php if($mastermatakuliah['silabus']=="Y") echo  "checked"; ?>  value='Y' />
						Ya
					 
						<input id='status_display2' name='mastermatakuliah_silabus' type='radio' class='' <?php if($mastermatakuliah['silabus']=="T") echo  "checked"; ?> value='T'  />
						Tidak
					  
					 
					<span class='help-inline'><?php echo form_error('diktat'); ?></span>
				</div>
				 
			</div>
			

			<div class="control-group <?php echo form_error('sap') ? 'error' : ''; ?>">
				<?php echo form_label('SAP', 'mastermatakuliah_sap', array('class' => 'control-label') ); ?>
				<div class='controls'>
					 
						<input id='status_display1' name='mastermatakuliah_sap' type='radio' class='' <?php if($mastermatakuliah['sap']=="Y") echo  "checked"; ?> value='Y' />
						Ya
					 
						<input id='status_display2' name='mastermatakuliah_sap' type='radio' class='' <?php if($mastermatakuliah['sap']=="T") echo  "checked"; ?> value='T'  />
						Tidak
					  
					 
					<span class='help-inline'><?php echo form_error('diktat'); ?></span>
				</div>
				 
			</div>


			<div class="control-group <?php echo form_error('bahan_ajar') ? 'error' : ''; ?>">
				<?php echo form_label('Bahan Ajar', 'mastermatakuliah_bahan_ajar', array('class' => 'control-label') ); ?>
					<div class='controls'>
					 
						<input id='status_display1' name='mastermatakuliah_bahan_ajar' type='radio' class='' <?php if($mastermatakuliah['bahan_ajar']=="Y") echo  "checked"; ?> value='Y' />
						Ya
					 
						<input id='status_display2' name='mastermatakuliah_bahan_ajar' type='radio' class='' <?php if($mastermatakuliah['bahan_ajar']=="T") echo  "checked"; ?> value='T'  />
						Tidak
					  
					 
					<span class='help-inline'><?php echo form_error('diktat'); ?></span>
				</div>
				 
			</div>


			<div class="control-group <?php echo form_error('diktat') ? 'error' : ''; ?>">
				<?php echo form_label('Diktat', 'mastermatakuliah_diktat', array('class' => 'control-label') ); ?>
					<div class='controls'>
					 
						<input id='status_display1' name='mastermatakuliah_diktat' type='radio' class='' <?php if($mastermatakuliah['diktat']=="Y") echo  "checked"; ?> value='Y' />
						Ya
					 
						<input id='status_display2' name='mastermatakuliah_diktat' type='radio' class='' <?php if($mastermatakuliah['diktat']=="T") echo  "checked"; ?> value='T'  />
						Tidak
					  
					 
					<span class='help-inline'><?php echo form_error('diktat'); ?></span>
				</div>
				 
			</div>
			<div class="control-group <?php echo form_error('status') ? 'error' : ''; ?>">
				<?php echo form_label('Status', 'status', array('class' => 'control-label') ); ?>
					<div class='controls'>
					 
						<input id='status_wajib1' name='status_wajib' type='radio' class='' <?php if($mastermatakuliah['status_wajib']=="w") echo  "checked"; ?> value='w' />
						Wajib
					 
						<input id='status_wajib2' name='status_wajib' type='radio' class='' <?php if($mastermatakuliah['status_wajib']=="p") echo  "checked"; ?> value='p'  />
						Pilihan
					<span class='help-inline'><?php echo form_error('status'); ?></span>
				</div>
			 
			</div>
			<div class="control-group <?php echo form_error('konsentrasi') ? 'error' : ''; ?>">
				<?php echo form_label('MK Konsentrasi', 'konsentrasi', array('class' => 'control-label') ); ?>
				<div class='controls'>
					 
						<input id='konsentrasi1' name='konsentrasi' type='radio' class='' <?php if($mastermatakuliah['konsentrasi']=="Y") echo  "checked"; ?>  value='Y' />
						Ya
					 
						<input id='konsentrasi2' name='konsentrasi' type='radio' class='' <?php if($mastermatakuliah['konsentrasi']=="T") echo  "checked"; ?> value='T'  />
						Bukan
					  
					 
					<span class='help-inline'><?php echo form_error('diktat'); ?></span>
				</div>
				 
			</div>
			<div class="control-group <?php echo form_error('nama_konsentrasi') ? 'error' : ''; ?>">
				<?php echo form_label('Nama Konsentrasi', 'nama_konsentrasi', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='nama_konsentrasi' type='text' name='nama_konsentrasi' maxlength="50" value="<?php echo set_value('nama_konsentrasi', isset($mastermatakuliah['nama_konsentrasi']) ? $mastermatakuliah['nama_konsentrasi'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('nama_konsentrasi'); ?></span>
				</div>
			</div>
			<div class="control-group <?php echo form_error('nama_dokumen') ? 'error' : ''; ?>">
				<?php echo form_label('File Materi', 'desc_materi', array('class' => 'control-label') ); ?>
				<div class='controls'>
				   <div class="dropzone well well-sm">
				   </div>
				   <input id='materi' type='hidden' name='materi' maxlength="100" value="<?php echo set_value('materi', isset($mastermatakuliah['materi']) ? $mastermatakuliah['materi'] : ''); ?>" />
				    <a href="<?php echo $this->settings_lib->item('site.urlmateri'); ?><?php echo isset($mastermatakuliah['materi']) ? $mastermatakuliah['materi'] : '';?>" target="_blank">
					  <?php echo isset($mastermatakuliah['materi']) ? $mastermatakuliah['materi'] : '';?> <img alt="" src="<?php echo base_url(); ?>assets/images/attach.gif">
				  </a>
			  </div>
			</div>
			</div>
			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('mastermatakuliah_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/master/mastermatakuliah', lang('mastermatakuliah_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('MasterMataKuliah.Master.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('mastermatakuliah_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('mastermatakuliah_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>
<script>

Dropzone.autoDiscover = true;
	//alert("<?php echo base_url() ?>admin/nilai/nilai_mahasiswa/saveberkas");
    var foto_upload= new Dropzone(".dropzone",{
    	 autoProcessQueue: true,
		 url: "<?php echo base_url() ?>admin/nilai/nilai_mahasiswa/saveberkas",
		 maxFilesize: 20,
		 parallelUploads : 10,
		 method:"post",
		 acceptedFiles:".pdf,.xls,.xlsx,.ppt,.pptx,.doc,.docx",
		 paramName:"userfile",
		 dictDefaultMessage:"<img src='<?php echo base_url(); ?>assets/images/dropico.png' width='50px'/><br>Drop dokumen disini atau klik area ini untuk browse file",
		 dictInvalidFileType:"Type file ini tidak dizinkan",
		 addRemoveLinks:true,
		 init: function () {
			   this.on("success", function (file,response) {
			   		var data_n=JSON.parse(response);
			   		$("#materi").val(data_n.namafile);
				   swal("File materi telah di upload, silahkan lanjutkan simpan data", "Warning");
			   });
		   }
		 });
		foto_upload.on("sending",function(a,b,c){
			 a.token=Math.random();
			 c.append('token_foto',a.token);
			 c.append('id_log',"");
			 console.log('mengirim');           
		 });
	foto_upload.processQueue();
</script>


