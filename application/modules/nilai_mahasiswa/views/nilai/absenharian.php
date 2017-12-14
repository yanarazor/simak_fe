<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminlte/css/dropzone/dropzone.min.css">
<script src="<?php echo base_url(); ?>themes/admin/js/dropzone/dropzone.min.js"></script>
<!-- sweet alert -->
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminlte/plugins/datepicker/datepicker3.css">
<script src="<?php echo base_url(); ?>themes/adminlte/js/sweetalert.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminlte/css/sweetalert.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.timepicker.css" media="screen" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.timepicker.js"></script>
<?php
	$this->load->library('convert');
	$convert = new convert();
  // Change the css classes to suit your needs
if( isset($datamahasiswa) ) {
//    $datamahasiswa = (array)$datamahasiswa;
}
$id = isset($datakrs['id']) ? $datakrs['id'] : '';
?>
<div class="box box-info">
  <div class="box-body">
   <form action="<?php $this->uri->uri_string() ?>" method="post" id="frmnilai" accept-charset="utf-8">
   <table border="0" style="font-size:10px;" width="100%">
    	<tr>
            <td align="left" width="100px" > Program Studi</td>
            <td align="left" width="10px">:</td>
            <td align="left" width="350px"><?php echo isset($nama_jurusan)?$nama_jurusan:"" ?></td>
            <td>&nbsp;</td>
            <td  width="100px"></td>
            <td align="left" width="10px"></td>
            <td></td>
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
            <td><?php echo isset($dosen) ? $dosen:"" ?> 
            	[Tugas 1 :
			   	<?php echo isset($bobot_harian) ? $bobot_harian : "" ?>%, 
			   	Tugas :
			   	<?php echo isset($normatif) ? $normatif : "" ?>%, 
				UTS :
			   	<?php echo isset($uts) ? $uts : "" ?>%, 
				UAS :
			   	<?php echo isset($uas) ? $uas : "" ?>%]
			</td>
            <td>&nbsp;</td>
            <td width="100px">KELAS</td>
            <td align="left" width="10px">:</td>
            <td><?php echo isset($kelas)?$kelas:"" ?></td>
        </tr>
		<tr>
        	 
            <td align="left">Semester </td>
            <td align="left">:</td>
            <td ><?php echo $tahunakademik; ?></td>
            <td>&nbsp;</td>
            <td width="200px">JUMLAH MAHASISWA</td>
            <td align="left" width="10px">:</td>
             <td>
             <?php if (isset($records) && is_array($records) && count($records)) : 
             	$no = 1;
				  echo count($records);
				  else :
					  echo "0";
			   endif;
			   ?>
             </td>
             <td align="right">
             	 
				 <a href="<?php echo base_url()."admin/krs/cetakdata/printdaftarhadirnew/print?";?>kode_jadwal=<?php echo isset($kode_jadwal)?$kode_jadwal : ""; ?>&kode_mk=<?php echo $kode_mk; ?>&kelas=<?php echo $kelas; ?>&filljurusan=<?php echo $jurusan; ?>&tahun=<?php echo $tahun; ?>" target="_blank" class="btn btn-xs btn-warning"><i class="fa fa-print-o"></i> Print</a>
				 <a href="<?php echo base_url(); ?>admin/reports/dashboard_kprd/printlaporandosen/simple/<?php echo $kode_jadwal;?>?kode_mk=<?php echo $kode_mk;?>&kelas=<?php echo $kelas;?>&tahun=<?php echo $tahun;?>&filljurusan=<?php echo $jurusan; ?>" target="_blank" class="btn btn-xs btn-warning"><i class="fa fa-print"></i> Print Laporan</a>
			</td>
             
        </tr>
		
    </table>
    
    <table border="1" width="100%" class="">
	<tr>
		 <th style="padding:5px;" width="20px" rowspan="2">No</th>
		 <th style="padding:5px;" width="100px" rowspan="2">NIM</th>
		 <th style="padding:5px;" rowspan="2">Nama</th>
		 <th style="padding:5px;" width="200px" colspan="<?php echo $jml_pertemuan != "" ? $jml_pertemuan : 1; ?>">
		 	Pertemuan
		 </th>
		 <th width="30px" rowspan="2">Persentase</th>
		 <th width="30px" rowspan="2">UTS</th>
		 <th width="30px" rowspan="2">UAS</th>
	</tr>
	<tr>
		<?php for($i=1;$i<($jml_pertemuan+1);$i++){ ?>
			<th style="padding:5px;">
			   <?php echo $i; ?>
			   <br>
			   <input type="checkbox" class="select_<?php echo $i; ?>" pertemuan="<?php echo $i; ?>" kode_mk="<?php echo $kode_mk; ?>" jurusan="<?php echo $jurusan; ?>"  dosen="<?php echo $nidn; ?>" kelas="<?php echo $kelas; ?>" value="1">
			</th>
		<?php } ?>
	 </tr>
	 
     
    
    	 <?php 
    	 		$semester = 0;
    	 		$hal = 1;
				if (isset($records) && is_array($records) && count($records)) : 
					 
					$no = 1;
					
					 foreach ($records as $record) :
					$persentase = 0;
					$jmlada = 0;
				?> 
				  
				  <tr>
					<td valign="middle" align="center" style="padding:5px;"> <?php echo $no; ?>. </td>
					<td valign="middle" align="left" style="padding:5px;"> <?php echo isset( $record->mahasiswa) ? $record->mahasiswa : ''; ?></td>
			 		<td valign="middle" align="left" style="padding:5px;"> 
			 			<input type="hidden" name="id_krs[]" id="id_krs_<?php echo $no; ?>" value="<?php echo isset( $record->id) ? $record->id : ''; ?>" width="50px"/>
			 			<?php echo isset( $record->nama_mahasiswa) ? $record->nama_mahasiswa : ''; ?></td>
					<?php for($i=1;$i<($jml_pertemuan+1);$i++){ 
						if(isset($dataabsen[$record->mahasiswa."_".$i])){
							$jmlada = $jmlada + 1;
						}
						//echo $jmlada;
					?>
					<td align="center">
						<input type="checkbox" <?php echo isset($dataabsen[$record->mahasiswa."_".$i]) ? "checked" :""; ?> class="chkabsen_<?php echo $i; ?> chkabsen" pertemuan="<?php echo $i; ?>" kode_mk="<?php echo $kode_mk; ?>" mhs="<?php echo $record->mahasiswa; ?>" jurusan="<?php echo $jurusan; ?>"  dosen="<?php echo $nidn; ?>" kelas="<?php echo $kelas; ?>" name="chk_<?php echo $i."_".$record->mahasiswa; ?>" value="1">
						<div id="div_<?php echo $i; ?>_<?php echo $record->mahasiswa; ?>"></div>
					</td>
					 <?php } ?>
					<td align="center">
						<?php 
							$persentase = $jmlada/$jml_pertemuan * 100;
							echo round($persentase)."%";
							$jmlada = 0;
						?>
					</td>
					<td align="center">
						<input type="checkbox" <?php echo isset($dataabsen[$record->mahasiswa."_uts"]) ? "checked" :""; ?> class="chkabsen_<?php echo $i; ?> chkabsen" pertemuan="uts" kode_mk="<?php echo $kode_mk; ?>" mhs="<?php echo $record->mahasiswa; ?>" jurusan="<?php echo $jurusan; ?>"  dosen="<?php echo $nidn; ?>" kelas="<?php echo $kelas; ?>" name="chk_uts<?php echo "_".$record->mahasiswa; ?>" value="1">
						<div id="div_uts_<?php echo $record->mahasiswa; ?>"></div>
					</td>
					<td align="center">
						<input type="checkbox" <?php echo isset($dataabsen[$record->mahasiswa."_uas"]) ? "checked" :""; ?> class="chkabsen_<?php echo $i; ?> chkabsen" pertemuan="uas" kode_mk="<?php echo $kode_mk; ?>" mhs="<?php echo $record->mahasiswa; ?>" jurusan="<?php echo $jurusan; ?>"  dosen="<?php echo $nidn; ?>" kelas="<?php echo $kelas; ?>" name="chk_uas<?php echo "_".$record->mahasiswa; ?>" value="1">
						<div id="div_uas_<?php echo $record->mahasiswa; ?>"></div>
					</td>
				  </tr>
        		<?php 
        		$hal++;
        		$no++;
					endforeach; 
				endif;
				?>
		<?php //if (isset($records) && is_array($records) && count($records)) : 
				?>
				 
				<?php
				   
		 // endif;
		  ?>	 
		  <tr>
			<td valign="middle" align="center" style="padding:5px;" colspan="3">Absen Dosen :
				<input type="hidden" name="id_krs[]" id="id_krs_<?php echo $no; ?>" value="<?php echo isset( $record->id) ? $record->id : ''; ?>" width="50px"/>
			</td>
			<?php for($i=1;$i<($jml_pertemuan+1);$i++){ ?>
			<td align="center">
				<?php //echo $nidn; ?>
				<input type="checkbox" <?php echo isset($dataabsen[$nidn."_".$i]) ? "checked" :""; ?> class="chkdosen_<?php echo $i; ?> chkdosen" pertemuan="<?php echo $i; ?>" kode_mk="<?php echo $kode_mk; ?>" mhs="<?php echo $nidn; ?>" jurusan="<?php echo $jurusan; ?>"  dosen="<?php echo $nidn; ?>" kelas="<?php echo $kelas; ?>" name="chk_<?php echo $i."_".$nidn; ?>" value="1">
				<div id="div_<?php echo $i; ?>_<?php echo $nidn; ?>"></div>
			</td>
			 <?php } ?>
			 <td>
			 </td>
			 <td>
			 </td>
			 <td>
			 </td>
		  </tr>
		  <tr>
			<td valign="middle" align="right" style="padding:5px;" colspan="3">Materi :
			</td>
			<?php for($i=1;$i<($jml_pertemuan+1);$i++){ ?>
			<td align="center">
				<?php if(isset($datamateri[$i])){; ?>
					<a href="<?php echo base_url(); ?>admin/nilai/nilai_mahasiswa/lihatmateri/<?php echo $datamateri[$i]; ?>" target="_blank">Lihat</a>
				<?php } ?>
			</td>
			 <?php } ?>
			 <td>
			 </td>
			 <td>
			 </td>
			 <td>
			 </td>
		  </tr>
	</table>
	</form>
	
	<h3>Materi</h3>
	 <?php echo form_open($this->uri->uri_string(), 'id="frmmateri"'); ?>
	  	<div class="control-group <?php echo form_error('pertemuan') ? 'error' : ''; ?> col-sm-12">
		  <input id='id_data' type='hidden' name='id_data' maxlength="10" value="" />
		  <input id='kode_jadwal' type='hidden' name='kode_jadwal' maxlength="20" value="<?php echo set_value('kode_jadwal', isset($kode_jadwal) ? $kode_jadwal : ''); ?>" />
		  <?php echo form_label("Pertemuan", 'permasalahan', array('class' => 'control-label')); ?>
		   <div class='controls'>
			   <select name="pertemuan" id="pertemuan" class="chosen-select-deselect form-control" required>
				   <option value="">Pilih Pertemuan</option>
					 <?php for($i=1;$i<($jml_pertemuan+1);$i++){ ?>
					   <option value="<?php echo $i;?>">Pertemuan ke <?php echo $i; ?></option>
					 <?php }?>
			   </select>
		   </div>
	  </div>
	  <div class="form-group col-sm-4">
			<label for="inputNama" class="control-label">Tanggal</label>
			<div class="input-group date">
				<div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				</div>
				<input type="text" id='tanggal' name='tanggal' class="form-control pull-right datepicker" value="<?php echo date("Y-m-d"); ?>">
				<span class='help-inline'><?php echo form_error('tanggal'); ?></span>
			</div>
		</div> 
		<div class="form-group col-sm-4">
			<label for="inputNama" class="control-label">Jam Mulai</label>
			<div class="input-group date">
				<div class="input-group-addon">
					<i class="fa fa-clock-o"></i>
				</div>
				<input type="text" id='jam_mulai' name='jam_mulai' class="form-control pull-right timeformat" value="<?php echo date("G:i:s"); ?>">
				<span class='help-inline'><?php echo form_error('jam_mulai'); ?></span>
			</div>
		</div> 
		<div class="form-group col-sm-4">
			<label for="inputNama" class="control-label">Jam Selesai</label>
			<div class="input-group date">
				<div class="input-group-addon">
					<i class="fa fa-clock-o"></i>
				</div>
				<input type="text" id='jam_selesai' name='jam_selesai' class="form-control pull-right timeformat" value="<?php echo date("G:i:s"); ?>">
				<span class='help-inline'><?php echo form_error('jam_selesai'); ?></span>
			</div>
		</div> 
		<div class="control-group <?php echo form_error('desc_materi') ? 'error' : ''; ?> col-sm-6">
			<?php echo form_label('Materi Pertemuan', 'desc_materi', array('class' => 'control-label') ); ?>
			<div class='controls'>
				<textarea name="desc_materi" cols="30" rows="5" id="desc_materi" class="form-control" ></textarea>
				<span class='help-inline'><?php echo form_error('desc_materi'); ?></span>
			</div>
		</div>
	  	<div class="control-group <?php echo form_error('nama_dokumen') ? 'error' : ''; ?> col-sm-6">
	  	  <?php echo form_label('File Materi', 'desc_materi', array('class' => 'control-label') ); ?>
		  <div class='controls'>
			 <div class="dropzone well well-sm">
			 </div>
			 <input id='file_materi' type='hidden' name='file_materi' maxlength="100" value="<?php echo set_value('file_materi', isset($jadwal['file_materi']) ? $jadwal['file_materi'] : ''); ?>" />
		</div>
	  </div>
		
	</div>
    <div class="box-footer">
				  <input type="button" name="save" id="btnsubmit" class="btn btn-primary" value="Save"  />
			   	</div>

	</form>
