<?php

$num_columns	= 10;
?>
<div class="admin-box">
	 
   <div class="alert alert-block alert-warning fade in ">
      <a class="close" data-dismiss="alert">&times;</a>
       Jumlah :  <?php echo isset($total) ? $total : ''; ?>
    </div>
	<a href="<?php echo base_url() ?>index.php/admin/reports/epsbed/downloadnilai?ta=<?=$tahun_ajaran?>&kode_prodi=<?=$kode_prodi?>" target="_blank" class="btn btn-primary"> Download Nilai </a>
					
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>THSMSTRNLM</th>
					<th>KDPTITRNLM</th>
					<th>KDJENTRNLM</th>
					<th>KDPSTTRNLM</th>
					<th>NIMHSTRNLM</th>
					<th>Mata Kuliah</th>
					<th>NLAKHTRNLM</th>
					<th>BOBOTTRNLM</th>
					<th>KELASTRNLM</th>
				</tr>
			</thead>
			<?php if (isset($datanilai) && is_array($datanilai) && count($datanilai)) : ?>
			<tfoot>
				  
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
					</td>
				</tr>
				 
			</tfoot>
			<?php endif; ?>
			<tbody>
				<?php
				if (isset($datanilai) && is_array($datanilai) && count($datanilai)) :
					foreach ($datanilai as $record) :
				?>
				<tr>
					<td><?php e($record->tahun_akademik); ?></td>
					<td><?php e("031011"); ?></td>
					<td><?php e("C"); ?></td>
					<td><?php e($record->kode_prodi); ?></td>
					<td><?php echo $record->mahasiswa.""; ?></td>
					<td><?php e($record->kode_mk); ?></td>
					<td><?php e($record->nilai_huruf) ?></td>
					<td>
					<?php 
					$nilaiangka = ""; 
					if($record->nilai_huruf == "A")
					{
						$nilaiangka = "4.00"; 
					}
					if($record->nilai_huruf == "B")
					{
						$nilaiangka = "3.00"; 
					}
					if($record->nilai_huruf == "C")
					{
						$nilaiangka = "2.00"; 
					}
					if($record->nilai_huruf == "D")
					{
						$nilaiangka = "1.00"; 
					}
					echo $nilaiangka;
					
					?></td> 
					<td>
						<?php 
						echo $record->kelas;
						/*
						$kelas = "";
						switch ($record->kelas) {
						   case "A":
							   $kelas = "01";
							   break;
						   case "B":
							   $kelas = "02";
							   break;
							case "C":
							   $kelas = "03";
							   break;
							case "D":
							   $kelas = "04";
							   break;
							   case "E":
							   $kelas = "05";
							   break;
							   case "F":
							   $kelas = "06";
							   break;
							case "G":
							   $kelas = "07";
							   break;
							case "H":
							   $kelas = "08";
							   break;
							case "I":
							   $kelas = "09";
							   break;
						   default:
							   $kelas = "";
					   }
						echo $kelas; 
						*/
						?>
					</td> 
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">No records found that match your selection.</td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php echo form_close(); ?>
</div>