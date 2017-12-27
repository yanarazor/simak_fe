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
 <div style="margin-left:10px;margin-top:30px;"> 
 	 <table border="0" style="font-size:11px;font-weight:bold;" width="100%">
    	<tr> <td width="270px" align="center">  <?php echo $this->settings_lib->item('nama_pt'); ?></td></tr>
        <tr><td align="center"> <?php echo isset($nama_jurusan)?$nama_jurusan:"" ?></td></tr>
        <tr><td align="center">  <?php echo $this->settings_lib->item('alamat_pt1'); ?> <?php echo $this->settings_lib->item('alamat_pt2'); ?> <?php echo $this->settings_lib->item('kota_pt'); ?> </td></tr>
        <tr><td align="center"> <br>
        DAFTAR HADIR MAHASISWA</td></tr>		
    </table>
      
    <br> 
    <table border="0" width="100%">
    	<tr>
            <td align="left" width="100px" > Program Studi</td>
            <td align="left" width="10px">:</td>
            <td align="left" width="250px"><?php echo isset($nama_jurusan)?$nama_jurusan:"" ?></td>
            <td>&nbsp;</td>
            <td  width="100px">Kelas</td>
            <td align="left" width="10px">:</td>
            <td><?php echo isset($kelas)?$kelas:"" ?></td>
        </tr>
        <tr>
            <td align="left"> Mata Kuliah  </td>
            <td align="left">:</td>
            <td><?php echo isset($nama_mk)?$nama_mk:"" ?></td>
            <td>&nbsp;</td>
            <td width="100px">Jumlah Peserta</td>
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
        
       <tr>
        	 
            <td align="left">Dosen</td>
            <td align="left">:</td>
            <td><?php echo isset($dosen)?$dosen:"" ?></td>
            <td>&nbsp;</td>
            <td width="100px">Waktu</td>
            <td align="left" width="10px">:</td>
            <td><?php echo isset($waktu)?$waktu:"" ?></td>
        </tr>
		<tr>
        	 
            <td align="left">Semester </td>
            <td align="left">:</td>
            <td >
            <?php //echo $sms%2==1 ? "Ganjil":"Genap";?> <?php //echo $this->settings_lib->item('site.tahunajaran'); ?>
				<?php echo isset($tahunakademik) ? $tahunakademik : ""; ?>
            </td>
        </tr>
		
    </table>
	   <br>
    <table border="1" width="100%">
	<tr>
		 <th style="padding:5px;" width="40px">No</th>
		 <th style="padding:5px;" width="100px">NIM</th>
		 <th style="padding:5px;" width="200px">Nama</th>
		 <?php for($i=1;$i<$jml+1;$i++){ ?>
			<td style="padding:5px;" align="center" width="100px" ><?php echo $i; ?></td>
		 <?php } ?>
		 <th style="padding:5px;" width="50px">Persentase</th>
    </tr>
    	 <?php 
    	 		$semester = 0;
    	 		$hal = 1;
				if (isset($records) && is_array($records) && count($records)) : 
					$no = 1;
					 foreach ($records as $record) :
				?> 
				<?php 
				if($hal > 255) { 
				?>
				</table>
				  <table border="1" width="100%" class="break">
					 <tr>
						  <th style="padding:5px;" width="40px">No</th>
						  <th style="padding:5px;" width="100px">NIM</th>
						  <th style="padding:5px;" width="300px">Nama</th>
						  <?php for($i=1;$i<$jml+1;$i++){ ?>
							 <td style="padding:5px;" align="center" width="100px" ><?php echo $i; ?></td>
						  <?php } ?>
		  					<td style="padding:5px;" width="50px">%</td>
					 </tr>
					
				 <?php 
				 $hal = 1;
				 } ?>
				 
				  <tr>
					<td valign="middle" align="center" style="padding:5px;"> <?php echo $no; ?>. </td>
					<td valign="middle" align="left" style="padding:5px;"> <?php echo isset( $record->mahasiswa) ? $record->mahasiswa : ''; ?></td>
			 		<td valign="middle" align="left" style="padding:5px;"> <?php echo isset( $record->nama_mahasiswa) ? $record->nama_mahasiswa : ''; ?>
			 			
			 		</td>
					<?php 
					$jmlada = 0;
					for($i=1;$i<$jml+1;$i++){ ?>
						<td valign="middle" align="center" style="padding:5px;">
							<?php if(isset($dataabsen[$record->mahasiswa."_".$i]))
							{ 
								echo "ada"; 
								$jmlada = $jmlada + 1;
							}; 
							?>
						
					 <?php } ?>
					 
					</td>
					<td align="center">
						<?php 
							$persentase = $jmlada/$jml * 100;
							echo round($persentase)."%";
							$jmlada = 0;
						?>
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
				 <tr>
					 
			 		<td valign="middle" align="left" colspan="3" style="padding:5px;">Dosen</td>
					<?php for($i=1;$i<$jml+1;$i++){ ?>
						<td valign="middle" align="center" style="padding:5px;">
						<?php if(isset($dataabsen[$nidn."_".$i]))
							{ 
								echo "ada"; 
								$jmlada = $jmlada + 1;
							}; 
						?>
						
						 </td>
					 <?php } ?>
					 <td align="center">
						<?php 
							$persentase = $jmlada/$jml * 100;
							echo round($persentase)."%";
							$jmlada = 0;
						?>
					</td>
				  </tr>
				<?php
				   
		 // endif;
		  ?>	 
	</table>
	<br><br><br>
	 <table border="0" width="100%">
        <tr>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="left" colspan="4">Catatan</td>
            <td align="left" colspan="2">&nbsp;</td>
            <td align="center" colspan="4">Ponorogo, <?php echo $convert->fmtDate(date("Y-m-d"),"dd month yyyy"); ?></td>
			<td align="center" colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="left" colspan="4">Mohon Dosen Membubuhkan paraf Setiap kali perkuliahan selesai</td>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4">Tanda tangan Dosen</td>
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
            <td align="center" colspan="4"></td>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4">( <?php echo isset($dosen)?$dosen:"" ?> )</td>
			<td align="center" colspan="2">&nbsp;</td>
        </tr>
        
    </table>
	   <br>
   
</div> 
