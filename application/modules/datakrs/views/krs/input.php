<script src="<?php echo base_url(); ?>themes/admin/js/sweetalert.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/css/sweetalert.css">
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
	  <div class="alert alert-block alert-warning fade in ">
			<a class="close" data-dismiss="alert">&times;</a>
			<h4>Matakuliah yang ditawarkan pada semester :  <?php echo isset($sms) ? $sms : ''; ?>, 
			Tahun Ajaran : <?php echo $this->settings_lib->item('site.tahun'); ?>,
			Kode Prodi : <?php echo isset($kode_prodi) ? $kode_prodi : ''; ?>
			 
			 </h4>
		  </div>
		  <div class="row-fluid stats-number">		
		  	<?php echo form_open($this->uri->uri_string()); ?>		
			   <div class="box-small span9">
				  
				   		<input name="tahun_ajaran" type="hidden" value="<?php echo $this->settings_lib->item('site.tahun'); ?>" />
						<input name="semester" id="semestermhs" type="hidden" value="<?php echo $sms; ?>" />
						<?php 
						if($stat_semester=="1"){
						?>
							Semester 1 
							<table class="table-bordered">
							  <thead>
								  <tr>
									  <th class="column-check" style="padding:5px;"></th> 
									  <th style="padding:5px;">Kode Mata Kuliah</th>
									  <th width="500px" style="padding:5px;">Nama Mata Kuliah</th>
									  <th style="padding:5px;">SKS</th>
									  <th style="padding:5px;">Semester</th>
								  
									   <th style="padding:5px;">Kelas</th>
									  <th style="padding:5px;">Lihat Jadwal</th>
						  
								  </tr>
							  </thead>
			
							  <tbody>
								  <?php
								  if (isset($recsemester1) && is_array($recsemester1) && count($recsemester1)) :
									  $jmlsks = 0;
									  $skstatapmuka = 0;
									  $skspraktek = 0;
									  $skslapangan = 0;
									  foreach ($recsemester1 as $record) :
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
											<input type="hidden" value="<?php
												echo isset($jsonkrs['kelas'][$record->kode_mata_kuliah]) ? $jsonkrs['kelas'][$record->kode_mata_kuliah] : "";
												?>" name="txtkelas_<?php echo $record->kode_mata_kuliah; ?>" id="txtkelas_<?php echo $record->kode_mata_kuliah; ?>"/>
											<input type="hidden" value="<?php
												echo isset($jsonkrs['kode_jadwal'][$record->kode_mata_kuliah]) ? $jsonkrs['kode_jadwal'][$record->kode_mata_kuliah] : "";
												?>" name="txtkdjadwal_<?php echo $record->kode_mata_kuliah; ?>" id="txtkdjadwal_<?php echo $record->kode_mata_kuliah; ?>"/>
											<span id="kelas_<?php echo $record->kode_mata_kuliah; ?>">
												<?php
												echo isset($jsonkrs['kelas'][$record->kode_mata_kuliah]) ? $jsonkrs['kelas'][$record->kode_mata_kuliah] : "";
												?>
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
									  <td style="padding:5px;" colspan="11">Matakuliah untuk semester ini tidak ditemukan, Silahkan hubungi Sekretariat.</td>
								  </tr>
								  <?php endif; ?>
							  </tbody>
							  <?php if (isset($recsemester1) && is_array($recsemester1) && count($recsemester1)) : ?>
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
						  
						  	Semester 3
							<table class="table-bordered">
							  <thead>
								  <tr>
									  <th class="column-check" style="padding:5px;"></th> 
									  <th style="padding:5px;">Kode Mata Kuliah</th>
									  <th width="500px" style="padding:5px;">Nama Mata Kuliah</th>
									  <th style="padding:5px;">SKS</th>
									  <th style="padding:5px;">Semester</th>
								  
									   <th style="padding:5px;">Kelas</th>
									  <th style="padding:5px;">Lihat Jadwal</th>
						  
								  </tr>
							  </thead>
			
							  <tbody>
								  <?php
								  if (isset($recsemester3) && is_array($recsemester3) && count($recsemester3)) :
									  $jmlsks = 0;
									  $skstatapmuka = 0;
									  $skspraktek = 0;
									  $skslapangan = 0;
									  foreach ($recsemester3 as $record) :
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
											<input type="hidden" value="<?php
												echo isset($jsonkrs['kelas'][$record->kode_mata_kuliah]) ? $jsonkrs['kelas'][$record->kode_mata_kuliah] : "";
												?>" name="txtkelas_<?php echo $record->kode_mata_kuliah; ?>" id="txtkelas_<?php echo $record->kode_mata_kuliah; ?>"/>
											<input type="hidden" value="<?php
												echo isset($jsonkrs['kode_jadwal'][$record->kode_mata_kuliah]) ? $jsonkrs['kode_jadwal'][$record->kode_mata_kuliah] : "";
												?>" name="txtkdjadwal_<?php echo $record->kode_mata_kuliah; ?>" id="txtkdjadwal_<?php echo $record->kode_mata_kuliah; ?>"/><span id="kelas_<?php echo $record->kode_mata_kuliah; ?>">
												<?php
												echo isset($jsonkrs['kelas'][$record->kode_mata_kuliah]) ? $jsonkrs['kelas'][$record->kode_mata_kuliah] : "";
												?>
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
									  <td style="padding:5px;" colspan="11">Matakuliah untuk semester ini tidak ditemukan, Silahkan hubungi Sekretariat.</td>
								  </tr>
								  <?php endif; ?>
							  </tbody>
							  <?php if (isset($recsemester3) && is_array($recsemester3) && count($recsemester3)) : ?>
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
						  
						  	Semester 5
							<table class="table-bordered">
							  <thead>
								  <tr>
									  <th class="column-check" style="padding:5px;"></th> 
									  <th style="padding:5px;">Kode Mata Kuliah</th>
									  <th width="500px" style="padding:5px;">Nama Mata Kuliah</th>
									  <th style="padding:5px;">SKS</th>
									  <th style="padding:5px;">Semester</th>
								  
									   <th style="padding:5px;">Kelas</th>
									  <th style="padding:5px;">Lihat Jadwal</th>
						  
								  </tr>
							  </thead>
			
							  <tbody>
								  <?php
								  if (isset($recsemester5) && is_array($recsemester5) && count($recsemester5)) :
									  $jmlsks = 0;
									  $skstatapmuka = 0;
									  $skspraktek = 0;
									  $skslapangan = 0;
									  foreach ($recsemester5 as $record) :
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
											<input type="hidden" value="<?php
												echo isset($jsonkrs['kelas'][$record->kode_mata_kuliah]) ? $jsonkrs['kelas'][$record->kode_mata_kuliah] : "";
												?>" name="txtkelas_<?php echo $record->kode_mata_kuliah; ?>" id="txtkelas_<?php echo $record->kode_mata_kuliah; ?>"/>
											<input type="hidden" value="<?php
												echo isset($jsonkrs['kode_jadwal'][$record->kode_mata_kuliah]) ? $jsonkrs['kode_jadwal'][$record->kode_mata_kuliah] : "";
												?>" name="txtkdjadwal_<?php echo $record->kode_mata_kuliah; ?>" id="txtkdjadwal_<?php echo $record->kode_mata_kuliah; ?>"/>
											<span id="kelas_<?php echo $record->kode_mata_kuliah; ?>">
												<?php
												echo isset($jsonkrs['kelas'][$record->kode_mata_kuliah]) ? $jsonkrs['kelas'][$record->kode_mata_kuliah] : "";
												?>
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
									  <td style="padding:5px;" colspan="11">Matakuliah untuk semester ini tidak ditemukan, Silahkan hubungi Sekretariat.</td>
								  </tr>
								  <?php endif; ?>
							  </tbody>
							  <?php if (isset($recsemester5) && is_array($recsemester5) && count($recsemester5)) : ?>
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
						  	
						  	Semester 7
							<table class="table-bordered">
							  <thead>
								  <tr>
									  <th class="column-check" style="padding:5px;"></th> 
									  <th style="padding:5px;">Kode Mata Kuliah</th>
									  <th width="500px" style="padding:5px;">Nama Mata Kuliah</th>
									  <th style="padding:5px;">SKS</th>
									  <th style="padding:5px;">Semester</th>
								  
									   <th style="padding:5px;">Kelas</th>
									  <th style="padding:5px;">Lihat Jadwal</th>
						  
								  </tr>
							  </thead>
			
							  <tbody>
								  <?php
								  if (isset($recsemester7) && is_array($recsemester7) && count($recsemester7)) :
									  $jmlsks = 0;
									  $skstatapmuka = 0;
									  $skspraktek = 0;
									  $skslapangan = 0;
									  foreach ($recsemester7 as $record) :
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
											<input type="hidden" value="<?php
												echo isset($jsonkrs['kelas'][$record->kode_mata_kuliah]) ? $jsonkrs['kelas'][$record->kode_mata_kuliah] : "";
												?>" name="txtkelas_<?php echo $record->kode_mata_kuliah; ?>" id="txtkelas_<?php echo $record->kode_mata_kuliah; ?>"/>
											<input type="hidden" value="<?php
												echo isset($jsonkrs['kode_jadwal'][$record->kode_mata_kuliah]) ? $jsonkrs['kode_jadwal'][$record->kode_mata_kuliah] : "";
												?>" name="txtkdjadwal_<?php echo $record->kode_mata_kuliah; ?>" id="txtkdjadwal_<?php echo $record->kode_mata_kuliah; ?>"/>
											<span id="kelas_<?php echo $record->kode_mata_kuliah; ?>">
												<?php
												echo isset($jsonkrs['kelas'][$record->kode_mata_kuliah]) ? $jsonkrs['kelas'][$record->kode_mata_kuliah] : "";
												?>
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
									  <td style="padding:5px;" colspan="11">Matakuliah untuk semester ini tidak ditemukan, Silahkan hubungi Sekretariat.</td>
								  </tr>
								  <?php endif; ?>
							  </tbody>
							  <?php if (isset($recsemester7) && is_array($recsemester7) && count($recsemester7)) : ?>
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
						<?php
						}// end semester 1
						?>
						
				   	  	<!-- genap -->
				   	  	<?php
				   	  	if($stat_semester=="2")
				   	  	{
				   	  		$dua 		= true;
				   	  		$empat 		= true;
				   	  		$enam		= true;
				   	  		$delapan	= true;
				   	  		if($sms == "2")
				   	  			$dua	= false;
				   	  		if($sms == "4")
				   	  			$empat	= false;
				   	  		if($sms == "6")
				   	  			$enam = false;
				   	  		if($sms == "8")
				   	  			$delapan = false;
				   	  		  
						?>
								<b>Semester 2</b>
								<table class="table-bordered">
								  <thead>
									  <tr>
										  <th class="column-check" style="padding:5px;"></th> 
										  <th style="padding:5px;">Kode Mata Kuliah</th>
										  <th width="500px" style="padding:5px;">Nama Mata Kuliah</th>
										  <th style="padding:5px;">SKS</th>
										  <th style="padding:5px;">Semester</th>
								  
										   <th style="padding:5px;">Kelas</th>
										  <th style="padding:5px;">Lihat Jadwal</th>
						  
									  </tr>
								  </thead>
			
								  <tbody>
							  
						
									  <?php
									  if (isset($recsemester2) && is_array($recsemester2) && count($recsemester2)) :
										  $jmlsks = 0;
										  $skstatapmuka = 0;
										  $skspraktek = 0;
										  $skslapangan = 0;
										  foreach ($recsemester2 as $record) :
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
												<input type="hidden" value="<?php
												echo isset($jsonkrs['kelas'][$record->kode_mata_kuliah]) ? $jsonkrs['kelas'][$record->kode_mata_kuliah] : "";
												?>" name="txtkelas_<?php echo $record->kode_mata_kuliah; ?>" id="txtkelas_<?php echo $record->kode_mata_kuliah; ?>"/>
											<input type="hidden" value="<?php
												echo isset($jsonkrs['kode_jadwal'][$record->kode_mata_kuliah]) ? $jsonkrs['kode_jadwal'][$record->kode_mata_kuliah] : "";
												?>" name="txtkdjadwal_<?php echo $record->kode_mata_kuliah; ?>" id="txtkdjadwal_<?php echo $record->kode_mata_kuliah; ?>"/>
												<span id="kelas_<?php echo $record->kode_mata_kuliah; ?>">
													<?php
													echo isset($jsonkrs['kelas'][$record->kode_mata_kuliah]) ? $jsonkrs['kelas'][$record->kode_mata_kuliah] : "";
													?>
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
										  <td style="padding:5px;" colspan="11">Matakuliah untuk semester ini tidak ditemukan, Silahkan hubungi Sekretariat.</td>
									  </tr>
									  <?php 
								  
									  endif; 
									  
									  ?>
								  </tbody>
								  <?php if (isset($recsemester2) && is_array($recsemester2) && count($recsemester2)) : ?>
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
							  
							  	<b>Semester 4</b>
								<table class="table-bordered">
								  <thead>
									  <tr>
										  <th class="column-check" style="padding:5px;"></th> 
										  <th style="padding:5px;">Kode Mata Kuliah</th>
										  <th width="500px" style="padding:5px;">Nama Mata Kuliah</th>
										  <th style="padding:5px;">SKS</th>
										  <th style="padding:5px;">Semester</th>
								  
										   <th style="padding:5px;">Kelas</th>
										  <th style="padding:5px;">Lihat Jadwal</th>
						  
									  </tr>
								  </thead>
			
								  <tbody>
							  
						
									  <?php
									  if (isset($recsemester4) && is_array($recsemester4) && count($recsemester4)) :
										  $jmlsks = 0;
										  $skstatapmuka = 0;
										  $skspraktek = 0;
										  $skslapangan = 0;
										  foreach ($recsemester4 as $record) :
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
												<input type="hidden" value="<?php
												echo isset($jsonkrs['kelas'][$record->kode_mata_kuliah]) ? $jsonkrs['kelas'][$record->kode_mata_kuliah] : "";
												?>" name="txtkelas_<?php echo $record->kode_mata_kuliah; ?>" id="txtkelas_<?php echo $record->kode_mata_kuliah; ?>"/>
											<input type="hidden" value="<?php
												echo isset($jsonkrs['kode_jadwal'][$record->kode_mata_kuliah]) ? $jsonkrs['kode_jadwal'][$record->kode_mata_kuliah] : "";
												?>" name="txtkdjadwal_<?php echo $record->kode_mata_kuliah; ?>" id="txtkdjadwal_<?php echo $record->kode_mata_kuliah; ?>"/>
												<span id="kelas_<?php echo $record->kode_mata_kuliah; ?>">
													<?php
													echo isset($jsonkrs['kelas'][$record->kode_mata_kuliah]) ? $jsonkrs['kelas'][$record->kode_mata_kuliah] : "";
													?>
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
										  <td style="padding:5px;" colspan="11">Matakuliah untuk semester ini tidak ditemukan, Silahkan hubungi Sekretariat.</td>
									  </tr>
									  <?php 
								  
									  endif; 
									  
									  ?>
								  </tbody>
								  <?php if (isset($recsemester4) && is_array($recsemester4) && count($recsemester4)) : ?>
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
							  
							   	<b>Semester 6</b>
								<table class="table-bordered">
								  <thead>
									  <tr>
										  <th class="column-check" style="padding:5px;"></th> 
										  <th style="padding:5px;">Kode Mata Kuliah</th>
										  <th width="500px" style="padding:5px;">Nama Mata Kuliah</th>
										  <th style="padding:5px;">SKS</th>
										  <th style="padding:5px;">Semester</th>
								  
										   <th style="padding:5px;">Kelas</th>
										  <th style="padding:5px;">Lihat Jadwal</th>
						  
									  </tr>
								  </thead>
			
								  <tbody>
							  
						
									  <?php
									  if (isset($recsemester6) && is_array($recsemester6) && count($recsemester6)) :
										  $jmlsks = 0;
										  $skstatapmuka = 0;
										  $skspraktek = 0;
										  $skslapangan = 0;
										  foreach ($recsemester6 as $record) :
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
												<input type="hidden" value="<?php
												echo isset($jsonkrs['kelas'][$record->kode_mata_kuliah]) ? $jsonkrs['kelas'][$record->kode_mata_kuliah] : "";
												?>" name="txtkelas_<?php echo $record->kode_mata_kuliah; ?>" id="txtkelas_<?php echo $record->kode_mata_kuliah; ?>"/>
											<input type="hidden" value="<?php
												echo isset($jsonkrs['kode_jadwal'][$record->kode_mata_kuliah]) ? $jsonkrs['kode_jadwal'][$record->kode_mata_kuliah] : "";
												?>" name="txtkdjadwal_<?php echo $record->kode_mata_kuliah; ?>" id="txtkdjadwal_<?php echo $record->kode_mata_kuliah; ?>"/>
												<span id="kelas_<?php echo $record->kode_mata_kuliah; ?>">
													<?php
													echo isset($jsonkrs['kelas'][$record->kode_mata_kuliah]) ? $jsonkrs['kelas'][$record->kode_mata_kuliah] : "";
													?>
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
										  <td style="padding:5px;" colspan="11">Matakuliah untuk semester ini tidak ditemukan, Silahkan hubungi Sekretariat.</td>
									  </tr>
									  <?php 
								  
									  endif; 
									  
									  ?>
								  </tbody>
								  <?php if (isset($recsemester6) && is_array($recsemester6) && count($recsemester6)) : ?>
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
							  
							  	<b>Semester 8</b>
								<table class="table-bordered">
								  <thead>
									  <tr>
										  <th class="column-check" style="padding:5px;"></th> 
										  <th style="padding:5px;">Kode Mata Kuliah</th>
										  <th width="500px" style="padding:5px;">Nama Mata Kuliah</th>
										  <th style="padding:5px;">SKS</th>
										  <th style="padding:5px;">Semester</th>
								  
										   <th style="padding:5px;">Kelas</th>
										  <th style="padding:5px;">Lihat Jadwal</th>
						  
									  </tr>
								  </thead>
			
								  <tbody>
							  
						
									  <?php
									  if (isset($recsemester8) && is_array($recsemester8) && count($recsemester8)) :
										  $jmlsks = 0;
										  $skstatapmuka = 0;
										  $skspraktek = 0;
										  $skslapangan = 0;
										  foreach ($recsemester8 as $record) :
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
											  <input type="checkbox" name="checked[]" class="chkmk" id="chkmk_<?php echo $record->kode_mata_kuliah; ?>" value="<?php echo $record->kode_mata_kuliah; ?>"/>
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
												<input type="hidden" value="<?php
												echo isset($jsonkrs['kelas'][$record->kode_mata_kuliah]) ? $jsonkrs['kelas'][$record->kode_mata_kuliah] : "";
												?>" name="txtkelas_<?php echo $record->kode_mata_kuliah; ?>" id="txtkelas_<?php echo $record->kode_mata_kuliah; ?>"/>
											<input type="hidden" value="<?php
												echo isset($jsonkrs['kode_jadwal'][$record->kode_mata_kuliah]) ? $jsonkrs['kode_jadwal'][$record->kode_mata_kuliah] : "";
												?>" name="txtkdjadwal_<?php echo $record->kode_mata_kuliah; ?>" id="txtkdjadwal_<?php echo $record->kode_mata_kuliah; ?>"/>
												<span id="kelas_<?php echo $record->kode_mata_kuliah; ?>">
													<?php
													echo isset($jsonkrs['kelas'][$record->kode_mata_kuliah]) ? $jsonkrs['kelas'][$record->kode_mata_kuliah] : "";
													?>
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
										  <td style="padding:5px;" colspan="11">Matakuliah untuk semester ini tidak ditemukan, Silahkan hubungi Sekretariat.</td>
									  </tr>
									  <?php 
								  
									  endif; 
									  
									  ?>
								  </tbody>
								  <?php if (isset($recsemester8) && is_array($recsemester8) && count($recsemester8)) : ?>
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
						<?php
						} // end status semester
						
						?>
				 </div>
	   
			   <div class="box-small span3">
				  <!--	<a class="btn btn-warning" href="<?php echo base_url().'index.php/admin/krs/datakrs/lainnya/?'; ?>&sms=<?php echo $sms; ?>&prodi=<?php echo isset($kode_prodi) ? $kode_prodi : ''; ?>" id="addlainnya" kode="<?php e($record->kode_mata_kuliah) ?>" >Matakuliah Lainnya</a></td>
									-->
				   <div class="box-small-title"> </div>
				   <!--<span id="visits-count-n"class="notification green">+ 2</span>-->
				   <b>
				    <table border="0" width="100%">
					  	<tr>
					  		<td align="left" width="300px">
					  		 	IPS Semester Lalu : 
					  		</td>
					  		<td align="left">
					  			<?php echo isset($ips) ? $ips : ""; ?>
					  		</td>
					  	</tr>
					  	<tr>
					  		<td align="left" width="200px">
					  			Maksimal SKS yang boleh diambil :
					  		</td>
					  		<td align="left">
					  			<?php echo isset($mak_sks) ? $mak_sks : ""; ?>
					  		</td>
					  	</tr>
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
					  			<?php if (isset($recordkrss) && is_array($recordkrss) && count($recordkrss) and $this->settings_lib->item('site.updatekrs') == "1") { ?>
					  				
									  
									  <?php if($bukakrs == "2"){ ?>
										  <br>
										  <input type="submit" name="ambil" id="ambil-me" class="btn-large btn-primary" value="Konfirmasi <?php echo (isset($recordkrss) && is_array($recordkrss) && count($recordkrss)) ? "Ulang" : ""; ?>" onclick="return confirm('<?php e(js_escape("Ambil Matakuliah")); ?>')" /> 
									
									  <?php }else{ ?>
									  		<div class="alert alert-block alert-error fade in ">
										 
											  <h4>Anda sudah konfirmasi, Maka anda tidak bisa merubah krs, silahkan hubungi sekretariat </h4>
										
											</div>
									  
									  <?php } ?>
					  			<?php }else{ ?>
					  				<br>
					  				<input type="submit" name="ambil" id="ambil-me" class="btn-large btn-primary" value="Konfirmasi <?php echo (isset($recordkrss) && is_array($recordkrss) && count($recordkrss)) ? "Ulang" : ""; ?>" onclick="return confirm('<?php e(js_escape("Ambil Matakuliah")); ?>')" /> 
					  				
					  			<?php } ?>
					  			
					  			
					  			
					  		</td>
					  	</tr>
					  </table>
					</b>
					<?php if ($this->settings_lib->item('site.updatekrs') == "2") { ?>
						<br>
					  <div class="alert alert-block alert-error fade in ">
						  <a class="close" data-dismiss="alert">&times;</a>
						  Untuk membatalkan matakuliah yang telah diambil dan sudah konfirmasi silahkan unchecklist pada matakuliah yang tidak jadi diambil
						</div>
						
						<div class="alert alert-block alert-success fade in ">
						  Anda dapat mengurangi/menambah matakuliah pada semester ini, silahkan tambahkan matakuliah kemudian klik "Konfirmasi Ulang"
						</div>
					<?php } ?>
					<!--
					  <div class="alert alert-block alert-error fade in ">
						  <a class="close" data-dismiss="alert">&times;</a>
						  <h2>Setelah anda mengklik konfirmasi, anda tidak bisa melakukan perubahan data KRS, Jika ingin merubah silahkan menghubungi bagian akademik</h2>
						</div>
					-->
			   </div>
		    <?php echo form_close(); ?>
			    		
		   </div> 
		   
	<?php } ?>