</div> 
<script language='JavaScript' type='text/javascript' src='<?php echo base_url(); ?>themes/adminlte/plugins/select2/select2.full.min.js'></script>
<script src="<?php echo base_url(); ?>themes/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
    //Date picker
    $('.datepicker').datepicker({
      autoclose: true,format: 'yyyy-mm-dd'
    });
	$('.timeformat').timepicker({ 'timeFormat': 'H:i:s' });
</script>
<script type="text/javascript">	  
	$('.chkabsen').change(function () {
		var kode_mk = encodeURIComponent($(this).attr("kode_mk"));
		var varjurusan = encodeURIComponent($(this).attr("jurusan"));
		var vardosen = encodeURIComponent($(this).attr("dosen"));
		var varkelas = encodeURIComponent($(this).attr("kelas"));
		var varmahasiswa = encodeURIComponent($(this).attr("mhs"));
		var varpertemuan = encodeURIComponent($(this).attr("pertemuan"));
		var varkodejadwal = "<?php echo $kode_jadwal; ?>";

	   	var post_data = "kode_jadwal="+varkodejadwal+"&mhs="+varmahasiswa+"&kode_mk="+kode_mk+"&jurusan="+varjurusan+"&dosen="+vardosen+"&kelas="+varkelas+"&pertemuan="+varpertemuan;
	   	var aksi = "";
	   	if (!$(this).is(':checked')) {
			 //this.checked = confirm("Tidak hadir?");
			 aksi = "<?php echo base_url() ?>admin/nilai/nilai_mahasiswa/delabsenharian";
		 }else{
		 	 aksi = "<?php echo base_url() ?>admin/nilai/nilai_mahasiswa/saveabsenharian";
		 }
    	//alert(aksi+"?"+post_data);
		$.ajax({
			url: aksi,
			type:"POST",
			data: post_data,
			dataType: "html",
			timeout:180000,
			success: function (result) {
 			 	//alert(result);
				$("#div_"+varpertemuan+"_"+varmahasiswa).html(result)

		},
			error : function(error) {
				alert(error);
			} 
		});        
	});
	$('.chkdosen').change(function () {
		var kode_mk = encodeURIComponent($(this).attr("kode_mk"));
		var varjurusan = encodeURIComponent($(this).attr("jurusan"));
		var vardosen = encodeURIComponent($(this).attr("dosen"));
		var varkelas = encodeURIComponent($(this).attr("kelas"));
		var varmahasiswa = encodeURIComponent($(this).attr("mhs"));
		var varpertemuan = encodeURIComponent($(this).attr("pertemuan"));
		var varkodejadwal = "<?php echo $kode_jadwal; ?>";

	   	var post_data = "kode_jadwal="+varkodejadwal+"&mhs="+varmahasiswa+"&kode_mk="+kode_mk+"&jurusan="+varjurusan+"&dosen="+vardosen+"&kelas="+varkelas+"&pertemuan="+varpertemuan;
	   	var aksi = "";
	   	if (!$(this).is(':checked')) {
			 //this.checked = confirm("Tidak hadir?");
			 aksi = "<?php echo base_url() ?>admin/nilai/nilai_mahasiswa/delabsenharian";
		 }else{
		 	 aksi = "<?php echo base_url() ?>admin/nilai/nilai_mahasiswa/saveabsenharian";
		 }
    	//alert(aksi+"?"+post_data);
		$.ajax({
			url: aksi,
			type:"POST",
			data: post_data,
			dataType: "html",
			timeout:180000,
			success: function (result) {
 			 	//alert(result);
				$("#div_"+varpertemuan+"_"+varmahasiswa).html(result)

		},
			error : function(error) {
				alert(error);
			} 
		});        
	});
	$('#pertemuan').change(function () {
		// $("#loading-all").show();
		 swal("Tunggu sebentar sedang mencari data");
		var varpertemuan = $("#pertemuan").val();
		var varkodejadwal = "<?php echo $kode_jadwal; ?>";
		var json_url = "<?php echo base_url() ?>admin/nilai/nilai_mahasiswa/getinfomateri/?pertemuan="+varpertemuan+"&kode_jadwal="+varkodejadwal;
		//alert(json_url);
		$.ajax({    
		type: "POST",
		url:json_url,
		data: "",
		dataType: 'json',
		success: function(data){
		   if(data.kode_tabel != "")
		   {
			   swal("Materi sudah pernah diinput, jika ingin merubah silahkan isi kembali deskripsi materi..");
			   $('#id_data').val(data.kode_tabel);
			   //$('#desc_materi').val(data.desc_materi);
			   $('textarea[name=desc_materi]').val(data.desc_materi);
			   $('#file_materi').val(data.file_materi);
			   $('#tanggal').val(data.tanggal);
			   $('#jam_mulai').val(data.jam_mulai);
			   $('#jam_selesai').val(data.jam_selesai);
		   }else{
		   	   swal("Materi belum pernah diinput..");
		   	   $('#id_data').val("");
			   $('#desc_materi').val("");
			   $('#file_materi').val("");
			   $('#tanggal').val("");
			   $('#jam_mulai').val("");
			   $('#jam_selesai').val("");
		   }
		   
		   
		},
		   error : function(error) {
			   alert(error);
		   } 
		});
   
	});
	<?php for($i=1;$i<($jml_pertemuan+1);$i++){ ?>
		$(".select_<?php echo $i;?>").click(function() {
			var kode_mk = encodeURIComponent($(".select_<?php echo $i;?>").attr("kode_mk"));
			var varjurusan = encodeURIComponent($(".select_<?php echo $i;?>").attr("jurusan"));
			var vardosen = encodeURIComponent($(".select_<?php echo $i;?>").attr("dosen"));
			var varkelas = encodeURIComponent($(".select_<?php echo $i;?>").attr("kelas"));
			var varpertemuan = encodeURIComponent($(".select_<?php echo $i;?>").attr("pertemuan"));
			var vartahun = "<?php echo $tahun; ?>";
			var varkodejadwal = "<?php echo $kode_jadwal; ?>";
		  var kode = $(this).attr("<?php echo $i; ?>");
			swal({
			title: "anda yakin?",
			text: "Klik Hadir jika mahasiswa hadir semua, dan klik tidak hadir semua untuk sebaliknya?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Hadir semua!",
			cancelButtonText: "Tidak hadir semua!",
			closeOnConfirm: false,
			closeOnCancel: false
		 },
		 function(isConfirm){
		   if (isConfirm) {
			
			var post_data = "kode_jadwal="+varkodejadwal+"&kode_mk="+kode_mk+"&jurusan="+varjurusan+"&dosen="+vardosen+"&kelas="+varkelas+"&pertemuan="+varpertemuan+"&tahun="+vartahun;
			var aksi = "<?php echo base_url() ?>admin/nilai/nilai_mahasiswa/saveaallbsenharian";
			//alert(aksi+"?"+post_data);
			$.ajax({
					url: aksi,
					type:"POST",
					data: post_data,
					dataType: "html",
					timeout:180000,
					success: function (result) {
						swal("Hadir semua!", result, "success");
						$(".chkabsen_<?php echo $i; ?>").prop("checked", true);
				},
				error : function(error) {
					alert("Ada error "+error);
				} 
			});        
		   } else {
		   		var post_data = "kode_jadwal="+varkodejadwal+"&kode_mk="+kode_mk+"&jurusan="+varjurusan+"&dosen="+vardosen+"&kelas="+varkelas+"&pertemuan="+varpertemuan+"&tahun="+vartahun;
				var aksi = "<?php echo base_url() ?>admin/nilai/nilai_mahasiswa/delaallbsenharian";
				$.ajax({
						url: aksi,
						type:"POST",
						data: post_data,
						dataType: "html",
						timeout:180000,
						success: function (result) {
							swal("Tidak Hadir semua!", result, "success");
							$(".chkabsen_<?php echo $i; ?>").prop("checked", false);
					},
					error : function(error) {
						alert(error);
					} 
				}); 
		   }
		 });
		 
		});
	<?php } ?>
	
