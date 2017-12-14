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
            <td><?php echo isset($dosen)?$dosen:"" ?></td>
            <td>&nbsp;</td>
            <td width="100px">KELAS</td>
            <td align="left" width="10px">:</td>
            <td><?php echo isset($kelas)?$kelas:"" ?></td>
        </tr>
		<tr>
        	 
            <td align="left">Semester </td>
            <td align="left">:</td>
            <td ><?php echo $sms%2==1 ? "Ganjil":"Genap";?> <?php echo $this->settings_lib->item('site.tahunajaran'); ?></td>
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
    <table border="1" width="100%" class="table">
	<tr>
		 <th style="padding:5px;" width="20px">No</th>
		 <th style="padding:5px;" width="100px">NIM</th>
		 <th style="padding:5px;" width="200px">Nama</th>
		 <th style="padding:5px;">Nilai</th>
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
					<td>
						<input type="text" name="nilaimhs[]" value="<?php echo isset( $record->nilai_huruf) ? $record->nilai_huruf : ''; ?>" width="200px"/> A, B, C, D, E
						<input type="hidden" name="id_krs[]" value="<?php echo isset( $record->id) ? $record->id : ''; ?>" width="200px"/>
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
	</table>
	<br>
	  <input type="submit" name="simpan" class="btn btn-primary" value=" Simpan Nilai "  />
</div> 
<script type="text/javascript">	  
	  
$("#frmnilai").submit( function() {
	var post_data = $( "#frmnilai" ).serialize();
	 
	$.ajax({
			url: "<?php echo base_url() ?>index.php/admin/nilai/nilai_mhs/updatenilai?simpan=1",
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
		return false;
	});
</script>