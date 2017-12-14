<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/css/dropzone/dropzone.min.css">
<script src="<?php echo base_url(); ?>themes/admin/js/dropzone/dropzone.min.js"></script>
<!-- sweet alert -->
<script src="<?php echo base_url(); ?>themes/admin/js/sweetalert.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/css/sweetalert.css">
<?php
	$this->load->library('convert');
	$convert = new convert();
  // Change the css classes to suit your needs
if( isset($datamahasiswa) ) {
//    $datamahasiswa = (array)$datamahasiswa;
}
$id = isset($datakrs['id']) ? $datakrs['id'] : '';
?>
<div class="box box-info">
	  
  <div class="box-body">
  	<table border="0" style="font-size:10px;" width="100%">
    	<tr>
            <td align="left" width="100px" > Program Studi</td>
            <td align="left" width="10px">:</td>
            <td align="left" width="350px"><?php echo isset($nama_jurusan)?$nama_jurusan:"" ?></td>
            <td>&nbsp;</td>
            <td  width="100px"></td>
            <td align="left" width="10px"></td>
            <td></td>
        </tr>
        <tr>
            <td align="left"> Mata Kuliah  </td>
            <td align="left">:</td>
            <td><?php echo isset($nama_mk)?$nama_mk:"" ?></td>
            <td>&nbsp;</td>
            <td width="100px"></td>
            <td align="left" width="10px"></td>
            <td>
              
             </td>
        </tr>
        
       <tr>
        	 
            <td align="left">Dosen</td>
            <td align="left">:</td>
            <td><?php echo isset($dosen) ? $dosen:"" ?> 
            	[Tugas 1 :
			   	<?php echo isset($bobot_harian) ? $bobot_harian : "" ?>%, 
			   	Tugas :
			   	<?php echo isset($normatif) ? $normatif : "" ?>%, 
				UTS :
			   	<?php echo isset($uts) ? $uts : "" ?>%, 
				UAS :
			   	<?php echo isset($uas) ? $uas : "" ?>%]
			</td>
            <td>&nbsp;</td>
            <td width="100px">KELAS</td>
            <td align="left" width="10px">:</td>
            <td><?php echo isset($kelas)?$kelas:"" ?></td>
        </tr>
		<tr>
        	 
            <td align="left">Semester </td>
            <td align="left">:</td>
            <td ><?php echo $tahunakademik; ?></td>
            <td>&nbsp;</td>
            <td width="200px">JUMLAH MAHASISWA</td>
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
             <td align="right">
             	 
			</td>
             
        </tr>
		
    </table>
    <div class="pull-right"><a href="<?php echo base_url(); ?>admin/reports/dashboard_kprd/printlaporandosen/simple/<?php echo $kode_jadwal;?>?kode_mk=<?php echo $kode_mk;?>&kelas=<?php echo $kelas;?>&sms=<?php echo $sms;?>&tahun=<?php echo $tahun;?>" target="_blank" class="btn btn-warning"><i class="nav-icon fa fa-print"> Laporan dosen</i></a></div>
    <table border="1" width="100%" class="">
	<tr>
		 <th style="padding:5px;" width="20px" rowspan="2">No</th>
		 <th style="padding:5px;" width="100px" rowspan="2">NIM</th>
		 <th style="padding:5px;" rowspan="2">Nama</th>
		 <th style="padding:5px;" width="200px" colspan="<?php echo $jml_pertemuan != "" ? $jml_pertemuan : 1; ?>">
		 	Pertemuan
		 </th>
		 <th width="30px" rowspan="2">Persentase</th>
		 <th width="30px" rowspan="2">UTS</th>
		 <th width="30px" rowspan="2">UAS</th>
	</tr>
	<tr>
		<?php for($i=1;$i<($jml_pertemuan+1);$i++){ ?>
			<th style="padding:5px;">
			   <?php echo $i; ?>
			</th>
		<?php } ?>
	 </tr>
	 
     
    
    	 <?php 
    	 		$semester = 0;
    	 		$hal = 1;
				if (isset($records) && is_array($records) && count($records)) : 
					 
					$no = 1;
					
					 foreach ($records as $record) :
					$persentase = 0;
					$jmlada = 0;
				?> 
				  
				  <tr>
					<td valign="middle" align="center" style="padding:5px;"> <?php echo $no; ?>. </td>
					<td valign="middle" align="left" style="padding:5px;"> <?php echo isset( $record->mahasiswa) ? $record->mahasiswa : ''; ?></td>
			 		<td valign="middle" align="left" style="padding:5px;"> 
			 			<input type="hidden" name="id_krs[]" id="id_krs_<?php echo $no; ?>" value="<?php echo isset( $record->id) ? $record->id : ''; ?>" width="50px"/>
			 			<?php echo isset( $record->nama_mahasiswa) ? $record->nama_mahasiswa : ''; ?></td>
					<?php for($i=1;$i<($jml_pertemuan+1);$i++){ 
						if(isset($dataabsen[$record->mahasiswa."_".$i])){
							$jmlada = $jmlada + 1;
						}
						//echo $jmlada;
					?>
					<td align="center">
						<?php echo isset($dataabsen[$record->mahasiswa."_".$i]) ? "Ada" :""; ?>
					</td>
					 <?php } ?>
					<td align="center">
						<?php 
							$persentase = $jmlada/$jml_pertemuan * 100;
							echo round($persentase)."%";
							$jmlada = 0;
						?>
					</td>
					<td align="center">
						<?php echo isset($dataabsen[$record->mahasiswa."_uts"]) ? "Ada" :""; ?>
					</td>
					<td align="center">
						<?php echo isset($dataabsen[$record->mahasiswa."_uas"]) ? "Ada" :""; ?> 
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
				 
				<?php
				   
		 // endif;
		  ?>	 
		   
		  <tr>
			<td valign="middle" align="right" style="padding:5px;" colspan="3">Materi :
			</td>
			<?php for($i=1;$i<($jml_pertemuan+1);$i++){ ?>
			<td align="center">
				<?php if(isset($datamateri[$i])){; ?>
					<a href="<?php echo base_url(); ?>admin/nilai/nilai_mahasiswa/lihatmateriabsen/<?php echo $datamateri[$i]; ?>" target="_blank">Lihat</a>
				<?php } ?>
			</td>
			 <?php } ?>
			 <td>
			 </td>
			 <td>
			 </td>
			 <td>
			 </td>
		  </tr>
	</table>
</div> 
</div> 