<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Khs
{
	var $CI;
    public function hitung_ipsemester($smssebelum, $mhs)
    {
    	$this->CI =& get_instance();
    	$this->CI->load->model('konversi/konversi_model', null, true);
		$sms = $smssebelum;
		 
		//die($mhs);
		$recordkonversi = $this->CI->konversi_model->find_all();
		$jsonkonversi[] =array();
		if (isset($recordkonversi) && is_array($recordkonversi) && count($recordkonversi)) :
		foreach ($recordkonversi as $record) : 
			$jsonkonversi[$record->huruf] = $record->angka;
			//echo $record->huruf;
		endforeach;
		endif;
		$jmlsks = 0;
		$jmlbobot = 0;
		$datakrs = $this->CI->datakrs_model->find_krs($sms,"",$mhs);
		$nilaiangka = "";
		if (isset($datakrs) && is_array($datakrs) && count($datakrs)) : 
							    
		 $no = 1;
			foreach ($datakrs as $record) :
			   if(isset($jsonkonversi[$record->nilai_huruf]))
					$nilaiangka = $jsonkonversi[$record->nilai_huruf];
			   if($nilaiangka!=""){
				 $jmlsks = $jmlsks + (int)$record->sks;
		  
				  $nilaiangka = $jsonkonversi[$record->nilai_huruf];
				  $jmlbobot = $jmlbobot + ((int)$record->sks*(int)$nilaiangka);
			   }
			  // echo $jmlsks;
			endforeach;
		endif;
		
		$ipk = 0;
		if($jmlbobot!="" and $jmlsks != "")
		{
			$ipk = round($jmlbobot/$jmlsks, 2);
			//echo $jmlbobot." ini";
		}
		return $ipk; 
    }
    
    public function hitung_ips($nim)
	{
		$this->CI =& get_instance();
    	$this->CI->load->model('konversi/konversi_model', null, true);
		$mhs = $nim; 
		//die($mhs);
		$recordkonversi = $this->CI->konversi_model->find_all();
		$jsonkonversi[] =array();
		if (isset($recordkonversi) && is_array($recordkonversi) && count($recordkonversi)) :
		foreach ($recordkonversi as $record) : 
			$jsonkonversi[$record->huruf] = $record->angka;
			//echo $record->huruf;
		endforeach;
		endif;
		$jmlsks = 0;
		$jmlbobot = 0;
		$datakrs = $this->CI->datakrs_model->find_distinct("","",$mhs);
		//print_r($datakrs);
		if (isset($datakrs) && is_array($datakrs) && count($datakrs)) : 
							    
		 $no = 1;
			foreach ($datakrs as $record) :
				//echo $record->semester." = ".$record->sks." = ".$jmlsks." ".$record->kode_mata_kuliah." ".$record->nama_mata_kuliah."<br>";
			   if(isset($jsonkonversi[$record->nilai_huruf]))
			   {
					$nilaiangka = $jsonkonversi[$record->nilai_huruf];
				 	$jmlsks = $jmlsks + (int)$record->sks;
				 	
				  $nilaiangka = $jsonkonversi[$record->nilai_huruf];
				  $jmlbobot = $jmlbobot + ((int)$record->sks*(int)$nilaiangka);
			   }
			  // echo $jmlsks;
			endforeach;
		endif;
		
		$ipk = 0;
		if($jmlbobot!="" and $jmlsks != "")
		{
			$ipk = round($jmlbobot/$jmlsks, 2);
		}
		//die($jmlsks." ini");
		return $ipk; 
		
	}
	public function getmaksks($ips="")
	{
		$mak_sks = 12;
		$this->CI =& get_instance();
    	$this->CI->load->model('role_krs/role_krs_model', null, true);
		$record_role = $this->CI->role_krs_model->get_mak($ips);
		if (isset($record_role) && is_array($record_role) && count($record_role)) :
			$mak_sks = $record_role[0]->maksimal_sks;
		endif;
		return $mak_sks;
		
	}
}

?>