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
<br>
<div class="alert alert-block alert-error fade in">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Please fix the following errors:</h4>
	<?php echo $validation_errors; ?>
</div>
<?php
endif;

if (isset($konfirmasipembayaran))
{
	$konfirmasipembayaran = (array) $konfirmasipembayaran;
}
$id = isset($konfirmasipembayaran['id']) ? $konfirmasipembayaran['id'] : '';

?>
<div class="box box-info admin-box">
  <div class="box-body">
	 
	<?php echo form_open($this->uri->uri_string(), 'id="frmkonfirmasi"'); ?>
		<fieldset>
 
			<div class="control-group <?php echo form_error('pembayaran') ? 'error' : ''; ?> col-sm-12">
				  <?php echo form_label('Untuk Pembayaran'. lang('bf_form_label_required'), 'konfirmasipembayaran_pembayaran', array('class' => 'control-label') ); ?>
				  <div class='controls'>
				  <select name="konfirmasipembayaran_pembayaran" id="konfirmasipembayaran_pembayaran" class="form-control chosen-select-deselect">
					  <option value=""></option>
					  <?php if (isset($pilihanpembayaran) && is_array($pilihanpembayaran) && count($pilihanpembayaran)):?>
					  <?php foreach($pilihanpembayaran as $record):?>
						  <option value="<?php echo $record->value?>" <?php if(isset($konfirmasipembayaran['pembayaran']))  echo  ($record->value==$konfirmasipembayaran['pembayaran']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
						  <?php endforeach;?>
					  <?php endif;?>
				  </select>
   
					  <span class='help-inline'><?php echo form_error('pembayaran'); ?></span>
				  </div>
			  </div>  

			<div class="control-group <?php echo form_error('semester') ? 'error' : ''; ?> col-sm-12">
				  <?php echo form_label('Semester'. lang('bf_form_label_required'), 'semester', array('class' => 'control-label') ); ?>
				  <div class='controls'>
				  <select name="konfirmasipembayaran_semester" id="konfirmasipembayaran_semester" class="form-control chosen-select-deselect">
					  <option value=""></option>
					  <?php if (isset($pilihansemesters) && is_array($pilihansemesters) && count($pilihansemesters)):?>
					  <?php foreach($pilihansemesters as $record):?>
						  <option value="<?php echo $record->value?>" <?php if(isset($konfirmasipembayaran['semester']))  echo  ($record->value==$konfirmasipembayaran['semester']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
						  <?php endforeach;?>
					  <?php endif;?>
				  </select>
   
					  <span class='help-inline'><?php echo form_error('semester'); ?></span>
				  </div>
			  </div>  


			<div class="control-group <?php echo form_error('konfirmasipembayaran_jumlah') ? 'error' : ''; ?> col-sm-12">
				<?php echo form_label('Jumlah Bayar'. lang('bf_form_label_required'), 'konfirmasipembayaran_jumlah', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='konfirmasipembayaran_jumlah' onkeyup="auto_currency('konfirmasipembayaran_jumlah')" class="form-control autonumber" type='text' name='konfirmasipembayaran_jumlah' maxlength="20" value="<?php echo set_value('konfirmasipembayaran_jumlah', isset($konfirmasipembayaran['jumlah']) ? $konfirmasipembayaran['jumlah'] : ''); ?>" data-a-sep="." data-a-dec=","/>
					<span class='help-inline'><?php echo form_error('konfirmasipembayaran_jumlah'); ?></span>
				</div>
			</div>
			 <div class="form-group col-sm-4">
				 <label for="inputNama" class="control-label">Tanggal</label>
				 <div class="input-group date">
					 <div class="input-group-addon">
						 <i class="fa fa-calendar"></i>
					 </div>
					 <input id='konfirmasipembayaran_tanggal' type='text' name='konfirmasipembayaran_tanggal' class="form-control datepicker" value="<?php echo set_value('konfirmasipembayaran_tanggal', isset($konfirmasipembayaran['tanggal']) ? $konfirmasipembayaran['tanggal'] : ''); ?>" />
					 <span class='help-inline'><?php echo form_error('tanggal'); ?></span>
				 </div>
			 </div> 
			 
				<div class="control-group <?php echo form_error('bank') ? 'error' : ''; ?> col-sm-8">
				  <?php echo form_label('Dari Bank'. lang('bf_form_label_required'), 'konfirmasipembayaran_bank', array('class' => 'control-label') ); ?>
				  <div class='controls'>
				  <select name="konfirmasipembayaran_bank" id="konfirmasipembayaran_bank" class="form-control chosen-select-deselect">
					  <option value=""></option>
					  <?php if (isset($pilihanbank) && is_array($pilihanbank) && count($pilihanbank)):?>
					  <?php foreach($pilihanbank as $record):?>
						  <option value="<?php echo $record->value?>" <?php if(isset($konfirmasipembayaran['bank']))  echo  ($record->value==$konfirmasipembayaran['bank']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
						  <?php endforeach;?>
					  <?php endif;?>
				  </select>
					  <span class='help-inline'><?php echo form_error('bank'); ?></span>
				  </div>
			  </div>  
			<div class="control-group <?php echo form_error('nama_dokumen') ? 'error' : ''; ?> col-sm-12">
			   <?php echo form_label('File Materi', 'desc_materi', array('class' => 'control-label') ); ?>
			   <div class='controls'>
				  <div class="dropzone well well-sm">
				  </div>
				  <input id='file_bukti' type='hidden' name='file_bukti' value="<?php echo set_value('file_bukti', isset($jadwal['file']) ? $jadwal['file'] : ''); ?>" />
			 </div>
		   </div>
			<div class="control-group <?php echo form_error('keterangan') ? 'error' : ''; ?> col-sm-12">
				<?php echo form_label('Keterangan', 'konfirmasipembayaran_keterangan', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'konfirmasipembayaran_keterangan', 'id' => 'konfirmasipembayaran_keterangan','style'=>'width:550px', 'rows' => '5', 'cols' => '80', 'value' => set_value('konfirmasipembayaran_keterangan', isset($konfirmasipembayaran['keterangan']) ? $konfirmasipembayaran['keterangan'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('keterangan'); ?></span>
				</div>
			</div>
 
			</div>
    		<div class="box-footer">
				<input type="submit" name="save" id="btnsubmit" class="btn btn-primary" value="Kirim Konfirmasi"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/pembayaran/konfirmasi_pembayaran', lang('konfirmasi_pembayaran_cancel'), 'class="btn btn-warning"'); ?>
				
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>
<script src="<?php echo base_url(); ?>themes/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
    //Date picker
    $('.datepicker').datepicker({
      autoclose: true,format: 'yyyy-mm-dd'
    });
</script>
<script type="text/javascript">
 
	$(document).ready(function() {	  
		$('.autonumber').autoNumeric('init', {mDec: '0'});
	}); 
function auto_currency(id){
	var variable = document.getElementById(id);
	var new_value =  variable.value.replace(/\,/g,"");
	variable.style.textAlign = "right";
	variable.value = digit_grouping(new_value);
}
</script>
<script>

$("#btnsubmit").click(function(){
	var valsemester = $("#konfirmasipembayaran_semester").val();
	var valjenis = $("#konfirmasipembayaran_pembayaran").val();
	if(valjenis == ""){
		$("#konfirmasipembayaran_pembayaran").focus();	
		swal("Silahkan Pilih jenis pembayaran", "Warning");
		return false;
	}
	if(valsemester == ""){
		$("#konfirmasipembayaran_semester").focus();	
		swal("Silahkan pilih semester", "Warning");
		return false;
	}
	
	var json_url = "<?php echo base_url() ?>admin/pembayaran/konfirmasi_pembayaran/savekonfirmasi";
	 $.ajax({    
		type: "POST",
		url: json_url,
		data: $("#frmkonfirmasi").serialize(),
		success: function(data){ 
			swal(data, "Warning");
			location.reload(true);
		}});
	//return false; 
});	
Dropzone.autoDiscover = true;
	//alert("<?php echo base_url() ?>admin/nilai/nilai_mahasiswa/saveberkas");
    var foto_upload= new Dropzone(".dropzone",{
    	 autoProcessQueue: true,
		 url: "<?php echo base_url() ?>admin/pembayaran/konfirmasi_pembayaran/saveberkas",
		 maxFilesize: 20,
		 parallelUploads : 10,
		 method:"post",
		 acceptedFiles:".pdf,.png,.jpg,.gif",
		 paramName:"userfile",
		 dictDefaultMessage:"<img src='<?php echo base_url(); ?>assets/images/dropico.png' width='50px'/><br>Drop bukti pembayaran disini atau klik area ini untuk browse file",
		 dictInvalidFileType:"Type file ini tidak dizinkan",
		 addRemoveLinks:true,
		 init: function () {
			   this.on("success", function (file,response) {
			   		var data_n=JSON.parse(response);
			   		$("#file_bukti").val(data_n.namafile);
				   swal("File bukti telah di upload, silahkan lanjutkan simpan data", "Warning");
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


