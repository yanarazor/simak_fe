<?php
	$this->load->library('convert');
	$convert = new convert();
	$kuesioner = $this->settings_lib->item('kuesioner');
?>
<div class="pull-right">

<a href="<?php echo base_url().'admin/krs/datakrs/printkhs/'; ?>/<?php echo $sms; ?>/<?php echo $nim; ?>/print" class='fancy' target="_blank">
	<span class="label label-success"><i class="fa fa-print"></i> Print Khs</span>
 </a>
  
</div> 
<table class="table" class="table table-striped">
   <thead>
		<tr>
		  <th width="20px" rowspan="2">No</th>
			<th rowspan="2">Mata Kuliah</th>
			<th rowspan="2">Sks</th>
			<th rowspan="2">Dosen</th>
			<th rowspan="2">Hari</th>
			<th rowspan="2">Jam</th>
			<th rowspan="2">Semester</th>
			<th colspan="5">Nilai</th>
			<th rowspan="2">Kelas</th>
			<th rowspan="2">Absen</th>
			<?php if($kuesioner == "1"){  ?>
			<th rowspan="2">Kuesioner</th>
			<?php } ?>
		</tr>
		<tr>
			<th>Tugas 1</th>
			<th>Tugas 2</th>
			<th>UTS</th>
			<th>UAS</th>
			<th>Akhir</th>
		</tr>
	</thead>
  	<tbody class="valign-middle">
	   <?php
			  $jmlskssekarang = 0;
			  $no = 1;
				if (isset($recordmks) && is_array($recordmks) && count($recordmks)) :
					foreach ($recordmks as $record) :
				?>
				<tr>
				  <td><?php e($no); ?>.</td>
					<td><?php e($record->nama_mk); ?></td>
					<td><?php 
						$jmlskssekarang = $jmlskssekarang + (int)$record->sks;
						e($record->sks) ?>
					</td>

					<td>
					   <?php 
					   if($record->namadosen!=""){
						 echo $record->namadosen;
					   }else{
						 e($record->nama_dosen); 
					   }
					   ?>
					</td>
					<td><?php e($record->hari) ?></td>
					<td><?php e($record->jam) ?></td>
					<td align="center"><?php e($record->semester) ?></td>
					<td align="center"><?php echo ((int)$record->tahun_akademik >= 20162 and isset($jsonkues[$record->kode_jadwal])) ? $record->harian : ""; ?></td>
					<td align="center"><?php echo ((int)$record->tahun_akademik >= 20162 and isset($jsonkues[$record->kode_jadwal])) ? $record->normatif : ""; ?></td>
					<td align="center"><?php echo ((int)$record->tahun_akademik >= 20162 and isset($jsonkues[$record->kode_jadwal])) ? $record->uts : ""; ?></td>
					<td align="center"><?php echo ((int)$record->tahun_akademik >= 20162 and isset($jsonkues[$record->kode_jadwal])) ? $record->uas : ""; ?></td>
					
					<td align="center">
						
					<?php 
						if($record->harian != "" and $record->normatif != "" and $record->uts != "" and $record->uas != "" and (int)$record->tahun_akademik >= 20162 and isset($jsonkues[$record->kode_jadwal]))
						{
							e($record->nilai_angka);
							echo "(".$record->nilai_huruf.")";
						}else{
							
							if((int)$record->tahun_akademik >= 20162 and isset($jsonkues[$record->kode_jadwal]))
							{
								 echo "(".$record->nilai_huruf.")";
							}
							if((int)$record->tahun_akademik < 20162)
							{
								 echo "(".$record->nilai_huruf.")";
							}
						}
						 
					?>
					
					</td>
					
					<td align="center"><?php e($record->kelas) ?></td>
					<td>
						<a href="<?php echo base_url() ?>admin/nilai/nilai_mahasiswa/absenharianku/simple/<?php echo $record->kode_jadwal; ?>?kode_mk=<?php echo $record->kode_mk; ?>&tahun=<?php echo $record->tahun_akademik; ?>&kelas=<?php echo $record->kelas; ?>&sms=<?php echo $record->semester; ?>&filljurusan=<?php echo $record->prodi; ?>" class='fancy show-modal' tooltip="Absen Harian" target="_blank">
							 <span class="label label-success pull-right">Lihat</span>
						 </a> 
					</td>
					<?php if($kuesioner == "1"){ ?>
					<td>
						<?php if((int)$record->tahun_akademik >= 20162 and !isset($jsonkues[$record->kode_jadwal]))
							{
						?>
						 <a href="<?php echo base_url() ?>admin/master/kuesioner/isi/<?php echo $record->kode_jadwal; ?>?kode_mk=<?php echo $record->kode_mk; ?>&tahun=<?php echo $record->tahun_akademik; ?>&kelas=<?php echo $record->kelas; ?>&sms=<?php echo $record->semester; ?>&filljurusan=<?php echo $record->prodi; ?>" class='fancy show-modal' tooltip="Evaluasi Proses Pembelajaran" target="_blank">
							 <span class="label label-warning pull-right">Kuesioner</span>
						 </a>
						 <?php }else{
						 ?>
						 	<span class="label label-success pull-right">Kuesioner</span>
						<?php } ?>
					</td>
					<?php } ?>
				</tr>
				<?php
				  $no++;
					endforeach;
				else:
				?>
				<tr>
					<td colspan="13">No records found that match your selection.</td>
				</tr>
				<?php endif; ?>
				 
  		</tbody>
	<tfoot>
	   <?php if ($jmlskssekarang>0) : ?>
	   <tr>
		  <td></td>
		   <td align="right">
				<b>Jumlah SKS</b>
		   </td>
			<td colspan="12">
			  <?php
				  echo $jmlskssekarang;
			  ?>
		   </td>
	   </tr>
	   <?php 
	   endif; ?>
   </tfoot>
</table>
 