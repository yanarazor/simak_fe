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
            <td align="left" width="50px" > Program Studi</td>
            <td align="left" width="10px">:</td>
            <td align="left" width="250px"><?php echo isset($nama_jurusan)?$nama_jurusan:"" ?></td>
            <td>&nbsp;</td>
            <td  width="50px"></td>
            <td align="left" width="10px"></td>
            <td></td>
        </tr>
        <tr>
            <td align="left"> Mata Kuliah  </td>
            <td align="left">:</td>
            <td><?php echo isset($nama_mk)?$nama_mk:"" ?></td>
            <td>&nbsp;</td>
            <td width="50px"></td>
            <td align="left" width="10px"></td>
            <td>
              
             </td>
        </tr>
        
       <tr>
        	 
            <td align="left">Dosen</td>
            <td align="left">:</td>
            <td><?php echo isset($dosen) ? $dosen:"" ?></td>
            <td>&nbsp;</td>
            <td width="50px">KELAS</td>
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
	<table class='table table-striped table-bordered'>
	<tr>
		 <th style="padding:5px;" width="20px" rowspan="2">No</th>
		 <th style="padding:5px;" width="50px" rowspan="2">NIM</th>
		 <th style="padding:5px;" rowspan="2">Nama</th>
		 <th style="padding:5px;" width="200px" colspan="5">Nilai</th>
	</tr>
	<tr>
		 <th style="padding:5px;">Tugas 1
		 	<br>
		 	<input type="hidden" name="bobot_harian" id="bobot_harian" class="auto" data-v-max="100" data-v-min="0" value="<?php echo isset( $bobot_harian) ? $bobot_harian : ''; ?>" style="width:50px"/>
		 	<span class="add-on"><?php echo isset( $bobot_harian) ? $bobot_harian : ''; ?>%</span>
		 </th>
		 <th style="padding:5px;">Tugas 2
		 	<br>
		 	<input type="hidden" name="normatif" id="normatif" class="auto" data-v-max="100" data-v-min="0" value="<?php echo isset( $normatif) ? $normatif : ''; ?>" style="width:50px"/>
		 	<span class="add-on"><?php echo isset( $normatif) ? $normatif : ''; ?>%</span>
		 </th>
		 <th style="padding:5px;">UTS <br>
		 	<input type="hidden" name="uts" id="uts" class="auto" data-v-max="100" data-v-min="0" value="<?php echo isset( $uts) ? $uts : ''; ?>" style="width:50px"/>
		 	<span class="add-on"><?php echo isset( $uts) ? $uts : ''; ?>%</span>
		 </th>
		 <th style="padding:5px;">UAS <br>
		 	<input type="hidden" name="uas" id="uas" class="auto" data-v-max="100" data-v-min="0" value="<?php echo isset( $uas) ? $uas : ''; ?>" style="width:50px"/>
		 	<span class="add-on"><?php echo isset( $uas) ? $uas : ''; ?>%</span>
		 </th>
		 <th style="padding:5px;">Nilai Akhir</th>
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
			 		<td valign="middle" align="left" style="padding:5px;"> <?php echo isset( $record->nama_mahasiswa) ? $record->nama_mahasiswa : ''; ?></td>
					<td align="center">
						<input type="text" name="harian[]" id="harian_<?php echo $no; ?>" onchange="hitung('<?=$no?>')" class="auto" data-v-max="100" data-v-min="0" value="<?php echo isset( $record->harian) ? $record->harian : ''; ?>" style="width:50px"/>
						<input type="hidden" name="id_krs[]" id="id_krs_<?php echo $no; ?>" value="<?php echo isset( $record->id_krs) ? $record->id_krs : ''; ?>" width="50px"/>
					</td>
					<td align="center" valign="middle">
						<input type="text" name="normatif[]" id="normatif_<?php echo $no; ?>" onchange="hitung('<?=$no?>')" class="auto" data-v-max="100" data-v-min="0" value="<?php echo isset( $record->normatif) ? $record->normatif : ''; ?>" style="width:50px"/>
						
					</td>
					<td align="center">
						<input type="text" name="nilaiuts[]" id="nilaiuts_<?php echo $no; ?>" onchange="hitung('<?=$no?>')" class="auto" data-v-max="100" data-v-min="0" value="<?php echo isset( $record->uts) ? $record->uts : ''; ?>" style="width:50px"/>
					</td>
					<td align="center">
						<input type="text" name="nilaiuas[]" id="nilaiuas_<?php echo $no; ?>" onchange="hitung('<?=$no?>')" class="auto" data-v-max="100" data-v-min="0"  value="<?php echo isset( $record->uas) ? $record->uas : ''; ?>" style="width:50px"/>
					</td>
					<td align="center">
						<input type="text" name="nilaiangka[]" readonly id="nilaiangka_<?php echo $no; ?>" placeholder="Angka" class="auto" data-v-max="100" data-v-min="0" value="<?php echo isset( $record->nilai_angka) ? $record->nilai_angka : ''; ?>" style="width:50px"/>
						<input type="text" name="nilaiakhir[]" readonly id="nilaiakhir_<?php echo $no; ?>" placeholder="Huruf" value="<?php echo isset( $record->nilai_huruf) ? $record->nilai_huruf : ''; ?>" style="width:50px"/>
					</td>
					 
				  </tr>
        		<?php 
        		$hal++;
        		$no++;
					endforeach; 
				else:
				?>
				<td colspan="8">Mahasiswa tidak ada</td>
				<?php
				endif;
				?>
		<?php //if (isset($records) && is_array($records) && count($records)) : 
				?>
				 
				<?php
				   
		 // endif;
		  ?>	 
	</table>
	</div>
	<div class="box-footer">
	  <input type="submit" name="simpan" class="btn btn-primary" id="btnsimpan" value=" Simpan Nilai "  />
	  <a href="<?php echo base_url()."admin/nilai/nilai_mahasiswa/viewmahasiswaprint/print/".$kode_jadwal;?>?kode_jadwal=<?php echo isset($kode_jadwal)?$kode_jadwal : ""; ?>&kode_mk=<?php echo $kode_mk; ?>&kelas=<?php echo $kelas; ?>&filljurusan=<?php echo $jurusan; ?>&tahun=<?php echo $tahun; ?>" target="_blank" class="btn btn-warning"><i class="fa fa-print"></i> Print</a>
	</div> 
