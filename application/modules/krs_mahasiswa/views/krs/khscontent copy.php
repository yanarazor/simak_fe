<style>
.one {border-bottom :1px dashed black;}
p.two {border-style: dotted solid dashed;}
p.three {border-style: dotted solid;}
p.four {border-style: dotted;}

@media print {
    body {
		font-weight:normal;
      font-style:normal;
      font-variant:normal;
	
		font-size : 12pt;
		line-height:20px;
    }
    .break { page-break-before: always; }
	.one {border-bottom :1px dashed black;}
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
</style>
<br/>
<?php
	$this->load->library('convert');
	$convert = new convert();
  // Change the css classes to suit your needs
if( isset($datamahasiswa) ) {
//    $datamahasiswa = (array)$datamahasiswa;
}
$id = isset($datakrs['id']) ? $datakrs['id'] : '';
$skselesai = 0;
$stringbatas = "-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------";
?>
<?php if($no>1) { ?>
<h1 class="break"> 
	</h1>
<?php } ?>
 <div style="margin-left:10px;margin-top:30px;"> 
 <table border="0" style="font-size:16px;font-weight:bold;" width="100%">
	 <tr> <td width="270px" align="center"> UNIVERSITAS MUHAMMADIYAH JAKARTA </td></tr>
	 <tr><td align="center"> <?php echo isset($datamahasiswa[0]->nama_fakultas) ? $datamahasiswa[0]->nama_fakultas : ""; ?> </td></tr>
	 <tr><td align="center"> Jl. K. H. Ahmad Dahlan Cirendeu Ciputat Jakarta Selatan	 </td></tr>
	 <tr><td align="center">===============================================================================================</td></tr>
	 <tr><td align="center"> KARTU HASIL STUDI </td></tr>
	 <tr><td align="center"><br></td></tr>		
 </table>
<table border="0" width="100%" class="one">
	<tr>
		<td align="left"> Nomor Pokok </td>
		<td>:</td> 
		<td><?php echo isset($datamahasiswa[0]->nim_mhs)?$datamahasiswa[0]->nim_mhs:"" ?> </td>
		<td align="left"> Nama </td>
		<td>:</td> 
		<td> <?php echo isset($datamahasiswa[0]->nama_mahasiswa)?$datamahasiswa[0]->nama_mahasiswa:"" ?> </td>
		<td width="20%"></td>
	</tr>
	<tr>
		<td align="left"> Semester </td><td>:</td> <td> <?php echo $sms%2==1 ? "Ganjil":"Genap";?> </td>
		
		<td align="left"> Jurusan </td><td>:</td> <td> <?php echo isset($datamahasiswa[0]->nama_prodi)?$datamahasiswa[0]->nama_prodi:"" ?> </td>
		<td></td>
	</tr>
	 <tr>
		<td align="left"> Dosen P.A </td><td>:</td> <td><?php echo isset($datamahasiswa[0]->nama_dosen)?$datamahasiswa[0]->nama_dosen:"" ?> </td>
		<td>  </td>
	</tr>
	 <tr>
		<td colspan="7"></td>
	</tr>
</table>
<br>
<table border="1" width="100%">
  <tr>
	   <th style="padding:5px;" width="40px">No</th>
	   <th style="padding:5px;" width="100px">Kode MK</th>
	   <th style="padding:5px;" width="60%">MATA KULIAH</th>
	   <th style="padding:5px;" width="50px">SKS</th>
	   <th style="padding:5px;" width="50px">Nilai</th>
  </tr>
  


	   <?php 
			   $jmlsks = 0;
			   $semester = 0;
			   $jmlbobot = 0;
			   $nilaiangka = "";
			  if (isset($datakrs) && is_array($datakrs) && count($datakrs)) : 
				   
			  $no = 1;
				  foreach ($datakrs as $record) :
					
				   if(isset($jsonkonversi[$record->nilai_huruf]))
						$nilaiangka = $jsonkonversi[$record->nilai_huruf];
					//echo $nilai_huruf;
					if($nilaiangka!=""){
					   $nilaiangka = $jsonkonversi[$record->nilai_huruf];
					   $jmlbobot = $jmlbobot + ((int)$record->sks*(int)$nilaiangka);
					   $skselesai = $skselesai + (int)$record->sks;
					}
			  ?> 
				<tr>
				  <td valign="middle" align="center" style="padding:5px;"> <?php echo $no; ?>. </td>
				  <td valign="middle" align="center" style="padding:5px;"> <?php echo isset( $record->kode_mk) ? $record->kode_mk : ''; ?></td>
				  <td valign="middle" style="padding:5px;"> <?php echo isset( $record->nama_mk) ? $record->nama_mk : ''; ?></td>
				  <td valign="middle" align="center" style="padding:5px;"> <?php echo isset( $record->sks) ? $record->sks : ''; ?></td>
				  <td valign="middle" align="center" style="padding:5px;"> <?php echo isset( $record->nilai_huruf) ? $record->nilai_huruf : ''; ?></td>
				</tr>
	  <?php 
				   $jmlsks = $jmlsks + (int)$record->sks;
		  $no++;
				  endforeach; 
			  endif;
			  ?>
			   <tr>
				   <td colspan="3" valign="middle" align="right">
					   <b>Jumlah </b> 
				   </td>
				   <td align="center">
					   <?php echo $jmlsks; ?>
				   </td>
				   <td>
				   </td>
				    
			   </tr> 
  </table>
  <br>
  <table border="0" width="100%">
	 <tr>
		 <td width="20%">
			 SKS yang diambil
		 </td>
		 <td width="20%">
		  : <?php echo $jmlsks; ?>
		 </td>
		 <td width="20%">
			 sks yang telah ditempuh
		 </td>
		 <td width="20%">
		 	: 
		 </td>
		 <td rowspan="5">
		 	Beban studi yang diperkenankan pada Semester Selanjutnya : 
		 	<?php echo isset($mak_sks) ? $mak_sks." SKS" : ""; ?>
		 </td>
	</tr>
	
	 <tr>
		 <td>
			 SKS yang diselesaikan
		 </td>
		 <td>
		 	: <?php echo $skselesai; ?>
		 </td>
		 <td>
			 IPK Semester Lalu
		 </td>
		 <td>
		  : <?php echo $ipklalu; ?>
		 </td>
	</tr>
	<tr>
		 <td>
			SKS yang gagal
		 </td>
		 <td>
		 	: <?php 
		 	$sksgagal = $jmlsks-$skselesai; 
		 	echo $sksgagal;
		 	?>
		 </td>
		 <td>
			 IPK Sekarang
		 </td>
		 <td> :
		 <?php echo $ips; ?>
		 </td>
	</tr>
	   <tr>
		 <td>
			IPS
		 </td>
		 
		 <td>
		 :
		  <?php 
				$ipk = 0;
				if($jmlbobot!="" and $jmlsks != "")
				{
					$ipk = round($jmlbobot/$jmlsks, 2);
					//echo $jmlbobot." ini";
				}
					echo $ipk; 
			?>
		  
		 </td>
		 <td>
			 
		 </td>
		 <td>
		 </td>
	</tr>

 </table>
 <br>
 <table border="0" width="100%">
 	<tr>
 		<td width="70%">
 			
 		</td>
 		<td valign="top">
			 <br/>
			 <br/>
			  <table border="0" width="100%">
				 <tr>
					 <td align="center" colspan="2">&nbsp;</td>
					  <td align="center" colspan="4">Jakarta, <?php echo $convert->fmtDate(date("Y-m-d"),"dd month yyyy"); ?></td>
					 <td align="center" colspan="2">&nbsp;</td>
					 
				 </tr>
				 <tr>
					 <td align="center" colspan="2">&nbsp;</td>
					 <td align="center" colspan="4">Ketua Jurusan,</td>
					 <td align="center" colspan="2">&nbsp;</td> 
				 </tr>
				<tr>
					 <td align="center" colspan="2">&nbsp;</td>
					 <td align="center" colspan="4"><br><br><br></td>
					 <td align="center" colspan="2">&nbsp;</td> 
				 </tr>
				 <tr>
					 <td align="center" colspan="2">&nbsp;</td>
					 <td align="center" colspan="4"><br><br><br><br>
					 ( .............................................. )</td>
					 <td align="center" colspan="2">&nbsp;</td>
					  
				 </tr>
		
			 </table>
 		</td>
 		<td>
 			
			   <br>
			   
 			
 		</td>
 	</tr>
 </table>
   
</div> 
