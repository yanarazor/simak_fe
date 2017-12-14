<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/css/dropzone/dropzone.min.css">
<script src="<?php echo base_url(); ?>themes/admin/js/dropzone/dropzone.min.js"></script>
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/plugins/datepicker/datepicker3.css">
<!-- sweet alert -->
<script src="<?php echo base_url(); ?>themes/admin/js/sweetalert.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/css/sweetalert.css">
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

if (isset($dokumen))
{
	$dokumen = (array) $dokumen;
}
$id = isset($dokumen['id']) ? $dokumen['id'] : '';

?>
<div class="admin-box">
	<h3>dokumen</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>
			<legend>Dokumen (Hanya Menerima exstensi file .pdf)</legend>
			<div class="control-group <?php echo form_error('nama_dokumen') ? 'error' : ''; ?>">
				<div class='controls'>
				   <div class="dropzone well well-sm">
				   </div>
				   <input id='dokumen_file' type='text' name='dokumen_file' maxlength="100" value="<?php echo set_value('dokumen_file', isset($dokumen['file']) ? $dokumen['file'] : ''); ?>" />
              </div>
            </div>
			<div class="control-group <?php echo form_error('nama_dokumen') ? 'error' : ''; ?>">
				<?php echo form_label('Nama Dokumen'. lang('bf_form_label_required'), 'dokumen_nama_dokumen', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='dokumen_nama_dokumen' type='text' name='dokumen_nama_dokumen' maxlength="100" value="<?php echo set_value('dokumen_nama_dokumen', isset($dokumen['nama_dokumen']) ? $dokumen['nama_dokumen'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('nama_dokumen'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('keterangan') ? 'error' : ''; ?>">
				<?php echo form_label('Keterangan', 'dokumen_keterangan', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'dokumen_keterangan', 'id' => 'dokumen_keterangan', 'rows' => '5', 'cols' => '80', 'value' => set_value('dokumen_keterangan', isset($dokumen['keterangan']) ? $dokumen['keterangan'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('keterangan'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('dokumen_action_create'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/master/dokumen', lang('dokumen_cancel'), 'class="btn btn-warning"'); ?>
				
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>
<script src="<?php echo base_url(); ?>themes/admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url(); ?>themes/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
Dropzone.autoDiscover = true;
	//alert("<?php echo base_url() ?>index.php/admin/master/dokumen/saveberkas");
    var foto_upload= new Dropzone(".dropzone",{
    	 autoProcessQueue: true,
		 url: "<?php echo base_url() ?>index.php/admin/master/dokumen/saveberkas",
		 maxFilesize: 20,
		 parallelUploads : 10,
		 method:"post",
		 acceptedFiles:"application/pdf",
		 paramName:"userfile",
		 dictDefaultMessage:"<img src='<?php echo base_url(); ?>assets/images/dropico.png' width='50px'/><br>Drop dokumen disini atau klik area ini untuk browse file",
		 dictInvalidFileType:"Type file ini tidak dizinkan",
		 addRemoveLinks:true,
		 init: function () {
			   this.on("success", function (file,response) {
			   		var data_n=JSON.parse(response);
			   		$("#dokumen_file").val(data_n.namafile);
				   swal("Selesai", "Warning");
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