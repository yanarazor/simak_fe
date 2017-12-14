<?php
$this->load->library('convert');
$convert = new convert();
$num_columns	= 10;
$can_delete	= $this->auth->has_permission('Konfirmasi_Pembayaran.Pembayaran.Delete');
$can_edit		= $this->auth->has_permission('Konfirmasi_Pembayaran.Pembayaran.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<div class="box box-warning admin-box">
	<div class="box-body">
	<div class='controls'>
	  <select name="sms" id="sms" class="chosen-select-deselect form-control">
		  <option value="">Pilih Semester</option>
		  <?php if (isset($pilihansemesters) && is_array($pilihansemesters) && count($pilihansemesters)):?>
		  <?php foreach($pilihansemesters as $record):?>
			  <option value="<?php echo $record->value?>" <?php if(isset($sms))  echo  ($record->value==$sms) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
			  <?php endforeach;?>
		  <?php endif;?>
	  </select>
	</div>
	<br>
   <div class="alert alert-block alert-warning fade in ">
      <a class="close" data-dismiss="alert">&times;</a>
       Jumlah :  <?php echo isset($total) ? $total : ''; ?> &nbsp; Pembayaran Kuliah
    </div>
	<?php echo form_open($this->uri->uri_string()); ?>
		<a class="btn btn-success show-modal pull-right" target="_blank" title="Kirim Konfirmasi Pembayaran" tooltip="Kirim Konfirmasi Pembayaran" href="<?php echo base_url(); ?>admin/pembayaran/konfirmasi_pembayaran/create/simple"><i class="fa fa-plus"></i> Kirim Konfirmasi</a>
		</a>
		<br><br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Nim Mahasiswa</th>
					<th>Untuk Pembayaran</th>
					<th>Semester</th>
					<th>Jumlah Bayar</th>
					<th>Tanggal Bayar</th>
					<th>Bank</th>
					<th>Bukti Pembayaran</th>
					<th>Keterangan</th>
					<th>Status</th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape('Hapus data?')); ?>')" />
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
					<td><?php echo anchor(SITE_AREA . '/pembayaran/konfirmasi_pembayaran/edit/' . $record->id, '<span class="icon-pencil"></span>' .  $record->nim); ?></td>
				<?php else : ?>
					<td><?php e($record->nim); ?></td>
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
							
							if(isset($record->file)) :
								$foto = unserialize($record->file);
								$fotothum = base_url()."assets/images/attach.gif";
								if($foto['file_name'] != ""){
									
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
								<img alt="" src="<?php echo $fotothum; ?>">
							</a>
						 
					</td>
					 
					<td><?php echo $record->keterangan; ?></td>
					<td>
						<?php echo $record->status =="" ? "<span class='label label-warning'>Blm Dicek</span>" : ''; ?>
						<?php echo $record->status =="0" ? "<span class='label label-warning'>Tidak</span>" : ''; ?>
						<?php echo $record->status =="1" ? "<span class='label label-success'>Ok</span>" : ''; ?>	
						 
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
</div>
<script type="text/javascript">	  
$("#sms").change(function() {
	var varanggaran = $("#sms" ).val();
	var json_url = "<?php echo base_url() ?>admin/pembayaran/konfirmasi_pembayaran/?sms="+varanggaran;
	window.location.href = json_url;
});
</script>