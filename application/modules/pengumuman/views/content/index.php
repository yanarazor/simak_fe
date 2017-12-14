<?php

$num_columns	= 9;
$can_delete	= $this->auth->has_permission('Pengumuman.Content.Delete');
$can_edit		= $this->auth->has_permission('Pengumuman.Content.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<div class="admin-box">
	<h3>pengumuman</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Tanggal Pengumuman</th>
					<th>Tanggal Awal</th>
					<th>Tanggal Akhir</th>
					<th>Judul</th>
					<th>Isi Pengumuman</th>
					<th>User ID</th>
					<th>Files</th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('pengumuman_delete_confirm'))); ?>')" />
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
					<td><?php echo anchor(SITE_AREA . '/content/pengumuman/edit/' . $record->id, '<span class="icon-pencil"></span>' .  $record->tgl_pengumuman); ?></td>
				<?php else : ?>
					<td><?php e($record->tgl_pengumuman); ?></td>
				<?php endif; ?>
					<td><?php e($record->tgl_awal) ?></td>
					<td><?php e($record->tgl_akhir) ?></td>
					<td><?php e($record->judul) ?></td>
					<td><?php e($record->content) ?></td>
					<td><?php e($record->user_id) ?></td>
					<td><?php e($record->files) ?></td>
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