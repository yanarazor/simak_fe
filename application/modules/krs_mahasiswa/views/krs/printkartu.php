<style>
 
@media print {
    body {
		font-weight:normal;
      font-style:normal;
      font-variant:normal;
	
		font-size : 9pt;
    }
	.break { page-break-before: always; }
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
?>
 <div style="margin-left:1px;margin-top:10px;"> 
 <table>
 	<tr>
 		<td valign="top" width="20%">
 			<table border="0" style="font-size:11px;font-weight:bold;" width="100%">
				 <tr> <td width="270px" align="center"> UNIVERSITAS MUHAMMADIYAH JAKARTA </td></tr>
				 <tr><td align="center"> FAKULTAS <?php echo isset($datamahasiswa[0]->nama_fakultas) ? $datamahasiswa[0]->nama_fakultas : ""; ?> </td></tr>
				 <tr><td align="center"> Jl. K. H. Ahmad Dahlan Cirendeu Ciputat Jakarta Selatan	 </td></tr>
				 <tr><td align="center">===============================================</td></tr>
				 <tr><td align="center"> KARTU PESERTA UJIAN </td></tr>
				 <tr><td align="center"><br></td></tr>		
			 </table>
			 <br> 
			 <table border="0" width="100%" style="font-size:12px;font-weight:bold;">
				 <tr>
					 
					 <td align="left" width="200px" > Nama</td>
					 <td align="center">:</td>
					 <td align="left" width="600px" ><?php echo isset($datamahasiswa[0]->nama_mahasiswa)?$datamahasiswa[0]->nama_mahasiswa:"" ?> </td>
				 </tr>
				 <tr>
					  
					 <td align="left"> Nomor Pokok  </td>
					  <td align="center">:</td>
					  <td align="left"><?php echo isset($datamahasiswa[0]->nim_mhs)?$datamahasiswa[0]->nim_mhs:"" ?></td>
				 </tr>
				 <tr>
					  
					 <td align="left"> Program Studi </td>
					  <td align="center">:</td>
					  <td align="left"><?php echo isset($datamahasiswa[0]->nama_prodi)?$datamahasiswa[0]->nama_prodi:"" ?></td>
				 </tr>
				 <tr>
					<td align="left"> Semester </td>
					 <td align="left"> : </td>
					  <td align="left"><?php echo isset($sms) ? $sms : ""; ?></td>
				 </tr>
			 </table>
 		</td>
 		<td>
 			<table border="1" width="100%" style="font-size:9px;font-weight:bold;">
			   <tr>
					<th style="padding:5px;" width="40px">No</th>
					 
					<th style="padding:5px;" width="100px">Kode MK</th>
					<th style="padding:5px;" width="300px">MATA KULIAH</th>
					<th style="padding:5px;" width="50px">SKS</th>
					<th style="padding:5px;" width="50px">Kelas</th>
					<th style="padding:5px;" width="200px">Dosen</th>
					<th style="padding:5px;" width="500px">Paraf <br>Pengawas </th>
			   </tr>
	
	
					<?php 
						   $semester = 0;
							$jmlsks = 0;
						   if (isset($datakrs) && is_array($datakrs) && count($datakrs)) : 
							   foreach ($datakrs as $record) :
								 if($record->semester!=$semester){
									$semester = $record->semester;
								 }
					
							   endforeach;
					 
						   $no = 1;
							   foreach ($datakrs as $record) :
								if($record->semester!=$semester){
								   $semester = $record->semester;
								}
						   ?> 
							 <tr>
							   <td valign="middle" align="center" style="padding:5px;"> <?php echo $no; ?>. </td>
							   <td valign="middle" align="center" style="padding:5px;"> <?php echo isset( $record->kode_mk) ? $record->kode_mk : ''; ?></td>
							   <td valign="middle" style="padding:5px;"> <?php echo isset( $record->nama_mk) ? $record->nama_mk : ''; ?></td>
							   <td valign="middle" align="center" style="padding:5px;"> <?php echo isset( $record->sks) ? $record->sks : ''; ?></td>
							   <td valign="middle" align="center" style="padding:5px;"> <?php echo isset( $record->kelas) ? $record->kelas : ''; ?></td>
							   <td valign="middle" align="left" style="padding:5px;"> <?php echo isset( $record->nama_dosen) ? $record->nama_dosen : ''; ?></td>
							   <td width="500px" style="padding:5px;" valign="top">&nbsp;</td>

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
				 				<td>
				 				</td>
				 				<td>
				 				</td>
				 			</tr>
				 			
			   </table>
 			
 		</td>
 	</tr>
 </table>
    <br/>
    <br/>
    <br/>
	 <table border="0" width="100%" style="font-size:9px;font-weight:bold;">
        <tr>
            <td align="center" colspan="2">&nbsp;</td>
             <td align="center" colspan="4">Jakarta, .........,...........,............</td>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4">Bagian Keuangan</td>
			<td align="center" colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4">Ketua,</td>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4"></td>
			<td align="center" colspan="2">&nbsp;</td>
        </tr>
       
        <tr>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4"><br><br><br><br><br><br>
            ( .................................................................................. )</td>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4"><br><br><br><br><br><br>
            ( .................................................................................. )</td>
			<td align="center" colspan="2">&nbsp;</td>
        </tr>
        
    </table>
	   <br>
   <center>
	   <a class="btn btn-large btnprint" target="_blank" href="<?php echo site_url(SITE_AREA .'/krs/krs_mahasiswa/printkartu/'); echo isset($sms)? "/".$sms:""; echo isset($mhs)? "/".$mhs:""; ?>/print">
		Cetak Data
		</a>
	</center>
</div> 
