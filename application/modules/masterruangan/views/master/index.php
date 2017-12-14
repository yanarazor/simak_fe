<?php

$num_columns	= 10;
$can_delete	= $this->auth->has_permission('MasterRuangan.Master.Delete');
$can_edit		= $this->auth->has_permission('MasterRuangan.Master.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<br>
<div class="admin-box">
	<form action="<?php $this->uri->uri_string() ?>" method="get" accept-charset="utf-8">
	 
    	<table>
        	<tr>
            	<td>Tahun</td>
            	<td>&nbsp;</td>
            	<td>		
			<div <div style="padding-bottom:4px;">
				
			<select name="tahun" id="tahun" class="chosen-select-deselect" placeholder="Tahun">
				<option value=""></option>
				<option value="2002">2002</option>
				<option value="2003">2003</option>
				<option value="2004">2004</option>
				<option value="2005">2005</option>
				<option value="2006">2006</option>
				<option value="2007">2007</option>
				<option value="2008">2008</option>
				<option value="2009">2009</option>
				<option value="2010">2010</option>
				<option value="2011">2011</option>
				<option value="2012">2012</option>
				<option value="2013">2013</option>
				<option value="2014">2014</option>
				<option value="2015">2015</option>
				<option value="2016">2016</option>
				<option value="2017">2017</option>
				<option value="2018">2018</option>
				<option value="2019">2019</option>
				<option value="2020">2020</option>
				</select>
				</div>



				</td>
			</tr>
			<tr>
                <td>Kode</td>
                <td>&nbsp;</td>
                <td>
                	<input id='kode' type='text' name='kode' value="<?php echo set_value('kode', isset($kode) ? $kode : ''); ?>" />
				</td> 
            </tr>
            <tr>
                <td>Nama
                </td>
                <td>&nbsp;</td>
                 <td>
                	<input id='nama' type='text' name='nama' value="<?php echo set_value('nama', isset($nama) ? $nama : ''); ?>" />
                </td> 
            </tr>
            <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td> 
				<td><input type="submit" name="Act" class="btn btn-primary" value="Cari"/></td> 

            </tr>
            
        </table>
    <?php echo form_close(); ?>
  		<br>
  		<h3>Master Ruangan</h3>
   <div class="alert alert-block alert-warning fade in ">
      <a class="close" data-dismiss="alert">&times;</a>
       Jumlah :  <?php echo isset($total) ? $total : ''; ?> Ruangan
    </div>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Tahun Akademik</th>
					<th>Kode Ruangan</th>
					<th>Nama Ruangan</th>
					<th>status</th>
					<th>Waktu Awal</th>
					<th>Waktu Akhir</th>
					 
					<th>Keterangan</th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('masterruangan_delete_confirm'))); ?>')" />
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
					<td><?php echo anchor(SITE_AREA . '/master/masterruangan/edit/' . $record->id, '<span class="icon-pencil"></span>' .  $record->tahun_akademik); ?></td>
				<?php else : ?>
					<td><?php e($record->tahun_akademik); ?></td>
				<?php endif; ?>
					<td><?php e($record->kode_ruangan) ?></td>
					<td><?php e($record->Nama_ruangan) ?></td>
					<td><?php e($record->status) ?></td>
					<td><?php e($record->waktu_awal) ?></td>
					<td><?php e($record->waktu_akhir) ?></td>
					 
					<td><?php e($record->keterangan) ?></td>
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
</div>