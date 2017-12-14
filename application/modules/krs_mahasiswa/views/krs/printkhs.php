<style>
.one {border-bottom :1px dashed black;}
p.two {border-style: dotted solid dashed;}
p.three {border-style: dotted solid;}
p.four {border-style: dotted;}
.tableborder {
border :1px solid black;

}
.bottomsolid {
	border-bottom :1px solid black;
}
 H1 {
		font-size : 15pt;
		font-style: bold;
    }
    H2{
		font-size : 14pt;
		font-style: bold;
    }
@media print {
    body {
		font-weight:normal;
      	font-style:normal;
      	font-variant:normal;
	
		font-size : 9pt;
    }
     H1 {
		font-size : 15pt;
		font-style: bold;
    }
    H2{
		font-size : 14pt;
		font-style: bold;
    }
	.one {border-bottom :1px dashed black;}
	@font-face {
		font-family: "Times New Roman", Times, serif;
		font-size : 9pt;
		font-weight: normal;
		font-style: normal;

	}
	.tableborder {
		border :1px solid black;
		font-size : 8pt;
	}
	.bottomsolid {
		border-bottom :1px solid black;
	}
   table {
	 border-collapse: collapse;
	 font-size : 9pt;
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
 <div style="margin-left:10px;margin-top:30px;"> 
<table border="0" style="font-size:16px;font-weight:bold;" width="100%">
 	
	 <tr>
	 	<td rowspan="3" width="100px">
	 		<img src="<?php echo base_url()."assets/images/logonew.jpg" ?>" width="90px"/>
	 	</td> 
	 	<td align="center"><h2> <?php echo $this->settings_lib->item('nama_pt'); ?> </h2></td></tr>
	 <tr><td align="center"> <?php echo isset($datamahasiswa[0]->nama_fakultas) ? $datamahasiswa[0]->nama_fakultas : ""; ?> </td></tr>
	 <tr><td align="center"> <?php echo $this->settings_lib->item('alamat_pt1'); ?> <?php echo $this->settings_lib->item('alamat_pt2'); ?> <?php echo $this->settings_lib->item('kota_pt'); ?></td></tr>
	 <tr><td align="center" class="one" colspan="2"></td></tr>
	 <tr><td align="center" colspan="2"> KARTU HASIL STUDI </td></tr>
	 <tr><td align="center" colspan="2"><br></td></tr>		
 </table>
<table border="0" width="100%">
	<tr>
		<td align="left"> Nomor Pokok Mhs</td>
		<td>:</td> 
		<td><?php echo isset($datamahasiswa[0]->nim_mhs)?$datamahasiswa[0]->nim_mhs:"" ?> </td>
		<td width="100px"></td>
		<td align="left"> Nama Mahasiswa</td>
		<td>:</td> 
		<td> <?php echo isset($datamahasiswa[0]->nama_mahasiswa)?$datamahasiswa[0]->nama_mahasiswa:"" ?> </td>
		 
	</tr>
	<tr>
		<td align="left"> Semester </td><td>:</td> <td> <?php echo $sms%2==1 ? "Ganjil":"Genap";?> <?php echo $this->settings_lib->item('site.tahunajaran'); ?></td>
		<td></td>
		<td align="left"> Program Studi </td><td>:</td> <td> <?php echo isset($datamahasiswa[0]->nama_prodi)?$datamahasiswa[0]->nama_prodi:"" ?> </td>
		 
		
	</tr>
	 <tr>
		<td align="left"> Dosen P.A </td><td>:</td> <td><?php echo isset($datamahasiswa[0]->nama_dosen)?$datamahasiswa[0]->nama_dosen:"" ?> </td>
		<td></td>
		<td>  </td>
		<td>  </td><td>  
	</tr>
	  
</table>
<br>
<table border="0" class="tableborder" width="100%">
  <tr class="bottomsolid">
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
				   		// echo (int)$record->sks;
					   //$jmlsks = $jmlsks + (int)$record->sks;
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
 <table border="1"  width="100%">
  	<tr>
  		<td width="33%" valign="top">
  			<table border="0"  width="100%">
			<tr>
				   <td width="20%">
					  KHS Semester
				   </td>
				   <td width="20%">
					: <?php echo $sms%2==1 ? "Ganjil":"Genap";?>
				   </td>
				   
			  </tr>
			   <tr>
				   <td width="20%">
					   SKS yang diambil
				   </td>
				   <td>
				    : <?php echo $jmlsks; ?>
					</td>
			  </tr>
	
			   <tr>
				   <td>
					   SKS yang diselesaikan
				   </td>
				   <td>
					  : <?php echo $skselesai; ?>
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
							  
							  //echo "<br>ipk sms".$ipksms;
					  ?>
				   
		  
				   </td>
				   
			  </tr>

		   </table>
  		</td>
  		<td width="35%" valign="top">
  			<table border="0" width="100%">
			<tr>
				   
				   <td width="20%">
					   sks yang telah ditempuh
				   </td>
				   <td width="20%">
					  : 
				   </td>
				    
			  </tr>
			   <tr>
				   
				   <td width="20%">
					   IPK Semester Lalu
				   </td>
				   <td width="20%">
					  :   <?php echo $ipklalu; ?>
				   </td>
		 
			  </tr>
	
			   <tr>
				   
				   <td>
					  IPK Sekarang
				   </td>
				   <td> 
				    : <?php echo $ips; ?>
				   
				   </td>
			  </tr>
			  <tr>
				   
				   <td>
			 
				   </td>
				   <td> 
		
				   </td>
			  </tr>
				  
		   </table>
  		</td>
  		<td>
  			 Beban studi yang diperkenankan pada Semester Selanjutnya : 
					  <?php echo isset($mak_sks) ? $mak_sks." SKS" : ""; ?>
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
			 
			  <table border="0" width="100%">
				 <tr>
					 <td align="center" colspan="2">&nbsp;</td>
					  <td align="center" colspan="4">Jakarta, <?php echo $convert->fmtDate(date("Y-m-d"),"dd month yyyy"); ?></td>
					 <td align="center" colspan="2">&nbsp;</td>
					 
				 </tr>
				 <tr>
					 <td align="center" colspan="2">&nbsp;</td>
					 <td align="center" colspan="4">Ketua Program Studi,</td>
					 <td align="center" colspan="2">&nbsp;</td> 
				 </tr>
				<tr>
					 <td align="center" colspan="2">&nbsp;</td>
					 <td align="center" colspan="4"><br><br><br></td>
					 <td align="center" colspan="2">&nbsp;</td> 
				 </tr>
				 <tr>
					 <td align="center" colspan="2">&nbsp;</td>
					 <td align="center" colspan="4"><br>
					 ( .........................................)</td>
					 <td align="center" colspan="2">&nbsp;</td>
					  
				 </tr>
		
			 </table>
 		</td>
 		<td>
 			
			   <br>
			   
 			
 		</td>
 	</tr>
 </table>
    
	   <br>
   <center>
	   <a class="btn btn-large btnprint" target="_blank" href="<?php echo site_url(SITE_AREA .'/krs/krs_mahasiswa/printkhs/'); echo isset($sms)? "/".$sms:""; echo isset($mhs)? "/".$mhs:""; ?>/print">
		Cetak Data
		</a>
	</center>
</div> 
