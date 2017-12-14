<?php
	$this->load->library('convert');
	$convert = new convert();


$num_columns	= 11;
$can_delete	= $this->auth->has_permission('KonfirmasiPembayaran.Pembayaran.Delete');
$can_edit		= $this->auth->has_permission('KonfirmasiPembayaran.Pembayaran.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<br>
<div class="admin-box">

	<form action="<?php $this->uri->uri_string() ?>" method="get" accept-charset="utf-8">
	<table>
		<tr>
			<td>Fakultas</td>
			<td>:</td>
			 <td>
                	<select name="filfakultas" id="filfakultas" class="chosen-select-deselect">
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
			<td>NIM</td>
			<td>:</td>
			<td>
				<input id='fillnim' type='text' name='fillnim' value="<?php echo set_value('fillnim', isset($fillnim) ? $fillnim : ''); ?>" />
            </td>
            </tr>
            
            <tr>
            	<td>Nama</td>
				<td>:</td>
				<td><input id='fillnama' type='text' name='fillnama' value="<?php echo set_value('fillnama', isset($fillnama) ? $fillnama : ''); ?>" /></td> 
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
                <td valign="top">
                	 <input type="submit" name="Act" class="btn btn-primary" value="Cari "  />
                	 <br>
               	</td> 
            </tr>
            
        </table>
    <?php echo form_close(); ?>

    <h3>Konfirmasi Pembayaran Kuliah</h3>
   <div class="alert alert-block alert-warning fade in ">
      <a class="close" data-dismiss="alert">&times;</a>
       Jumlah :  <?php echo isset($total) ? $total : ''; ?> &nbsp;Konfirmasi Pembayaran
    </div>
	<?php echo form_open($this->uri->uri_string()); ?>
	
		<table class="table table-striped">
			<thead>
				<tr>
					<?php //if ($can_delete && $has_records) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php //endif;?>
					
					<th>Mahasiswa</th>
					<th>Untuk Pembayaran</th>
					<th>Semester</th>
					<th>Jumlah Bayar</th>
					<th>Tanggal Bayar</th>
					<th>Bank</th>
					<th>Bukti Pembayaran</th>
					<th>Keterangan</th>
					<th>Dibuat Tanggal</th>
					<th>Status</th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('konfirmasipembayaran_delete_confirm'))); ?>')" />
						
					</td>
				</tr>
				<?php else:
				?>
					<td colspan="<?php echo $num_columns; ?>">
						<input type="submit" name="ver" class="btn btn-warning" value="verifikasi" />
					</td>
					
				<?php
				endif; ?>
			</tfoot>
			<?php endif; ?>
			<tbody>
				<?php
				if ($has_records) :
					foreach ($records as $record) :
				?>
				<tr>
					<?php //if ($can_delete) : ?>
					<td class="column-check">
						<input type="checkbox" name="checked[]" value="<?php echo $record->id; ?>" />
						<input type="hidden" name="nimchk[<?php echo $record->id; ?>]" value="<?php echo $record->nim; ?>" />
					</td>
					<?php //endif;?>
					
				<?php if ($can_edit) : ?>
					<td><?php echo anchor(SITE_AREA . '/pembayaran/konfirmasipembayaran/edit/' . $record->id, '<span class="icon-pencil"></span>' .  $record->nim."-".$record->nama_mahasiswa); ?></td>
				<?php else : ?>
					<td><?php e($record->nim."-".$record->nama_mahasiswa); ?></td>
				<?php endif; ?>
					<td><?php e($record->pembayaran) ?></td>
					<td><?php e($record->semester) ?></td>
					<td><?php e($convert->toRp($record->jumlah)) ?></td>
					<td><?php e($record->tanggal) ?></td>
					<td><?php e($record->bank) ?></td>
					<td> 
						<?php 
							$fotothum = "";
							$fotoasli = "";
							
							if(isset($record->file) and $record->file != "") :
								$foto = unserialize($record->file);
								$fotothum = base_url()."assets/images/attach.gif";
								if(isset($foto['file_name'])){
									
									$fotoasli = $this->settings_lib->item('site.urluploaded').$foto['file_name'];
								}else{
									
									if($record->file != ""){
										
										$fotoasli = $this->settings_lib->item('site.urluploaded').$record->file;
									}
								}
							else:
								$foto = base_url().$this->settings_lib->item('site.urluploaded')."no_image.jpg";
							endif;
							
						?>
						 
							<a href="<?php echo $fotoasli; ?>" target="_blank">
								<?php echo $record->file; ?>
								<img alt="" src="<?php echo $fotothum; ?>">
							</a>
						 
					</td>
					 
					<td><?php e($record->keterangan) ?></td>
					<td><?php e($record->date_created) ?></td>
					<td>
						<?php echo $record->status =="" ? "<span class='label label-warning'>Belum diproses</span>" : ''; ?>
						<?php echo $record->status =="0" ? "<span class='label label-warning'>Tidak dapat diverifikasi</span>" : ''; ?>
						<?php echo $record->status =="1" ? "<span class='label label-success'>Sudah diverifikasi</span>" : ''; ?>	
						 
					</td>
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