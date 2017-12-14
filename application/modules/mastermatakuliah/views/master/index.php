<?php

$num_columns	= 25;
$can_delete	= $this->auth->has_permission('MasterMataKuliah.Master.Delete');
$can_edit		= $this->auth->has_permission('MasterMataKuliah.Master.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<br>
<div class="admin-box">
	 <form action="<?php $this->uri->uri_string() ?>" method="get" accept-charset="utf-8">
	 
    	<table>
        	<tr>
            	<td>Semester</td>
                <td>:</td>
  				<td>
  					<input id='statsms' type='text' name='statsms' value="<?php echo set_value('statsms', isset($statsms) ? $statsms : ''); ?>" />
               	 	isi "1" untuk ganjil, "2" untuk genap
				</td> 
			</tr>
			<tr>
                 <td>Fakultas</td>
                <td>:</td>
                <td>
                	<select name="filfakultas" id="filfakultas" class="chosen-select-deselect" style="width:300px;">
						<option value=""></option>
						<?php if (isset($masterfakultass) && is_array($masterfakultass) && count($masterfakultass)):?>
						<?php foreach($masterfakultass as $record):?>
							<option value="<?php echo $record->kode_fakultas?>" <?php if(isset($filfakultas))  echo  ($record->kode_fakultas==$filfakultas) ? "selected" : ""; ?>><?php echo $record->nama_fakultas; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
                </td> 
            </tr>
            <tr>
            	<td>Program Studi</td>
                <td>:</td>
                <td>
                	<select name="filljurusan" id="filljurusan" class="chosen-select-deselect">
						<option value=""></option>
						<?php if (isset($masterprogramstudis) && is_array($masterprogramstudis) && count($masterprogramstudis)):?>
						<?php foreach($masterprogramstudis as $record):?>
							 <option value="<?php echo $record->kode_prodi?>" <?php if(isset($filljurusan))  echo  ($record->kode_prodi==$filljurusan) ? "selected" : ""; ?>><?php echo $record->nama_prodi; ?></option>
						 <?php endforeach;?>
						<?php endif;?>
					</select>
               	</td>
            </tr>
            <tr>
                <td>Kode Matakuliah</td>
                <td>:</td>
                <td>
                	<input id='fillkodemk' type='text' name='fillkodemk' value="<?php echo set_value('fillkodemk', isset($fillkodemk) ? $fillkodemk : ''); ?>" />
               	</td> 
            </tr>
			<tr>
            	<td>Nama Matakuliah</td>
                <td>:</td>
                <td>
                	 <input id='fillnamamk' type='text' name='fillnamamk' value="<?php echo set_value('fillnamamk', isset($fillnamamk) ? $fillnamamk : ''); ?>" />
               	</td> 
            </tr>
            <tr>
            	<td>Semester</td>
                <td>:</td>
                <td>
                	 <input id='sms' type='text' name='sms' value="<?php echo set_value('sms', isset($sms) ? $sms : ''); ?>" />
               	</td> 
            </tr>
            <tr>
            	<td>&nbsp;</td>
				<td>&nbsp;</td>
                <td>
                	 <input type="submit" name="Act" class="btn btn-primary" value="Cari "  />
               	</td> 
            </tr>
            
        </table>
    <?php echo form_close(); ?>
	<br>
		<h3>Master Mata Kuliah</h3>
   <div class="alert alert-block alert-warning fade in ">
      <a class="close" data-dismiss="alert">&times;</a>
       Jumlah :  <?php echo isset($total) ? $total : ''; ?> Mata Kuliah
    </div>

	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Semester<br>Akademik</th>
					<th>Fakultas</th>
					<th>Program<br>Studi</th>
					<th>Jenjang<br>Studi</th>
					<th>Kode<br>Mata Kuliah</th>
					<th>Nama<br>Mata Kuliah</th>
					<th>SKS</th>
					<th>Semester</th>
					<th>NO Dosen</th>
					<th>Program Studi<br> Pengampu</th>
					<th>Status</th>

				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('mastermatakuliah_delete_confirm'))); ?>')" />
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
					<td><?php echo anchor(SITE_AREA . '/master/mastermatakuliah/edit/' . $record->id, '<span class="icon-pencil"></span>' .  $record->sms); ?></td>
				<?php else : ?>
					<td><?php e($record->sms); ?></td>
				<?php endif; ?>
					 
					<td><?php e($record->kode_fakultas) ?></td>
					<td><?php e($record->nama_prodi) ?></td>
					<td><?php e($record->kode_jenjang_studi) ?></td>
					<td><?php e($record->kode_mata_kuliah) ?></td>
					<td><?php e($record->nama_mata_kuliah) ?></td>
					<td><?php e($record->sks) ?></td>
					<td><?php e($record->semester) ?></td>
				
					<td><?php e($record->nidn) ?></td>
					<td><?php e($record->prodi_pengampu) ?></td>
					<td><?php e($record->status_mata_kuliah) ?></td>

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
	 <div class="pagination pagination-right"> 
		
		<?php echo $this->pagination->create_links(); ?>
	</div>
</div>