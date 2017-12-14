<?php

$num_columns	= 17;
$can_delete	= $this->auth->has_permission('MasterPerguruanTinggi.Master.Delete');
$can_edit		= $this->auth->has_permission('MasterPerguruanTinggi.Master.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<div class="admin-box">
	<h3>MasterPerguruanTinggi</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Kode Badan Hukum</th>
					<th>Kode Perguruan Tinggi</th>
					<th>Nama Perguruan Tinggi</th>
					<th>Alamat 1</th>
					<th>Alamat 2</th>
					<th>Kota</th>
					<th>Kode Pos</th>
					<th>Telepon</th>
					<th>Faksimili</th>
					<th>Tanggal Akta Perguruan Tinggi</th>
					<th>No Akta Perguruan Tinggi</th>
					<th>E-Mail Perguruan Tinggi</th>
					<th>Website Perguruan Tinggi</th>
					<th>Tanggal Pendirian Perguruan Tinggi</th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('masterperguruantinggi_delete_confirm'))); ?>')" />
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
					<td><?php echo anchor(SITE_AREA . '/master/masterperguruantinggi/edit/' . $record->id, '<span class="icon-pencil"></span>' .  $record->kode_badan_hukum); ?></td>
				<?php else : ?>
					<td><?php e($record->kode_badan_hukum); ?></td>
				<?php endif; ?>
					<td><?php e($record->kode_pt) ?></td>
					<td><?php e($record->nama_pt) ?></td>
					<td><?php e($record->alamat_pt_1) ?></td>
					<td><?php e($record->alamat_pt_2) ?></td>
					<td><?php e($record->kota_pt) ?></td>
					<td><?php e($record->kodepos_pt) ?></td>
					<td><?php e($record->telepon_pt) ?></td>
					<td><?php e($record->fax_pt) ?></td>
					<td><?php e($record->tgl_akta_pt) ?></td>
					<td><?php e($record->no_akta_pt) ?></td>
					<td><?php e($record->email_pt) ?></td>
					<td><?php e($record->website_pt) ?></td>
					<td><?php e($record->tgl_pendirian_pt) ?></td>
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