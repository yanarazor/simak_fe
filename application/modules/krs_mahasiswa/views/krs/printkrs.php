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
    <table border="0" style="font-size:16px;font-weight:bold;" width="100%">
    	<tr> <td width="270px" align="center"> <?php echo $this->settings_lib->item('nama_pt'); ?>  </td></tr>
        <tr><td align="center"> FAKULTAS <?php echo isset($datamahasiswa[0]->nama_fakultas) ? $datamahasiswa[0]->nama_fakultas : ""; ?> </td></tr>
        <tr><td align="center"> <?php echo $this->settings_lib->item('alamat_pt1'); ?> <?php echo $this->settings_lib->item('alamat_pt2'); ?> <?php echo $this->settings_lib->item('kota_pt'); ?>	 </td></tr>
        <tr><td align="center"> ***Kartu Rencana Studi***</td></tr>
        <tr><td align="center"> Periode Semester  </td></tr>		
    </table>
    <br> 
    <table border="0" width="100%">
    	<tr>
        	<td align="center" colspan="4">&nbsp;</td>
            <td align="left" width="600px" > Nama Mahasiswa : <?php echo isset($datamahasiswa[0]->nama_mahasiswa)?$datamahasiswa[0]->nama_mahasiswa:"" ?> </td>
            <td align="center" colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="center" colspan="4">&nbsp;</td>
            <td align="left"> Nomor Pokok : <?php echo isset($datamahasiswa[0]->nim_mhs)?$datamahasiswa[0]->nim_mhs:"" ?> </td>
             <td align="center" colspan="3">&nbsp;</td>
        </tr>
       <tr>
        	<td align="center" colspan="4">&nbsp;</td>
            <td align="left">No HP : </td>
            <td align="center" colspan="4">&nbsp;</td>
        </tr>
		
    </table>
	   <br>
    <table border="1" width="100%">
	<tr>
		 <th style="padding:5px;" width="40px">No</th>
		 <th style="padding:5px;" width="60px">Semester</th>
		 <th style="padding:5px;" width="100px">Kode MK</th>
		 <th style="padding:5px;" width="300px">MATA KULIAH</th>
		 <th style="padding:5px;" width="50px">SKS</th>
		 <th style="padding:5px;" width="500px">Keterangan</th>
    </tr>
    
    
    	 <?php 
    	 		$semester = 0;
    	 		
				if (isset($datakrs) && is_array($datakrs) && count($datakrs)) : 
					 
				$no = 1;
					foreach ($datakrs as $record) :
					 if($record->semester!=$semester){
						$semester = $record->semester;
					 }
				?> 
				  <tr>
					<td valign="middle" align="center" style="padding:5px;"> <?php echo $no; ?>. </td>
					<td valign="middle" align="center" style="padding:5px;"> <?php echo isset( $record->semester) ? $record->semester : ''; ?></td>
			 		<td valign="middle" align="center" style="padding:5px;"> <?php echo isset( $record->kode_mk) ? $record->kode_mk : ''; ?></td>
					<td valign="middle" style="padding:5px;"> <?php echo isset( $record->nama_mk) ? $record->nama_mk : ''; ?></td>
					<td valign="middle" align="center" style="padding:5px;"> <?php echo isset( $record->sks) ? $record->sks : ''; ?></td>
					<td width="500px" style="padding:5px;" valign="top">&nbsp;</td>

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
            <td align="center" colspan="4">(.......................................................................)</td>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4">(.......................................................................)</td>
			<td align="center" colspan="2">&nbsp;</td>
        </tr>
        
    </table>
	   <br>
   <center>
	   <a class="btn btn-large btnprint" target="_blank" href="<?php echo site_url(SITE_AREA .'/krs/krs_mahasiswa/printkrs/'); echo isset($sms)? "/".$sms:""; echo isset($mhs)? "/".$mhs:""; ?>/print">
		Cetak Data
		</a>
	</center>
</div> 
