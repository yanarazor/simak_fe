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
		font-size : 13pt;
		font-style: bold;
    }
    H2{
		font-size : 12pt;
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
	//$datamahasiswa = (array)$datamahasiswa;
}
$id = isset($datakrs['id']) ? $datakrs['id'] : '';
?>

	 <table border="0" width="100%">
 	
	 <tr>
	 	<td rowspan="3" width="100px">
	 		<img src="<?php echo base_url()."assets/images/logonew.jpg" ?>" width="90px"/>
	 	</td> 
	 <td align="left"><h2>
	 <?php echo $this->settings_lib->item('nama_pt'); ?>  </h2>
	 	<?php echo $this->settings_lib->item('alamat_pt1'); ?> <?php echo $this->settings_lib->item('alamat_pt2'); ?> <?php echo $this->settings_lib->item('kota_pt'); ?></td></tr>
	 <tr><td align="center" colspan="2"> JADWAL </td></tr>	
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
					  <td valign="middle" align="center" style="padding:5px">  <?php echo isset( $record->kelas) ? $record->kelas : ''; ?> </td>
					  <td valign="middle" align="center" style="padding:5px">  <?php echo isset( $record->nama_prodi) ? $record->nama_prodi : ''; ?> </td>
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
            <td align="Right" colspan="4">Jakarta , .........,...........,............</td>
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
   
</div> 
