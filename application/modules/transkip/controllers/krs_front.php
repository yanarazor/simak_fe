<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * master controller
 */
class krs_front extends Front_Controller
{
	//--------------------------------------------------------------------
	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('transkip/transkip_model', null, true);
	}
	public function import_data()
	{
		ini_set('memory_limit', '1024M'); 
		$success = 0;
		
		$original_session_id = $this->input->get('session_id');
		$user_id = $this->input->get('user_id');
		$sudahada = 0;
		$success = 0;
		$newdata = array(
            'session_id'  => $original_session_id,                   
               );
		$this->session->set_userdata($newdata);	
		// handle upload
		$this->load->helper('handle_upload');
		$uploadData = array();
		$upload = true;
		  if (isset($_FILES['Filedata']) && is_array($_FILES['Filedata']) && $_FILES['Filedata']['error'] != 4)
		  {
			  $uploadData = handle_upload('Filedata',$this->settings_lib->item('site.pathxls'));
			  //print_r($uploadData);
			  //die();
			  if (isset($uploadData['error']) && !empty($uploadData['error']))
			  {
				  $upload = false;
				  die("Upload error");
			  }else{
				  // end handle upload
				  $this->load->library('Convert');
				  $Class_Convert = new Convert;
				  //$file = $this->settings_lib->item('site.pathxls').'excell-absen/absenmaret.xlsx';
				  if(isset($uploadData['data']['file_name']))
					  $file = $this->settings_lib->item('site.pathxls').$uploadData['data']['file_name'];
				  else
					  $file ="";
				  $this->load->library('Excel');
				  $objPHPExcel = PHPExcel_IOFactory::load($file);
		 
				  //  Get worksheet dimensions
				  $sheet = $objPHPExcel->getSheet(0); 
				  $highestRow = $sheet->getHighestRow(); 
				  $highestColumn = $sheet->getHighestColumn();

				  //  Loop through each row of the worksheet in turn
				  for ($row = 2; $row <= $highestRow; $row++){ 
					  //  Read a row of data into an array
					  $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
													  NULL,
													  TRUE,
													  FALSE);
					  //  Insert row data array into your database of choice here
					 
						$nim	= preg_replace("/\s+/", "",$rowData[0][0]);
						$mk		= $rowData[0][1];
					  if(!$this->transkip_model->cekuniq($nim,$mk))
					  {
						  $success++;
						  $this->generate_transkip($nim,$rowData[0][2],$rowData[0][1],$rowData[0][3],$rowData[0][4],$rowData[0][5],$rowData[0][6],$rowData[0][7]);
					   //   generate_transkip($nim="",$nama_mk="",$kode_mk="",$semester="",$dosen="",$nilai_huruf="",$sks="",$jml_diambil="",$type='insert', $id=0)
					   }else{
						  $sudahada++;
					   }
					  //echo $nomor;	
			  }
		  } 	
		
		}
		$msgsudahada = "";
		$msgsuccess = "";
		if($sudahada>0)
			$msgsudahada .= "Duplikasi data : ".$sudahada." data";
		if($success>0)
			$msgsuccess .= "Berhasil : ".$success." data";
		echo $msgsuccess.$msgsudahada."\nUpload Selesai";
	   //send the data in an array format
	 	exit;
		 
	}
	public function runimport()
	{
		ini_set('memory_limit', '1024M'); 
		$success = 0;
		$sudahada = 0;
		$upload = true;
		 
				  // end handle upload
				  $this->load->library('Convert');
				  $Class_Convert = new Convert;
				  $file = $this->settings_lib->item('site.pathxls').'manajemenintensif.xlsx';
				  $this->load->library('Excel');
				  $objPHPExcel = PHPExcel_IOFactory::load($file);
		 
				  //  Get worksheet dimensions
				  $sheet = $objPHPExcel->getSheet(0); 
				  $highestRow = $sheet->getHighestRow(); 
				  $highestColumn = $sheet->getHighestColumn();

				  //  Loop through each row of the worksheet in turn
				for ($row = 2; $row <= $highestRow; $row++){ 
					 //  Read a row of data into an array
					 $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
													 NULL,
													 TRUE,
													 FALSE);
					 //  Insert row data array into your database of choice here
				  
					 $nim	= preg_replace("/\s+/", "",$rowData[0][0]);
					 //echo $nim;
			
					  $mk	= $rowData[0][1];
					  if(!$this->transkip_model->cekuniq($nim,$mk))
					  {
					   $success++;
					   $this->generate_transkip($nim,$rowData[0][2],$rowData[0][1],$rowData[0][3],$rowData[0][4],$rowData[0][5],$rowData[0][6],$rowData[0][7]);
					//   generate_transkip($nim="",$nama_mk="",$kode_mk="",$semester="",$dosen="",$nilai_huruf="",$sks="",$jml_diambil="",$type='insert', $id=0)
					}else{
					   $sudahada++;
					}
					 //echo $nomor;	
					 
			  	}
			  	
		   
		$msgsudahada = "";
		$msgsuccess = "";
		if($sudahada>0)
			$msgsudahada .= "Duplikasi data : ".$sudahada." data";
		if($success>0)
			$msgsuccess .= "Berhasil : ".$success." data";
		echo $msgsuccess.$msgsudahada."\nUpload Selesai";
	   //send the data in an array format
	 	exit;
		 
	}
	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------
	/**
	 * Summary
	 *
	 * @param String $type Either "insert" or "update"
	 * @param Int	 $id	The ID of the record to update, ignored on inserts
	 *
	 * @return Mixed    An INT id for successful inserts, TRUE for successful updates, else FALSE
	 */
	private function generate_transkip($nim="",$nama_mk="",$kode_mk="",$semester="",$dosen="",$nilai_huruf="",$sks="",$jml_diambil="",$type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}
		// make sure we only pass in the fields we want
		$data = array();
		$data['nim']        		= $nim;
		$data['kode_mk']        	= $kode_mk;
		$data['nama_mk']        	= $nama_mk;
		
		$valsemester = str_replace("semester :","",$semester);
		$data['semester']        	= trim($valsemester);
		$data['dosen']        		= $dosen;
		$data['nilai_huruf']        = $nilai_huruf;
		$data['sks']        		= $sks;
		$data['jml_diambil']        		= $jml_diambil;
		
		if ($type == 'insert')
		{
			$id = $this->transkip_model->insert($data);

			if (is_numeric($id))
			{
				$return = $id;
			}
			else
			{
				$return = FALSE;
			}
		}
		elseif ($type == 'update')
		{
			$return = $this->transkip_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}