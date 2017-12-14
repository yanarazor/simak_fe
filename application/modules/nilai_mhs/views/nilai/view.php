<?php

$num_columns	= 10;
$can_delete	= $this->auth->has_permission('DataKrs.Krs.Delete');
$can_edit		= $this->auth->has_permission('Nilai_Mahasiswa.Nilai.Create');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<br>
<div class="admin-box">
	<form action="<?php $this->uri->uri_string() ?>" method="get" accept-charset="utf-8">
    	<table>
    		<tr>
    			<td>Nim Mahasiswa</td>
    			<td>:</td>
    			<td>
    				<input id='nama' type='text' name='nama' value="<?php echo set_value('mhs', isset($mhs) ? $mhs : ''); ?>" /> 				
    			</td>
    		</tr>
    		<tr>
                <td>Semester</td>
    			<td>:</td>
    			<td>
    				<select name="sms" id="sms" class="chosen-select-deselect">
						 <option value="">Pilih Semester</option>
						 <?php if (isset($pilihansemesters) && is_array($pilihansemesters) && count($pilihansemesters)):?>
						 <?php foreach($pilihansemesters as $record):?>
							  <option value="<?php echo $record->value;?>" <?php if(isset($value))  echo  ($record->value==$sms) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
						  <?php endforeach;?>
						 <?php endif;?>
					 </select>

    			</td>
            </tr>
            <tr>
                <td>Mata Kuliah</td>
				<td>:</td> 		
                <td>
                	<select name="kode_mk" id="kode_mk" class="chosen-select-deselect">
						 <option value="">Pilih Matakuliah</option>
						 <?php if (isset($matakuliahs) && is_array($matakuliahs) && count($matakuliahs)):?>
						 <?php foreach($matakuliahs as $record):?>
							  <option value="<?php echo $record->kode_mata_kuliah;?>" <?php if(isset($kode_mk))  echo  ($record->kode_mata_kuliah==$kode_mk) ? "selected" : ""; ?>><?php echo $record->nama_mata_kuliah; ?></option>
						  <?php endforeach;?>
						 <?php endif;?>
					 </select>
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
    <h3>Pengelolaan Data Nilai Mahasiswa</h3>
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
					
					<th>Mata Kuliah</th>
					<th>Sks</th>
					<th>Mahasiswa</th>
					<th>Dosen</th>
					<th>Semester</th>
					
					<th>Nilai Angka</th>
					<th>Nilai Huruf</th>
					 
				</tr>
			</thead>
			 
			<?php if ($has_records) : ?>
						 <tfoot>
							 <?php if ($can_delete) : ?>
							 <tr>
								 <td colspan="<?php echo $num_columns; ?>">
									 <?php echo lang('bf_with_selected'); ?>
									 <input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('datakrs_delete_confirm'))); ?>')" />
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
					<td><?php echo anchor(SITE_AREA . '/nilai/nilai_mhs/edit/' . $record->id, '<span class="icon-pencil"></span>' .  $record->kode_mk."-".$record->nama_mata_kuliah); ?></td>
				<?php else : ?>
					<td><?php e($record->kode_mk."-".$record->nama_mata_kuliah); ?></td>
				<?php endif; ?>
					<td><?php e($record->sks) ?></td>
					 
					<td><?php echo $record->nim_mhs." - ".$record->nama_mahasiswa; ?></td>
					<td><?php echo $record->nama_dosen; ?></td>
					<td><?php e($record->semester) ?></td>
					 
					<td><?php e($record->nilai_angka) ?></td>
					<td><?php e($record->nilai_huruf) ?></td>
					 
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