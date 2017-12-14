<?php

$num_columns	= 11;
$can_delete	= $this->auth->has_permission('MasterMahasiswa.Master.Delete');
$can_edit		= $this->auth->has_permission('MasterMahasiswa.Master.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<br/>
<div class="admin-box">
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
<script type="text/javascript">	 
	
 	 $("#fakultas").change(function(){
		  	var valfakultas 	= $("#fakultas").val();
			$("#prodi").empty().append("<option>loading...</option>");
			var json_url = "<?php echo base_url(); ?>admin/master/masterprogramstudi/getbyfakultas?fak=" + encodeURIComponent(valfakultas);
			//alert(json_url);
			$.getJSON(json_url,function(data){
				$("#prodi").empty(); 
				if(data==""){
					$("#prodi").append("<option value=\"\">-- Pilih --</option>");
				}
				else{
					$("#prodi").append("<option value=\"\">-- Pilih --</option>");
					for(i=0; i<data.id.length; i++){
						$("#prodi").append("<option value=\"" + data.id[i]  + "\">" + data.nama_prodi[i] +"</option>");
					}
				}
				
			});
			return false;
		});
 	 
</script>