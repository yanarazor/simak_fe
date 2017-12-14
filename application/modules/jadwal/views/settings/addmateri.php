<!-- sweet alert -->
<script src="<?php echo base_url(); ?>themes/admin/js/sweetalert.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/css/sweetalert.css">

<?php
	$this->load->library('convert');
	$convert = new convert();
  // Change the css classes to suit your needs
if( isset($rcjadwal) ) {
	//print_r($rcjadwal);
	$rcjadwal = (array)$rcjadwal;
	//print_r($rcjadwal);
}
$id = isset($rcjadwal[0]->id) ? $rcjadwal[0]->id : '';
?>
<div class="admin-box box box-primary">
	<div class="box-body">
	   <?php echo form_open_multipart($this->uri->uri_string(), 'id="frmmateri"'); ?>
	   <table border="0" style="font-size:10px;" width="90%">
			<tr>
				<td align="left" width="100px" > Program Studi</td>
				<td align="left" width="10px">:</td>
				<td align="left" width="250px"><?php echo isset($nama_jurusan)?$nama_jurusan:"" ?></td>
				<td>&nbsp;</td>
				<td align="left">Semester </td>
				<td align="left">:</td>
				<td ><?php echo $tahunakademik; ?></td>
				 
			</tr>
			<tr>
				<td align="left"> Mata Kuliah  </td>
				<td align="left">:</td>
				<td><?php echo isset($nama_mk)?$nama_mk:"" ?></td>
				<td>&nbsp;</td>
				<td width="100px"></td>
				<td align="left" width="10px"></td>
				<td>
			  
				 </td>
			</tr>
		
		   <tr>
			 
				<td align="left">Dosen</td>
				<td align="left">:</td>
				<td><?php echo isset($dosen) ? $dosen:"" ?></td>
				<td>&nbsp;</td>
				<td width="100px">KELAS</td>
				<td align="left" width="10px">:</td>
				<td><?php echo isset($kelas)?$kelas:"" ?></td>
			</tr>
			 
		</table>
		<fieldset>
			<legend></legend>
				<div class="control-group <?php echo form_error('presensi') ? 'error' : ''; ?> col-sm-12">
					 <?php echo form_label('Substansi Materi', 'presensi', array('class' => 'control-label') ); ?>
					 <div class='controls'>
					 	<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" class="form-control"/>
						 <?php echo form_textarea( array( 'name' => 'presensi', 'id' => 'presensi','class'=>'form-control', 'rows' => '5', 'cols' => '30', 'value' => set_value('presensi', isset($rcjadwal[0]->presensi) ? $rcjadwal[0]->presensi : '') ) ); ?>
						 <span class='help-inline'><?php echo form_error('presensi'); ?></span>
					 </div>
				 </div>
					<div class="control-group col-sm-3">
						<label class="control-label">Persentase Tugas 1</label>
						<div class="controls">
							<input type="text" name="harian" id="harian" onchange="validatepersentase()" value="<?php echo set_value('tugas', isset($rcjadwal[0]->bobot_harian) ? $rcjadwal[0]->bobot_harian : '') ?>" class="form-control"/>
							<p class="help-inline"></p>
						</div>
					</div>
					<div class="control-group col-sm-3">
						<label class="control-label">Persentase Tugas 2</label>
						<div class="controls">
							<input type="text" name="normatif" id="normatif" onchange="validatepersentase()" value="<?php echo set_value('bobot_formatif', isset($rcjadwal[0]->bobot_formatif) ? $rcjadwal[0]->bobot_formatif : '') ?>" class="form-control" />
							<p class="help-inline"></p>
						</div>
					</div>
					<div class="control-group col-sm-3" id="pr">
						<label class="control-label" for="password_min_length">Persentase UTS</label>
						<div class="controls">
							<input type="text" name="uts" id="uts" onchange="validatepersentase()" value="<?php echo set_value('bobot_uts', isset($rcjadwal[0]->bobot_uts) ? $rcjadwal[0]->bobot_uts : '') ?>" class="form-control" />
							<p class="help-inline"></p>
						</div>
					</div>
					<div class="control-group col-sm-3" id="pr">
						<label class="control-label" for="password_min_length">Persentase UAS</label>
						<div class="controls">
							<input type="text" name="uas" id="uas" onchange="validatepersentase()" value="<?php echo set_value('bobot_uas', isset($rcjadwal[0]->bobot_uas) ? $rcjadwal[0]->bobot_uas : '') ?>" class="form-control" />
							<p class="help-inline"></p>
						</div>
					</div>
					<div class="control-group col-sm-12" id="pertemuan">
						<label class="control-label" for="password_min_length">Jumlah Pertemuan</label>
						<div class="controls">
							<input type="text" name="jml_pertemuan" id="jml_pertemuan" value="<?php echo set_value('bobot_uas', isset($rcjadwal[0]->jml_pertemuan) ? $rcjadwal[0]->jml_pertemuan : '12') ?>" class="form-control" />
							<p class="help-inline"></p>
						</div>
					</div>
					<div class="control-group col-sm-12" id="pertemuan">
						<label class="control-label" for="password_min_length">RPS</label>
						<div class="controls">
							 <p class="help-inline">
							 <?php
							 if(isset($mastermatakuliah->materi) and $mastermatakuliah->materi != ""){ ?>
							 <a href="<?php echo $this->settings_lib->item('site.urlmateri'); ?><?php echo isset($mastermatakuliah->materi) ? $mastermatakuliah->materi : '';?>" target="_blank">
								 <?php echo (isset($mastermatakuliah->materi) and $mastermatakuliah->materi) != "" ? $mastermatakuliah->materi : '';?> <img alt="" src="<?php echo base_url(); ?>assets/images/attach.gif">
							 </a>
							 <?php } else{ echo "Rps belum ada, silahkan hubungi akademik"; }?>
							 </p>
						</div>
					</div>
					
					
				 
		</fieldset>
		<fieldset>	 
				  <div class="form-actions">
				  <input type="submit" name="save" id="btnsubmit" class="btn btn-primary" value="Save"  />
			   	</div>
			  </div>
		</fieldset>
	</form>
	</div> 
