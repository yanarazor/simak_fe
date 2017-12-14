<?php
 
$can_delete	= $this->auth->has_permission('DataKrs.Krs.Delete');
$can_edit		= $this->auth->has_permission('DataKrs.Krs.Edit');
$has_records	= isset($records) && is_array($records) && count($records);
$this->load->model('mastermahasiswa/mastermahasiswa_model', null, true);
$this->load->library('khs');
$classkhs = new khs();
?>
			<?php
				$recordkonversi = $this->konversi_model->find_all();
				$jsonkonversi[] =array();
				if (isset($recordkonversi) && is_array($recordkonversi) && count($recordkonversi)) :
				foreach ($recordkonversi as $record) : 
					$jsonkonversi[$record->huruf] = $record->angka;
					//echo $record->huruf;
				endforeach;
				endif;
		
				if ($has_records) :
					$no = 1;
					foreach ($records as $record) :
					//detil mahasiswa
					$sms 	= $record->semester;
					$mhs	= $record->mahasiswa;
					$datamahasiswa = $this->mastermahasiswa_model->find_detil($record->mahasiswa);
					$smssebelum = 1;
					if((int)$sms>1 and (int)$sms<10)
					{	
						$smssebelum = ((int)$sms-1);
					}
					if($sms=="PP")
						$smssebelum = "7";
	   
					$ipklalu 	= $classkhs->hitung_ipsemester($smssebelum,$record->mahasiswa);
					$ips 		=  $classkhs->hitung_ips($mhs);
					$mak_sks 		=  $classkhs->getmaksks($ips);
					$datakrs 	= $this->datakrs_model->find_krs($sms,"",$mhs);
					$this->load->view('krs/khscontent',array('datamahasiswa'=>$datamahasiswa,'sms'=>$record->semester,'ipklalu'=>$ipklalu,'ips'=>$ips,'datakrs'=>$datakrs,'jsonkonversi'=>$jsonkonversi,'mak_sks'=>$mak_sks,'no'=>$no));	
				?>
				 	
				<?php
					$no++;
					endforeach; // end foreach records
				else:
				?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">Tidak ada Data yang sesuai dengan pilihan anda</td>
				</tr>
				<?php 
				endif; // end if hashrecord
				?>
			 