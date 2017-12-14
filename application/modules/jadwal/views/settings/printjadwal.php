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
	//$datamahasiswa = (array)$datamahasiswa;
}
$id = isset($datakrs['id']) ? $datakrs['id'] : '';
?>

 <div style="margin-left:10px;margin-top:30px;"> 
    <table border="0" style="font-size:16px;font-weight:bold;" width="100%">
    	<tr> <td width="270px" align="center"> UNIVERSITAS MUHAMMADIYAH JAKARTA </td></tr>
        <tr><td align="center"> FAKULTAS <?php echo isset($datamahasiswa[0]->nama_fakultas) ? $datamahasiswa[0]->nama_fakultas : ""; ?> </td></tr>
        <tr><td align="center"> Jl. K. H. Ahmad Dahlan Cirendeu Ciputat Jakarta Selatan	 </td></tr>
        <tr><td align="center"> ***JADWAL***</td></tr>
        <tr><td align="center"> Periode Semester  </td></tr>		
    </table>
	   <br>
    <table border="1" width="100%">
	<tr>
		 <th width="40px" style="padding:5px">No</th>
		 <th width="60px">HARI/JAM</th>
		 <th width="75px">Kode MK</th>
		 <th width="275px">MATA KULIAH</th>
		 <th width="20px">SKS</th>
		 <th width="50px">Semester</th>
		 <th width="50px">Kelas</th>
		 <th width="100px">Prodi</th>
		 <th width="150px">Dosen</th>
    </tr>
    
    
    	 <?php 
    	 		$semester = 0;
    	 		
				if (isset($records) && is_array($records) && count($records)) : 
					foreach ($records as $record) :
					  if($record->semester!=$semester){
						 $semester = $record->semester;
					  }
					
					endforeach;
					 
				$no = 1;
					foreach ($records as $record) :
					 if($record->semester!=$semester){
						$semester = $record->semester;
					 }
				?> 
				  <tr>
					  <td valign="middle" align="center"  style="padding:5px">  <?php echo $no; ?>. </td>
					  <td valign="middle" style="padding:5px"><?php echo isset(  $record->hari) ?  $record->hari." : ". $record->jam : ''; ?></td>
			 		  <td valign="middle" style="padding:5px"> <?php echo isset( $record->kode_mk) ? $record->kode_mk : ''; ?> </td>
					  <td valign="middle" style="padding:5px"> <?php echo isset( $record->nama_mata_kuliah) ? $record->nama_mata_kuliah : ''; ?> </td>
					  <td valign="middle" align="center" style="padding:5px"> <?php echo isset( $record->sks) ? $record->sks : ''; ?> </td>
					  <td valign="middle" align="center" style="padding:5px">  <?php echo isset( $record->semester) ? $record->semester : ''; ?> </td>
					  <td valign="middle" align="center" style="padding:5px">  <?php echo isset( $record->sks) ? $record->nama_kelas : ''; ?> </td>
					  <td valign="middle" align="center" style="padding:5px">  <?php echo isset( $record->prodi) ? $record->prodi : ''; ?> </td>
					  <td valign="middle" style="padding:5px">  <?php echo isset( $record->nama_dosen) ? $record->nama_dosen : ''; ?> </td>
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
            <td align="center" colspan="4">&nbsp;</td>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="Right" colspan="4">Jakarta, .........,...........,............</td>
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
            <td align="center" colspan="4">&nbsp;</td>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="Right" colspan="4">Akademik Fakultas</td>
			<td align="center" colspan="2">&nbsp;</td>
        </tr>
        
    </table>
	   <br>
   <center>
     <br>
   <a class="btn btn-large btnprint" target="_blank" href="<?php echo site_url(SITE_AREA .'/settings/jadwal/printjadwal'); echo isset($tahun_akademik)? "/".$tahun_akademik:""; ?>/print/?tahun_akademik=<?php echo $tahun_akademik; ?>&mk=<?php echo $mk; ?>&prodi=<?php echo $prodi; ?>">Cetak Jadwal</a>
   </center>
</div> 
