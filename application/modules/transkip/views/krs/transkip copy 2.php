<?php
	$this->load->library('predikat');
	$classpredikat = new predikat();
	$this->load->library('convert');
	$classConvert = new Convert();
?>
<style>
 .borderbottom {
	  	border-bottom: 1px solid black;
		border-width: 1px;
   }
   	.borderleft {
	  	border-left: 1px solid black;
		border-width: 1px;
   	}
   	 body {
		font-weight:normal;
      	font-style:normal;
      	font-variant:normal;
		font-size : 9pt;
    }
	th{
		font-size : 10pt;
	}
	td{
		padding-left:2px;
	}
@media print {
    body {
		font-weight:normal;
      	font-style:normal;
      	font-variant:normal;
		font-size : 8pt;
    }
	th{
		font-size : 9pt;
	}
	td{
		padding-left:2px;
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
	.borderbottom {
	  	border-bottom: 1px solid black;
		border-width: 1px;
   	}
   	.borderleft {
	  	border-left: 1px solid black;
		border-width: 1px;
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
<div style="margin-left:0px;"> 
    <table border="0" width="100%">
   		 <tr>
        	<td align="center" colspan="7"><b>DAFTAR NILAI AKADEMIS / TRANSKIP</b><br></td> 
        </tr>
        <tr>
            <td align="left" width="150px">N a m a</td>
            <td width="4px">
            	:
            </td>
            <td align="left" width="200px"><?php echo isset($datamahasiswa[0]->nama_mahasiswa)?$datamahasiswa[0]->nama_mahasiswa:"" ?> </td>
            <td width="5%"></td>
            <td align="left" width="100px"> Fakultas</td>
            <td align="left" width="4px">:</td>
            <td align="left"><?php echo isset($datamahasiswa[0]->nama_fakultas)?$datamahasiswa[0]->nama_fakultas:"" ?> </td>
        </tr>
        <tr>
        	<td align="left">Tempat tanggal lahir</td>
            <td>:</td>
            <td align="left"><?php echo isset($datamahasiswa[0]->tempat_lahir)?$datamahasiswa[0]->tempat_lahir:"" ?>,
            <?php echo $classConvert->fmtDate(isset($datamahasiswa[0]->tgl_lahir)?$datamahasiswa[0]->tgl_lahir:"","dd month yyyy"); ?> </td>
            <td></td>
            <td align="left">Program Studi</td>
            <td align="left">:</td>
            <td align="left"><?php echo isset($datamahasiswa[0]->nama_prodi)?$datamahasiswa[0]->nama_prodi:"" ?> </td>
        </tr>
    	<tr>
        	<td align="left"> Nomor Pokok Mahasiswa (NPM)</td>
            <td>:</td>
            <td align="left"><?php echo isset($datamahasiswa[0]->nim_mhs)?$datamahasiswa[0]->nim_mhs:"" ?> </td>
            <td></td>
           <td align="left">Konsentrasi</td>
            <td align="left">:</td>
            <td align="left"><?php echo isset($datamahasiswa[0]->nama_prodi)?$datamahasiswa[0]->nama_prodi:"" ?> </td>
        </tr>
        <tr>
        	<td align="left"></td>
            <td></td>
            <td align="left"></td>
            <td></td>
           <td align="left">Jenjang Pendidikan</td>
            <td align="left">:</td>
            <td align="left"><?php echo $datamahasiswa[0]->kode_jenjang_studi == "C" ? "Strata Satu (S 1)": "Strata Satu  (S 1)" ?> </td>
        </tr>
        <tr>
             <td align="center" colspan="3">&nbsp;</td>
        </tr>
    </table>
	   <br>
    <table border="1" width="100%">
	<tr> 
		 <th style="padding:5px;" width="10px" rowspan="2">No</th>
		 <th style="padding:5px;" width="100px" rowspan="2">Kode MK</th>
		 <th style="padding:5px;" width="300px" rowspan="2">MATA KULIAH</th>
		 <th style="padding:5px;" width="50px" rowspan="2">SKS</th>
		 <th style="padding:5px;" width="100px" colspan="2">Nilai</th>
		 <th width="10px" rowspan="2"></th>
		 <th style="padding:5px;" width="10px" rowspan="2">No</th>
		 <th style="padding:5px;" width="100px" rowspan="2">Kode MK</th>
		 <th style="padding:5px;" width="300px" rowspan="2">MATA KULIAH</th>
		 <th style="padding:5px;" width="50px" rowspan="2">SKS</th>
		 <th style="padding:5px;" width="50px" colspan="2">Nilai</th>
    </tr>
    <tr>
    	<th>Angka Mutu</th>
    	<th>Huruf Mutu</th>
    	
    	<th>Angka Mutu</th>
    	<th>Huruf Mutu</th>
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
					 <td colspan="6" valign="top">
					 	<table border="0" width="100%">
						   <tr>
						   	<td>
						   	</td>
							   <td colspan="2" class="borderbottom borderleft">
								  <b><?php echo isset( $semester) ? "Semester : ".$semester : ''; ?> </b>
							  </td>
							  	<td class="borderbottom borderleft">
						   		</td>
						   		<td class="borderbottom borderleft">
						   		</td>
						   		<td class="borderbottom borderleft">
						   		</td>
						   </tr>
						   <?php 
							if(isset($jsonkrs[$semester]['kode_mk'])){
							foreach($jsonkrs[$semester]['kode_mk'] as $rec){ ?>
							   <tr>
							   		<td width="22px" style="padding:5px;">
										 <?php echo $no; ?>
									</td>
								   <td class="borderleft" width="100px" >
										 <?php echo $rec; ?>
									</td>
									<td width="245px"class="borderleft">
										 <?php 
										 echo $jsonkrs[$rec][$sms]['namamtk']; ?>
									</td>
									<td width="52px" align="center" class="borderleft">
										 <?php 
										 //echo $rec." - ".$semester;
										 echo (int)$jsonkrs[$rec][$sms]['sks']; ?>
									</td>
									<td width="50px" align="center" class="borderleft">
										 <?php 
										 //echo $rec." - ".$semester;
										 echo $jsonkrs[$rec][$sms]['nilai']; ?>
									</td>
									<td width="50px" align="center" class="borderleft">
										 <?php 
										 //echo $rec." - ".$semester;
										 echo $jsonkrs[$rec][$sms]['nilai']; ?>
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
					</td><td width="10px"></td>
					 <td colspan="6" valign="top">
					 	<table border="0" width="100%">
						   <tr>
						   	<td>
						   	</td>
							   <td colspan="2" class="borderbottom borderleft">
								  <b><?php echo isset( $semester) ? "Semester : ".$semester : ''; ?> </b>
							  </td>
							  	<td class="borderbottom borderleft">
						   		</td>
						   		<td class="borderbottom borderleft">
						   		</td>
						   		<td class="borderbottom borderleft">
						   		</td>
						   </tr>
						   
						   <?php 
						   if(isset($jsonkrs[$semester]['kode_mk'])){
						   	$no = 1;
						   	foreach($jsonkrs[$semester]['kode_mk'] as $rec){ ?>
							  <tr>
							   		<td width="22px" style="padding:5px;">
										 <?php echo $no; ?>
									</td>
								   <td class="borderleft" width="100px" >
										 <?php echo $rec; ?>
									</td>
									<td width="245px"class="borderleft">
										 <?php 
										 echo $jsonkrs[$rec][$sms]['namamtk']; ?>
									</td>
									<td width="52px" align="center" class="borderleft">
										 <?php 
										 //echo $rec." - ".$semester;
										 echo (int)$jsonkrs[$rec][$sms]['sks']; ?>
									</td>
									<td width="50px" align="center" class="borderleft">
										 <?php 
										 //echo $rec." - ".$semester;
										 echo $jsonkrs[$rec][$sms]['nilai']; ?>
									</td>
									<td width="50px" align="center" class="borderleft">
										 <?php 
										 //echo $rec." - ".$semester;
										 echo $jsonkrs[$rec][$sms]['nilai']; ?>
									</td>
						   <?php $no++;
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
	 
	   <br>
	<table border="0" width="100%">
		
    	
        
    		</tr>
        <tr><td> Kredit Mata Kuliah Wajib	 </td><td>:</td><td><?php echo $jmlsks; ?></td>
        	<td width="200px"></td>
        	<td> Indeks Prestasi Kumulatif	 </td><td>:</td><td>
        	<?php 
        	$ipk = 0;
        	if($jmlbobot!="" and $jmlsks != "")
        	{
        		$ipk = round($jmlbobot/$jmlsks, 2);
        	}
        		echo $ipk; 
        	?>
        	
        </td>
    </tr>
        <tr>
			 <td> Kredit Mata Kuliah Pilihan	 </td><td>:</td><td>0</td>
			 <td></td>
			 <td> Predikat	 </td><td>:</td><td>
				 <?php
					 $recordpredikat  = $classpredikat->getpredikat($ipk);
					 if(isset($recordpredikat[0]->predikat))
						 echo $recordpredikat[0]->predikat;
					 else
						 echo "-";    		
				 ?>
			
			 </td>
        </tr>
        <tr>
        <td> Total Kredit	 </td><td>:</td><td><?php echo $jmlsks; ?></td>
        <td></td>
        <td>Tanggal Keulusan</td>
        <td>:</td>
        <td></td>
        </tr>
        
    	<tr>
    		<td align="left">  </td>
    		<td></td>
    		<td> </td>
    		<td></td>
    		<td align="center"> 
    			Jakarta,<?php echo $classConvert->fmtDate(date("Y-m-d"),"dd month yyyy"); ?>
    			<br>
    			Dekan,
    		</td>
    	</tr>
    </table>
    <br/>
   <center>
	   <a class="btn btn-large btnprint" target="_blank" href="<?php echo site_url(SITE_AREA .'/nilai/transkip/printtranskip/');echo isset($mhs)? "/".$mhs:""; ?>/print/<?php echo isset($nilai) ? $nilai: ""; ?>">
		Cetak Data
		</a>
	</center>
</div> 
