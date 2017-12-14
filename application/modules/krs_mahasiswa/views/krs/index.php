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
    <h3>KARTU RENCANA STUDI MAHASISWA</h3>
   <div class="alert alert-block alert-warning fade in ">
      <a class="close" data-dismiss="alert">&times;</a>
       Jumlah :  <?php echo isset($total) ? $total : ''; ?>  &nbsp;KRS
    </div>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped" style="width:500px">
			<thead>
				<tr>
					<th width="10px">No.</th>
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
					$no = $limit;
					foreach ($records as $record) :
				?>
				<tr>
					<td><?php echo $no; ?>.</td>
					
					<td><a href="<?php echo base_url().'admin/krs/krs_mahasiswa/detil/'.$record->semester."/".$record->mahasiswa; ?>"><?php echo $record->nama_mahasiswa; ?> - <?php echo $record->mahasiswa; ?></a></td>
					<td><a href="<?php echo base_url().'admin/krs/krs_mahasiswa/detil/'.$record->semester."/".$record->mahasiswa; ?>"><?php echo $record->semester; ?></a></td>	  
					<td><?php e($record->jml_sks) ?></td> 
					  
				</tr>
				<?php
					$no++;
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