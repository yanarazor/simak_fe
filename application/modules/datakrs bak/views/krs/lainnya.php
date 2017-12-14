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
		<br>
		<br/>
		<br/>
	  <div class="alert alert-block alert-warning fade in ">
			<a class="close" data-dismiss="alert">&times;</a>
			Matakuliah yang ditawarkan pada Semester Lainnya, 
			Tahun Ajaran : <?php echo $this->settings_lib->item('site.tahun'); ?>,
			Kode Prodi : <?php echo isset($kode_prodi) ? $kode_prodi : ''; ?>
			
		  </div>
		  <div class="row-fluid stats-number">				
			   <div class="box-small span11">
				   <?php echo form_open($this->uri->uri_string()); ?>
					  <table class="table-bordered">
						  <thead>
							  <tr>
				 
								  <th class="column-check" style="padding:5px;"><input class="check-all" type="checkbox" /></th> 
								  <th style="padding:5px;">Kode Mata Kuliah</th>
								  <th width="500px" style="padding:5px;">Nama Mata Kuliah</th>
								  <th style="padding:5px;">SKS</th>
								  <th style="padding:5px;">SKS<br>Tatap Muka</th>
								  <th style="padding:5px;">SKS<br>Praktikum</th>
								  <th style="padding:5px;">SKS<br>Praktek Lapangan</th>
								  <th style="padding:5px;">Semester</th>
							  </tr>
						  </thead>
			
						  <tbody>
							  <input name="tahun_ajaran" type="hidden" value="<?php echo $this->settings_lib->item('site.tahun'); ?>" />
							  <input name="semester" type="hidden" value="<?php echo $sms; ?>" />
						
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
					 
								  <td style="padding:5px;" class="column-check">
						
								  <?php if(isset($jsonkrs['idkrs'][$record->kode_mata_kuliah])) { ?>
									  <input type="checkbox" name="checked[]" value="<?php echo $record->kode_mata_kuliah; ?>" checked />
								  <?php }else{ ?>
									  <input type="checkbox" name="checked[]" value="<?php echo $record->kode_mata_kuliah; ?>" />
								  <?php } ?>
									  <input type="hidden" name="kodemk_<?php echo $record->kode_mata_kuliah; ?>" value="<?php echo $record->kode_mata_kuliah; ?>" />
									  <input type="hidden" name="mksks_<?php echo $record->kode_mata_kuliah; ?>" value="<?php echo $record->sks; ?>" />
								  </td>
								  <td style="padding:5px;">
								  <?php e($record->kode_mata_kuliah) ?></td>
								  <td style="padding:5px;" align="left"><?php e($record->nama_mata_kuliah) ?></td>
								  <td style="padding:5px;"><?php e($record->sks) ?></td>
								  <td style="padding:5px;"><?php e($record->sks_tatap_muka) ?></td>
								  <td style="padding:5px;"><?php e($record->sks_praktikum) ?></td>
								  <td style="padding:5px;"><?php e($record->sks_praktek_lap) ?></td>
								  <td style="padding:5px;"><?php e($record->semester) ?></td>
								  
							  </tr>
							  <?php
								  endforeach;
							  else:
							  ?>
							  <tr>
								  <td style="padding:5px;" colspan="10">Data tidak ditemukan, Silahkan hubungi Sekretariat.</td>
							  </tr>
							  <?php endif; ?>
						  </tbody>
						  <?php if (isset($recordmks) && is_array($recordmks) && count($recordmks)) : ?>
						  <tfoot>
							  <tr>
								  <td style="padding:5px;" colspan="3" align="left">
									  <?php echo lang('bf_with_selected'); ?>
									  <input type="submit" name="ambil" id="ambil-me" class="btn btn-success" value="ambil" onclick="return confirm('<?php e(js_escape("Ambil Matakuliah")); ?>')" />
								  </td>
								  <td align="center" style="padding:5px;" colspan="1"> <?php echo $jmlsks;  ?> </td>
								  <td align="center" style="padding:5px;" colspan="1"> <?php echo $skstatapmuka;  ?> </td>
								  <td align="center" style="padding:5px;" colspan="1"> <?php echo $skspraktek;  ?> </td>
								  <td align="center" style="padding:5px;" colspan="1"> <?php echo $skslapangan;  ?> </td>
								   <td colspan="1">&nbsp;</td>
							  </tr>
						  </tfoot>
						  <?php endif; ?>
					  </table>
				  <?php echo form_close(); ?>
				 
			   </div> 		
		   </div> 
		   
	<?php } ?>
</div>

<script type="text/javascript">
 
function loadjadwal(){
	//alert("masuk");
}
  
$(document).ready(function() { 	 
 
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
			'type'	: 'iframe',
			'onClosed'           : function(){loadjadwal()},
			 
			'height':700,
			'width': 900,
    		'autoDimensions': false
		});			
	 
}); 
 	
</script>  