</div>

<script type="text/javascript">
var mak_sks = <?php echo $mak_sks; ?>;
 $(document).ready(function () {
	$('.chkmk').change(function () {
		var valkodemk = encodeURIComponent($(this).val());
		var valsemester = encodeURIComponent($("#semestermhs").val());
		 
	   if($(this).is(':unchecked')){
			<?php
			if($this->settings_lib->item('site.updatekrs') == "2" or $bukakrs == "2"){
			?>
			
			<?php }else{ ?>
				
				$("#"+thisid).attr("checked", true);
				swal("Error", "Tidak diizinkan menghapus matakuliah", "error");
				return false;
			<?php } ?>
			swal({
			   title: "Anda yakin?",
			   text: "Hapus matakuliah '#"+valkodemk+"' dari KRS anda",
			   type: "warning",
			   showCancelButton: true,
			   confirmButtonText: "Ya hapus!",
			   cancelButtonText: "Batal!",
			   closeOnConfirm: false,
			   closeOnCancel: false
			},
			function(isConfirm){
			   if (isConfirm) {
					var post_data = "valkodemk="+valkodemk+"&valsemester="+valsemester;
					var aksi = "<?php echo base_url() ?>admin/krs/datakrs/deletemk";
					$.ajax({
					   url: aksi,
					   type:"POST",
					   data: post_data,
					   dataType: "html",
					   timeout:180000,
					   success: function (result) {
						   swal("Sukses", result, "success");
				   },
					   error : function(error) {
						   alert(error);
					   } 
				   });        
			   } else {
				  	swal("Cancelled", "Batal menghapus matakuliah", "error");
				  	$("#"+thisid).attr("checked", true);
				  	hitungjmlmk();
					hitungsks(thisid);
			   }
			});
	   }
	   
		var thisid = $(this).attr("id");
		var thisval = $(this).attr("value");
		var valuejadwal = $("#txtkdjadwal_"+thisval).val();
		if(valuejadwal == "")
		{
			alert("Silahkan pilih kelas terlebih dahulu");
			$("#"+thisid).attr("checked", false);
			return false;
		}
		hitungjmlmk();
		hitungsks(thisid);
	});
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
	hitungsks("");
 	hitungjmlmk();
 });
 
 $('.mkdipilih').text($(":checkbox:checked").length);
 
  
</script>  
