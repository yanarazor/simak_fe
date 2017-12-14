<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * master controller
 */
class master_front extends Front_Controller
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
		$this->load->model('mastermahasiswa_model', null, true);
	}
	public function import_dataold()
	{
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
					 
					  $nim =  preg_replace("/\s+/", "",$rowData[0][0]);
					 if(!$this->mastermahasiswa_model->cekuniq($nim))
					 {
					 	$success++;
					 	$this->generate_save($nim,$rowData[0][1],$rowData[0][2],$rowData[0][3],$rowData[0][4]);
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
	public function import_data()
	{
		ini_set('memory_limit', '1024M'); 
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
				  $insert_id = "";
				  //  Loop through each row of the worksheet in turn
				  for ($row = 2; $row <= $highestRow; $row++){ 
					  //  Read a row of data into an array
					  $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
													  NULL,
													  TRUE,
													  FALSE);
					  //  Insert row data array into your database of choice here
					 	$univ 			= $rowData[0][0];
					 	$jenjangstudi 	= $rowData[0][1];
					 	$kdprodi 		= $rowData[0][2];
					 	$nim 			= $rowData[0][3];
					 	$nama			= $rowData[0][4];
					 	$SHIFTMSMHS		= $rowData[0][5];
					 	$tempatlahir 	= $rowData[0][6];
					 	$tanggallahir	= $rowData[0][7];
					 	$jk				= $rowData[0][8];
					 	$tahunmasuk		= $rowData[0][9];
					 	$semesterawal	= $rowData[0][10];
					 	$batasstudi		= $rowData[0][11];
					 	$asalprovinsi	= $rowData[0][12];
					 	$tanggalmasuk	= $rowData[0][13];
					 	$tanggallulus	= $rowData[0][14];
					 	$statusaktifitas= $rowData[0][15];
					 	$statusawal		= $rowData[0][16];
					 	$status_mahasiswa= $rowData[0][17];
					 	
					  //$nim =  preg_replace("/\s+/", "",$rowData[0][0]);
					 if(!$this->mastermahasiswa_model->cekuniq($nim))
					 {
					 	$success++;
					 	$insert_id = $this->generate_save($univ,$jenjangstudi,$kdprodi,$nim,$nama,$SHIFTMSMHS,$tempatlahir,$tanggallahir,$jk,$tahunmasuk,$semesterawal,$batasstudi,$asalprovinsi,$tanggalmasuk,$tanggallulus,$statusaktifitas,$statusawal,$status_mahasiswa);
					 	$insert_id .= "-".$insert_id;
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
	public function runmanual()
	{
	 	ini_set('memory_limit', '1024M'); 
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
		 
				  // end handle upload
				  $this->load->library('Convert');
				  $Class_Convert = new Convert;
				  $file = $this->settings_lib->item('site.pathxls').'mhsmanajemenintensif.xlsx';
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
				  
						$univ 			= $rowData[0][0];
					 	$jenjangstudi 	= $rowData[0][1];
					 	$kdprodi 		= $rowData[0][2];
					 	$nim 			= $rowData[0][3];
					 	$nama			= $rowData[0][4];
					 	$SHIFTMSMHS		= $rowData[0][5];
					 	$tempatlahir 	= $rowData[0][6];
					 	$tanggallahir	= $rowData[0][7];
					 	$jk				= $rowData[0][8];
					 	$tahunmasuk		= $rowData[0][9];
					 	$semesterawal	= $rowData[0][10];
					 	$batasstudi		= $rowData[0][11];
					 	$asalprovinsi	= $rowData[0][12];
					 	$tanggalmasuk	= $rowData[0][13];
					 	//die($tanggallahir);
					 	$tanggallulus	= $rowData[0][14];
					 	$statusaktifitas= $rowData[0][15];
					 	$statusawal		= $rowData[0][16];
					 	$status_mahasiswa= $rowData[0][17];
					 	echo $status_mahasiswa."<br>";
					  //$nim =  preg_replace("/\s+/", "",$rowData[0][0]);
					 if(!$this->mastermahasiswa_model->cekuniq($nim))
					 {
					 	
					 	$insert_id = $this->generate_save($univ,$jenjangstudi,$kdprodi,$nim,$nama,$SHIFTMSMHS,$tempatlahir,$tanggallahir,$jk,$tahunmasuk,$semesterawal,$batasstudi,$asalprovinsi,$tanggalmasuk,$tanggallulus,$statusaktifitas,$statusawal,$status_mahasiswa);
					 	if($insert_id){
					 		$success++;
					 	}else{
					 		die($insert_id." error");
					 	}
					 	
					 }else{
					  	$sudahada++;
					 }
					 //echo $nomor;	
			  	}
		   
		$msgsudahada = "";
		$msgsuccess = "";
		echo $insert_id;
		if($sudahada>0)
			$msgsudahada .= "Duplikasi data : ".$sudahada." data";
		if($success>0)
			$msgsuccess .= "Berhasil : ".$success." data";
		echo $msgsuccess.$msgsudahada."\nUpload Selesai";
	   //send the data in an array format
	 	exit;
		 
	}
	public function runimport1()
	{
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
		 
				  // end handle upload
				  $this->load->library('Convert');
				  $Class_Convert = new Convert;
				  $file = $this->settings_lib->item('site.pathxls').'mhsmanajemen.xlsx';
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
				  
					 $nim =  preg_replace("/\s+/", "",$rowData[0][0]);
					if(!$this->mastermahasiswa_model->cekuniq($nim))
					{
					   $success++;
					   $this->generate_save($nim,$rowData[0][1],$rowData[0][2],$rowData[0][3],$rowData[0][4]);
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
	private function generate_save($univ ="",$jenjangstudi ="",$kdprodi ="",$nim ="",$nama ="",$SHIFTMSMHS ="",$tempatlahir="",$tanggallahir ="",$jk ="",$tahunmasuk ="",$semesterawal ="",$batasstudi ="",$asalprovinsi ="",$tanggalmasuk ="",$tanggallulus="",$statusaktifitas="",$statusawal="",$status_mahasiswa="1",$type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}
		  
		// make sure we only pass in the fields we want
		
		$data = array();
		$data['kode_pt']        		= $univ ? $univ : "031011";
		$data['kode_fakultas']        	= $this->input->post('mastermahasiswa_kode_fakultas') ? $this->input->post('mastermahasiswa_kode_fakultas') : "03";
		$data['kode_prodi']        		= $kdprodi;
		$data['kode_jenjang_studi']     = $jenjangstudi;
		$data['nim_mhs']        		= $nim;
		$data['nama_mahasiswa']        	= $nama;
		$data['tempat_lahir']        	= $tempatlahir;
		$data['tgl_lahir']        		= $tanggallahir ? $tanggallahir : '0000-00-00';
		$data['jenis_kelamin']        	= $jk;
		$data['tahun_masuk']        	= $tahunmasuk;
		$data['semester_awal']        	= $semesterawal;
		$data['semester']        		= $semesterawal;
		$data['batas_studi']        	= $batasstudi;
		$data['asal_propinsi']        	= $asalprovinsi;
		//$data['tgl_masuk']        		= $tanggalmasuk ? $tanggalmasuk : '0000-00-00';
		//$data['tgl_lulus']        		= $tanggallulus ? $tanggallulus : '0000-00-00';
		$data['status_aktivitas']       = $statusaktifitas;
		$data['status_awal']        	= $statusawal;
		$data['jml_sks_diakui']        = $this->input->post('mastermahasiswa_jml_sks_diakui');
		$data['nim_asal']        = $this->input->post('mastermahasiswa_nim_asal');
		$data['asal_pt']        = $this->input->post('mastermahasiswa_asal_pt');
		$data['asal_jenjang_studi']        = $this->input->post('mastermahasiswa_asal_jenjang_studi');
		$data['asal_prodi']        = $this->input->post('mastermahasiswa_asal_prodi');
		$data['kode_biaya_studi']        = $this->input->post('mastermahasiswa_kode_biaya_studi');
		$data['kode_pekerjaan']        = $this->input->post('mastermahasiswa_kode_pekerjaan');
		$data['tempat_kerja']        = $this->input->post('mastermahasiswa_tempat_kerja');
		$data['kode_pt_kerja']        = $this->input->post('mastermahasiswa_kode_pt_kerja');
		$data['kode_ps_kerja']        = $this->input->post('mastermahasiswa_kode_ps_kerja');
		$data['nip_promotor']        = $this->input->post('mastermahasiswa_nip_promotor');
		$data['nip_co_promotor1']        = $this->input->post('mastermahasiswa_nip_co_promotor1');
		$data['nip_co_promotor2']        = $this->input->post('mastermahasiswa_nip_co_promotor2');
		$data['nip_co_promotor3']        = $this->input->post('mastermahasiswa_nip_co_promotor3');
		$data['nip_co_promotor4']        = $this->input->post('mastermahasiswa_nip_co_promotor4');
		$data['keterangan']        = $this->input->post('keterangan');
		$data['status_mahasiswa']        = $status_mahasiswa;
		 
		if ($type == 'insert')
		{
			$id = $this->mastermahasiswa_model->insert($data);

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
			$return = $this->mastermahasiswa_model->update($id, $data);
		}

		return $return;
	}				 
	private function generate_save1($nim="",$nama="",$kode_prodi="",$jk="",$tahun_masuk="",$type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}
		  
		// make sure we only pass in the fields we want
		
		$data = array();
		$data['kode_pt']        = $this->input->post('mastermahasiswa_kode_pt') ? $this->input->post('mastermahasiswa_kode_pt'):"031011";
		$data['kode_fakultas']        = $this->input->post('mastermahasiswa_kode_fakultas') ? $this->input->post('mastermahasiswa_kode_fakultas') : "03";
		$data['kode_prodi']        = $kode_prodi;
		$data['kode_jenjang_studi']        = $this->input->post('mastermahasiswa_kode_jenjang_studi');
		$data['nim_mhs']        = $nim;
		$data['nama_mahasiswa']        = $nama;
		$data['tempat_lahir']        = $this->input->post('mastermahasiswa_tempat_lahir');
		$data['tgl_lahir']        = $this->input->post('mastermahasiswa_tgl_lahir') ? $this->input->post('mastermahasiswa_tgl_lahir') : '0000-00-00';
		$data['jenis_kelamin']        = $jk;
		$data['tahun_masuk']        = $tahun_masuk;
		$data['semester_awal']        = $this->input->post('mastermahasiswa_semester_awal');
		$data['semester']        = $this->input->post('mastermahasiswa_semester');
		$data['batas_studi']        = $this->input->post('mastermahasiswa_batas_studi');
		$data['asal_propinsi']        = $this->input->post('mastermahasiswa_asal_propinsi');
		$data['tgl_masuk']        = $this->input->post('mastermahasiswa_tgl_masuk') ? $this->input->post('mastermahasiswa_tgl_masuk') : '0000-00-00';
		$data['tgl_lulus']        = $this->input->post('mastermahasiswa_tgl_lulus') ? $this->input->post('mastermahasiswa_tgl_lulus') : '0000-00-00';
		$data['status_aktivitas']        = $this->input->post('mastermahasiswa_status_aktivitas');
		$data['status_awal']        = $this->input->post('mastermahasiswa_status_awal');
		$data['jml_sks_diakui']        = $this->input->post('mastermahasiswa_jml_sks_diakui');
		$data['nim_asal']        = $this->input->post('mastermahasiswa_nim_asal');
		$data['asal_pt']        = $this->input->post('mastermahasiswa_asal_pt');
		$data['asal_jenjang_studi']        = $this->input->post('mastermahasiswa_asal_jenjang_studi');
		$data['asal_prodi']        = $this->input->post('mastermahasiswa_asal_prodi');
		$data['kode_biaya_studi']        = $this->input->post('mastermahasiswa_kode_biaya_studi');
		$data['kode_pekerjaan']        = $this->input->post('mastermahasiswa_kode_pekerjaan');
		$data['tempat_kerja']        = $this->input->post('mastermahasiswa_tempat_kerja');
		$data['kode_pt_kerja']        = $this->input->post('mastermahasiswa_kode_pt_kerja');
		$data['kode_ps_kerja']        = $this->input->post('mastermahasiswa_kode_ps_kerja');
		$data['nip_promotor']        = $this->input->post('mastermahasiswa_nip_promotor');
		$data['nip_co_promotor1']        = $this->input->post('mastermahasiswa_nip_co_promotor1');
		$data['nip_co_promotor2']        = $this->input->post('mastermahasiswa_nip_co_promotor2');
		$data['nip_co_promotor3']        = $this->input->post('mastermahasiswa_nip_co_promotor3');
		$data['nip_co_promotor4']        = $this->input->post('mastermahasiswa_nip_co_promotor4');
		$data['keterangan']        = $this->input->post('keterangan');
		 
		if ($type == 'insert')
		{
			$id = $this->mastermahasiswa_model->insert($data);

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
			$return = $this->mastermahasiswa_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}