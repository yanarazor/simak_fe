<?php

$num_columns	= 11;
$can_delete	= $this->auth->has_permission('MasterMahasiswa.Master.Delete');
$can_edit		= $this->auth->has_permission('MasterMahasiswa.Master.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<br/>
<div class="admin-box">

	<form action="<?php $this->uri->uri_string() ?>" method="get" accept-charset="utf-8">
	 
    	<table>
    		<tr>
                <td>Fakultas</td>
                <td>:</td>
                <td>
                	<select name="filfakultas" id="filfakultas" class="chosen-select-deselect" style="width:300px;">
						<option value=""></option>
						<?php if (isset($masterfakultass) && is_array($masterfakultass) && count($masterfakultass)):?>
						<?php foreach($masterfakultass as $record):?>
							<option value="<?php echo $record->kode_fakultas;?>" <?php if(isset($filfakultas))  echo  ($record->kode_fakultas==$filfakultas) ? "selected" : ""; ?>><?php echo $record->nama_fakultas; ?></option>
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
                <td>
                 
            </tr>
        	<tr>
            	<td>Nama</td>
                <td>:</td>
                <td>
                	<input id='fillnama' type='text' name='fillnama' value="<?php echo set_value('fillnama', isset($fillnama) ? $fillnama : ''); ?>" />
				</td>
			</tr>
			<tr> 
				<td>NIM</td>
                <td>:</td>
                <td>
                	<input id='fillnim' type='text' name='fillnim' value="<?php echo set_value('fillnim', isset($fillnim) ? $fillnim : ''); ?>" />
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
		<h3>Master Mahasiswa</h3>
   <div class="alert alert-block alert-warning fade in ">
      <a class="close" data-dismiss="alert">&times;</a>
       Jumlah :  <?php echo isset($total) ? $total : ''; ?> Mahasiswa
    </div>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					<th>NIM</th>
					<th>Nama Mahasiswa</th>
					<th>Program Studi</th>
					<th>Kode <br>Jenjang<br>Studi</th>	
					
					<th>Tempat<br> Lahir</th>
					<th>Tanggal<br>Lahir</th>
					<th>Jenis<br>Kelamin</th>
					<th>Tahun<br>Masuk</th>
					<th>Semester</th>
					<th>Status<br>Aktivitas</th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('mastermahasiswa_delete_confirm'))); ?>')" />
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
					<td><?php echo anchor(SITE_AREA . '/master/mastermahasiswa/edit/' . $record->id, '<span class="icon-pencil"></span>' .  $record->nim_mhs); ?></td>
				<?php else : ?>
					<td><?php e($record->nim_mhs); ?></td>
				<?php endif; ?>
					<td><?php e($record->nama_mahasiswa) ?></td>
					<td><?php e($record->nama_prodi) ?></td>
					<td><?php e($record->kode_jenjang_studi) ?></td> 
					<td><?php e($record->tempat_lahir) ?></td>
					<td><?php e($record->tgl_lahir) ?></td>
					<td><?php e($record->jenis_kelamin) ?></td>
					<td><?php e($record->tahun_masuk) ?></td>
					<td><?php e($record->semester) ?></td>
					<td><?php e($record->status_aktivitas) ?></td>
					 
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
</div>