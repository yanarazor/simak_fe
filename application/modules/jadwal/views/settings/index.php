<?php

$num_columns	= 12;
$can_delete	= $this->auth->has_permission('Jadwal.Settings.Delete');
$can_edit		= $this->auth->has_permission('Jadwal.Settings.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<br>
<div class="admin-box">
	<form action="<?php $this->uri->uri_string() ?>" method="get" accept-charset="utf-8">
		<table>
			<tr>
				<td>Tahun Akademik</td>
				<td>:</td>
				<td>
					<input id='tahun_akademik' type='text' name='tahun_akademik' maxlength="10" value="<?php echo set_value('tahun_akademik', isset($tahun_akademik) ? $tahun_akademik : ''); ?>" />
					ex 20141, 20142
					<!--
					 <select name="tahun_akademik" id="tahun_akademik" class="chosen-select-deselect">
					  <option value=""></option>
					  <?php if (isset($pilihantahuns) && is_array($pilihantahuns) && count($pilihantahuns)):?>
					  <?php foreach($pilihantahuns as $record):?>
						  <option value="<?php echo $record->value?>" <?php if(isset($tahun_akademik))  echo  ($record->value==$tahun_akademik) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
						  <?php endforeach;?>
					  <?php endif;?>
				  	</select>
				  	-->
				</td>
			</tr>
			<tr>
				<td>Program Studi</td>
				<td>:</td>
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
                <td>Mata Kuliah</td>
				<td>:</td>
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
            </tr>
            </tr>
            	<td>&nbsp;</td>
				<td>&nbsp;</td>
                <td valign="top">
                	 <input type="submit" name="Act" class="btn btn-primary" value="Cari "  />
               	</td> 
            </tr>
            
        </table>
    <?php echo form_close(); ?>
   <br>
   <h3>Jadwal Kuliah</h3>
   <div class="alert alert-block alert-warning fade in ">
      <a class="close" data-dismiss="alert">&times;</a>
       Jumlah :  <?php echo isset($total) ? $total : ''; ?> Jadwal Kuliah
    </div>
	<?php echo form_open($this->uri->uri_string()); ?>
		
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class="column-check" rowspan="2"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					<th rowspan="2">Mata Kuliah</th>
					<th rowspan="2">Semester</th>
					<th colspan="3">Dosen 1</th>
					<th colspan="3">Dosen 2</th>
					<th rowspan="2">Kelas</th>
					<th rowspan="2">Prodi</th>
					<th rowspan="2">Kuota</th>
				</tr>
				<tr>
					<th>Dosen</th>
					<th>Hari</th>
					<th>Jam</th>
					

					<th>Dosen</th>
					<th>Hari</th>
					<th>Jam</th>
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
					<td><?php echo anchor(SITE_AREA . '/settings/jadwal/edit/' . $record->id, '<span class="icon-pencil"></span>' .  $record->nama_mata_kuliah); ?></td>
				<?php else : ?>
					<td><?php e($record->nama_mata_kuliah); ?></td>
				<?php endif; ?>
					<td><?php e($record->semester) ?></td>
					<td><?php e($record->nama_dosen) ?></td>
					<td><?php e($record->hari) ?></td>
					<td><?php e($record->jam) ?></td>

					<td><?php e($record->nama_dosen_2) ?></td>
					<td><?php e($record->hari_2) ?></td>
					<td><?php e($record->jam_2) ?></td>
					
					<td><?php e($record->kelas) ?></td>
					<td><?php e($record->nama_prodi) ?></td>
					<td><?php e($record->kuota_kelas) ?></td>
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



<script type="text/javascript">	  

	$("#tahun_akademik").change(function(){
			var jadwal_prodi = $("#prodi").val();
			var tahun_akademik = $("#tahun_akademik").val();
			$("#mk").empty().append("<option>loading...</option>");
			var json_url = "<?php echo base_url(); ?>index.php/admin/master/mastermatakuliah/getbytahun?tahun_akademik=" + encodeURIComponent(tahun_akademik)+"&jadwal_prodi=" + encodeURIComponent(jadwal_prodi);
			//alert(json_url);
			$.getJSON(json_url,function(data){
				$("#mk").empty(); 
				if(data==""){
					$("#mk").append("<option value=\"\">-- Pilih Matakuliah --</option>");
				}
				else{
					$("#mk").append("<option value=\"\">-- Pilih Matakuliah --</option>");
					for(i=0; i<data.id.length; i++){
						$("#mk").append("<option value=\"" + data.id[i]  + "\">" + data.nama_mata_kuliah[i] +"</option>");
					}
				}
				
			});
			return false;
		});
	$("#prodi").change(function(){
		  
			var jadwal_prodi = $("#prodi").val();
			var tahun_akademik = $("#tahun_akademik").val();
			$("#mk").empty().append("<option>loading...</option>");
			var json_url = "<?php echo base_url(); ?>index.php/admin/master/mastermatakuliah/getbytahun?tahun_akademik=" + encodeURIComponent(tahun_akademik)+"&jadwal_prodi=" + encodeURIComponent(jadwal_prodi);
			//alert(json_url);
			$.getJSON(json_url,function(data){
				$("#mk").empty(); 
				if(data==""){
					$("#mk").append("<option value=\"\">-- Pilih Matakuliah --</option>");
				}
				else{
					$("#mk").append("<option value=\"\">-- Pilih Matakuliah --</option>");
					for(i=0; i<data.id.length; i++){
						$("#mk").append("<option value=\"" + data.id[i]  + "\">" + data.nama_mata_kuliah[i] +"</option>");
					}
				}
				
			});
			
			return false;
		});
 
</script>