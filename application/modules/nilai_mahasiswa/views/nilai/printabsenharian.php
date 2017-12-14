<script src="<?php echo base_url(); ?>themes/admin/js/sweetalert.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/css/sweetalert.css">

<?php
	$this->load->library('convert');
	$convert = new convert();
  // Change the css classes to suit your needs
if( isset($datamahasiswa) ) {
//    $datamahasiswa = (array)$datamahasiswa;
}
$id = isset($datakrs['id']) ? $datakrs['id'] : '';
?>
 <div style="margin-left:11px;margin-top:0px;"> 
   <form action="<?php $this->uri->uri_string() ?>" method="post" id="frmnilai" accept-charset="utf-8">
   <table border="0" style="font-size:10px;" width="100%">
    	<tr>
            <td align="left" width="100px" > Program Studi</td>
            <td align="left" width="10px">:</td>
            <td align="left" width="250px"><?php echo isset($nama_jurusan)?$nama_jurusan:"" ?></td>
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
            	[Harian :
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
        </tr>
		
    </table>
    
    <table border="1" width="100%" class="">
	<tr>
		 <th style="padding:5px;" width="20px" rowspan="2">No</th>
		 <th style="padding:5px;" width="100px" rowspan="2">NIM</th>
		 <th style="padding:5px;" rowspan="2">Nama</th>
		 <th style="padding:5px;" width="200px" colspan="16">
		 	Pertemuan
		 </th>
	</tr>
	<tr>
		<?php for($i=1;$i<17;$i++){ ?>
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
					
				?> 
				  
				  <tr>
					<td valign="middle" align="center" style="padding:5px;"> <?php echo $no; ?>. </td>
					<td valign="middle" align="left" style="padding:5px;"> <?php echo isset( $record->mahasiswa) ? $record->mahasiswa : ''; ?></td>
			 		<td valign="middle" align="left" style="padding:5px;"> 
			 			<input type="hidden" name="id_krs[]" id="id_krs_<?php echo $no; ?>" value="<?php echo isset( $record->id) ? $record->id : ''; ?>" width="50px"/>
			 			<?php echo isset( $record->nama_mahasiswa) ? $record->nama_mahasiswa : ''; ?></td>
					<?php for($i=1;$i<17;$i++){ ?>
					<td align="center">
						<input type="checkbox" <?php echo isset($dataabsen[$record->mahasiswa."_".$i]) ? "checked" :""; ?> class="chkabsen_<?php echo $i; ?> chkabsen" pertemuan="<?php echo $i; ?>" kode_mk="<?php echo $kode_mk; ?>" mhs="<?php echo $record->mahasiswa; ?>" jurusan="<?php echo $jurusan; ?>"  dosen="<?php echo $nidn; ?>" kelas="<?php echo $kelas; ?>" name="chk_<?php echo $i."_".$record->mahasiswa; ?>" value="1">
						<div id="div_<?php echo $i; ?>_<?php echo $record->mahasiswa; ?>"></div>
					</td>
					 <?php } ?>
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
	</table>
	<br>
	<center>
	<a href="<?php echo base_url()."admin/krs/cetakdata/printdaftarhadirnew/print?";?>kode_jadwal=<?php echo isset($kode_jadwal)?$kode_jadwal : ""; ?>&kode_mk=<?php echo $kode_mk; ?>&kelas=<?php echo $kelas; ?>&filljurusan=<?php echo $jurusan; ?>&tahun=<?php echo $tahun; ?>" target="_blank" class="btn btn-xs btn-warning"><i class="fa fa-print"></i> Print</a>
	</center>
</div> 
<br>
 
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
	<?php for($i=1;$i<17;$i++){ ?>
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
						$(".chkabsen_<?php echo $i; ?>").prop("checked", $(".select_<?php echo $i; ?>").prop("checked"));
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
							  $(".chkabsen_<?php echo $i; ?>").prop("checked", $(".select_<?php echo $i; ?>").prop("unchecked"));
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