<?php

$num_columns	= 3;
$can_delete	= $this->auth->has_permission('DataKrs.Krs.Delete');
$can_edit		= $this->auth->has_permission('DataKrs.Krs.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<br>

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
       Jumlah :  <?php echo isset($total) ? $total : ''; ?> &nbsp;Semester
    </div>

	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-bordered" style="width:500px">
			<thead>
				<tr>
					 
					<th>Semester</th>
					<th>Jumlah SKS</th>
					 
					 
				</tr>
			</thead>
			 
			<tfoot>
				 
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						</td>
				</tr>
				 
			</tfoot>
			 
			<tbody>
				<?php
				if ($has_records) :
					foreach ($records as $record) :
				?>
				<tr>
					 
					<td><a href="<?php echo base_url().'admin/krs/datakrs/detil/'.$record->semester; ?>"><?php echo $record->semester; ?></a></td>
				  
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
	</div>
</div>
<script type="text/javascript">	  
$("#sms").change(function() {
	var varanggaran = $("#sms" ).val();
	var json_url = "<?php echo base_url() ?>admin/krs/datakrs/?sms="+varanggaran;
	window.location.href = json_url;
});
</script>