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
    	<tr> <td width="270px" align="center"> UNIVERSITAS MUHAMMADIYAH JAKARTA </td></tr>
        <tr><td align="center"> FAKULTAS <?php echo isset($datamahasiswa[0]->nama_fakultas) ? $datamahasiswa[0]->nama_fakultas : ""; ?> </td></tr>
        <tr><td align="center"> Jl. K. H. Ahmad Dahlan Cirendeu Ciputat Jakarta Selatan	 </td></tr>
        <tr><td align="center">  ============================================================================================================ </td></tr>
        	
    </table>
    <br> 
    <table border="0" width="100%">
   		 <tr>
        	<td align="center" colspan="2">** DAFTAR NILAI AKADEMIS / TRANSKIP ** <br></td> 
        </tr>
    	<tr>
        	<td align="left"> Nomor Pokok : <?php echo isset($datamahasiswa[0]->nim_mhs)?$datamahasiswa[0]->nim_mhs:"" ?> </td>
             
            <td align="left" width="600px" > Nama Mahasiswa : <?php echo isset($datamahasiswa[0]->nama_mahasiswa)?$datamahasiswa[0]->nama_mahasiswa:"" ?> </td>
            
        </tr>
        <tr>
            
             <td align="center" colspan="3">&nbsp;</td>
        </tr>
       <tr>
        	
            <td align="left">N.I.R.M : </td>
            <td align="left" width="600px" > Jurusan : <?php echo isset($datamahasiswa[0]->nama_prodi)?$datamahasiswa[0]->nama_prodi:"" ?> </td>
            
        </tr>
		 <tr>
            
             <td align="center" colspan="3">==============================================================================================================================================================</td>
        </tr>
    </table>
	   <br>
    <table border="0" width="100%">
	<tr> 
		 <th style="padding:5px;" width="100px">Kode MK</th>
		 <th style="padding:5px;" width="300px">MATA KULIAH</th>
		 <th style="padding:5px;" width="50px">SKS</th>
		 <th style="padding:5px;" width="50px">Nilai</th>
		 <th></th>
		 <th style="padding:5px;" width="100px">Kode MK</th>
		 <th style="padding:5px;" width="300px">MATA KULIAH</th>
		 <th style="padding:5px;" width="50px">SKS</th>
		 <th style="padding:5px;" width="50px">Nilai</th>
    </tr>
    <tr>
    	<td>
	    <?php 
		$semester = 0;
		$jmlsks = 0;
		$jmlbobot = 0;
		$i = 0;
		if (isset($datakrs) && is_array($datakrs) && count($datakrs)) : 
	 
			foreach ($datakrs as $record) :
			 if($record->semester!=$semester){
				$no = 1;
				$semester = $record->semester;
				if($i%2==0){
					?> 
					 </td>
					 <tr>
					 <td colspan="4">
						<br>
						<?php echo isset( $semester) ? "Semester : ".(int)$semester : ''; ?>
					 </td>
					 <td>
					<?php
				}else
				{
				?> 
					 </td>
					 <td colspan="4">
					 <br>
					 <?php echo isset( $semester) ? "Semester : ".(int)$semester : ''; ?>
				 	  </td>
					 <td>
				<?php
				}
				$i++;
			 }
			 ?>
			 <tr>
					<td valign="middle" align="center" style="padding:5px;"> <?php echo $no; ?>.
						<?php echo isset( $record->kode_mata_kuliah) ? $record->kode_mata_kuliah : ''; ?>
					</td>
					<td valign="middle" style="padding:5px;"> <?php echo isset( $record->nama_mata_kuliah) ? $record->nama_mata_kuliah : ''; ?></td>
					<td valign="middle" align="center" style="padding:5px;"> <?php echo isset( $record->sks) ? $record->sks : ''; ?></td>
					<td width="100px" style="padding:5px;" valign="top" align="center"> <?php echo isset( $record->nilai_huruf) ? $record->nilai_huruf : ''; ?></td>
				  </tr>
        		<?php 
        			$nilaiangka = $jsonkonversi[$record->nilai_huruf];
        			//echo $nilaiangka;
        			if($nilaiangka!=""){
					   $jmlsks = $jmlsks + (int)$record->sks;
					   $nilaiangka = $jsonkonversi[$record->nilai_huruf];
					   $jmlbobot = $jmlbobot + ((int)$record->sks*(int)$nilaiangka);
        			}
        			$no++;
        		 
			endforeach;
		
		endif;
		?> 
	   </td>
    </tr>
    
    	 <?php 
    	 		$semester = 0;
    	 		$jmlsks = 0;
    	 		$jmlbobot = 0;
				if (isset($datakrs) && is_array($datakrs) && count($datakrs)) : 
				
					foreach ($datakrs as $record) :
					 if($record->semester!=$semester){
					 	$no = 1;
						$semester = $record->semester;
						?>
						 <tr>
							<td colspan="5"> 
								<br>
								<?php echo isset( $semester) ? "Semester : ".(int)$semester : ''; ?>
							</td>
						</tr>
						<?php
					 }
				?> 
				  <tr>
					<td valign="middle" align="center" style="padding:5px;"> <?php echo $no; ?>.
						<?php echo isset( $record->kode_mata_kuliah) ? $record->kode_mata_kuliah : ''; ?>
					</td>
					<td valign="middle" style="padding:5px;"> <?php echo isset( $record->nama_mata_kuliah) ? $record->nama_mata_kuliah : ''; ?></td>
					<td valign="middle" align="center" style="padding:5px;"> <?php echo isset( $record->sks) ? $record->sks : ''; ?></td>
					<td width="100px" style="padding:5px;" valign="top" align="center"> <?php echo isset( $record->nilai_huruf) ? $record->nilai_huruf : ''; ?></td>
				  </tr>
        		<?php 
        			$nilaiangka = $jsonkonversi[$record->nilai_huruf];
        			//echo $nilaiangka;
        			if($nilaiangka!=""){
					   $jmlsks = $jmlsks + (int)$record->sks;
					   $nilaiangka = $jsonkonversi[$record->nilai_huruf];
					   $jmlbobot = $jmlbobot + ((int)$record->sks*(int)$nilaiangka);
        			}
        			$no++;
					endforeach; 
				endif;
				?>
				 
	</table>
	 
	   <br>
	<table border="0" width="100%">
	 <tr>
            
             <td align="center" colspan="5">==============================================================================================================================================================</td>
        </tr>
    	<tr>
    		<td align="left" width="100px"> M.K. Wajib </td>
    		<td>:</td>
    		<td> </td>
    		<td width="600px"></td>
    		<td> Jakarta, <?php echo date("d m Y"); ?></td>
    	</tr>
        <tr><td> M.K. Pilihan	 </td><td>:</td><td></td>
        <td width="400px"></td>
    		<td> Ka. Jurusan,</td>
    		</tr>
        <tr><td> Total Kredit	 </td><td>:</td><td><?php echo $jmlsks; ?></td></tr>
        <tr><td> I.P. Kumulatif	 </td><td>:</td><td>
        	<?php echo $jmlbobot/$jmlsks; ?>
        </td></tr>  
        <tr>
        	<td>
        		
        	</td><td></td><td></td>
        	<td width="400px"></td>
    		<td> <br>
        		<br>
        		<br>
        		-----------------------------</td>
    		</tr>  	
    </table>
    <br/>
   <center>
	   <a class="btn btn-large btnprint" target="_blank" href="<?php echo site_url(SITE_AREA .'/krs/transkip/view/');echo isset($mhs)? "/".$mhs:""; ?>/print">
		Cetak Data
		</a>
	</center>
</div> 
