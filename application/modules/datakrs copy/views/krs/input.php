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
      <h4>Maaf Anda tidak bisa mengisi KRS pada semester ini (<?php echo $sms; ?>), Mohon lakukan pembayaran terlebih dahulu... </h4>
      <br/>
      <br/>Terimakasih
    </div>
<?php } else{?>
		<br>
		<br/>
		<br/>
	  <div class="alert alert-block alert-warning fade in ">
			<a class="close" data-dismiss="alert">&times;</a>
			<h4>Matakuliah yang ditawarkan pada semester :  <?php echo isset($sms) ? $sms : ''; ?>, 
			Tahun Ajaran : <?php echo $this->settings_lib->item('site.tahun'); ?>,
			Kode Prodi : <?php echo isset($kode_prodi) ? $kode_prodi : ''; ?>
			<br/>
			 Jumlah Mata Kuliah :  <?php echo isset($total) ? $total : ''; ?>
			 </h4>
		  </div>
		  <div class="row-fluid stats-number">				
			   <div class="box-small span9">
				   <?php echo form_open($this->uri->uri_string()); ?>
					  <table class="table-bordered">
						  <thead>
							  <tr>
				 
								  <th class="column-check" style="padding:5px;"></th> 
								  <th style="padding:5px;">Kode Mata Kuliah</th>
								  <th width="500px" style="padding:5px;">Nama Mata Kuliah</th>
								  <th style="padding:5px;">SKS</th>
								  <th style="padding:5px;">Semester</th>
								  <!--
								  <th style="padding:5px;">SKS<br>Tatap Muka</th>
								  <th style="padding:5px;">SKS<br>Praktikum</th>
								  <th style="padding:5px;">SKS<br>Praktek Lapangan</th>
								  -->
								   <th style="padding:5px;">Kelas</th>
								  <th style="padding:5px;">Lihat Jadwal</th>
						  
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
									  <input type="checkbox" name="checked[]" class="chkmk" id="chkmk_<?php echo $record->kode_mata_kuliah; ?>" value="<?php echo $record->kode_mata_kuliah; ?>" checked />
								  <?php }else{ ?>
									  <input type="checkbox" name="checked[]" class="chkmk" id="chkmk_<?php echo $record->kode_mata_kuliah; ?>" value="<?php echo $record->kode_mata_kuliah; ?>" />
								  <?php } ?>
									  <input type="hidden" name="kodemk_<?php echo $record->kode_mata_kuliah; ?>" value="<?php echo $record->kode_mata_kuliah; ?>" />
									  <input type="hidden" name="nama_mk_<?php echo $record->kode_mata_kuliah; ?>" value="<?php echo $record->nama_mata_kuliah; ?>" />
									  <input type="hidden" id="mksks_<?php echo $record->kode_mata_kuliah; ?>" name="mksks_<?php echo $record->kode_mata_kuliah; ?>" value="<?php echo $record->sks; ?>" />
									  <input type="hidden" id="sms_<?php echo $record->kode_mata_kuliah; ?>" name="sms_<?php echo $record->kode_mata_kuliah; ?>" value="<?php echo $record->semester; ?>" />
								  </td>
								  <td style="padding:5px;">
								  <?php e($record->kode_mata_kuliah) ?></td>
								  <td style="padding:5px;" align="left"><?php e($record->nama_mata_kuliah) ?></td>
								  <td style="padding:5px;"><?php e($record->sks) ?></td>
								  <td style="padding:5px;"><?php e($record->semester) ?></td>
								  
								 
								   	<td style="padding:5px;">
								   		<input type="hidden" value="" name="txtkelas_<?php echo $record->kode_mata_kuliah; ?>" id="txtkelas_<?php echo $record->kode_mata_kuliah; ?>"/>
										<input type="hidden" value="" name="txtkdjadwal_<?php echo $record->kode_mata_kuliah; ?>" id="txtkdjadwal_<?php echo $record->kode_mata_kuliah; ?>"/>
										<span id="kelas_<?php echo $record->kode_mata_kuliah; ?>">
								    		-
								    	</span>
								    </td>
								   <td style="padding:5px;">
									 	<a href="<?php echo base_url().'index.php/admin/settings/jadwal/lihat/?mk='.$record->kode_mata_kuliah; ?>&sms=<?php e($record->semester) ?>&prodi=<?php echo isset($kode_prodi) ? $kode_prodi : ''; ?>&idkrs=<?php echo isset($jsonkrs['idkrs'][$record->kode_mata_kuliah])?$jsonkrs['idkrs'][$record->kode_mata_kuliah]:''; ?>" class="addjadwal" kode="<?php e($record->kode_mata_kuliah) ?>">Lihat</a>
									 </td>
									</tr>
							  <?php
								  endforeach;
							  else:
							  ?>
							  <tr>
								  <td style="padding:5px;" colspan="11">Data tidak ditemukan, Silahkan hubungi Sekretariat.</td>
							  </tr>
							  <?php endif; ?>
						  </tbody>
						  <?php if (isset($recordmks) && is_array($recordmks) && count($recordmks)) : ?>
						  <tfoot>
							  <tr>
								  <td style="padding:5px;" colspan="3" align="left">
									  <?php echo lang('bf_with_selected'); ?>
									 <!-- <input type="submit" name="ambil" id="ambil-me" class="btn btn-success" value="Konfirmasi" onclick="return confirm('<?php e(js_escape("Ambil Matakuliah")); ?>')" /> -->
								  </td>
								  <td align="center" style="padding:5px;" colspan="1"> <?php echo $jmlsks;  ?> </td>
								  <td colspan="1">&nbsp;</td>
								   <td colspan="1">&nbsp;</td>
								   <td colspan="1">&nbsp;</td>
							  </tr>
						  </tfoot>
						  <?php endif; ?>
					  </table>
				 
					  <br>
					  <table width="100%">
					  	<tr>
					  		<td align="left" width="200px">
					  			Jumlah matakuliah yang dipilih :
					  		</td>
					  		<td align="left">
					  			<div class="mkdipilih">-</div>
					  		</td>
					  	</tr>
					  	<tr>
					  		<td align="left">
					  			Jumlah SKS yang di ambil :
					  		</td>
					  		<td align="left">
					  			<div class="sksdipilih">-</div>
					  		</td>
					  	</tr>
					  	<tr>
					  		<td align="center" colspan="2">
					  			<input type="submit" name="ambil" id="ambil-me" class="btn-large btn-success" value="Konfirmasi" onclick="return confirm('<?php e(js_escape("Ambil Matakuliah")); ?>')" /> 
					  		</td>
					  	</tr>
					  </table>
					  <div class="alert alert-block alert-error fade in ">
						  <a class="close" data-dismiss="alert">&times;</a>
						  <h2>Setelah anda mengklik konfirmasi, anda tidak bisa melakukan perubahan data KRS, Jika ingin merubah silahkan menghubungi bagian akademik</h2>
						  
						</div>
				  <?php echo form_close(); ?>
				 </div>
	   
			   <div class="box-small span2">
				  <!--	<a class="btn btn-warning" href="<?php echo base_url().'index.php/admin/krs/datakrs/lainnya/?'; ?>&sms=<?php echo $sms; ?>&prodi=<?php echo isset($kode_prodi) ? $kode_prodi : ''; ?>" id="addlainnya" kode="<?php e($record->kode_mata_kuliah) ?>" >Matakuliah Lainnya</a></td>
									-->
				   <div class="box-small-title"> </div>
				   <!--<span id="visits-count-n"class="notification green">+ 2</span>-->
			   </div>
		   
			    		
		   </div> 
		   
	<?php } ?>