</div> 
</div> 
<script type="text/javascript">	  
 
	function hitung(no)
	 {
	 	var harianval = $("#harian_"+no).val() != "" ? $("#harian_"+no).val() : 0;
	 	var normatifval = $("#normatif_"+no).val() != "" ? $("#normatif_"+no).val() : 0;
	 	var utsval 		= $("#nilaiuts_"+no).val() != "" ? $("#nilaiuts_"+no).val() : 0;
	 	var uasval 		= $("#nilaiuas_"+no).val() != "" ? $("#nilaiuas_"+no).val() : 0;
	 	
	 	var bobotharian = $("#bobot_harian").val();//<?php echo $bobot_harian != "" ? (int)$bobot_harian : 0 ; ?>;
	 	var bobotnormatif = $("#normatif").val();//<?php echo $normatif != "" ? (int)$normatif : 0 ; ?>;
	 	var bobotuts = $("#uts").val();;//<?php echo $uts != "" ? (int)$uts : 0 ; ?>;
	 	var bobotuas = $("#uas").val();;// <?php echo $uas != "" ? (int)$uas : 0 ; ?>;
	 	
	 	var nilaiharian = (bobotharian/100) * harianval;
	 	var normatif = (bobotnormatif/100) * normatifval;
	 	var uts = (bobotuts/100) * utsval;
	 	var uas = (bobotuas/100) * uasval;
	 	
	 	var hasil = nilaiharian + normatif + uts + uas;
	 	$("#nilaiangka_"+no).val(roundToTwo(hasil));
	 	// cek huruf
	 	var post_data = "nilai="+hasil;
	 	$.ajax({
				url: "<?php echo base_url() ?>admin/master/range_nilai/getnilai",
				type:"POST",
				data: post_data,
				dataType: "html",
				timeout:180000,
				success: function (result) {
					if(result!=""){
					 	$("#nilaiakhir_"+no).val(result);
					}else{
						alert("Nilai belum diketahui, silahkan hubungi akademik/Administrator");
					}
			},
			error : function(error) {
				alert(error);
			} 
		});        
	 	//alert(normatif+" - "+ utsval +" - "+uas);
	 	
		//return false;
	 }
 
 function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}
$("#btnsimpan").click( function() {
	var post_data = $( "#frmnilai" ).serialize();
	 $.ajax({
			 url: "<?php echo base_url() ?>admin/nilai/nilai_mahasiswa/updatenilai?simpan=1",
			 type:"POST",
			 data: post_data,
			 dataType: "html",
			 timeout:180000,
			 success: function (result) {
				  alert(result);
		 },
		 error : function(error) {
			 alert(error);
		 } 
	 });        
	//return false;
});
</script>