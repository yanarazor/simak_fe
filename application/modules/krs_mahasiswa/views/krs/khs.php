<?php

$num_columns	= 10;
$can_delete	= $this->auth->has_permission('DataKrs.Krs.Delete');
$can_edit		= $this->auth->has_permission('DataKrs.Krs.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<br>
<div class="admin-box">
	<form action="<?php $this->uri->uri_string() ?>" method="get" accept-charset="utf-8">
	 <table>
	 	 <tr>
	 		<td>Angkatan</td>
	 		<td>:</td>
	 		<td>
	            <input id='mhs' type='text' name='mhs' value="<?php echo set_value('mhs', isset($mhs) ? $mhs : ''); ?>" />
	            <span class='help-inline'>"2014" untuk angkatan 2014 </span>
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
    <h3>KARTU HASIL STUDI</h3>
   <div class="alert alert-block alert-warning fade in ">
      <a class="close" data-dismiss="alert">&times;</a>
       Jumlah :  <?php echo isset($total) ? $total : ''; ?>  &nbsp;Mahasiswa
    </div>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped" style="width:500px">
			<thead>
				<tr>
					<th>Mahasiswa</th>
					<th>Semester</th>
					<th>Jumlah SKS</th>
					 
				</tr>
			</thead>
			 
			<tfoot> 
				<tr>
					<td colspan="<?php echo $num_columns; ?>">&nbsp;</td>
				</tr>
			</tfoot>
			 
			<tbody>
				<?php
				if ($has_records) :
					foreach ($records as $record) :
				?>
				<tr>
					<td><a href="<?php echo base_url().'admin/krs/krs_mahasiswa/detil/'.$record->semester."/".$record->mahasiswa; ?>"><?php echo $record->nama_mahasiswa; ?> - <?php echo $record->mahasiswa; ?></a></td>
					<td><a href="<?php echo base_url().'admin/krs/krs_mahasiswa/detil/'.$record->semester."/".$record->mahasiswa; ?>"><?php echo $record->semester; ?></a></td>	  
					<td><?php e($record->jml_sks) ?></td> 
					  
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