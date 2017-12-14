<?php

$num_columns	= 9;
$can_delete	= $this->auth->has_permission('Khs.Nilai.Delete');
$can_edit		= $this->auth->has_permission('Khs.Nilai.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<br>
<div class="alert alert-block alert-success fade in">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Perhatian :</h4>
	Data diurutkan berdasarkan IPK tertinggi
</div>
<div class="admin-box">
	<form action="<?php $this->uri->uri_string() ?>" method="get" accept-charset="utf-8">
	 <table>
	 	<tr>
                <td>Tahun Kademik</td>
                <td>:</td>
                <td>
                	 <select name="tahun" id="tahun" class="chosen-select-deselect">
					  <option value=""></option>
					  <?php if (isset($pilihantahuns) && is_array($pilihantahuns) && count($pilihantahuns)):?>
					  <?php foreach($pilihantahuns as $record):?>
						  <option value="<?php echo $record->value?>" <?php if(isset($tahun))  echo  ($record->value==$tahun) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
						  <?php endforeach;?>
					  <?php endif;?>
				  </select>
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
            <td>Status</td>
                <td>:</td>
                <td>
                	<select name="status" id="status" class="chosen-select-deselect">
						<option value="">Silahkan Pilih</option>
						 	 <option value="1" <?php if(isset($status))  echo  ($status == "1") ? "selected" : ""; ?>>Pagi</option>
						 	<option value="2" <?php if(isset($status))  echo  ($status == "2") ? "selected" : ""; ?>>Sore</option>
						 
					</select>
               	</td> 
                <td>
                 
            </tr>
         <tr>
	 		<td>Angkatan</td>
	 		<td>:</td>
	 		<td>
	            <input id='angkatan' type='text' name='angkatan' value="<?php echo set_value('mhs', isset($angkatan) ? $angkatan : ''); ?>" />
	        </td> 
	 	</tr>
	 	 <tr>
	 		<td>NIM Mahasiswa</td>
	 		<td>:</td>
	 		<td>
	            <input id='mhs' type='text' name='mhs' value="<?php echo set_value('mhs', isset($mhs) ? $mhs : ''); ?>" />
	        </td> 
	 	</tr>

            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td valign="top">
                	 <input type="submit" name="Act" class="btn btn-primary" value="Cari "  />
               	</td> 
            </tr>
            
        </table>
    <?php echo form_close(); ?>
    <br>
   <div class="alert alert-block alert-warning fade in ">
      <a class="close" data-dismiss="alert">&times;</a>
       Jumlah :  <?php echo isset($total) ? $total : '0'; ?>  &nbsp;KHS
    </div>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Nim</th>
					<th>Nama</th>

					<th>Prodi</th>
					<th>Tahun</th>
					<th>Semester</th>
					<th>SKS</th>
					<th>IPS</th>
					<th>IPk</th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('khs_delete_confirm'))); ?>')" />
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
					<td><?php e($record->nim); ?></td>
					<td><?php e($record->nama_mahasiswa); ?></td>
					<td><?php e($record->nama_prodi); ?></td>
					<td><?php e($record->tahun_ajaran) ?></td>
					<td><?php e($record->semester) ?></td>
					<td><?php e($record->jml_sks) ?></td>
					<td><?php e($record->ipk) ?></td>
					<td><?php e($record->ipkk) ?></td>
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
	<center>
		<?php echo $this->pagination->create_links(); ?>
	</center
</div>