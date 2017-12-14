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
 <div style="margin-left:10px;margin-top:30px;" class="btnprint"> 
    <table border="0" style="font-size:16px;font-weight:bold;" width="100%">
    	<tr> <td width="270px" align="center"> UNIVERSITAS MUHAMMADIYAH JAKARTA </td></tr>
        <tr><td align="center"> <?php echo isset($datamahasiswa[0]->nama_fakultas) ? $datamahasiswa[0]->nama_fakultas : ""; ?> </td></tr>
        <tr><td align="center"> Jl. K. H. Ahmad Dahlan Cirendeu Ciputat Jakarta Selatan	 </td></tr>
        <tr><td align="center">  ============================================================================================================ </td></tr>
        	
    </table>
    <br> 
    <table border="0" width="100%">
   		 <tr>
        	<td align="center" colspan="2">** DAFTAR MATA KULIAH YANG TELAH DIAMBIL ** <br></td> 
        </tr>
    	<tr>
        	<td align="left" width="50%"> NIM : <?php echo isset($datamahasiswa[0]->nim_mhs)?$datamahasiswa[0]->nim_mhs:"" ?> </td>
             
            <td align="left" width="600px" > </td>
            
        </tr>
        <tr>
            
             <td align="center" colspan="3">&nbsp;</td>
        </tr>
       <tr>
        	
            <td align="left">Nama Mahasiswa : <?php echo isset($datamahasiswa[0]->nama_mahasiswa)?$datamahasiswa[0]->nama_mahasiswa:"" ?> </td>
            <td align="left" width="600px" > Program Studi : <?php echo isset($datamahasiswa[0]->nama_prodi)?$datamahasiswa[0]->nama_prodi:"" ?> </td>
            
        </tr>
		 <tr>
            
             <td align="center" colspan="3">==============================================================================================================================================================</td>
        </tr>
    </table>
	   <br>
    <table border="1" width="100%">
	<tr> 
		 <th style="padding:5px;" width="10px">No</th>
		 <th style="padding:5px;" width="100px">Kode MK</th>
		 <th style="padding:5px;" width="300px">MATA KULIAH</th>
		 <th style="padding:5px;" width="50px">SKS</th>
		 <th style="padding:5px;" width="50px">Nilai</th>
		 <th width="100px"></th>
		 <th style="padding:5px;" width="10px">No</th>
		 <th style="padding:5px;" width="100px">Kode MK</th>
		 <th style="padding:5px;" width="300px">MATA KULIAH</th>
		 <th style="padding:5px;" width="50px">SKS</th>
		 <th style="padding:5px;" width="50px">Nilai</th>
    </tr>
      
	    <?php 
		$semester = 0;
		$jmlsks = 0;
		$jmlbobot = 0;
		$i = 0;
		if (isset($datakrs) && is_array($datakrs) && count($datakrs)) : 
	 
			for($sms=1;$sms<$semesterakhir+1;$sms++):
			 if($sms!=$semester){
				 
				$semester = $sms;
				if($i%2==0){ //genap
					?> 
					 </td>
					 <tr>
					 <td colspan="5" valign="top">
					 	<table border="0" width="100%">
						   <tr>
							   <td colspan="5">
								 <br>
								  <b><?php echo isset( $semester) ? "Semester : ".$semester : ''; ?> </b>
								  
								 <? 
								 //echo count($jsonkrs[$semester]['kode_mata_kuliah']);
								 ?>
							  </td>
						   </tr>
						   <?php 
						  // echo "jumlah ".count($jsonkrs[$semester]['kode_mata_kuliah']);
						   if(isset($jsonkrs[$semester]) and count($jsonkrs[$semester]['kode_mata_kuliah'])>0){
						   	$no =1;
							   foreach($jsonkrs[$semester]['kode_mata_kuliah'] as $rec){ ?>
								  <tr>
								  	<td width="10px">
											<?php echo $no; ?>.
									   </td>
									  <td width="100px">
											<?php echo $rec; ?>
									   </td>
									   <td width="400px">
											<?php 
											//echo $rec." - ".$semester;
											echo $jsonkrs[$rec][$semester]['namamtk']; ?>
									   </td>
									   <td width="50px">
											<?php 
											//echo $rec." - ".$semester;
											echo (int)$jsonkrs[$rec][$semester]['sks']; ?>
									   </td>
									   <td width="50px" align="center">
											<?php 
											//echo $rec." - ".$semester;
											echo $jsonkrs[$rec][$semester]['nilai']; ?>
									   </td>
								   
								  </tr>
							  
							   <?php 
							   $no++;
							   } 
						   }
						   ?>
						</table>
					 	
					<?php
				}else
				{
				?> 
					</td><td width="100px"></td>
					 <td colspan="5" valign="top">
					 	<table border="0" width="100%">
						   <tr>
							   <td colspan="4">
								 <br>
								 <b><?php echo isset( $semester) ? "Semester : ".$semester : ''; ?> </b>
								 <? 
								 //echo count($jsonkrs[$semester]['kode_mata_kuliah']);
								 ?>
							  </td>
						   </tr>
						   <?php 
						  if(isset($jsonkrs[$semester]) and count($jsonkrs[$semester]['kode_mata_kuliah'])>0){
						  	$no =1;
						   foreach($jsonkrs[$semester]['kode_mata_kuliah'] as $rec){ 
								 
								?>
								   <tr>
									 <td width="10px">
											 <?php echo $no; ?>.
										</td>
									   <td width="100px">
											 <?php echo $rec; ?>
										</td>
										<td width="300px">
											 <?php 
											 //echo $rec." - ".$semester;
											 echo $jsonkrs[$rec][$semester]['namamtk']; ?>
										</td>
										<td width="50px">
											 <?php 
											 //echo $rec." - ".$semester;
											 echo (int)$jsonkrs[$rec][$semester]['sks']; ?>
										</td>
										<td width="50px" align="center">
											 <?php 
											 //echo $rec." - ".$semester;
											 echo $jsonkrs[$rec][$semester]['nilai']; ?>
										</td>
								   
								   </tr>
								<?php 
								$no++;
								} 
						   }?>
						</table>
				 
				<?php
				}
				?> 	
				 
				<?php
			 	$i++;
			 	
			 }
			 
			endfor;
		
		endif;
		?> 
	   
    
    	 <?php 
    	 		$semester = 0;
    	 		$jmlsks = 0;
    	 		$jmlbobot = 0;
    	 		$nilaiangka = "";
				if (isset($datakrs) && is_array($datakrs) && count($datakrs)) : 
				
					foreach ($datakrs as $record) :
					
					if(isset($jsonkonversi[$record->nilai_huruf]))
					{
	        			$nilaiangka = $jsonkonversi[$record->nilai_huruf];
        				//echo $record->semester." = ".$record->sks." = ".$record->nama_mata_kuliah."<br>";
					   	$jmlsks = $jmlsks + (int)$record->sks;
					   
					   //$nilaiangka = $jsonkonversi[$record->nilai_huruf];
					   $jmlbobot = $jmlbobot + ((int)$record->sks*(int)$nilaiangka);
        			}else{
        				//echo $record->nilai_huruf."NIlai huruf<br>";
        				
        			}
        			$no++;
					endforeach; 
				endif;
				?>
				 
	</table>
	 
	   
	<table border="0" width="100%">
	 <tr>
            
             <td align="center" colspan="5">==============================================================================================================================================================</td>
        </tr>
    	 
    </table>
    <br/>
   
</div> 
