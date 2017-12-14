<?php

$num_columns	= 5;
$can_delete	= $this->auth->has_permission('Pilihan.Master.Delete');
$can_edit		= $this->auth->has_permission('Pilihan.Master.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<br/>
<div class="admin-box">
	<h3>Pilihan</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Kode</th>
					<th>Nama</th>
					<th>Value</th>
					<th>Label</th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('pilihan_delete_confirm'))); ?>')" />
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
					<td><?php echo anchor(SITE_AREA . '/master/pilihan/edit/' . $record->id, '<span class="icon-pencil"></span>' .  $record->kode); ?></td>
				<?php else : ?>
					<td><?php e($record->kode); ?></td>
				<?php endif; ?>
					<td><?php e($record->nama) ?></td>
					<td><?php e($record->value) ?></td>
					<td><?php e($record->label) ?></td>
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
	 <div class="pagination pagination-right"> 
		
		<?php echo $this->pagination->create_links(); ?>
	</div>
</div>