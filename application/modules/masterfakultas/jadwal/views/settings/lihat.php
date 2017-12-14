<?php

$num_columns	= 10;
$can_delete	= $this->auth->has_permission('Jadwal.Settings.Delete');
$can_edit		= $this->auth->has_permission('Jadwal.Settings.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<div class="admin-box">
   	<div class="box span7">
	 <div class="box-header">
		 <h2><i class="icon-list"></i><span class="break"></span>Jadwal</h2>
	 </div>
	<div class="box-content">
		 <div class="alert alert-block alert-warning fade in ">
			<a class="close" data-dismiss="alert">&times;</a>
			 Jumlah :  <?php echo isset($total) ? $total : ''; ?>
		  </div>
		  <?php echo form_open($this->uri->uri_string()); ?>
			  <table class="table table-striped" style="width:400px">
				  <thead>
					  <tr>
						  <?php if ($can_delete && $has_records) : ?>
						  <th class="column-check"><input class="check-all" type="checkbox" /></th>
						  <?php endif;?>
					
						  <th>Hari</th>
						  <th>Jam</th>
						  <th>Mata Kuliah</th>
						  <th>Dosen</th>
						  <th>Semester</th>
						  <th>Kelas</th>
						   <th>Ruangan</th>
						  <th>kuota</th>
						 <!-- <th>Prodi</th> -->
						  <th>Sisa</th>
						  <th>#</th>
					  </tr>
				  </thead>
				  <?php if ($has_records) : ?>
				  <tfoot>
				 
					  <tr>
						  <td colspan="<?php echo $num_columns; ?>">
						
						  </td>
					  </tr>
				 
				  </tfoot>
				  <?php endif; ?>
				  <tbody>
					  <?php
					  if ($has_records) :
						  foreach ($records as $record) :
					  ?>
					  <tr>
						  <?php if ($can_delete) : ?>
						  <td class="column-check"><input type="checkbox" name="checked[]" value="<?php echo $record->id; ?>" /></td>
						  <?php endif;?>
					
					  <?php if ($can_edit) : ?>
						  <td><?php echo anchor(SITE_AREA . '/settings/jadwal/edit/' . $record->id, '<span class="icon-pencil"></span>' .  $record->hari); ?></td>
					  <?php else : ?>
						  <td><?php e($record->hari); ?></td>
					  <?php endif; ?>
						  <td><?php e($record->jam) ?></td>
						  <td><?php e($record->nama_mata_kuliah) ?></td>
						  <td><?php e($record->nama_dosen) ?></td>
						  <td><?php e($record->semester) ?></td>
						  <td><?php e($record->nama_kelas) ?></td>
						    <td><?php e($record->kd_ruangan) ?></td>
						   <td>
						   <?php 
						   $sisa = $record->kuota-$record->jmlterisi;
						   e($record->kuota) 
						   ?></td>
						    <td><?php e($sisa) ?></td>
						  <!-- <td><?php e($record->nama_prodi) ?></td>-->
						  <td>
						  <?php
						  	if($sisa<1){
						  	?>
						  		Kuota Habis
						  	<?php
						  	}else{
						  ?>
						  		<a href="#" class="kliksave" kode="<?php e($record->id) ?>" kelas="<?php e($record->kelas) ?>" idkrs="<?php e($record->id) ?>">Pilih</a>
						  <?php
						  }
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
		</div> <!-- end content -->
	</div>  <!-- end span -->
	 
</div>
<script type="text/javascript">
  
	 $('.kliksave').click(function (){
	 	var kode = $(this).attr('kode');
	 	var kelas = $(this).attr('kelas');
	 	//alert(kelas);
	 		//alert("<?php echo base_url() ?>index.php/admin/krs/datakrs/updatekrs/?kode_jadwal="+kode+"&id_krs=<?php echo $idkrs;?>");
			$.ajax({
				url: "<?php echo base_url() ?>index.php/admin/krs/datakrs/updatekrs/",
				type:"get",
				data: "kode_jadwal="+kode+"&kelas="+kelas+"&id_krs=<?php echo $idkrs;?>",
				dataType: "html",
				timeout:180000,
				success: function (result) {
					parent.jQuery.fancybox.close();
				debugger;
			},
			error : function() {
				alert("error");
				
			}                       
		});		 
		parent.jQuery.fancybox.close();
		return false;
	});
</script>