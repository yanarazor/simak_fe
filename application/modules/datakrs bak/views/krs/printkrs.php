<style>
 
@media print {
    body {
		font-weight:normal;
      font-style:normal;
      font-variant:normal;
	
		font-size : 12pt;
		line-height:20px;
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

 <div style="margin-left:10px;margin-top:30px;"> 
    <table border="0" width="100%">
    	<tr>
        	<td width="270px" align="center"> UNIVERSITAS MUHAMMADIYAH JAKARTA </td>
        </tr>
        <tr>
            <td align="center"> FAKULTAS <?php echo isset($datamahasiswa[0]->nama_fakultas) ? $datamahasiswa[0]->nama_fakultas : ""; ?></td>
        </tr>
        <tr>
            <td align="center"> Jl. K. H. Ahmad Dahlan Cirendeu Ciputat Jakarta Selatan	 </td>
        </tr>
        <tr>
            <td align="center"> ***KARTU RENCANA STUDI***	</td>
        </tr>
        <tr>
            <td align="center"> Periode Semester <?php echo isset($sms) ? (int)$sms:""; ?>  Tahun Akademik <?php echo $this->settings_lib->item('site.tahun'); ?> </td>
        </tr>
        <tr>
            <td align="center"> PROGRAM STUDI <?php echo isset($datamahasiswa[0]->nama_prodi) ? $datamahasiswa[0]->nama_prodi : ""; ?></td>
        </tr>
		
    </table>
    <table border="0" width="100%">
    	<tr>
        	<td colspan="4"align="center" width="100px"> &nbsp;</td>
            <td align="left" width="600px" >
            	 Nama Mahasiswa : <?php echo isset($datamahasiswa[0]->nama_mahasiswa)?$datamahasiswa[0]->nama_mahasiswa:"" ?>
            </td>
            <td align="center" colspan="3" width="100px"> &nbsp;</td>
        </tr>
        <tr>
        	<td colspan="4"align="center" width="100px"> &nbsp;</td>
            <td align="left">
            	  Nomor Pokok : <?php echo isset($datamahasiswa[0]->nim_mhs)?$datamahasiswa[0]->nim_mhs:"" ?>
            </td>
             <td align="center" colspan="3" width="100px"> &nbsp;</td>
        </tr>
       <tr>
        	<td colspan="4"align="center" width="100px"> &nbsp;</td>
            <td align="left">
            	 No HP :
            </td>
            <td align="center" colspan="3" width="100px"> &nbsp;</td>
        </tr>
		
    </table>
	   <br>
    <table border="1" width="100%">
	<tr>
		 <th width="40px" style="padding:5px"> NO.</th>
		 <th width="60px"style="padding:5px"> SEMESTER </th>
		 <th width="150px"style="padding:5px"> KODE MATA KULIAH </th>
		 <th width="300px" style="padding:5px"> MATA KULIAH </th>
		 <th width="50px"style="padding:5px"> SKS</th>
		 <th width="200px" style="padding:5px"> KETERANGAN </th>
    </tr>
    	 <?php 
    	 		$semester = 0;
    	 		
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
					<td valign="middle" align="center" style="padding:5px"> <?php echo $no; ?> .</td>
                    <td valign="middle" align="center" style="padding:5px"> <?php echo isset( $semester) ? $semester : ''; ?> </td>
			 		<td valign="middle" align="left" style="padding:5px"> <?php echo isset( $record->kode_mk) ? $record->kode_mk : ''; ?> </td>
                    <td valign="middle" align="left" style="padding:5px" width="50px"> <?php echo isset( $record->nama_mk) ? $record->nama_mk : ''; ?> </td>
                    <td valign="middle" align="center" style="padding:5px"> <?php echo isset( $record->sks) ? $record->sks : ''; ?> </td>
				    <td valign="middle" align="center" style="padding:5px" width="550px">&nbsp;</td>
				  </tr>
        <?php 
        	$no++;
					endforeach; 
				endif;
				?>
	</table>
	<br><br><br>
	 <table border="0" width="100%">
        <tr>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4">Mengetahui</td>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4">Jakarta, .........,...........,............</td>
			<td align="center" colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4">Dosen Penasehat Akademik</td>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4">Mahasiswa Ybs</td>
			<td align="center" colspan="2">&nbsp;</td>
        </tr>
       <tr>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4"><br><br><br></td>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4"><br><br><br></td>
			<td align="center" colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4">( .................................................................................. )</td>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4">( .................................................................................. )</td>
			<td align="center" colspan="2">&nbsp;</td>
        </tr>
        
    </table>
	   <br>
   <center>
   <br>
   <a class="btn btn-large btnprint" target="_blank" href="<?php echo site_url(SITE_AREA .'/krs/datakrs/printkrs/'); echo isset($sms)? "/".$sms:""; ?>/print">Cetak</a>
	</center>
</div> 
