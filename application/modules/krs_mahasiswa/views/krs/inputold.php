<?php

$validation_errors = validation_errors();

if ($validation_errors) :
?>
<div class="alert alert-block alert-error fade in">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Please fix the following errors:</h4>
	<?php echo $validation_errors; ?>
</div>
<?php
endif;

if (isset($datakrs))
{
	$datakrs = (array) $datakrs;
}
$id = isset($datakrs['id']) ? $datakrs['id'] : '';

?>
<div class="admin-box">
<?php
	if($status_bayar=="0"){
?>
	<br/>
	<br/>
	<br/>
	<div class="alert alert-block alert-error fade in ">
      <a class="close" data-dismiss="alert">&times;</a>
      Maaf Anda tidak bisa mengisi KRS pada semester ini, Mohon lakukan pembayaran terlebih dahulu...
      <br/>
      <br/>Terimakasih
    </div>
<?php } else{?>

	  <div class="alert alert-block alert-warning fade in ">
			<a class="close" data-dismiss="alert">&times;</a>
			 Matakuliah yang ditawarkan pada semester :  <?php echo isset($sms) ? $sms : ''; ?><br/>
			 Jumlah Matakuliah :  <?php echo isset($total) ? $total : ''; ?>
		  </div>
		   <?php echo form_open($this->uri->uri_string()); ?>
			  <table class="table-bordered">
				  <thead>
					  <tr>
				 
						  <th class="column-check"><input class="check-all" type="checkbox" /></th> 
						  <th>Kode Mata Kuliah</th>
						  <th>Nama Mata Kuliah</th>
						  <th>SKS</th>
						  <th>SKS Tatap Muka</th>
						  <th>SKS Praktikum</th>
						  <th>SKS Praktek Lapangan</th>
						  <th>Jadwal</th>
					  </tr>
				  </thead>
			
				  <tbody>
					  <?php
					  if (isset($recordmks) && is_array($recordmks) && count($recordmks)) :
						  $jmlsks = 0;
						  $skstatapmuka = 0;
						  $skspraktek = 0;
						  $skslapangan = 0;
						  foreach ($recordmks as $record) :
						  $jmlsks = $jmlsks+$record->sks;
						  $skstatapmuka = $skstatapmuka+$record->sks_tatap_muka;
						  $skspraktek = $skspraktek+$record->sks_praktikum;
						  $skslapangan = $skslapangan+$record->sks_praktek_lap;
					  ?>
					  <tr>
					 
						  <td class="column-check">
						
						  <?php if(isset($jsonkrs['idkrs'][$record->kode_mata_kuliah])) { ?>
							  <input type="checkbox" name="checked[]" value="<?php echo $record->id; ?>" checked />
						  <?php }else{ ?>
							  <input type="checkbox" name="checked[]" value="<?php echo $record->id; ?>" />
						  <?php } ?>
							  <input type="hidden" name="kodemk_<?php echo $record->id; ?>" value="<?php echo $record->kode_mata_kuliah; ?>" />
							  <input type="hidden" name="mksks_<?php echo $record->id; ?>" value="<?php echo $record->sks; ?>" />
						  </td>
						  <td>
						  <?php e($record->kode_mata_kuliah) ?></td>
						  <td><?php e($record->nama_mata_kuliah) ?></td>
						  <td><?php e($record->sks) ?></td>
						  <td><?php e($record->sks_tatap_muka) ?></td>
						  <td><?php e($record->sks_praktikum) ?></td>
						  <td><?php e($record->sks_praktek_lap) ?></td>
						  <td><a href="<?php echo base_url().'index.php/admin/settings/jadwal/lihat/?mk='.$record->kode_mata_kuliah; ?>&sms=<?php echo $sms; ?>&idkrs=<?php echo isset($jsonkrs['idkrs'][$record->kode_mata_kuliah])?$jsonkrs['idkrs'][$record->kode_mata_kuliah]:''; ?>" class="addjadwal" kode="<?php e($record->kode_mata_kuliah) ?>">Pilih</a></td>
					  </tr>
					  <?php
						  endforeach;
					  else:
					  ?>
					  <tr>
						  <td colspan="10">No records found that match your selection.</td>
					  </tr>
					  <?php endif; ?>
				  </tbody>
				  <?php if (isset($recordmks) && is_array($recordmks) && count($recordmks)) : ?>
				  <tfoot>
			 
					  <tr>
						  <td colspan="3">
							  <?php echo lang('bf_with_selected'); ?>
							  <input type="submit" name="ambil" id="ambil-me" class="btn btn-danger" value="ambil" onclick="return confirm('<?php e(js_escape("Ambil Matakuliah")); ?>')" />
						  </td>
						  <td colspan="1">
							  <?php echo $jmlsks;  ?>
						  </td>
						  <td colspan="1">
							  <?php echo $skstatapmuka;  ?>
						  </td>
						  <td colspan="1">
							  <?php echo $skspraktek;  ?>
						  </td>
						  <td colspan="1">
							  <?php echo $skslapangan;  ?>
						  </td>
						   <td colspan="1">
						 
						  </td>
					  </tr>
				 
				  </tfoot>
				  <?php endif; ?>
			  </table>
		  <?php echo form_close(); ?>
	<?php } ?>
</div>

<script type="text/javascript">
function loadpeserta(){
	var json_url = "<?php echo base_url()."index.php/admin/pelatihan/data_pelatihan/listpesertapelatihan/".$id; ?>";
	
	$('#divpeserta').load(json_url);
}
function loadinstruktur(){
	
	var json_url = "<?php echo base_url()."index.php/admin/pelatihan/data_pelatihan/listinstrukturpelatihan/".$id; ?>";
	//alert(json_url);
	$('#divinstruktur').load(json_url);
}
 
function loadsaraninstruktur(order_id){
 $.ajax({
			url: "<?php echo base_url() ?>index.php/admin/kuisioner/kuesioner_instruktur/viewsaranbyorder/"+order_id,
			type:"GET",
			data: "",
			dataType: "html",
			timeout:180000,
			success: function (result) {
				$('#divsaraninstruktur').html(result);
		},
		error : function(error) {
			alert(error);
		} 
	});        
	return false;
} 
$(document).ready(function() { 	 
 //loadinstruktur();

		$(".delete").live("click", function(){
		 	var post_data = "id="+$(this).attr("kode");
			 conf = confirm("Anda yakin?"); 
				if (!conf)
                    return false;
			$.ajax({
				url: "<?php echo base_url() ?>index.php/admin/pelatihan/data_pelatihan/deletepesertavia_ajax",
				type:"POST",
				data: post_data,
				dataType: "html",
				timeout:180000,
				success: function (result) {
					loadpeserta();
					loadinstruktur();
			},
			error : function(error) {
				alert(error);
			} 
			});        
			return false;
		}); 
	 
		$(".addjadwal").fancybox({
			'overlayShow'	: true,
			'transitionIn'	: 'elastic',
			'transitionOut'	: 'elastic',
			//'type'	: 'iframe',
			'onClosed'           : function(){loadinstruktur()},
			 
			'height':700,
			'width': 750,
    		'autoDimensions': false
		});			
	 
}); 
 	
</script>  
