<?php

$num_columns	= 7;
$can_delete	= $this->auth->has_permission('Event.Site.Delete');
$can_edit		= $this->auth->has_permission('Event.Site.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>

<br>
<div class="admin-box">
	<h3> Pengelolaan Kegiatan/Event</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Tanggal</th>
					<th>Judul</th>
					<th>Mulai</th>
					<th>Selesai</th>
					<th>Tempat</th>
					<th>Keterangan</th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('event_delete_confirm'))); ?>')" />
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
					<td><?php echo anchor(SITE_AREA . '/site/event/edit/' . $record->id, '<span class="icon-pencil"></span>' .  $record->tanggal); ?></td>
				<?php else : ?>
					<td><?php e($record->tanggal); ?></td>
				<?php endif; ?>
					<td><?php e($record->judul) ?></td>
					<td><?php e($record->mulai) ?></td>
					<td><?php e($record->selesai) ?></td>
					<td><?php e($record->tempat) ?></td>
					<td><?php e($record->keterangan) ?></td>
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