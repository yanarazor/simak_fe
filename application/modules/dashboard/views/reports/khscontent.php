<?php
	$this->load->library('convert');
	$convert = new convert();
?>
	 
<table class="table" class="table table-striped">
   <thead>
		<tr>
		  <th width="20px">No</th>
			<th>Mata Kuliah</th>
			<th>Sks</th>
			<th>Dosen</th>
			 <th>Hari</th>
			  <th>Jam</th>
			<th>Semester</th>
			<th>Nilai</th>
			<th>Kelas</th>
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
					e($record->sks) ?></td>

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
					<td align="center"><?php e($record->nilai_huruf) ?></td>
					<td align="center"><?php e($record->kelas) ?></td>
				</tr>
				<?php
				  $no++;
					endforeach;
				else:
				?>
				<tr>
					<td colspan="8">No records found that match your selection.</td>
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
			<td colspan="7">
			  <?php
				  echo $jmlskssekarang;
			  ?>
		   </td>
	   </tr>
	   <?php 
	   endif; ?>
   </tfoot>
</table>

 