</div>

<script type="text/javascript">
 $(document).ready(function () {
	$('.chkmk').change(function () {
		hitungjmlmk();
		hitungsks();
	});
 });
 
 $('.mkdipilih').text($(":checkbox:checked").length);
 hitungsks();
 hitungjmlmk();
 function setJadwal(kelas,kode,kdmk,kdjadwal) {
 
    $('#kelas_'+kdmk).text(kelas);
    $("#txtkelas_"+kdmk).val(kelas);
    $("#chkmk_"+kdmk).attr("checked",true);
  	$("#txtkdjadwal_"+kdmk).val(kdjadwal);
	hitungjmlmk();
   	hitungsks();
}
function hitungsks(){
	var checkedValue = null; 
    var jmlsks = 0;
	var inputElements = document.getElementsByClassName('chkmk');
	for(var i=0; inputElements[i]; ++i){
		  if(inputElements[i].checked){
			   checkedValue = inputElements[i].value;
			   jmlsks = jmlsks + parseInt($("#mksks_"+checkedValue).val());
		  }
	}
	$('.sksdipilih').text(jmlsks);
}
function hitungjmlmk(){
	  $('.mkdipilih').text($(":checkbox:checked").length);
}
$(document).ready(function() {
		$(".addjadwal").fancybox({
			'overlayShow'	: true,
			'transitionIn'	: 'elastic',
			'transitionOut'	: 'elastic',
			//'type'	: 'iframe',
			'onClosed'           : function(){},
			 
			'height':700,
			'width': 900,
    		'autoDimensions': true
		});	
}); 
 	
</script>  
