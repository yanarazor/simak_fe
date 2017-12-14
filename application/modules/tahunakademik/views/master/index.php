<?php

$num_columns	= 33;
$can_delete	= $this->auth->has_permission('TahunAkademik.Master.Delete');
$can_edit		= $this->auth->has_permission('TahunAkademik.Master.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<div class="admin-box">
	<h3>TahunAkademik</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Tahun</th>
					<th>Nama Tahun</th>
					<th>Krs Mulai</th>
					<th>Krs Selesai</th>
					
					<th>Kuliah Mulai</th>
					<th>Kuliah Selesai</th>
					<th>Buka</th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('tahunakademik_delete_confirm'))); ?>')" />
					</td>
				</tr>
				<?php endif; ?>
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
					<td><?php echo anchor(SITE_AREA . '/master/tahunakademik/edit/' . $record->id, '<span class="icon-pencil"></span>' .  $record->tahun_id); ?></td>
				<?php else : ?>
					<td><?php e($record->tahun_id); ?></td>
				<?php endif; ?>
					<td><?php e($record->nama_tahun) ?></td>
					<td><?php e($record->krs_mulai) ?></td>
					<td><?php e($record->krs_selesai) ?></td>
					<td><?php e($record->kuliah_mulai) ?></td>
					<td><?php e($record->kuliah_selesai) ?></td>
					<td>
					<?php if($record->buka == "Y"){
					?>
					 
						 <a href="#" class="updatestatus" kdtahun="<?php echo $record->tahun_id; ?>" stat="N"> 
						 	<span class='label label-info'>Buka</span>
						 </a>
						
					<?php
					} ?>
					<?php if($record->buka == "N"){
					?>
					 
						 <a href="#" class="updatestatus" kdtahun="<?php echo $record->tahun_id; ?>" stat="Y"> 
						 	<span class='label label-danger'>Tutup</span>
						 </a>
						
					<?php
					} ?>
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
<script type="text/javascript">   
$(".updatestatus").click(function(){
	if (!confirm("Update Status?")) {
        return false;
    }
  var valkdtahun = $(this).attr('kdtahun');
  var valstat = $(this).attr('stat');
  var post_data = "kdtahun="+valkdtahun+"&stat="+valstat;
	//alert("<?php echo base_url() ?>admin/master/tahunakademik/changestatusbuka?"+post_data);
	$.ajax({
			url: "<?php echo base_url() ?>admin/master/tahunakademik/changestatusbuka",
			type:"POST",
			data: post_data,
			dataType: "html",
			timeout:180000,
			success: function (result) {
				 alert(result);
				 location.reload(true); 
		},
		error : function(error) {
			alert(error);
		} 
	});        
  return false;
});
  
</script> 