</div> 

<script language='JavaScript' type='text/javascript' src='<?php echo base_url();?>assets/js/tiny_mce/tiny_mce.js'></script>
<script type="text/javascript">
 
tinyMCE.init({
// General options
mode : "textareas",
theme : "advanced", 
plugins : "",

// Theme options
theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect,|,undo,redo",
theme_advanced_buttons2 : "",
theme_advanced_toolbar_location : "top",
theme_advanced_toolbar_align : "left",
theme_advanced_resizing : true,

// Example content CSS (should be your site CSS)
content_css : "css/content.css",

// Drop lists for link/image/media/template dialogs
template_external_list_url : "lists/template_list.js",
external_link_list_url : "lists/link_list.js", 

// Style formats
style_formats : [
{title : 'Bold text', inline : 'b'},
{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
{title : 'Table styles'},
{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
],

// Replace values for the template plugin
template_replace_values : {
username : "Some User",
staffid : "991234"
}
});

function validatepersentase(){
	var persenharian 	= $("#harian").val();
	var persennormatif 	= $("#normatif").val();
	var persenuts 		= $("#uts").val();
	var persenuas 		= $("#uas").val();
	if(persenharian == "")
		persenharian = 0;
	if(persennormatif == "")
		persennormatif = 0;
	if(persenuts == "")
		persenuts = 0;
	if(persenuas == "")
		persenuas = 0;
	var jumlah = parseFloat(persenharian) + parseFloat(persennormatif) + parseFloat(persenuts) + parseFloat(persenuas);
	if(jumlah < 100 || jumlah > 100){
		alert("Persentase harus total 100 persen");
	}
	return false;
}

</script>
<script>

$("#btnsubmit").click(function(){
	var json_url = "<?php echo base_url() ?>admin/settings/jadwal/savemateri";
	 
	 $.ajax({    
		type: "POST",
		url: json_url,
		data: $("#frmmateri").serialize(),
		success: function(data){ 
			swal(data, "Warning");
			//location.reload(true);
		}});
	return false; 
});	
 
</script>


