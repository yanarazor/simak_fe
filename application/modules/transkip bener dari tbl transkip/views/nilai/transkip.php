<?php
	$this->load->library('predikat');
	$classpredikat = new predikat();
	
?>
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
 <div style="margin-left:0px;margin-top:30px;"> 
    <table border="0" style="font-size:16px;font-weight:bold;" width="100%">
    	<tr> <td width="270px" align="center"> UNIVERSITAS MUHAMMADIYAH JAKARTA </td></tr>
        <tr><td align="center"> <?php echo isset($datamahasiswa[0]->nama_fakultas) ? $datamahasiswa[0]->nama_fakultas : ""; ?> </td></tr>
        <tr><td align="center"> Jl. K. H. Ahmad Dahlan Cirendeu Ciputat Jakarta Selatan	 </td></tr>
        <tr><td align="center">==========================================================================================================================</td></tr>
        	
    </table>
    <br> 
    <table border="0" width="100%">
   		 <tr>
        	<td align="center" colspan="2">** DAFTAR NILAI AKADEMIS / TRANSKIP ** <br></td> 
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
            
             <td align="center" colspan="3">==========================================================================================================================</td>
        </tr>
    </table>
	   <br>
    <table border="0" width="100%">
	<tr> 
		 <th style="padding:5px;" width="100px">Kode MK</th>
		 <th style="padding:5px;" width="300px">MATA KULIAH</th>
		 <th style="padding:5px;" width="50px">SKS</th>
		 <th style="padding:5px;" width="50px">Nilai</th>
		 <th width="100px"></th>
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
	 	
			for($smt=1;$smt<$semesterakhir+1;$smt++):
			 $sms = (int)str_replace("semester : ","",$smt);
			 if($sms !=$semester){
				$no = 1;
				$semester = $sms;
				 
				if($i%2==0){ //genap
					?> 
					 </td>
					 <tr>
					 <td colspan="4" valign="top">
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
						    //print_r($jsonkrs[$semester]);
						   foreach($jsonkrs[$semester]['kode_mk'] as $rec){ ?>
							  <tr>
								  <td width="100px">
								  		<?php echo $rec; ?>
								   </td>
								   <td width="400px">
								  		<?php 
								  		//echo $rec." - ".$sms;
								  		echo $jsonkrs[$rec][$sms]['namamtk']; ?>
								   </td>
								   <td width="50px">
								  		<?php 
								  		//echo $rec." - ".$semester;
								  		echo (int)$jsonkrs[$rec][$sms]['sks']; ?>
								   </td>
								   <td width="50px" align="center">
								  		<?php 
								  		//echo $rec." - ".$semester;
								  		echo $jsonkrs[$rec][$sms]['nilai']; ?>
								   </td>
								   
							  </tr>
							  
						   <?php } ?>
						</table>
					 	
					<?php
				}else
				{
				?> 
					</td><td width="100px"></td>
					 <td colspan="4" valign="top">
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
						   <?php foreach($jsonkrs[$semester]['kode_mk'] as $rec){ ?>
							  <tr>
								  <td width="100px">
								  		<?php echo $rec; ?>
								   </td>
								   <td width="300px">
								  		<?php 
								  		//echo $rec." - ".$semester;
								  		echo $jsonkrs[$rec][$sms]['namamtk']; ?>
								   </td>
								   <td width="50px">
								  		<?php 
								  		//echo $rec." - ".$semester;
								  		echo (int)$jsonkrs[$rec][$sms]['sks']; ?>
								   </td>
								   <td width="50px" align="center">
								  		<?php 
								  		//echo $rec." - ".$semester;
								  		echo $jsonkrs[$rec][$sms]['nilai']; ?>
								   </td>
								   
							  </tr>
						   <?php } ?>
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
	 
	   <br>
	<table border="0" width="100%">
	 <tr>
            
             <td align="center" colspan="5">==========================================================================================================================</td>
        </tr>
    	<tr>
    		<td align="left" width="100px">  </td>
    		<td></td>
    		<td> </td>
    		<td width="600px"></td>
    		<td> Jakarta, <?php echo date("d m Y"); ?></td>
    	</tr>
        <tr><td>  </td><td></td><td></td>
        <td width="400px"></td>
    		<td> Ketua Program Studi,</td>
    		</tr>
        <tr><td> Total SKS	 </td><td>:</td><td><?php echo $jmlsks; ?></td></tr>
        <tr><td> I.P. Kumulatif	 </td><td>:</td><td>
        	<?php 
        	$ipk = 0;
        	if($jmlbobot!="" and $jmlsks != "")
        	{
        		$ipk = round($jmlbobot/$jmlsks, 2);
        	}
        		echo $ipk; 
        	?>
        	
        </td></tr> 
         <tr><td> Predikat	 </td><td>:</td><td>
        	<?php
        		$recordpredikat  = $classpredikat->getpredikat($ipk);
        		if(isset($recordpredikat[0]->predikat))
	        		echo $recordpredikat[0]->predikat;
    			else
    				echo "-";    		
        	?>
        	
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
	   <a class="btn btn-large btnprint" target="_blank" href="<?php echo site_url(SITE_AREA .'/krs/transkip/printtranskip/');echo isset($mhs)? "/".$mhs:""; ?>/print/<?php echo isset($nilai) ? $nilai: ""; ?>">
		Cetak Data
		</a>
	</center>
</div> 
