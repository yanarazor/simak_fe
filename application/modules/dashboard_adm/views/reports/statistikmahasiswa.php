<?php
	$this->load->library('convert');
	$convert = new convert();
?>
<br>
	<div class="alert alert-block alert-error fade in disclaimer">
	Jml : Jumlah Mahasiswa yang status Aktifitasnya aktif atau "A" <br>
	Aktif : Jumlah Mahasiswa yang sudah mengisi KRS <br>
	Tidak Aktif : Jumlah Mahasiswa yang status Aktifitasnya selain A atau (Cuti, Droput, Keluar, Lulus, Non Aktif, atau sedang Double Degree)
					  
	</div>
<h3> Kelas Pagi </h3>
 <table style="width:100%;" class="table" border="1">
	
	<thead>
		<tr>
			<?php 
			if(isset($TahunRecordReg) && is_array($TahunRecordReg) && count($TahunRecordReg)):
			$i=1;
			foreach ($TahunRecordReg as $record) : ?>
			   <th colspan="3">
				   <strong><?php echo ucwords($record->tahun_masuk); ?></strong>
			   </th>
			<?php 
			$i++;
			endforeach; 
			endif;?>
		</tr>
		<tr>
			<?php 
			if(isset($TahunRecordReg) && is_array($TahunRecordReg) && count($TahunRecordReg)):
			$i=1;
			foreach ($TahunRecordReg as $record) : ?>
			   <td>
				   Jml
			   </td>
			   <td>
				   Aktif
			   </td>
			   <td>
				   Tdk Aktif
			   </td>
			<?php 
			$i++;
			endforeach; 
			endif;?>
		</tr>
	</thead>
	<tbody class="valign-middle">
	
		<?php 
			if(isset($TahunRecordReg) && is_array($TahunRecordReg) && count($TahunRecordReg)):
			$i=1;
			foreach ($TahunRecordReg as $record) : ?>
				<td>
					<a href="<?php echo base_url().'admin/master/mastermahasiswa/viewall/simple?tahun='; ?><?php echo $record->tahun_masuk; ?>&fakultas=<?php echo $fakultas; ?>&prodi=<?php echo $prodi; ?>&status=1" target="_blank" class='fancy'>
						<?php if(isset($mahasiswatahun[$record->tahun_masuk])) { echo $mahasiswatahun[$record->tahun_masuk]; } ?> 
					</a>
				</td>
				<td>
					<a href="<?php echo base_url().'admin/master/mastermahasiswa/viewallkrs/simple?tahun='; ?><?php echo $record->tahun_masuk; ?>&fakultas=<?php echo $fakultas; ?>&prodi=<?php echo $prodi; ?>&status=1" target="_blank" class='fancy'>
						<?php echo isset($mahasiswaisikrs[$record->tahun_masuk]) ? $mahasiswaisikrs[$record->tahun_masuk] : "0"; ?> </td>
					</a>
				<td>
					<a href="<?php echo base_url().'admin/master/mastermahasiswa/viewallin/simple?tahun='; ?><?php echo $record->tahun_masuk; ?>&fakultas=<?php echo $fakultas; ?>&prodi=<?php echo $prodi; ?>&status=1" target="_blank" class='fancy'>
						<?php echo isset($MhstidakAktif[$record->tahun_masuk]) ? $MhstidakAktif[$record->tahun_masuk] : "0"; ?> 
					</a>
				</td>
			<?php 
			$i++;
			endforeach; 
			endif;?>
	</tbody>

	</table>
	<h3> Kelas Sore </h3>
<table class="table" border="1">

	<thead>
		<tr>
			<?php 
			if(isset($TahunRecordIn) && is_array($TahunRecordIn) && count($TahunRecordIn)):
			$i=1;
			foreach ($TahunRecordIn as $record) : ?>
			   <th colspan="3">
				   <strong><?php echo ucwords($record->tahun_masuk); ?></strong>
			   </th>
			<?php 
			$i++;
			endforeach;
			endif;?>
		</tr>
		<tr>
			<?php 
			if(isset($TahunRecordIn) && is_array($TahunRecordIn) && count($TahunRecordIn)):
			foreach ($TahunRecordIn as $record) : ?>
			  <td>
				   Jml
			   </td>
			   <td>
				   Aktif
			   </td>
			   <td>
				   Tdk Aktif
			   </td>
			<?php 
			endforeach; 
			endif;?>
		</tr>
	</thead>
	<tbody class="valign-middle">
		<?php 
			if(isset($TahunRecordIn) && is_array($TahunRecordIn) && count($TahunRecordIn)):
			$i=1;
			foreach ($TahunRecordIn as $record) : ?>
				<td align="center">
					<a href="<?php echo base_url().'admin/master/mastermahasiswa/viewall/simple?tahun='; ?><?php echo $record->tahun_masuk; ?>&fakultas=<?php echo $fakultas; ?>&prodi=<?php echo $prodi; ?>&status=2" target="_blank" class='fancy'>
						<?php echo isset($mahasiswatahunsore[$record->tahun_masuk]) ? $mahasiswatahunsore[$record->tahun_masuk] : "0"; ?> </td>
					</a>
				<td>
					<a href="<?php echo base_url().'admin/master/mastermahasiswa/viewallkrs/simple?tahun='; ?><?php echo $record->tahun_masuk; ?>&fakultas=<?php echo $fakultas; ?>&prodi=<?php echo $prodi; ?>&status=2" target="_blank" class='fancy'>
						<?php echo isset($mahasiswaisikrsin[$record->tahun_masuk]) ? $mahasiswaisikrsin[$record->tahun_masuk] : "0"; ?> </td>
					</a>
				<td>
					<a href="<?php echo base_url().'admin/master/mastermahasiswa/viewallin/simple?tahun='; ?><?php echo $record->tahun_masuk; ?>&fakultas=<?php echo $fakultas; ?>&prodi=<?php echo $prodi; ?>&status=2" target="_blank" class='fancy'>
						<?php echo isset($MhstidakAktifsore[$record->tahun_masuk]) ? $MhstidakAktifsore[$record->tahun_masuk] : "0"; ?> </td>
					</a>
			<?php 
			$i++;
			endforeach; 
			else:
			?>
			<td colspan="10">
				Tidak ada data
			</td>		
			<?php
			endif;?>
	</tbody>

</table>
<script type="text/javascript">  
	$(".fancy").fancybox({
			'overlayShow'	: true,
			'transitionIn'	: 'elastic',
			'transitionOut'	: 'elastic', 
			'onClosed'           : function(){},
			'autoSize' : false,
			'minheight':'600',
			'type':'iframe',
			'width':'400',
			'height':'700'
			 
		}); 
	 
</script>