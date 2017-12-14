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

if (isset($masterdosen))
{
	$masterdosen = (array) $masterdosen;
}
$id = isset($masterdosen['id']) ? $masterdosen['id'] : '';

?>
	 <br/>

<div class="admin-box">
	 <h3>Master Dosen</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>

 <table border="0">
	<tr>
		<td width="60%">
	<fieldset>

<div class="control-group <?php echo form_error('masterdosen_kode_fakultas') ? 'error' : ''; ?>">
				<?php echo form_label('Kode Fakultas', 'masterdosen_kode_fakultas', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<select name="masterdosen_kode_fakultas" id="masterdosen_kode_fakultas" class="chosen-select-deselect" style="width:300px;">
						<option value=""></option>
						<?php if (isset($masterfakultass) && is_array($masterfakultass) && count($masterfakultass)):?>
						<?php foreach($masterfakultass as $record):?>
							<option value="<?php echo $record->kode_fakultas?>" <?php if(isset($masterdosen['kode_fakultas']))  echo  ($record->kode_fakultas==$masterdosen['kode_fakultas']) ? "selected" : ""; ?>><?php echo $record->nama_fakultas; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
					<span class='help-inline'><?php echo form_error('masterdosen_kode_fakultas'); ?></span>
				</div>
			</div>
			<div class="control-group <?php echo form_error('masterdosen_kode_prodi') ? 'error' : ''; ?>">
				 <?php echo form_label('Program Studi'. lang('bf_form_label_required'), 'masterdosen_kode_prodi', array('class' => 'control-label') ); ?>
				 <div class='controls'>
					 <select name="masterdosen_kode_prodi" id="masterdosen_kode_prodi" class="chosen-select-deselect" style="width:300px;">
						 <option value=""></option>
						 <?php if (isset($masterprogramstudis) && is_array($masterprogramstudis) && count($masterprogramstudis)):?>
						 <?php foreach($masterprogramstudis as $record):?>
							  <option value="<?php echo $record->kode_prodi?>" <?php if(isset($masterdosen['kode_prodi']))  echo  ($record->kode_prodi==$masterdosen['kode_prodi']) ? "selected" : ""; ?>><?php echo $record->nama_prodi; ?></option>
						  <?php endforeach;?>
						 <?php endif;?>
					 </select>
					 <span class='help-inline'><?php echo form_error('masterdosen_kode_prodi'); ?></span>
				 </div>
			 </div> 
			 
			<div class="control-group <?php echo form_error('masterdosen_kode_jenjang_studi_option1') ? 'error' : ''; ?>">
				<?php echo form_label('Kode Jenjang Studi'. lang('bf_form_label_required'), 'masterdosen_kode_jenjang_studi_option1', array('class' => 'control-label') ); ?>
				<div class='controls'>
				<select name="masterdosen_kode_jenjang_studi" id="masterdosen_kode_jenjang_studi" class="chosen-select-deselect">
					<option value=""></option>
					<?php if (isset($pilihans) && is_array($pilihans) && count($pilihans)):?>
					<?php foreach($pilihans as $record):?>
						<option value="<?php echo $record->value?>" <?php if(isset($masterdosen['kode_jenjang_studi']))  echo  ($record->value==$masterdosen['kode_jenjang_studi']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
						<?php endforeach;?>
					<?php endif;?>
				</select>
		 
					<span class='help-inline'><?php echo form_error('masterdosen_kode_jenjang_studi_option1'); ?></span>
				</div>
			</div>  

			<div class="control-group <?php echo form_error('masterdosen_no_ktp_dosen') ? 'error' : ''; ?>">
				<?php echo form_label('No KTP Dosen'. lang('bf_form_label_required'), 'masterdosen_no_ktp_dosen', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterdosen_no_ktp_dosen' type='text' name='masterdosen_no_ktp_dosen' maxlength="30" value="<?php echo set_value('masterdosen_no_ktp_dosen', isset($masterdosen['no_ktp_dosen']) ? $masterdosen['no_ktp_dosen'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('masterdosen_no_ktp_dosen'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('nidn') ? 'error' : ''; ?>">
				<?php echo form_label('NIDN'. lang('bf_form_label_required'), 'masterdosen_nidn', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterdosen_nidn' type='text' name='masterdosen_nidn' maxlength="30" value="<?php echo set_value('masterdosen_nidn', isset($masterdosen['nidn']) ? $masterdosen['nidn'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('nidn'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('masterdosen_nama_dosen') ? 'error' : ''; ?>">
				<?php echo form_label('Nama Dosen'. lang('bf_form_label_required'), 'masterdosen_nama_dosen', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterdosen_nama_dosen' type='text' name='masterdosen_nama_dosen' maxlength="50" value="<?php echo set_value('masterdosen_nama_dosen', isset($masterdosen['nama_dosen']) ? $masterdosen['nama_dosen'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('masterdosen_nama_dosen'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('gelar_akademik') ? 'error' : ''; ?>">
				<?php echo form_label('Gelar Akademik', 'masterdosen_gelar_akademik', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterdosen_gelar_akademik' type='text' name='masterdosen_gelar_akademik' maxlength="10" value="<?php echo set_value('masterdosen_gelar_akademik', isset($masterdosen['gelar_akademik']) ? $masterdosen['gelar_akademik'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('gelar_akademik'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('tempat_lahir_dosen') ? 'error' : ''; ?>">
				<?php echo form_label('Tempat Lahir', 'masterdosen_tempat_lahir_dosen', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterdosen_tempat_lahir_dosen' type='text' name='masterdosen_tempat_lahir_dosen' maxlength="50" value="<?php echo set_value('masterdosen_tempat_lahir_dosen', isset($masterdosen['tempat_lahir_dosen']) ? $masterdosen['tempat_lahir_dosen'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('tempat_lahir_dosen'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('tgl_lahir_dosen') ? 'error' : ''; ?>">
				<?php echo form_label('Tanggal Lahir Dosen', 'masterdosen_tgl_lahir_dosen', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterdosen_tgl_lahir_dosen' type='text' name='masterdosen_tgl_lahir_dosen'  value="<?php echo set_value('masterdosen_tgl_lahir_dosen', isset($masterdosen['tgl_lahir_dosen']) ? $masterdosen['tgl_lahir_dosen'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('tgl_lahir_dosen'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('jenis_kelamin') ? 'error' : ''; ?>">
				<?php echo form_label('Jenis Kelamin', '', array('class' => 'control-label', 'id' => 'masterdosen_jenis_kelamin_label') ); ?>
				<div class='controls' aria-labelled-by='masterdosen_jenis_kelamin_label'>
					<label class='radios' for='masterdosen_jenis_kelamin_option1'>
						<input id='masterdosen_jenis_kelamin_option1' name='masterdosen_jenis_kelamin' type='radio' class='' value='L'

						<?php if(isset($masterdosen['jenis_kelamin'])) echo ($masterdosen['jenis_kelamin'] == 'L' ) ? set_radio('masterdosen_jenis_kelamin', 'L', true ) : ""; ?> />
						Laki-laki
					</label>
					<label class='radios' for='masterdosen_jenis_kelamin_option2'>
						<input id='masterdosen_jenis_kelamin_option2' name='masterdosen_jenis_kelamin' type='radio' class='' value='P'

						<?php if(isset($masterdosen['jenis_kelamin'])) echo ($masterdosen['jenis_kelamin'] == 'P' ) ? set_radio('masterdosen_jenis_kelamin', 'P', true ) : ""; ?> />
					Perempuan
					</label>
					<span class='help-inline'><?php echo form_error('jenis_kelamin'); ?></span>
				</div>
			</div>

 
			<div class="control-group <?php echo form_error('masterdosen_kode_jabatan_akademik') ? 'error' : ''; ?>">
				<?php echo form_label('Jabatan Akademik'. lang('bf_form_label_required'), 'masterdosen_kode_jabatan_akademik', array('class' => 'control-label') ); ?>
				<div class='controls'>
				<select name="masterdosen_kode_jabatan_akademik" id="masterdosen_kode_jabatan_akademik" class="chosen-select-deselect">
					<option value=""></option>
					<?php if (isset($pilihan02s) && is_array($pilihan02s) && count($pilihan02s)):?>
					<?php foreach($pilihan02s as $record):?>
						<option value="<?php echo $record->value?>" <?php if(isset($masterdosen['kode_jabatan_akademik']))  echo  ($record->value==$masterdosen['kode_jabatan_akademik']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
						<?php endforeach;?>
					<?php endif;?>
				</select>
		 
					<span class='help-inline'><?php echo form_error('masterdosen_kode_jenjang_studi_option1'); ?></span>
				</div>
			</div> 

			<div class="control-group <?php echo form_error('masterdosen_kode_pendidikan_tertinggi') ? 'error' : ''; ?>">
				<?php echo form_label('Pendidikan Tertinggi'. lang('bf_form_label_required'), 'masterdosen_kode_pendidikan_tertinggi', array('class' => 'control-label') ); ?>
				<div class='controls'>
				<select name="masterdosen_kode_pendidikan_tertinggi" id="masterdosen_kode_pendidikan_tertinggi" class="chosen-select-deselect">
					<option value=""></option>
					<?php if (isset($pilihans) && is_array($pilihans) && count($pilihans)):?>
					<?php foreach($pilihans as $record):?>
						<option value="<?php echo $record->value?>" <?php if(isset($masterdosen['kode_pendidikan_tertinggi']))  echo  ($record->value==$masterdosen['kode_pendidikan_tertinggi']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
						<?php endforeach;?>
					<?php endif;?>
				</select>
		 
					<span class='help-inline'><?php echo form_error('masterdosen_kode_jenjang_studi_option1'); ?></span>
				</div>
			</div>
			 
			<div class="control-group <?php echo form_error('masterdosen_kode_status_kerja_pts') ? 'error' : ''; ?>">
				<?php echo form_label('Status Kerja'. lang('bf_form_label_required'), 'masterdosen_kode_status_kerja_pts', array('class' => 'control-label') ); ?>
				<div class='controls'>
				<select name="masterdosen_kode_status_kerja_pts" id="masterdosen_kode_status_kerja_pts" class="chosen-select-deselect">
					<option value=""></option>
					<?php if (isset($pilihan03s) && is_array($pilihan03s) && count($pilihan03s)):?>
					<?php foreach($pilihan03s as $record):?>
						<option value="<?php echo $record->value?>" <?php if(isset($masterdosen['kode_status_kerja_pts']))  echo  ($record->value==$masterdosen['kode_status_kerja_pts']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
						<?php endforeach;?>
					<?php endif;?>
				</select>
		 
					<span class='help-inline'><?php echo form_error('masterdosen_kode_jenjang_studi_option1'); ?></span>
				</div>
			</div>  
			
			
			
						<div class="control-group <?php echo form_error('kode_status_aktivitas_dosen') ? 'error' : ''; ?>">
				<?php echo form_label('Status Aktivitas Dosen'. lang('bf_form_label_required'), 'masterdosen_kode_status_aktivitas_dosen', array('class' => 'control-label') ); ?>
				<div class='controls'>
				<select name="masterdosen_kode_status_aktivitas_dosen" id="masterdosen_kode_status_aktivitas_dosen" class="chosen-select-deselect">
					<option value=""></option>
					<?php if (isset($pilihan15s) && is_array($pilihan15s) && count($pilihan15s)):?>
					<?php foreach($pilihan15s as $record):?>
						<option value="<?php echo $record->value?>" <?php if(isset($masterdosen['kode_status_aktivitas_dosen']))  echo  ($record->value==$masterdosen['kode_status_aktivitas_dosen']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
						<?php endforeach;?>
					<?php endif;?>
				</select>
		 
					<span class='help-inline'><?php echo form_error('kode_status_aktivitas_dosen'); ?></span>
				</div>
			</div>  

			<div class="control-group <?php echo form_error('tahun_semester') ? 'error' : ''; ?>">
				<?php echo form_label('Tahun Semester', 'masterdosen_tahun_semester', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterdosen_tahun_semester' type='text' name='masterdosen_tahun_semester' maxlength="5" value="<?php echo set_value('masterdosen_tahun_semester', isset($masterdosen['tahun_semester']) ? $masterdosen['tahun_semester'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('tahun_semester'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('nip_pns') ? 'error' : ''; ?>">
				<?php echo form_label('NIP PNS', 'masterdosen_nip_pns', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterdosen_nip_pns' type='text' name='masterdosen_nip_pns' maxlength="30" value="<?php echo set_value('masterdosen_nip_pns', isset($masterdosen['nip_pns']) ? $masterdosen['nip_pns'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('nip_pns'); ?></span>
				</div>
			</div>


			<div class="control-group <?php echo form_error('home_base') ? 'error' : ''; ?>">
				<?php echo form_label('Home Base', 'masterdosen_home_base', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterdosen_home_base' type='text' name='masterdosen_home_base' maxlength="6" value="<?php echo set_value('masterdosen_home_base', isset($masterdosen['home_base']) ? $masterdosen['home_base'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('home_base'); ?></span>
				</div>
			</div>
 
			<div class="control-group <?php echo form_error('no_telp_dosen') ? 'error' : ''; ?>">
				<?php echo form_label('No Telepon Dosen', 'masterdosen_no_telp_dosen', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='masterdosen_no_telp_dosen' type='text' name='masterdosen_no_telp_dosen' maxlength="25" value="<?php echo set_value('masterdosen_no_telp_dosen', isset($masterdosen['no_telp_dosen']) ? $masterdosen['no_telp_dosen'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('no_telp_dosen'); ?></span>
				</div>
			</div>

</fieldset>
                
            </td>
            <td valign="top" align="center"> 
            <?php if(isset($masterdosen) && isset($masterdosen['photo_dosen']) && $masterdosen['photo_dosen']!='no image' && !empty($masterdosen['photo_dosen'])) :
						$foto = $masterdosen['photo_dosen'];
					else:
						$foto = "noimage.jpg";
					endif;
				?>
            	 <fieldset>
            	 	<div class="control-group">
						   <div id="logo">
							   <div class="get-photo" style="z-index: 690;"> 
								   <a href="<?php echo $this->settings_lib->item('site.urlphotodosen').$foto; ?>">
									   <img width="160" height="160" alt="" src="<?php echo $this->settings_lib->item('site.urlphotodosen').$foto; ?>">
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
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('masterdosen_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/master/masterdosen', lang('masterdosen_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('MasterDosen.Master.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('masterdosen_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('masterdosen_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>