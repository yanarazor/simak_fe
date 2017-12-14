<?php

$num_columns	= 8;
$can_delete	= $this->auth->has_permission('Jadwal.Settings.Delete');
$can_edit		= $this->auth->has_permission('Jadwal.Settings.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<div class="admin-box">
	<form action="<?php $this->uri->uri_string() ?>" method="get" accept-charset="utf-8">
	 
    	<table>
        	<tr>
            	<td>
                	Matakuliah
                </td>
                <td>:
                </td>
                <td>
                	 <select name="mk" id="mk" class="chosen-select-deselect">
						 <option value=""></option>
						 <?php if (isset($matakuliahs) && is_array($matakuliahs) && count($matakuliahs)):?>
						 <?php foreach($matakuliahs as $record):?>
							  <option value="<?php echo $record->kode_mata_kuliah?>" <?php if(isset($mk))  echo  ($record->kode_mata_kuliah==$mk) ? "selected" : ""; ?>><?php echo $record->nama_mata_kuliah; ?></option>
						  <?php endforeach;?>
						 <?php endif;?>
					 </select>
                </td> 
                 <td>
                	Prodi
                </td>
                <td>:
                </td>
                <td>
                	<select name="prodi" id="prodi" class="chosen-select-deselect">
						 <option value=""></option>
						 <?php if (isset($masterprogramstudis) && is_array($masterprogramstudis) && count($masterprogramstudis)):?>
						 <?php foreach($masterprogramstudis as $record):?>
							  <option value="<?php echo $record->kode_prodi?>" <?php if(isset($prodi))  echo  ($record->kode_prodi==$prodi) ? "selected" : ""; ?>><?php echo $record->nama_prodi; ?></option>
						  <?php endforeach;?>
						 <?php endif;?>
					 </select>
                </td> 
				 
            </tr>
             
			 
            <tr>
            	<td>
                	 
                </td>
                <td> 
                </td>
                <td>
                	 <input type="submit" name="Act" class="btn btn-primary" value="Cari "  />
               	</td> 
            </tr>
            
        </table>
    <?php echo form_close(); ?>
   <div class="alert alert-block alert-warning fade in ">
      <a class="close" data-dismiss="alert">&times;</a>
       Jumlah :  <?php echo isset($total) ? $total : ''; ?>
    </div>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
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
					<th>Prodi</th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('jadwal_delete_confirm'))); ?>')" />
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
					<td><?php echo anchor(SITE_AREA . '/settings/jadwal/edit/' . $record->id, '<span class="icon-pencil"></span>' .  $record->hari); ?></td>
				<?php else : ?>
					<td><?php e($record->hari); ?></td>
				<?php endif; ?>
					<td><?php e($record->jam) ?></td>
					<td><?php e($record->nama_mata_kuliah) ?></td>
					<td><?php e($record->nama_dosen) ?></td>
					<td><?php e($record->semester) ?></td>
					<td><?php e($record->kelas) ?></td>
					<td><?php e($record->nama_prodi) ?></td>
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