</script>

<script>

$("#btnsubmit").click(function(){
	var valmasalah = $("#pertemuan").val();
	var valdesc_materi = $("#desc_materi").val();
	//alert($("#frmmateri").serialize());
	if(valmasalah == ""){
		$("#pertemuan").focus();	
		swal("Silahkan pilih pertemuan", "Warning");
		return false;
	}
	if(valdesc_materi == ""){
		$("#desc_materi").focus();	
		swal("Silahkan isi deskripsi materi", "Warning");
		return false;
	}
	var json_url = "<?php echo base_url() ?>admin/nilai/nilai_mahasiswa/savemateri";
	 $.ajax({    
		type: "POST",
		url: json_url,
		data: $("#frmmateri").serialize(),
		success: function(data){ 
			swal(data, "Warning");
			//location.reload(true);
		}});
	//return false; 
});	
Dropzone.autoDiscover = true;
	//alert("<?php echo base_url() ?>admin/nilai/nilai_mahasiswa/saveberkas");
    var foto_upload= new Dropzone(".dropzone",{
    	 autoProcessQueue: true,
		 url: "<?php echo base_url() ?>admin/nilai/nilai_mahasiswa/saveberkas",
		 maxFilesize: 50,
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
			   		if(data_n.namafile != ""){
			   			$("#file_materi").val(data_n.namafile);
				   		swal("File materi telah di upload, silahkan lanjutkan simpan data", "Warning");
					}else{
						swal("Ada masalah", "error");
					}
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


