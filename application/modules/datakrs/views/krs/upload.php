
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

if (isset($photo_upload))
{
	$photo_upload = (array) $photo_upload;
}
$id = isset($photo_upload['id']) ? $photo_upload['id'] : '';

?>
<div class="admin-box">
	 
	<?php echo form_open_multipart($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset> 
        	<div class="control-group <?php echo form_error('tahun_anggaran') ? 'error' : ''; ?>">
				<?php echo form_label('Tahun Anggaran'. lang('bf_form_label_required'), 'photo_upload_tahun_anggaran', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tahun_anggaran' type='text' name='photo_upload_tahun_anggaran' maxlength="4" value="<?php echo set_value('photo_upload_tahun_anggaran', isset($photo_upload['tahun_anggaran']) ? $photo_upload['tahun_anggaran'] : ''); ?>" />
					<input id='nomor_kontrak' type='hidden' name='photo_upload_nomor_kontrak' maxlength="4" value="<?php echo set_value('photo_upload_nomor_kontrak', isset($photo_upload['nomor_kontrak']) ? $photo_upload['nomor_kontrak'] : ''); ?>" />
					
                    <span class='help-inline'><?php echo form_error('tahun_anggaran'); ?></span>
				</div>
			</div> 
            <div class="control-group <?php echo form_error('provinsi') ? 'error' : ''; ?>">
				<?php echo form_label('Provinsi', 'provinsi', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<select name="ID_PROV" id="ID_PROV" class="chosen-select-deselect">
						<option value="">-- Pilih Provinsi --</option>
						<?php if (isset($provinsis) && is_array($provinsis) && count($provinsis)):?>
						<?php foreach($provinsis as $provinsi_record):?>
							<option value="<?php echo $provinsi_record->id?>" <?php if(isset($prov))  echo  ($provinsi_record->id==$prov) ? "selected" : ""; ?>><?php echo $provinsi_record->prov; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
					<span class='help-inline'><?php echo form_error('provinsi'); ?></span>
				</div>
			</div>
			<div class="control-group <?php echo form_error('kabupaten') ? 'error' : ''; ?>">
				<?php echo form_label('Kabupaten', 'kabupaten', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<select name="ID_KAB" id="ID_KAB" class="chosen-select-deselect">
						<option value="">-- Pilih Kabupaten --</option>
						<?php if (isset($recordkabupatens) && is_array($recordkabupatens) && count($recordkabupatens)):?>
						<?php foreach($recordkabupatens as $kabupaten_record):?>
							<option value="<?php echo $kabupaten_record->id?>" <?php if(isset($kab))  echo  ($kabupaten_record->id==$kab) ? "selected" : ""; ?>><?php echo $kabupaten_record->kab; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
					<span class='help-inline'><?php echo form_error('kabupaten'); ?></span>
				</div>
			</div>
			<div class="control-group <?php echo form_error('kecamatan') ? 'error' : ''; ?>">
				<?php echo form_label('Kecamatan', 'kecamatan', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<select name="ID_KEC" id="ID_KEC" class="chosen-select-deselect">
						<option value="">-- Pilih Kecamatan --</option>
						<?php if (isset($recordkecamatans) && is_array($recordkecamatans) && count($recordkecamatans)):?>
						<?php foreach($recordkecamatans as $kecamatan_record):?>
							<option value="<?php echo $kecamatan_record->id?>" <?php if(isset($kec))  echo  ($kecamatan_record->id==$kec) ? "selected" : ""; ?>><?php echo $kecamatan_record->kec; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
					<span class='help-inline'><?php echo form_error('kecamatan'); ?></span>
				</div>
			</div>
			<div class="control-group <?php echo form_error('photo_upload_id_desa') ? 'error' : ''; ?>">
				<?php echo form_label('Desa', 'photo_upload_id_desa', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<select name="photo_upload_id_desa" id="ID_DES" class="chosen-select-deselect">
						<option value="">-- Pilih Desa --</option>
						<?php if (isset($recorddesas) && is_array($recorddesas) && count($recorddesas)):?>
						<?php foreach($recorddesas as $desa_record):?>
							<option value="<?php echo $desa_record->id?>" <?php if(isset($photo_upload['id_desa']))  echo  ($desa_record->id==$photo_upload['id_desa']) ? "selected" : ""; ?>><?php echo $desa_record->des; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
					<span class='help-inline'><?php echo form_error('photo_upload_id_desa'); ?></span>
				</div>
			</div>
			 
			<div class="control-group <?php echo form_error('keterangan') ? 'error' : ''; ?>">
				<?php echo form_label('Keterangan', 'photo_upload_keterangan', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'photo_upload_keterangan', 'id' => 'photo_upload_keterangan', 'rows' => '5', 'cols' => '80', 'value' => set_value('photo_upload_keterangan', isset($photo_upload['keterangan']) ? $photo_upload['keterangan'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('keterangan'); ?></span>
				</div>
			</div>  
            <div class="control-group <?php echo form_error('photo_upload_nama_file') ? 'error' : ''; ?>">
				<?php echo form_label('Foto', 'photo_upload_nama_file', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<div id="foto">
						<?php if(isset($peserta) && isset($photo_upload['nama_file']) && $photo_upload['nama_file']!='no image' && !empty($photo_upload['nama_file'])) :
								 
								$foto = base_url().$this->settings_lib->item('site.urlphoto').$photo_upload['nama_file'];
							else:
								$foto = base_url().$this->settings_lib->item('site.urlphoto')."nopicture.jpg";
							endif;
						?>
						<div class="photo" style="z-index: 690;"> 
							<a href="<?php echo $foto; ?>" target="_blank">
								<img width="100" alt="" src="<?php echo $foto; ?>">
							</a>
						</div>
					</div>
					<input type="file" class="span6" name="file_upload" id="file_upload" /> 
					<span class="help-block">Photo size: 700 x 600 pixels</span> 
					<span class='help-inline'><?php echo form_error('photo_upload_nama_file'); ?></span>
				</div>
			</div>
			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('photo_upload_action_create'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/fileupload/photo_upload', lang('photo_upload_cancel'), 'class="btn btn-warning"'); ?>
				
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>

<script type="text/javascript">	  
 
	
	$("#ID_PROV").change(function(){
		 
			var id_provinsi = $("#ID_PROV").val();
			$("#ID_KAB").empty().append("<option>loading...</option>"); //show loading...
			 
			var json_url = "<?php echo base_url(); ?>index.php/admin/masters/kabupaten/getbyprovinsi?id_provinsi=" + encodeURIComponent(id_provinsi);
			$.getJSON(json_url,function(data){
				$("#ID_KAB").empty(); 
				if(data==""){
					$("#ID_KAB").append("<option value=\"\">Pilih Kabupaten </option>");
				}
				else{
					$("#ID_KAB").append("<option value=\"\">-- Pilih Kabupaten --</option>");
					for(i=0; i<data.id.length; i++){
						$("#ID_KAB").append("<option value=\"" + data.id[i]  + "\">" + data.kab[i] +"</option>");
					}
				}
				
			});
			
			return false;
		});

	$("#ID_KAB").change(function(){
			var id_kabupaten = $("#ID_KAB").val();
			$("#ID_KEC").empty().append("<option>loading...</option>"); //show loading...
			var json_url = "<?php echo base_url(); ?>index.php/admin/masters/kecamatan/getbykabupaten?id_kabupaten=" + encodeURIComponent(id_kabupaten);
			$.getJSON(json_url,function(data){
				$("#ID_KEC").empty(); 
				if(data==""){
					$("#ID_KEC").append("<option value=\"\">Pilih Kecamatan </option>");
				}
				else{
					$("#ID_KEC").append("<option value=\"\">-- Pilih Kecamatan --</option>");
					for(i=0; i<data.id.length; i++){
						$("#ID_KEC").append("<option value=\"" + data.id[i]  + "\">" + data.kec[i] +"</option>");
					}
				}
				
			});
			
			return false;
		});

	$("#ID_KEC").change(function(){
			var id_kecamatan = $("#ID_KEC").val();
			$("#ID_DES").empty().append("<option>loading...</option>"); //show loading...
			var json_url = "<?php echo base_url(); ?>index.php/admin/masters/desa/getbykecamatan?id_kecamatan=" + encodeURIComponent(id_kecamatan);
			$.getJSON(json_url,function(data){
				$("#ID_DES").empty(); 
				if(data==""){
					$("#ID_DES").append("<option value=\"\">Pilih Desa </option>");
				}
				else{
					$("#ID_DES").append("<option value=\"\">-- Pilih Desa --</option>");
					for(i=0; i<data.id.length; i++){
						$("#ID_DES").append("<option value=\"" + data.id[i]  + "\">" + data.des[i] +"</option>");
					}
				}
				
			});
			
			return false;
		});

	$("#ID_DES").change(function(){
		
			var iddesa = $("#ID_DES").val();
			var TA = $("#tahun_anggaran").val();
			 
			$("#nomor_kontrak").val(TA+""+iddesa);
			//alert("masuk");
			return false;
		});
		$("#tahun_anggaran").change(function(){
			var iddesa = $("#ID_DES").val();
			var TA = $("#tahun_anggaran").val();
			$("#nomor_kontrak").val(TA+""+iddesa);
			//alert("masuk");
			return false;
		});
</script>