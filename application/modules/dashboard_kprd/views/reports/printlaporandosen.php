<style>
 
@media print {
    body {
		font-weight:normal;
      font-style:normal;
      font-variant:normal;
	
		font-size : 11pt;
		line-height:15px;
    }
	
	@font-face {
		font-family: "Times New Roman", Times, serif;
		/*
		src: url('../font/DOTMATRI.eot');
		src: url('../font/DOTMATRI.eot?#iefix') format('embedded-opentype'),
			 url('../font/DOTMATRI.woff') format('woff'),
			 url('../font/DOTMATRI.ttf') format('truetype'),
			 url('../font/DOTMATRI.svg#proxima_nova_rgregular') format('svg');
			 */
		font-weight: normal;
		font-style: normal;

	}
	 
   table {
	 border-collapse: collapse;
   }
	/* use this class to attach this font to any element i.e. <p class="fontsforweb_fontid_507">Text with this font applied</p> */
	.fontsforweb_fontid_507 {
		font-family: 'DOTMATRI' !important;
	}
	.btnprint{
		display: none;
	}
}
</style><?php
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
  	<center>DAFTAR LAPORAN PERKULIAHAN</center>
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
             	 
			</td>
             
        </tr>
		
    </table>
    <table border="1" width="100%" class="">
	<tr>
		 <th style="padding:5px;" width="20px">KU<BR>LIAH<BR>KE :</th>
		 <th style="padding:5px;" width="100px">TGL</th>
		 <th style="padding:5px;">DARI JAM <br>s/d JAM</th>
		 <th width="50%">MATERI YANG DIKULIAHKAN/DIBAHAS</th>
		 <th width="30%" colspan="2">KETERANGAN dan Tanda Tangan Dosen</th>
	</tr>
     
    	 <?php 
    	 		$semester = 0;
    	 		$hal = 1;
				if (isset($recordmateri) && is_array($recordmateri) && count($recordmateri)) : 
					$no = 1;
					 foreach ($recordmateri as $record) :
					$persentase = 0;
					$jmlada = 0;
				?> 
				  
				  <tr>
					<td rowspan="2" valign="middle" align="center" style="padding:5px;"> <?php echo isset( $record->pertemuan) ? $record->pertemuan : ''; ?></td>
			 		<td rowspan="2" valign="top" align="left"> <?php echo isset( $record->tanggal) ? $record->tanggal : ''; ?> </td>
			 		<td rowspan="2" valign="top" align="left"> <?php echo isset( $record->jam_mulai) ? $record->jam_mulai : ''; ?> - <?php echo isset( $record->jam_selesai) ? $record->jam_selesai : ''; ?> </td>
			 		<td rowspan="2" valign="top" align="left"> <?php echo isset( $record->desc_materi) ? str_replace("+"," ",urldecode($record->desc_materi)) : ''; ?></td>
			 		<td  colspan="2">
			 			Dosen,
			 			<br>
			 			<br>
			 			<br>
			 			<br>
			 			
			 		</td>
				  </tr>
				  <tr>
				  	<td>
				  		Ketua Prodi.
				  		<br>
			 			<br>
			 			<br>
			 			<br>
				  	</td>
				  	<td>
				  		Ketua Kelas
				  		<br>
			 			<br>
			 			<br>
			 			<br>
				  	</td>
				  </tr>
        		<?php 
        		$hal++;
        		$no++;
					endforeach; 
				endif;
				?>
		   
	</table>
</div> 
</div> 