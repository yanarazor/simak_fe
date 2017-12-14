<script src="<?php echo base_url(); ?>themes/admin/js/sweetalert.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/css/sweetalert.css">
<?php

$num_columns	= 10;
$can_delete	= $this->auth->has_permission('Jadwal.Settings.Delete');
$can_edit		= $this->auth->has_permission('Jadwal.Settings.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<div class="admin-box">
   	<div class="box span10">
	 <div class="box-header">
		 <h2><i class="icon-list"></i><span class="break"></span>Jadwal</h2>
	 </div>
	<div class="box-content">
		 <div class="alert alert-block alert-warning fade in ">
			<a class="close" data-dismiss="alert">&times;</a>
			 Jumlah :  <?php echo isset($total) ? $total : ''; ?>
		  </div>
		  <?php echo form_open($this->uri->uri_string()); ?>
			  <table class="table table-striped" style="width:99%">
				  <thead>
					  <tr>
						  <?php if ($can_delete && $has_records) : ?>
						  <th class="column-check"><input class="check-all" type="checkbox" /></th>
						  <?php endif;?>
					
						  <th style="width:40px">Hari</th>
						  <th style="width:40px">Jam</th>
						  <th>Mata Kuliah</th>
						  <th style="width:200px">Dosen</th>
						  <th style="width:40px">Semester</th>
						  <th style="width:40px">Kelas</th>
						  <th style="width:40px">Ruangan</th>
						  <th style="width:60px">Kuota</th>
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
						  <td align="center"><?php e($record->jam) ?></td>
						  <td align="center"><?php e($record->nama_mata_kuliah) ?></td>
						  
						  <td ><?php e($record->nama_dosen) ?></td>
						  <td align="center"><?php e($record->semester) ?></td>
						  <td><?php e($record->kelas) ?></td>
						  <td align="center"><?php e($record->kd_ruangan) ?></td>
						   <td align="center">
						   <?php 
						   
						   $sisa = $record->kuota;
						   if(isset($jsonjumlah[$record->id]))
						  		$sisa = $record->kuota-$jsonjumlah[$record->id];
						   e($record->kuota) 
						   ?></td>
						    <td>
						    <?php 
						    //e($jsonjumlah[$record->id]);
						    	 e($sisa) ?>
						    </td>
						  <!-- <td><?php e($record->nama_prodi) ?></td>-->
						  <td align="center">
						  <?php
						  	if($sisa<1){
						  	?>
						  		Kuota Habis
						  	<?php
						  	}else{
						  ?>
						  		<a href="#" class="kliksave" kode="<?php e($record->id) ?>" kelas="<?php e($record->kelas) ?>" mk="<?php e($record->kode_mk) ?>" kdjadwal="<?php e($record->id) ?>">Pilih</a>
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
						  
							<td colspan="<?php echo $num_columns; ?>">Tidak ada Data yang sesuai dengan pilihan anda</td>
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
	 	<?php if ($this->settings_lib->item('site.updatekrs') != "2" and !$this->auth->has_permission('Krs_Mahasiswa.Krs.Create') and $idkrs != "") { ?>
	 		//alert("<?php echo $current_user->role_id; ?>");
	 		swal("Informasi", "Anda tidak bisa merubah jadwal, Silahkan hubungi akademik", "error");
	 		return false;
	 	<?php } ?>
	 	//alert(kelas);
	 		//alert("<?php echo base_url() ?>index.php/admin/krs/datakrs/updatekrs/?kode_jadwal="+kode+"&id_krs=<?php echo $idkrs;?>");
			$.ajax({
				url: "<?php echo base_url() ?>index.php/admin/krs/datakrs/updatekrs/",
				type:"get",
				data: "kode_jadwal="+kode+"&kelas="+kelas+"&id_krs=<?php echo $idkrs;?>",
				dataType: "html",
				timeout:180000,
				success: function (result) {
					//swal("Informasi", "Jadwal telah diubah", "warning");
					parent.jQuery.fancybox.close();
				debugger;
			},
			error : function() {
				alert("error");
				
			}                       
		});
		 
		parent.setJadwal($(this).attr("kelas"),$(this).attr("kode"),$(this).attr("mk"),$(this).attr("kdjadwal"));
		parent.jQuery.fancybox.close();
		return false;
	});
</script>