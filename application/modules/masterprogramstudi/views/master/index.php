<?php

$num_columns	= 28;
$can_delete	= $this->auth->has_permission('MasterProgramStudi.Master.Delete');
$can_edit		= $this->auth->has_permission('MasterProgramStudi.Master.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<br/>
<div class="admin-box">
	 <form action="<?php $this->uri->uri_string() ?>" method="get" accept-charset="utf-8">
    	<table>

    	 <tr>
				<td>&nbsp;</td>
                <td>Fakultas</td>
				<td>:</td>
                <td>
				<div>
                	<select name="fillfakultas" id="fillfakultas" class="chosen-select-deselect" style="width:300px;">
						<option value=""></option>
						<?php if (isset($masterfakultass) && is_array($masterfakultass) && count($masterfakultass)):?>
						<?php foreach($masterfakultass as $record):?>
							<option value="<?php echo $record->kode_fakultas?>" <?php if(isset($fillfakultas))  echo  ($record->kode_fakultas==$fillfakultas) ? "selected" : ""; ?>><?php echo $record->nama_fakultas; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
					</div>
                </td>  
            </tr>
        	<tr>
			<td>&nbsp;</td>
			<td>Nama</td>
			<td>:</td>
            <td>
            	<input id='fillnama' type='text' name='fillnama' value="<?php echo set_value('fillnama', isset($fillnama) ? $fillnama : ''); ?>" />
			</td>
            </tr>
            
           
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td valign="top"> <br> <input type="submit" name="Act" class="btn btn-primary" value="Cari "  /></td> 
			</tr>  
        </table>
    <?php echo form_close(); ?>
	<br>
	 <h3>Master Program Studi</h3>
   <div class="alert alert-block alert-warning fade in ">
      <a class="close" data-dismiss="alert">&times;</a>
       Jumlah :  <?php echo isset($total) ? $total : ''; ?> &nbsp; Program Studi
    </div>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Kode Prodi</th>
					<th>Fakultas</th>
					<th>Program Studi</th>
					<th>Jenjang Studi</th>
					<th>No SK DIKTI</th>
					<th>Status</th>
					<th>E-Mail<br>Prodi</th>
					<th>Status Akreditasi</th>
					<th>NIDN <br>Ketua Prodi</th>
					<th>Telepon</th>
					<th>Fax</th>					
					<th>Operator</th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('masterprogramstudi_delete_confirm'))); ?>')" />
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
					<td><?php echo anchor(SITE_AREA . '/master/masterprogramstudi/edit/' . $record->id, '<span class="icon-pencil"></span>' .  $record->kode_prodi); ?></td>
				<?php else : ?>
					<td><?php e($record->kode_prodi); ?></td>
				<?php endif; ?>
				<td><?php e($record->nama_fakultas) ?></td>
					
				
					<td><?php e($record->nama_prodi) ?></td>
					<td><?php e($record->kode_jenjang_studi) ?></td>

					<td><?php e($record->no_sk_dikti) ?></td>
					<td><?php e($record->kode_status) ?></td>
					<td><?php e($record->email_prodi) ?></td>
					<td><?php e($record->kode_status_akreditasi) ?></td>
					<td><?php e($record->nidn_ketua_prodi) ?></td>
					<td><?php e($record->telepon_program_studi) ?></td>
					<td><?php e($record->fax_prodi) ?></td>
					<td><?php e($record->nama_operator) ?></td>	
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