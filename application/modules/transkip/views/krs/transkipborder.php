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
		font-size : 7pt;
    }
	th{
		font-size : 7.5pt;
		font-weight:normal;
      	font-style:normal;
      	font-variant:normal;
	}
	.head{
		font-size : 10pt;
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
   	.noborderbottom {
	  	border-bottom: 1px solid transparent;
		border-width: 1px;
   	}
   	.nobordertop {
	  	border-top: 1px solid white;
	  	border-left: 1px solid black;
	  	border-right: 1px solid black;
		border-width: 1px;
   	}
   	.noborderleft {
	  	border-left: 1px solid transparent;
		border-width: 1px;
   	}
   	.borderleft {
	  	border-left: 1px solid black;
		border-width: 1px;
   	}
   	.bordertop {
	  	border-top: 1px solid black !important;
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
        	<td align="center" colspan="7" class="head"><b>DAFTAR NILAI AKADEMIS / TRANSKIP</b><br><br></td> 
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
        
    </table>
    <table border="1" width="100%" class="borderbottom">
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
    <tr>
    	<td class="noborderbottom">
    	</td>
    	<td>
    	</td>
    	<td colspan="4" class="noborderleft">
	    	Semester 1
	    </td>
	    
    	<td class="noborderbottom">
    	</td>
    	<td class="noborderbottom">
    	
	    </td>
    	<td>	
    	</td>
    	<td colspan="4" class="noborderleft">
    		Semester 2
    	</td>
    	 
    </tr>
    <!-- semester 1 -->
    <?php 
    	$no = 1;
    	$no2 = 1;
    	$jmlmk = isset($jsonkrs[1]['kode_mk']) ? count($jsonkrs[1]['kode_mk']) : 0;
    	$jmlmk2 = isset($jsonkrs[2]['kode_mk']) ? count($jsonkrs[2]['kode_mk']) : 0;
    	$jml = ($jmlmk > $jmlmk2) ? $jmlmk : $jmlmk2;
    	for($i=0;$i<$jml;$i++){
    		$sms = 1;
    		$sms2 = 2;
    		$kodemk1 = isset($jsonkrs[1]['kode_mk'][$i]) ?  $jsonkrs[1]['kode_mk'][$i] : ""; 
    		$kodemk2 = isset($jsonkrs[2]['kode_mk'][$i]) ?  $jsonkrs[2]['kode_mk'][$i] : ""; 
    		$nilaiangka1 = isset($jsonkrs[$kodemk1][$sms]['nilai']) ?  $jsonkonversi[$jsonkrs[$kodemk1][$sms]['nilai']] : ""; 
    		$nilaiangka2 = isset($jsonkrs[$kodemk2][$sms2]['nilai']) ?  $jsonkonversi[$jsonkrs[$kodemk2][$sms2]['nilai']] : ""; 
    	?>
    		<tr>
				<td width="22px" style="padding:5px;" align="center" class="noborderbottom">
					 <?php echo isset($jsonkrs[$kodemk1][$sms]['namamtk']) ? $no : ""; ?>
				</td>
			   <td width="100px">
					 <?php echo $kodemk1; ?>
				</td>
				<td width="245px">
					 <?php 
					 echo isset($jsonkrs[$kodemk1][$sms]['namamtk']) ? $jsonkrs[$kodemk1][$sms]['namamtk'] : ""; ?>
				</td>
				<td width="52px" align="center">
					 <?php 
					 //echo $rec." - ".$semester;
					 echo isset($jsonkrs[$kodemk1][$sms]['sks']) ? (int)$jsonkrs[$kodemk1][$sms]['sks'] : ""; ?>
				</td>
				<td width="50px" align="center">
					 <?php 
					 echo $nilaiangka1;
					 
					 ?>
				</td>
				<td width="50px" align="center">
					 <?php 
					 //echo $rec." - ".$semester;
					 echo isset($jsonkrs[$kodemk1][$sms]['nilai']) ? $jsonkrs[$kodemk1][$sms]['nilai'] : ""; ?>
				</td>
				<td class="noborderbottom">
					<!-- semester 2 -->
				</td>
				<td width="22px" align="center" style="padding:5px;" class="noborderbottom">
					 <?php echo isset($jsonkrs[$kodemk2][$sms2]['namamtk']) ? $no2 : ""; ?>
				</td>
			   <td width="100px" >
					 <?php echo $kodemk2; ?>
				</td>
				<td width="245px">
					 <?php 
					 echo isset($jsonkrs[$kodemk2][$sms2]['namamtk']) ? $jsonkrs[$kodemk2][$sms2]['namamtk'] : ""; ?>
				</td>
				<td width="52px" align="center">
					 <?php 
					 //echo $rec." - ".$semester;
					 echo isset($jsonkrs[$kodemk2][$sms2]['sks']) ? (int)$jsonkrs[$kodemk2][$sms2]['sks'] : ""; ?>
				</td>
				<td width="50px" align="center">
					 <?php 
					 //echo $rec." - ".$semester;
					 echo $nilaiangka2; 
					  ?>
				</td>
				<td width="50px" align="center">
					 <?php 
					 //echo $rec." - ".$semester;
					 echo isset($jsonkrs[$kodemk2][$sms2]['nilai']) ? $jsonkrs[$kodemk2][$sms2]['nilai'] : ""; ?>
				</td>
			   
		   </tr>
		<?php
    		$no++;
    		$no2++;
    	}
		?>
		<tr>
			<td>
			</td>
			<td colspan="12">
				<br> 
			</td>
		</tr>
		 <!-- semester 3 -->
		<tr>
    	<td class="noborderbottom">
    	</td>
    	<td>
    	</td>
    	<td colspan="4" class="noborderleft">
	    	Semester 3
	    </td>
	    
    	 
    	<td>
	    </td>
    	<td class="noborderbottom">	
    	</td>
    	<td>
	    </td>
    	<td colspan="4" class="noborderleft">
    		Semester 4
    	</td>
    	 
    </tr>
    <?php 
    	$no = 1;
    	$no2 = 1;
    	$jmlmk = isset($jsonkrs[3]['kode_mk']) ? count($jsonkrs[3]['kode_mk']) : 0;
    	$jmlmk2 = isset($jsonkrs[4]['kode_mk']) ? count($jsonkrs[4]['kode_mk']) : 0;
    	$jml = ($jmlmk > $jmlmk2) ? $jmlmk : $jmlmk2;
    	for($i=0;$i<$jml;$i++){
    		$sms = 3;
    		$sms2 = 4;
    		$kodemk1 = isset($jsonkrs[3]['kode_mk'][$i]) ?  $jsonkrs[3]['kode_mk'][$i] : ""; 
    		$kodemk2 = isset($jsonkrs[4]['kode_mk'][$i]) ?  $jsonkrs[4]['kode_mk'][$i] : ""; 

    		$nilaiangka1 = isset($jsonkrs[$kodemk1][$sms]['nilai']) ?  $jsonkonversi[$jsonkrs[$kodemk1][$sms]['nilai']] : ""; 
    		$nilaiangka2 = isset($jsonkrs[$kodemk2][$sms2]['nilai']) ?  $jsonkonversi[$jsonkrs[$kodemk2][$sms2]['nilai']] : "";
    	?>
    		<tr>
				<td width="22px" align="center" style="padding:5px;" class="noborderbottom">
					 <?php echo isset($jsonkrs[$kodemk1][$sms]['namamtk']) ? $no : ""; ?>
				</td>
			   <td width="100px" >
					 <?php echo $kodemk1; ?>
				</td>
				<td width="245px">
					 <?php 
					 echo isset($jsonkrs[$kodemk1][$sms]['namamtk']) ? $jsonkrs[$kodemk1][$sms]['namamtk'] : ""; ?>
				</td>
				<td width="52px" align="center">
					 <?php 
					 //echo $rec." - ".$semester;
					 echo isset($jsonkrs[$kodemk1][$sms]['sks']) ? (int)$jsonkrs[$kodemk1][$sms]['sks'] : ""; ?>
				</td>
				<td width="50px" align="center">
					 <?php 
					 //echo $rec." - ".$semester;
					 echo isset($nilaiangka1) ? $nilaiangka1 : ""; ?>
				</td>
				<td width="50px" align="center">
					 <?php 
					 //echo $rec." - ".$semester;
					 echo isset($jsonkrs[$kodemk1][$sms]['nilai']) ? $jsonkrs[$kodemk1][$sms]['nilai'] : ""; ?>
				</td>
				<td class="noborderbottom">
					<!-- semester 2 -->
				</td>
				<td width="22px" align="center" style="padding:5px;" class="noborderbottom">
					 <?php echo isset($jsonkrs[$kodemk2][$sms2]['namamtk']) ? $no2 : ""; ?>
				</td>
			   <td width="100px" >
					 <?php echo $kodemk2; ?>
				</td>
				<td width="245px">
					 <?php 
					 echo isset($jsonkrs[$kodemk2][$sms2]['namamtk']) ? $jsonkrs[$kodemk2][$sms2]['namamtk'] : ""; ?>
				</td>
				<td width="52px" align="center">
					 <?php 
					 //echo $rec." - ".$semester;
					 echo isset($jsonkrs[$kodemk2][$sms2]['sks']) ? (int)$jsonkrs[$kodemk2][$sms2]['sks'] : ""; ?>
				</td>
				<td width="50px" align="center">
					 <?php 
					 //echo $rec." - ".$semester;
					echo $nilaiangka2; 
					?>
				</td>
				<td width="50px" align="center">
					 <?php 
					 //echo $rec." - ".$semester;
					 echo isset($jsonkrs[$kodemk2][$sms2]['nilai']) ? $jsonkrs[$kodemk2][$sms2]['nilai'] : ""; ?>
				</td>
			   
		   </tr>
		<?php
    		$no++;
    		$no2++;
    	}
		?>
		
		<tr>
			<td>
			</td>
			<td colspan="12">
				<br> 
			</td>
		</tr>
		 <!-- semester 3 -->
		<tr>
    	<td>
    	</td>
    	<td>
    	</td>
    	<td colspan="4" class="noborderleft">
	    	Semester 5
	    </td>
	    
    	 
    	<td>
	    </td>
    	<td class="noborderbottom">	
    	</td>
    	<td>
	    </td>
    	<td colspan="4" class="noborderleft">
    		Semester 6
    	</td>
    	 
    </tr>
    <?php 
    	$no = 1;
    	$no2 = 1;
    	$jmlmk = isset($jsonkrs[5]['kode_mk']) ? count($jsonkrs[5]['kode_mk']) : 0;
    	$jmlmk2 = isset($jsonkrs[6]['kode_mk']) ? count($jsonkrs[6]['kode_mk']) : 0;
    	$jml = ($jmlmk > $jmlmk2) ? $jmlmk : $jmlmk2;
    	for($i=0;$i<$jml;$i++){
    		$sms = 5;
    		$sms2 = 6;
    		$kodemk1 = isset($jsonkrs[5]['kode_mk'][$i]) ?  $jsonkrs[5]['kode_mk'][$i] : ""; 
    		$kodemk2 = isset($jsonkrs[6]['kode_mk'][$i]) ?  $jsonkrs[6]['kode_mk'][$i] : ""; 
    		$nilaiangka1 = isset($jsonkrs[$kodemk1][$sms]['nilai']) ?  $jsonkonversi[$jsonkrs[$kodemk1][$sms]['nilai']] : ""; 
    		$nilaiangka2 = isset($jsonkrs[$kodemk2][$sms2]['nilai']) ?  $jsonkonversi[$jsonkrs[$kodemk2][$sms2]['nilai']] : "";
    	?>
    		<tr>
				<td width="22px" align="center" style="padding:5px;" class="noborderbottom">
					 <?php echo isset($jsonkrs[$kodemk1][$sms]['namamtk']) ? $no : ""; ?>
				</td>
			   <td width="100px" >
					 <?php echo $kodemk1; ?>
				</td>
				<td width="245px">
					 <?php 
					 echo isset($jsonkrs[$kodemk1][$sms]['namamtk']) ? $jsonkrs[$kodemk1][$sms]['namamtk'] : ""; ?>
				</td>
				<td width="52px" align="center">
					 <?php 
					 //echo $rec." - ".$semester;
					 echo isset($jsonkrs[$kodemk1][$sms]['sks']) ? (int)$jsonkrs[$kodemk1][$sms]['sks'] : ""; ?>
				</td>
				<td width="50px" align="center">
					 <?php 
					 echo $nilaiangka1; ?>
				</td>
				<td width="50px" align="center">
					 <?php 
					 //echo $rec." - ".$semester;
					 echo isset($jsonkrs[$kodemk1][$sms]['nilai']) ? $jsonkrs[$kodemk1][$sms]['nilai'] : ""; ?>
				</td>
				<td class="noborderbottom">
					<!-- semester 2 -->
				</td>
				<td width="22px" align="center" style="padding:5px;" class="noborderbottom">
					 <?php echo isset($jsonkrs[$kodemk2][$sms2]['namamtk']) ? $no2 : ""; ?>
				</td>
			   <td width="100px" >
					 <?php echo $kodemk2; ?>
				</td>
				<td width="245px">
					 <?php 
					 echo isset($jsonkrs[$kodemk2][$sms2]['namamtk']) ? $jsonkrs[$kodemk2][$sms2]['namamtk'] : ""; ?>
				</td>
				<td width="52px" align="center">
					 <?php 
					 //echo $rec." - ".$semester;
					 echo isset($jsonkrs[$kodemk2][$sms2]['sks']) ? (int)$jsonkrs[$kodemk2][$sms2]['sks'] : ""; ?>
				</td>
				<td width="50px" align="center">
					 <?php 
					echo $nilaiangka2; 
					?>
				</td>
				<td width="50px" align="center">
					 <?php 
					 //echo $rec." - ".$semester;
					 echo isset($jsonkrs[$kodemk2][$sms2]['nilai']) ? $jsonkrs[$kodemk2][$sms2]['nilai'] : ""; ?>
				</td>
			   
		   </tr>
		<?php
    		$no++;
    		$no2++;
    	}
		?>
		
		<tr>
			<td>
			</td>
			<td colspan="12">
				<br> 
			</td>
		</tr>
		 <!-- semester 7 -->
		<tr>
    	<td class="noborderbottom">
    	</td>
    	<td>
    	</td>
    	<td colspan="4" class="noborderleft">
	    	Semester 7
	    </td>
	    
    	 
    	<td>
	    </td>
    	<td class="noborderbottom">	
    	</td>
    	<td>
	    </td>
    	<td colspan="4" class="noborderleft">
    		Semester 8
    	</td>
    	 
    </tr>
    <?php 
    	$no = 1;
    	$no2 = 1;
    	$jmlmk = isset($jsonkrs[7]['kode_mk']) ? count($jsonkrs[7]['kode_mk']) : 0;
    	$jmlmk2 = isset($jsonkrs[8]['kode_mk']) ? count($jsonkrs[8]['kode_mk']) : 0;
    	$jml = ($jmlmk > $jmlmk2) ? $jmlmk : $jmlmk2;
    	for($i=0;$i<$jml;$i++){
    		$sms = 7;
    		$sms2 = 8;
    		$kodemk1 = isset($jsonkrs[$sms]['kode_mk'][$i]) ?  $jsonkrs[$sms]['kode_mk'][$i] : ""; 
    		$kodemk2 = isset($jsonkrs[$sms2]['kode_mk'][$i]) ?  $jsonkrs[$sms2]['kode_mk'][$i] : ""; 
    		$nilaiangka1 = isset($jsonkrs[$kodemk1][$sms]['nilai']) ?  $jsonkonversi[$jsonkrs[$kodemk1][$sms]['nilai']] : ""; 
    		$nilaiangka2 = isset($jsonkrs[$kodemk2][$sms2]['nilai']) ?  $jsonkonversi[$jsonkrs[$kodemk2][$sms2]['nilai']] : "";
    	?>
    		<tr>
				<td width="22px" align="center" style="padding:5px;" class="nobordertop">
					 <?php echo isset($jsonkrs[$kodemk1][$sms]['namamtk']) ? $no : ""; ?>
				</td>
			   <td width="100px">
					 <?php echo $kodemk1; ?>
				</td>
				<td width="245px">
					 <?php 
					 echo isset($jsonkrs[$kodemk1][$sms]['namamtk']) ? $jsonkrs[$kodemk1][$sms]['namamtk'] : ""; ?>
				</td>
				<td width="52px" align="center">
					 <?php 
					 //echo $rec." - ".$semester;
					 echo isset($jsonkrs[$kodemk1][$sms]['sks']) ? (int)$jsonkrs[$kodemk1][$sms]['sks'] : ""; ?>
				</td>
				<td width="50px" align="center">
					 <?php 
					 //echo $rec." - ".$semester;
					 echo $nilaiangka1; 
					 ?>
				</td>
				<td width="50px" align="center">
					 <?php 
					 //echo $rec." - ".$semester;
					 echo isset($jsonkrs[$kodemk1][$sms]['nilai']) ? $jsonkrs[$kodemk1][$sms]['nilai'] : ""; ?>
				</td>
				<td class="nobordertop">
					<!-- semester 2 -->
				</td>
				<td width="22px" align="center" style="padding:5px;" class="nobordertop">
					 <?php echo isset($jsonkrs[$kodemk2][$sms2]['namamtk']) ? $no2 : ""; ?>
				</td>
			   <td width="100px" >
					 <?php echo $kodemk2; ?>
				</td>
				<td width="245px">
					 <?php 
					 echo isset($jsonkrs[$kodemk2][$sms2]['namamtk']) ? $jsonkrs[$kodemk2][$sms2]['namamtk'] : ""; ?>
				</td>
				<td width="52px" align="center">
					 <?php 
					 //echo $rec." - ".$semester;
					 echo isset($jsonkrs[$kodemk2][$sms2]['sks']) ? (int)$jsonkrs[$kodemk2][$sms2]['sks'] : ""; ?>
				</td>
				<td width="50px" align="center">
					<?php 
						echo $nilaiangka2; 
					?>
				</td>
				<td width="50px" align="center">
					 <?php 
					 //echo $rec." - ".$semester;
					 echo isset($jsonkrs[$kodemk2][$sms2]['nilai']) ? $jsonkrs[$kodemk2][$sms2]['nilai'] : ""; ?>
				</td>
			   
		   </tr>
		   <tr>
			
		</tr>
		<?php
    		$no++;
    		$no2++;
    	}
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
    			<br>
    			Jakarta, <?php echo $classConvert->fmtDate(date("Y-m-d"),"dd month yyyy"); ?>
    			<br>
    			Dekan,
    			<br>
    			<br>
    			<br>
    			<?php echo isset($datamahasiswa[0]->dekan)?$datamahasiswa[0]->dekan:"" ?> 
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
