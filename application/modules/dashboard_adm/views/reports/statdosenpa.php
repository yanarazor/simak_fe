<?php
	$this->load->library('convert');
	$convert = new convert();
?>
<br>
	<div class="alert alert-block alert-error fade in disclaimer">
		Dosen PA dan jumlah Mahasiswa yang dibimbing			  
	</div>
<table style="width:100%;" class="table" border="1">
	
	<thead>
		<tr>
		   <th width="80%">
			  Dosen
		   </th>
		   <th>
			  Jumlah Mahasiswa
		   </th>  
		</tr>
		 
	</thead>
	<tbody class="valign-middle">
	
		<?php 
			if(isset($recorddosen) && is_array($recorddosen) && count($recorddosen)):
			$i=1;
			foreach ($recorddosen as $record) : ?>
				<tr>
				<td>
					<a href="#">
						<?php echo $record->nama_dosen; ?> 
					</a>
				</td>
				<td>
					<a href="<?php echo base_url();?>admin/master/mastermahasiswa/viewbydosen/simple?dosen=<?php echo $record->nip_promotor; ?>&fakultas=<?php echo $fakultas; ?>&prodi=<?php echo $prodi; ?>&status=1" target="_blank" class='fancy'>
						<?php echo $record->jumlahmahasiswa; ?> 
					</a>
				</td>
				</tr>
			<?php 
			$i++;
			endforeach; 
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