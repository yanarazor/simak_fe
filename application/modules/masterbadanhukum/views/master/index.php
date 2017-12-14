<?php

$num_columns	= 16;
$can_delete	= $this->auth->has_permission('MasterBadanHukum.Master.Delete');
$can_edit		= $this->auth->has_permission('MasterBadanHukum.Master.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<div class="admin-box">
	<h3>MasterBadanHukum</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Kode Badan Hukum</th>
					<th>Nama Badan Hukum</th>
					<th>Alamat 1</th>
					<th>Alamat 2</th>
					<th>Kota</th>
					<th>Kode Pos</th>
					<th>Telepon</th>
					<th>Fax</th>
					<th>Tanggal Akta</th>
					<th>No Akta</th>
					<th>Tanggal Pengesahan</th>
					<th>No Pengesahan</th>
					<th>E-Mail</th>
					<th>Website Badan Hukum</th>
					<th>Tanggal Pendirian</th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('masterbadanhukum_delete_confirm'))); ?>')" />
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
					<td><?php echo anchor(SITE_AREA . '/master/masterbadanhukum/edit/' . $record->id, '<span class="icon-pencil"></span>' .  $record->kode_badan_hukum); ?></td>
				<?php else : ?>
					<td><?php e($record->kode_badan_hukum); ?></td>
				<?php endif; ?>
					<td><?php e($record->nama_badan_hukum) ?></td>
					<td><?php e($record->alamat1) ?></td>
					<td><?php e($record->alamat2) ?></td>
					<td><?php e($record->kota) ?></td>
					<td><?php e($record->kode_pos) ?></td>
					<td><?php e($record->telepon) ?></td>
					<td><?php e($record->fax) ?></td>
					<td><?php e($record->tgl_akta) ?></td>
					<td><?php e($record->no_akta) ?></td>
					<td><?php e($record->tgl_pengesahan) ?></td>
					<td><?php e($record->no_pengesahan) ?></td>
					<td><?php e($record->email_badan_hukum) ?></td>
					<td><?php e($record->website_badan_hukum) ?></td>
					<td><?php e($record->tgl_pendirian) ?></td>
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