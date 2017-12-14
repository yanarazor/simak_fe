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

if (isset($tahunakademik))
{
	$tahunakademik = (array) $tahunakademik;
}
$id = isset($tahunakademik['id']) ? $tahunakademik['id'] : '';

?>
<div class="admin-box">
	<h3>TahunAkademik</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>
			<!--
			<div class="control-group <?php echo form_error('tahun_id') ? 'error' : ''; ?>">
				<?php echo form_label('Tahun Id'. lang('bf_form_label_required'), 'tahunakademik_tahun_id', array('class' => 'control-label') ); ?>
				<div class='controls'>
					
					<span class='help-inline'><?php echo form_error('tahun_id'); ?></span>
				</div>
			</div>
-->
			<div class="control-group <?php echo form_error('tahunakademik_tahun') ? 'error' : ''; ?>">
				<?php echo form_label('Tahun'. lang('bf_form_label_required'), 'tahunakademik_tahun', array('class' => 'control-label') ); ?>
				<div class='controls'>	
					<input id='tahunakademik_tahun_id' type='hidden' name='tahunakademik_tahun_id' maxlength="5" value="<?php echo set_value('tahunakademik_tahun_id', isset($tahunakademik['tahun_id']) ? $tahunakademik['tahun_id'] : ''); ?>" />
					<input id='tahunakademik_tahun' type='text' name='tahunakademik_tahun' maxlength="4" value="<?php echo set_value('tahunakademik_tahun', isset($tahunakademik['tahun']) ? $tahunakademik['tahun'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('tahunakademik_tahun'); ?></span>
				</div>
			</div>
			<div class="control-group <?php echo form_error('tahunakademik_semester') ? 'error' : ''; ?>">
				<?php echo form_label('Semester', 'semester', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<select name="tahunakademik_semester" id="tahunakademik_semester" class="chosen-select-deselect" style="width:400px">
						<option value=""></option>
						<option value="1" <?php if(isset($tahunakademik['semester']))  echo  ($tahunakademik['semester'] == "1") ? "selected" : ""; ?>>Ganjil</option>
						<option value="2" <?php if(isset($tahunakademik['semester']))  echo  ($tahunakademik['semester'] == "2") ? "selected" : ""; ?>>Genap</option>
					</select>
					<span class='help-inline'><?php echo form_error('tahunakademik_semester'); ?></span>
				</div>
			</div>
			
			 
			<div class="control-group <?php echo form_error('tahunakademik_nama_tahun') ? 'error' : ''; ?>">
				<?php echo form_label('Nama Tahun'. lang('bf_form_label_required'), 'tahunakademik_nama_tahun', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tahunakademik_nama_tahun' type='text' name='tahunakademik_nama_tahun' maxlength="50" value="<?php echo set_value('tahunakademik_nama_tahun', isset($tahunakademik['nama_tahun']) ? $tahunakademik['nama_tahun'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('tahunakademik_nama_tahun'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('krs_mulai') ? 'error' : ''; ?>">
				<?php echo form_label('Krs Mulai', 'tahunakademik_krs_mulai', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tahunakademik_krs_mulai' class="datepicker" type='text' name='tahunakademik_krs_mulai'  value="<?php echo set_value('tahunakademik_krs_mulai', isset($tahunakademik['krs_mulai']) ? $tahunakademik['krs_mulai'] : ''); ?>" />
					s/d 
					<input id='tahunakademik_krs_selesai' class="datepicker" type='text' name='tahunakademik_krs_selesai'  value="<?php echo set_value('tahunakademik_krs_selesai', isset($tahunakademik['krs_selesai']) ? $tahunakademik['krs_selesai'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('krs_mulai'); ?></span>
				</div>
			</div>

			 

			<div class="control-group <?php echo form_error('krs_online_mulai') ? 'error' : ''; ?>">
				<?php echo form_label('Krs Online Mulai', 'tahunakademik_krs_online_mulai', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tahunakademik_krs_online_mulai' class="datepicker" type='text' name='tahunakademik_krs_online_mulai'  value="<?php echo set_value('tahunakademik_krs_online_mulai', isset($tahunakademik['krs_online_mulai']) ? $tahunakademik['krs_online_mulai'] : ''); ?>" />
					s/d
					<input id='tahunakademik_krs_online_selesai' class="datepicker" type='text' name='tahunakademik_krs_online_selesai'  value="<?php echo set_value('tahunakademik_krs_online_selesai', isset($tahunakademik['krs_online_selesai']) ? $tahunakademik['krs_online_selesai'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('krs_online_mulai'); ?></span>
				</div>
			</div>

			 
			<div class="control-group <?php echo form_error('krs_ubah_mulai') ? 'error' : ''; ?>">
				<?php echo form_label('Krs Ubah Mulai', 'tahunakademik_krs_ubah_mulai', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tahunakademik_krs_ubah_mulai' type='text' class="datepicker" name='tahunakademik_krs_ubah_mulai'  value="<?php echo set_value('tahunakademik_krs_ubah_mulai', isset($tahunakademik['krs_ubah_mulai']) ? $tahunakademik['krs_ubah_mulai'] : ''); ?>" />
					s/d
					<input id='tahunakademik_krs_ubah_selesai' type='text' class="datepicker" name='tahunakademik_krs_ubah_selesai'  value="<?php echo set_value('tahunakademik_krs_ubah_selesai', isset($tahunakademik['krs_ubah_selesai']) ? $tahunakademik['krs_ubah_selesai'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('krs_ubah_mulai'); ?></span>
				</div>
			</div>

			 
			<div class="control-group <?php echo form_error('kss_cetak_mulai') ? 'error' : ''; ?>">
				<?php echo form_label('Kss Cetak Mulai', 'tahunakademik_kss_cetak_mulai', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tahunakademik_kss_cetak_mulai' type='text' class="datepicker" name='tahunakademik_kss_cetak_mulai'  value="<?php echo set_value('tahunakademik_kss_cetak_mulai', isset($tahunakademik['kss_cetak_mulai']) ? $tahunakademik['kss_cetak_mulai'] : ''); ?>" />
					s/d
					<input id='tahunakademik_kss_cetak_selesai' type='text' class="datepicker" name='tahunakademik_kss_cetak_selesai'  value="<?php echo set_value('tahunakademik_kss_cetak_selesai', isset($tahunakademik['kss_cetak_selesai']) ? $tahunakademik['kss_cetak_selesai'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('kss_cetak_mulai'); ?></span>
				</div>
			</div>

			 
			<div class="control-group <?php echo form_error('cuti') ? 'error' : ''; ?>">
				<?php echo form_label('Boleh Cuti', 'tahunakademik_cuti', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tahunakademik_cuti' type='text' class="datepicker" name='tahunakademik_cuti'  value="<?php echo set_value('tahunakademik_cuti', isset($tahunakademik['cuti']) ? $tahunakademik['cuti'] : ''); ?>" />
					s/d
					<input id='tahunakademik_cuti_selesai' class="datepicker" type='text' name='tahunakademik_cuti_selesai'  value="<?php echo set_value('tahunakademik_cuti_selesai', isset($tahunakademik['cuti_selesai']) ? $tahunakademik['cuti_selesai'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('cuti'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('mundur') ? 'error' : ''; ?>">
				<?php echo form_label('Mundur', 'tahunakademik_mundur', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tahunakademik_mundur' type='text'  class="datepicker" name='tahunakademik_mundur'  value="<?php echo set_value('tahunakademik_mundur', isset($tahunakademik['mundur']) ? $tahunakademik['mundur'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('mundur'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('bayar_mulai') ? 'error' : ''; ?>">
				<?php echo form_label('Bayar Mulai', 'tahunakademik_bayar_mulai', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tahunakademik_bayar_mulai' type='text' class="datepicker" name='tahunakademik_bayar_mulai'  value="<?php echo set_value('tahunakademik_bayar_mulai', isset($tahunakademik['bayar_mulai']) ? $tahunakademik['bayar_mulai'] : ''); ?>" />
					s/d
					<input id='tahunakademik_bayar_selesai' type='text'  class="datepicker"name='tahunakademik_bayar_selesai'  value="<?php echo set_value('tahunakademik_bayar_selesai', isset($tahunakademik['bayar_selesai']) ? $tahunakademik['bayar_selesai'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('bayar_mulai'); ?></span>
				</div>
			</div>
 
			<div class="control-group <?php echo form_error('kuliah_mulai') ? 'error' : ''; ?>">
				<?php echo form_label('Kuliah Mulai', 'tahunakademik_kuliah_mulai', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tahunakademik_kuliah_mulai' class="datepicker" type='text' name='tahunakademik_kuliah_mulai'  value="<?php echo set_value('tahunakademik_kuliah_mulai', isset($tahunakademik['kuliah_mulai']) ? $tahunakademik['kuliah_mulai'] : ''); ?>" />
					s/d
					<input id='tahunakademik_kuliah_selesai' class="datepicker" type='text' name='tahunakademik_kuliah_selesai'  value="<?php echo set_value('tahunakademik_kuliah_selesai', isset($tahunakademik['kuliah_selesai']) ? $tahunakademik['kuliah_selesai'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('kuliah_mulai'); ?></span>
				</div>
			</div>
			<div class="control-group <?php echo form_error('uts_mulai') ? 'error' : ''; ?>">
				<?php echo form_label('Uts Mulai', 'tahunakademik_uts_mulai', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tahunakademik_uts_mulai' class="datepicker" type='text' name='tahunakademik_uts_mulai'  value="<?php echo set_value('tahunakademik_uts_mulai', isset($tahunakademik['uts_mulai']) ? $tahunakademik['uts_mulai'] : ''); ?>" />
					s/d
					<input id='tahunakademik_uts_selesai' class="datepicker" type='text' name='tahunakademik_uts_selesai'  value="<?php echo set_value('tahunakademik_uts_selesai', isset($tahunakademik['uts_selesai']) ? $tahunakademik['uts_selesai'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('uts_mulai'); ?></span>
				</div>
			</div>

			 
			<div class="control-group <?php echo form_error('uas_mulai') ? 'error' : ''; ?>">
				<?php echo form_label('Uas Mulai', 'tahunakademik_uas_mulai', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tahunakademik_uas_mulai' class="datepicker" type='text' name='tahunakademik_uas_mulai'  value="<?php echo set_value('tahunakademik_uas_mulai', isset($tahunakademik['uas_mulai']) ? $tahunakademik['uas_mulai'] : ''); ?>" />
					s/d
					<input id='tahunakademik_uas_selesai' class="datepicker" type='text' name='tahunakademik_uas_selesai'  value="<?php echo set_value('tahunakademik_uas_selesai', isset($tahunakademik['uas_selesai']) ? $tahunakademik['uas_selesai'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('uas_mulai'); ?></span>
				</div>
			</div>

			 <!--

			<div class="control-group <?php echo form_error('nilai') ? 'error' : ''; ?>">
				<?php echo form_label('Nilai', 'tahunakademik_nilai', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tahunakademik_nilai' type='text' name='tahunakademik_nilai'  value="<?php echo set_value('tahunakademik_nilai', isset($tahunakademik['nilai']) ? $tahunakademik['nilai'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('nilai'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('akhir_kss') ? 'error' : ''; ?>">
				<?php echo form_label('Akhir Kss', 'tahunakademik_akhir_kss', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tahunakademik_akhir_kss' type='text' name='tahunakademik_akhir_kss'  value="<?php echo set_value('tahunakademik_akhir_kss', isset($tahunakademik['akhir_kss']) ? $tahunakademik['akhir_kss'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('akhir_kss'); ?></span>
				</div>
			</div>
			
			<div class="control-group <?php echo form_error('proses_buka') ? 'error' : ''; ?>">
				<?php echo form_label('Proses Buka', 'tahunakademik_proses_buka', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tahunakademik_proses_buka' type='text' name='tahunakademik_proses_buka'  value="<?php echo set_value('tahunakademik_proses_buka', isset($tahunakademik['proses_buka']) ? $tahunakademik['proses_buka'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('proses_buka'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('proses_ipk') ? 'error' : ''; ?>">
				<?php echo form_label('Proses Ipk', 'tahunakademik_proses_ipk', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tahunakademik_proses_ipk' type='text' name='tahunakademik_proses_ipk'  value="<?php echo set_value('tahunakademik_proses_ipk', isset($tahunakademik['proses_ipk']) ? $tahunakademik['proses_ipk'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('proses_ipk'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('proses_tutup') ? 'error' : ''; ?>">
				<?php echo form_label('Proses Tutup', 'tahunakademik_proses_tutup', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tahunakademik_proses_tutup' type='text' name='tahunakademik_proses_tutup'  value="<?php echo set_value('tahunakademik_proses_tutup', isset($tahunakademik['proses_tutup']) ? $tahunakademik['proses_tutup'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('proses_tutup'); ?></span>
				</div>
			</div>
			
			<div class="control-group <?php echo form_error('tahunakademik_buka') ? 'error' : ''; ?>">
				<?php echo form_label('Buka', 'tahunakademik_buka', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<select name="tahunakademik_buka" id="tahunakademik_buka" class="chosen-select-deselect" style="width:400px">
						<option value=""></option>
						<option value="Y" <?php if(isset($tahunakademik['buka']))  echo  ($tahunakademik['buka'] == "Y") ? "selected" : ""; ?>>Buka</option>
						<option value="N" <?php if(isset($tahunakademik['buka']))  echo  ($tahunakademik['buka'] == "N") ? "selected" : ""; ?>>Tutup</option>
					</select>
					<span class='help-inline'><?php echo form_error('tahunakademik_buka'); ?></span>
				</div>
			</div>
 
			-->
			<div class="control-group <?php echo form_error('tahunakademik_syarat_krs') ? 'error' : ''; ?>">
				<?php echo form_label('Pembayaran Syarat KRS', 'tahunakademik_syarat_krs', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<select name="tahunakademik_syarat_krs" id="tahunakademik_syarat_krs" class="chosen-select-deselect" style="width:400px">
						<option value=""></option>
						<option value="Y" <?php if(isset($tahunakademik['syarat_krs']))  echo  ($tahunakademik['syarat_krs'] == "Y") ? "selected" : ""; ?>>Ya</option>
						<option value="N" <?php if(isset($tahunakademik['syarat_krs']))  echo  ($tahunakademik['syarat_krs'] == "N") ? "selected" : ""; ?>>Tidak</option>
					</select>
					<span class='help-inline'><?php echo form_error('tahunakademik_syarat_krs'); ?></span>
				</div>
			</div>
			 
			<div class="control-group <?php echo form_error('tahunakademik_syarat_krs_ips') ? 'error' : ''; ?>">
				<?php echo form_label('Ambil SKS Berdasarkan IPS', 'tahunakademik_syarat_krs_ips', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<select name="tahunakademik_syarat_krs_ips" id="tahunakademik_syarat_krs_ips" class="chosen-select-deselect" style="width:400px">
						<option value=""></option>
						<option value="Y" <?php if(isset($tahunakademik['syarat_krs_ips']))  echo  ($tahunakademik['syarat_krs_ips'] == "Y") ? "selected" : ""; ?>>Ya</option>
						<option value="N" <?php if(isset($tahunakademik['syarat_krs_ips']))  echo  ($tahunakademik['syarat_krs_ips'] == "N") ? "selected" : ""; ?>>Tidak</option>
					</select>
					<span class='help-inline'><?php echo form_error('tahunakademik_syarat_krs_ips'); ?></span>
				</div>
			</div>
			
 
			<div class="control-group <?php echo form_error('max_sks') ? 'error' : ''; ?>">
				<?php echo form_label('Max Sks', 'tahunakademik_max_sks', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tahunakademik_max_sks' type='text' name='tahunakademik_max_sks' maxlength="10" value="<?php echo set_value('tahunakademik_max_sks', isset($tahunakademik['max_sks']) ? $tahunakademik['max_sks'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('max_sks'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('tahunakademik_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/master/tahunakademik', lang('tahunakademik_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('TahunAkademik.Master.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('tahunakademik_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('tahunakademik_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>
<script type="text/javascript">	 
	$("#tahunakademik_tahun").change(function(){
		  	var valtahunakademik_tahun 	= $("#tahunakademik_tahun").val();
		  	var valtahunakademik_semester 	= $("#tahunakademik_semester").val();
			if(valtahunakademik_tahun != "" && valtahunakademik_semester != "")
			{
				$("#tahunakademik_tahun_id").val(valtahunakademik_tahun+""+valtahunakademik_semester);
			}
			return false;
	});
	$("#tahunakademik_semester").change(function(){
		  	var valtahunakademik_tahun 	= $("#tahunakademik_tahun").val();
		  	var valtahunakademik_semester 	= $("#tahunakademik_semester").val();
			if(valtahunakademik_tahun != "" && valtahunakademik_semester != "")
			{
				$("#tahunakademik_tahun_id").val(valtahunakademik_tahun+""+valtahunakademik_semester);
			}
			return false;
	});
 	 
</script>