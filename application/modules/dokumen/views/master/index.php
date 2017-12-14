<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminlte/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminlte/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css">
<!-- sweet alert -->
<script src="<?php echo base_url(); ?>themes/adminlte/js/sweetalert.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminlte/css/sweetalert.css">
<?php

$num_columns	= 4;
$can_delete	= $this->auth->has_permission('Dokumen.Master.Delete');
$can_edit		= $this->auth->has_permission('Dokumen.Master.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<div class="admin-box box box-warning">
	<div class="box-body">
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-bordered table-striped table-responsive dt-responsive table-data">
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Nama Dokumen</th>
					<th>Keterangan</th>
					<th>file</th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('dokumen_delete_confirm'))); ?>')" />
					</td>
				</tr>
				<?php endif; ?>
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
					<td><?php echo anchor(SITE_AREA . '/master/dokumen/edit/' . $record->id, '<span class="icon-pencil"></span>' .  $record->nama_dokumen); ?></td>
				<?php else : ?>
					<td><?php e($record->nama_dokumen); ?></td>
				<?php endif; ?>
					<td><?php e($record->keterangan) ?></td>
					<td><a href="<?php echo $this->settings_lib->item('site.urluploaded').$record->file; ?>" target="_blank"><?php e($record->file) ?></a></td>
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td></td>
					<td>Belum ada dokumen</td>
					<td></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php echo form_close(); ?>
	</div>
</div>
<script src="<?php echo base_url(); ?>themes/adminlte/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url(); ?>themes/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>themes/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>themes/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>themes/adminlte/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>themes/adminlte/plugins/datatables/extensions/Responsive/js/dataTables.responsive.js"></script>
<script type="text/javascript">
//alert("<?php echo base_url() ?>admin/masters/pak/ambil_datanew");
$(".table-data").DataTable({
	ordering: false,
	processing: false 
});
 

</script>