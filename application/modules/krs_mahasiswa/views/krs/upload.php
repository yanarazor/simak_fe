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
	<?php echo form_open($this->uri->uri_string(), ''); ?>
		<fieldset>
			<legend>Upload data KRS</legend>
			<div class="control-group <?php echo form_error('nama_dokumen') ? 'error' : ''; ?>">
				<div class='controls'>
				   <div class="dropzone well well-sm">
				   </div>
              </div>
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
		 url: "<?php echo base_url() ?>index.php/admin/krs/krs_mahasiswa/saveuploadkrs",
		 maxFilesize: 20,
		 parallelUploads : 10,
		 method:"post",
		 acceptedFiles:".xlsx",
		 paramName:"userfile",
		 dictDefaultMessage:"<img src='<?php echo base_url(); ?>assets/images/dropico.png' width='50px'/><br>Drop file excell disini",
		 dictInvalidFileType:"Type file ini tidak dizinkan",
		 addRemoveLinks:true,
		 init: function () {
			   this.on("success", function (file,response) {
			   		//var data_n=JSON.parse(response);
				   swal(response, "Warning");
			   });
		   }
		 });
		foto_upload.on("sending",function(a,b,c){
			 a.token=Math.random();
			 c.append('token_foto',a.token);
			 console.log('mengirim');           
		 });
	foto_upload.processQueue();
</script>