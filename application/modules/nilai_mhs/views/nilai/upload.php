
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
        	
            <div class="control-group <?php echo form_error('photo_upload_nama_file') ? 'error' : ''; ?>">
				<?php echo form_label('File (xls)', 'photo_upload_nama_file', array('class' => 'control-label') ); ?>
				<div class='controls'>
					 
					<input type="file" class="span6" name="Filedata" id="Filedata" /> 
					<span class="help-block">Max File size: 20 Mb</span> 
					<span class='help-inline'><?php echo form_error('photo_upload_nama_file'); ?></span>
				</div>
			</div>
			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="Upload"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/nilai/nilai_mhs/upload', "Cancel", 'class="btn btn-warning"'); ?>
				
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