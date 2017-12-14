<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminlte/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminlte/dist/css/AdminLTE.min.css">   	
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<!-- sweet alert -->
<?php
	$this->load->library('convert');
	$convert = new convert();
	$mainmenu = $this->uri->segment(2);
	$menu = $this->uri->segment(3);
	$submenu = $this->uri->segment(4);

?>

<table>
	<tr>
		<td width="100px">Nomor</td>
		<td>:</td>
		<td></td>
	</tr>
	<tr>
		<td>Lamp.</td>
		<td>:</td>
		<td>1 berkas</td>
	</tr>
	<tr>
		<td>Perihal</td>
		<td>:</td>
		<td><u>Hasil Evaluasi Kinerja Proses Pembelajaran</u></td>
	</tr>
</table>   
<br>
<br>
Kepada Yth. <br>
Bapak/Ibu <?php echo $namadosen; ?><br>
Dosen Fakultas Ekonomi Dan Bisnis <br>
Universitas Muhammadiyah Jakarta <br>
di -
	<br>
	Jakarta
<br>
<br>
<i>Assalamu'alaikum Wr.Wb.</i> <br>
Teriring salam dan do'a semoga kita senantiasa dalam keadaan sehat wal'afiat serta selalu sukses dalam menjalanakan tugas sehari-hari. Amin <br>
Dalam rangka menjamin mutu pelaksanaan akademik Fakultas Ekonomi dan Bisnis Universitas Muhammadiyah Jakarta, maka Unit Penjaminan Mutu Fakultas bersama-sama dengan Gugus kendali Mutu Program Studi telah melakukan evaluasi kinerja dosen terhadap proses pembelajaran melalui kuesioner mahasiswa pada tahun akademik <?php echo $tahunakademik; ?>. <br>
Bersama ini kami sampaikan hasil evaluasi terhadap mata kuliah yang Bapak/Ibu asuk adalah sebagai berikut :
<br><br>
<table class="table" border="1">
	<thead>
		<tr>
			<th width="10px">No</th>
			<th>Mata Kuliah</th>
			<th width="20%">Indeks Prestasi</th>
			<th width="20%">Kriteria</th>
		</tr>
	</thead>
	<tbody class="valign-middle">
		 
		<?php 
			$rata = 0;
			if(isset($jadwalngajars) && is_array($jadwalngajars) && count($jadwalngajars)):
			$i=1;
			foreach ($jadwalngajars as $recordjadwal) : ?>
				<tr>
					<td>
						<?php echo $i; ?>.
					</td>
					 <td><?php echo $recordjadwal->nama_mata_kuliah; ?></td>
					 <td align="center">
					 	<?php 
					 		$rata = $rata + (double)$recordjadwal->ratarata;
					 		echo round($recordjadwal->ratarata,2); 
					 	?>
					 </td> 
					 <td align="center"><?php echo (double)$recordjadwal->ratarata > 0 ? $this->convert->getrangeevaluasi((double)$recordjadwal->ratarata) : ""; ?></td>
				</tr>
			<?php 
			$i++;
			endforeach; 
			endif;?>
			<tr>
				<td>
					
				</td>
				 <td>Nilai Rata-rata</td>
				 <td align="center"><?php echo round($rata,2); ?></td> 
				 <td align="center"><?php echo (double)$rata > 0 ? $this->convert->getrangeevaluasi((double)$rata) : ""; ?></td>
			</tr>
	</tbody>
</table>
<br>
Keterangan :
<br>
<b>1,00-1,99 = Tidak Baik(TB), 2,00-2,99=Cukup(C), 3,00-3,99= Baik(B), 4,00-4,99=Sangat Baik(SB) </b>
<br>
<br>
<br>
Demikian hasil evaluasi ini kami sampaikan, atas perhatian dan kerjasama Bapak/ibu kami mengucapkan terimakasih.
<br>
<br>
<i>Wabillahittaufiq walhidayah,<br>
Wassalamu'alaikum Wr. Wb <br>
</i>
 