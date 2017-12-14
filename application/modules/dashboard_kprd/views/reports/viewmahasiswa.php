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
   <form action="#" method="post" id="frmnilai" accept-charset="utf-8">
   <table border="0" style="font-size:10px;" width="100%">
    	<tr>
            <td align="left" width="100px" > Program Studi</td>
            <td align="left" width="10px">:</td>
            <td align="left" width="250px"><?php echo isset($nama_jurusan)?$nama_jurusan:"" ?></td>
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
            <td><?php echo isset($dosen) ? $dosen:"" ?></td>
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
        </tr>
		
    </table>
    <table class="table table-bordered table-responsive">
	<tr>
		 <th style="padding:5px;" width="20px" rowspan="2">No</th>
		 <th style="padding:5px;" width="100px" rowspan="2">NIM</th>
		 <th style="padding:5px;" rowspan="2">Nama</th>
		 <th style="padding:5px;" width="200px" colspan="5">Nilai</th>
	</tr>
	<tr>
		 <th style="padding:5px;">Tugas 1
		 	<br>
		 	<?php echo isset( $bobot_harian) ? $bobot_harian : ''; ?>
		 	<span class="add-on">%</span>
		 </th>
		 <th style="padding:5px;">Tugas 2
		 	<br>
		 	<?php echo isset( $normatif) ? $normatif : ''; ?>
		 	<span class="add-on">%</span>
		 </th>
		 <th style="padding:5px;">UTS <br>
		 	<?php echo isset( $uts) ? $uts : ''; ?>
		 	<span class="add-on">%</span>
		 </th>
		 <th style="padding:5px;">UAS <br>
		 	<?php echo isset( $uas) ? $uas : ''; ?>
		 	<span class="add-on">%</span>
		 </th>
		 <th style="padding:5px;">Nilai Akhir</th>
	 </tr>
	 
     
    
    	 <?php 
    	 		$semester = 0;
    	 		$hal = 1;
				if (isset($records) && is_array($records) && count($records)) : 
					 
					$no = 1;
					
					 foreach ($records as $record) :
					
				?> 
				  
				  <tr>
					<td valign="middle" align="center" style="padding:5px;"> <?php echo $no; ?>. </td>
					<td valign="middle" align="left" style="padding:5px;"> <?php echo isset( $record->mahasiswa) ? $record->mahasiswa : ''; ?></td>
			 		<td valign="middle" align="left" style="padding:5px;"> <?php echo isset( $record->nama_mahasiswa) ? $record->nama_mahasiswa : ''; ?></td>
					<td align="center">
						<?php echo isset( $record->harian) ? $record->harian : ''; ?>
						<input type="hidden" name="id_krs[]" id="id_krs_<?php echo $no; ?>" value="<?php echo isset( $record->id_krs) ? $record->id_krs : ''; ?>" width="50px"/>
					</td>
					<td align="center" valign="middle">
						<?php echo isset( $record->normatif) ? $record->normatif : ''; ?>
						
					</td>
					<td align="center">
						<?php echo isset( $record->uts) ? $record->uts : ''; ?>
					</td>
					<td align="center">
						<?php echo isset( $record->uas) ? $record->uas : ''; ?>
					</td>
					<td align="center">
						<?php echo isset( $record->nilai_angka) ? $record->nilai_angka : ''; ?>
						(<?php echo isset( $record->nilai_huruf) ? $record->nilai_huruf : ''; ?>)
					</td>
					 
				  </tr>
        		<?php 
        		$hal++;
        		$no++;
					endforeach; 
				else:
				?>
				<td colspan="8">Mahasiswa tidak ada</td>
				<?php
				endif;
				?>
		<?php //if (isset($records) && is_array($records) && count($records)) : 
				?>
				 
				<?php
				   
		 // endif;
		  ?>	 
	</table>
  </div> 
</div> 
 