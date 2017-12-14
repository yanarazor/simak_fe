<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * nilai controller
 */
class nilai extends Admin_Controller
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

		$this->auth->restrict('Nilai_Mhs.Nilai.View');
		$this->lang->load('nilai_mhs');
		
		Template::set_block('sub_nav', 'nilai/_sub_nav');

		Assets::add_module_js('nilai_mhs', 'nilai_mhs.js');
		$this->load->model('datakrs/datakrs_model', null, true);
		
		//master matakuliah
		$this->load->model('mastermatakuliah/mastermatakuliah_model', null, true);
		
		//$this->mastermatakuliah_model->where("tahun_akademik", $this->settings_lib->item('site.tahun'));
		$matakuliahs = $this->mastermatakuliah_model->find_distinct();
		Template::set('matakuliahs', $matakuliahs);
		
		//master Dosen
		$this->load->model('masterdosen/masterdosen_model', null, true);
		$dosens = $this->masterdosen_model->find_all();
		Template::set('dosens', $dosens);
		
		$this->load->model('pilihan/pilihan_model', null, true);
		$pilihansemester = $this->pilihan_model->find_all("sms");
		Template::set('pilihansemesters', $pilihansemester);
		
		$this->load->model('masterkelas/masterkelas_model', null, true);
		$pilihkelas = $this->masterkelas_model->find_distinct();
		Template::set('pilihkelas', $pilihkelas);
		
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index1()
	{

		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$this->load->model('transkip/transkip_model', null, true);
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$datadetil = $this->datakrs_model->find($pid);
					$datadelete = array('nim '=>$datadetil->mahasiswa,'kode_mk'=>$datadetil->kode_mk,'nilai_huruf'=>$datadetil->nilai_huruf);
					$this->transkip_model->delete_where($datadelete);
					$result = $this->datakrs_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('datakrs_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('datakrs_delete_failure') . $this->datakrs_model->error, 'error');
				}
			}
		}
		//die("masuk");
		$kode_mk = $this->input->get('kode_mk');
		$kelas = $this->input->get('kelas');
		
		$this->load->library('pagination');
		$total = count($this->datakrs_model->distinct_mk_kelas($kelas,$kode_mk));
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url()."?kelas=".$kelas."&kode_mk=".$kode_mk;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		$records = $this->datakrs_model->limit($limit, $offset)->distinct_mk_kelas($kelas,$kode_mk);

		Template::set('records', $records);
		Template::set('total', $total); 
		//Template::set('sms', $sms); 
		Template::set('kode_mk', $kode_mk);
		//Template::set('mhs', $mhs);
		
		Template::set('toolbar_title', '&nbsp;&nbsp; Pengelolaan Data Nilai Mahasiswa');
		Template::render();
	}
	public function index()
	{

		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$this->load->model('transkip/transkip_model', null, true);
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$datadetil = $this->datakrs_model->find($pid);
					$datadelete = array('nim '=>$datadetil->mahasiswa,'kode_mk'=>$datadetil->kode_mk,'nilai_huruf'=>$datadetil->nilai_huruf);
					$this->transkip_model->delete_where($datadelete);
					$result = $this->datakrs_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. "Delete Success", 'success');
				}
				else
				{
					Template::set_message("Delete data gagal" . $this->datakrs_model->error, 'error');
				}
			}
		}
		//$id = $this->uri->segment(5);
		
		$kode_mk = $this->input->get('kode_mk');
		$mhs = $this->input->get('nama');
		$sms = $this->input->get('sms');
		$kelas = $this->input->get('kelas');
	 
		$this->load->library('pagination');
		$total = $this->datakrs_model->count_nilai($sms,$kode_mk,$mhs);
		
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url()."?sms=".$sms."&kode_mk=".$kode_mk."&nama=".$mhs;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		$records = $this->datakrs_model->limit($limit, $offset)->find_nilai($sms,$kode_mk,$mhs);

		Template::set('records', $records);
		Template::set('total', $total);
		
		Template::set('sms', $sms);
		
		Template::set('kode_mk', $kode_mk);
		Template::set('mhs', $mhs);
		
		Template::set('toolbar_title', '&nbsp;&nbsp; Pengelolaan Data Nilai Mahasiswa');
		Template::render();
	}
	public function view()
	{

		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$result = $this->datakrs_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('datakrs_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('datakrs_delete_failure') . $this->datakrs_model->error, 'error');
				}
			}
		}
		//$id = $this->uri->segment(5);
		
		$kode_mk = $this->input->get('kode_mk');
		$mhs = $this->input->get('nama');
		$sms = $this->input->get('sms');
		$kelas = $this->input->get('kelas');
		
		$this->load->library('pagination');
		$total = $this->datakrs_model->count_nilai($sms,$kode_mk,$mhs);
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url()."?sms=".$sms."&kode_mk=".$kode_mk."&mhs=".$mhs;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		$records = $this->datakrs_model->limit($limit, $offset)->find_nilai($sms,$kode_mk,$mhs);

		Template::set('records', $records);
		Template::set('total', $total);
		
		Template::set('sms', $sms);
		
		Template::set('kode_mk', $kode_mk);
		Template::set('mhs', $mhs);
		
		Template::set('toolbar_title', '&nbsp;&nbsp; Pengelolaan Data Nilai Mahasiswa');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Nilai Mhs object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Nilai_Mhs.Nilai.Create');
		$this->load->model('transkip/transkip_model', null, true);
		Assets::add_module_js('nilai_mhs', 'nilai_mhs.js');
		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_datakrs())
			{
				$dateadetil		= $this->datakrs_model->find($insert_id);
				$kode_mk        = $dateadetil->kode_mk;
				$nama_mk        = $dateadetil->nama_mk;
				$kd_dosen       = $dateadetil->kode_dosen;
				$dosen      	= $dateadetil->namadosen;
				$sks        	= $dateadetil->sks;
				$nim        	= $dateadetil->mahasiswa;
				$semester       = (int)$dateadetil->semester;
				$nilai_huruf    = $dateadetil->nilai_huruf;
				$jml_diambil	= $this->input->post('jml_diambil');
				if(!$this->transkip_model->cekuniq($nim,$kode_mk))
				{
					if($this->save_transkip($nim,$kode_mk,$nama_mk,$semester,$kd_dosen,$dosen,$nilai_huruf,$sks,$jml_diambil))
					{
						// Log the activity
						log_activity($this->current_user->id, 'Update, dan Publis Nilai Sukses : '. $id .' : '. $this->input->ip_address(), 'datakrs');
						Template::set_message("Publis Nilai Success", 'success');	
					}else{
						Template::set_message("Publis Nilai gagal", 'error');
					}	
				}else{
					if($this->input->post('perbaharui') =="1"){
						$datadelete = array('nim '=>$nim,'kode_mk'=>$kode_mk);
						$this->transkip_model->delete_where($datadelete);
						
						if($this->save_transkip($nim,$kode_mk,$nama_mk,$semester,$kd_dosen,$dosen,$nilai_huruf,$sks,$jml_diambil))
						{
							// Log the activity
							log_activity($this->current_user->id, 'Perbaharuan Nilai, Update, dan Publis Nilai Sukses : '. $id .' : '. $this->input->ip_address(), 'datakrs');
							Template::set_message("Perbaharuan Nilai Success", 'success');	
						}else{
							Template::set_message("Publis Nilai gagal", 'error');
						}	
				   
					}
					//Template::set_message("Nilai sudah terdaftar", 'error');
				}
				// Log the activity
				log_activity($this->current_user->id, 'Simpan nilai : '. $insert_id .' : '. $this->input->ip_address(), 'datakrs');

				Template::set_message("Save Nilai Sukses", 'success');
				redirect(SITE_AREA .'/nilai/nilai_mhs');
			}
			else
			{
				Template::set_message("Save Gagal" . $this->jadwal_model->error, 'error');
			}
		}
		 
			Template::set('toolbar_title', '&nbsp;&nbsp; Tambah Data Nilai Mahasiswa');
		Template::render();
	}
	public function input()
	{
		$this->auth->restrict('Nilai_Mhs.Nilai.Create');
		$this->load->model('transkip/transkip_model', null, true);
		
		//master pilihan
		$this->load->model('pilihan/pilihan_model', null, true);
		$pilihantahuns = $this->pilihan_model->find_all("ta");
		Template::set('pilihantahuns', $pilihantahuns);
		$this->load->model('masterfakultas/masterfakultas_model', null, true);
		$masterfakultas = $this->masterfakultas_model->find_all();
		Template::set('masterfakultass', $masterfakultas);
			//master pilihan
		//master jurusan
		$this->load->model('masterprogramstudi/masterprogramstudi_model', null, true);
		$masterprogramstudis = $this->masterprogramstudi_model->find_all();
		Template::set('masterprogramstudis', $masterprogramstudis);
		
		
		$mode = $this->uri->segment(5); 
		$filfakultas = $this->input->get('filfakultas');
		$filljurusan = $this->input->get('filljurusan');
		
		$kode_mk = $this->input->get('kode_mk');
		$dosen = $this->input->get('dosen');
		$tahun = $this->input->get('tahun');
		$kelas = $this->input->get('kelas');
		$sms = $this->input->get('sms');
		$jml = $this->input->get('jml');
		
		$this->load->model('masterprogramstudi/masterprogramstudi_model', null, true);
		$prodi = $this->masterprogramstudi_model->find_detil($filljurusan);
		
		$this->load->model('mastermatakuliah/mastermatakuliah_model', null, true);
		$rcmatakuliah = $this->mastermatakuliah_model->find_detil($kode_mk);
		
		$this->load->model('jadwal/jadwal_model', null, true);
		$rcjadwal = $this->jadwal_model->find_detil($kode_mk,$kelas,$filljurusan);
		//die(print_r($rcjadwal));
		
		$records = $this->datakrs_model->find_absen($tahun,$filljurusan,$kode_mk,$dosen,$sms,$kelas);
		Template::set('records', $records);
		Template::set('fakultas', $filfakultas);
		Template::set('jurusan', $filljurusan);
		Template::set('nama_jurusan', $prodi[0]->nama_prodi);
		Template::set('kode_mk', $kode_mk);
		Template::set('nama_mk', $rcmatakuliah[0]->kode_mata_kuliah." - ".$rcmatakuliah[0]->nama_mata_kuliah);
		Template::set('dosen', $rcjadwal[0]->nama_dosen.", ".$rcjadwal[0]->gelar_akademik);
		Template::set('waktu',  $rcjadwal[0]->hari." - ". $rcjadwal[0]->jam);
		Template::set('tahun', $tahun);
		Template::set('kelas', $rcjadwal[0]->kelas);
		Template::set('jml', $jml);
		Template::set('sms', $tahun);
		
		 
		Template::set('toolbar_title', 'Input Nilai Perkelas');
		Template::render();
	}
	public function viewmahasiswa()
	{
		$mode = $this->uri->segment(5); 
		$filfakultas = $this->input->get('filfakultas');
		$filljurusan = $this->input->get('filljurusan');
		
		$kode_mk = $this->input->get('kode_mk');
		$dosen = $this->input->get('dosen');
		$tahun = $this->input->get('tahun');
		$kelas = $this->input->get('kelas');
		$sms = $this->input->get('sms');
		$jml = $this->input->get('jml');
		
		$this->load->model('masterprogramstudi/masterprogramstudi_model', null, true);
		$prodi = $this->masterprogramstudi_model->find_detil($filljurusan);
		
		$this->load->model('mastermatakuliah/mastermatakuliah_model', null, true);
		$rcmatakuliah = $this->mastermatakuliah_model->find_detil($kode_mk);
		
		$this->load->model('jadwal/jadwal_model', null, true);
		$rcjadwal = $this->jadwal_model->find_detil($kode_mk,$kelas,$filljurusan);
		//die(print_r($rcjadwal));
		
		$records = $this->datakrs_model->find_absen($tahun,$filljurusan,$kode_mk,$dosen,$sms,$kelas);
		$dosen = isset($rcjadwal[0]->nama_dosen) ? $rcjadwal[0]->nama_dosen.",".$rcjadwal[0]->nama_dosen : "";
		$waktu = isset($rcjadwal[0]->hari) ? $rcjadwal[0]->hari."-". $rcjadwal[0]->jam : "";
		$kelas = isset($rcjadwal[0]->kelas) ? $rcjadwal[0]->kelas: "";
		$nama_mk = $rcmatakuliah[0]->kode_mata_kuliah." - ".$rcmatakuliah[0]->nama_mata_kuliah;
		Template::set('records', $records);
		Template::set('fakultas', $filfakultas);
		Template::set('jurusan', $filljurusan);
		Template::set('nama_jurusan', $prodi[0]->nama_prodi);
		Template::set('kode_mk', $kode_mk);
		Template::set('nama_mk', $rcmatakuliah[0]->kode_mata_kuliah." - ".$rcmatakuliah[0]->nama_mata_kuliah);
		Template::set('dosen', $dosen);
		Template::set('waktu',  $waktu);
		Template::set('tahun', $tahun);
		Template::set('kelas', $kelas);
		Template::set('jml', $jml);
		Template::set('sms', $tahun);
		 
		
		$output= "";
		//$recordpegawais = $this->payroll_model->find_all($nhi,$bulan,$tahun,$nama,"3");
		
		//print_r($recordpegawais);
		$output .= $this->load->view('nilai/viewmahasiswa',array("prodi"=>$prodi,"records"=>$records,"fakultas"=>$filfakultas,"jurusan"=>$filljurusan,"nama_jurusan"=>$prodi[0]->nama_prodi,"kode_mk"=>$kode_mk,"nama_mk"=>$nama_mk,"dosen"=>$dosen,"waktu"=>$waktu,"kelas"=>$kelas,"jml"=>$jml,"sms"=>$tahun),true);	
		
		echo $output;
		die();
	}
	public function updatenilai()
	{
		Template::set_block('sub_nav', 'krs/_sub_nav');
		$this->auth->restrict('DataKrs.Krs.Input');
		//die("masuk");
		 
			$index = 0;
			$return = false;
			$id_krs = $this->input->post('id_krs');
			$nilaimhs = $this->input->post('nilaimhs');
			if (is_array($id_krs) && count($id_krs))
			{
			 
				$result = FALSE;
				foreach ($id_krs as $pid)
				{
				  //echo $nilaimhs[$index]; 	
				  $data = array();
				  $data['nilai_huruf']        	= $nilaimhs[$index]; 
				  $return = $this->datakrs_model->update($pid, $data);
				  $index++;  
				}
				if($return){
					die("Update Selesai..");
				}
				
			}
		 
	 
		exit();
	}
	public function upload()
	{
		$this->auth->restrict('Nilai_Mhs.Nilai.Create');
		$this->load->model('transkip/transkip_model', null, true);
		$this->load->helper('handle_upload');
		Assets::add_js('jquery.uniform.min.js');
		Assets::add_js('jquery-ui-1.8.13.min.js');
		Assets::add_js('jquery.cleditor.min.js');
		Assets::add_js('jquery.imagesloaded.js');
		Assets::add_js('custom.js');
		if (isset($_POST['save']))
		{
			$sudahadakrs = 0;
			$sudahada = 0;
			$successkrs = 0;
			$success = 0;
			// handle upload
			$this->load->helper('handle_upload');
			$uploadData = array();
			$upload = true;
			  if (isset($_FILES['Filedata']) && is_array($_FILES['Filedata']) && $_FILES['Filedata']['error'] != 4)
			  {
			  		//get data conversi
			  		$this->load->model('konversi/konversi_model', null, true);
			  		$recordkonversi = $this->konversi_model->find_all();
					$jsonkonversi[] =array();
					if (isset($recordkonversi) && is_array($recordkonversi) && count($recordkonversi)) :
					foreach ($recordkonversi as $record) : 
						$jsonkonversi[$record->huruf] = $record->angka;
					endforeach;
					endif;
					// end data konversi
					
				  $uploadData = handle_upload('Filedata',$this->settings_lib->item('site.pathxls'));
				  //print_r($uploadData);
				 // die();
				  if (isset($uploadData['error']) && !empty($uploadData['error']))
				  {
				  	print_r($uploadData);
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
					  	$this->load->library('Convert');
						$convert = new Convert();	
					  for ($row = 2; $row <= $highestRow; $row++){ 
						  //  Read a row of data into an array
						  $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
														  NULL,
														  TRUE,
														  FALSE);
						  //  Insert row data array into your database of choice here
							$nim			= preg_replace("/\s+/", "",$rowData[0][0]);
							$mk				= $rowData[0][1];
							$nama_mk 		= $rowData[0][2];
							//$semester	= $rowData[0][3];
							$sks			= $rowData[0][4];
							$tahun_akademik	= $rowData[0][5];
							$semester 		= $this->convert->getsemester(TRIM($nim),TRIM($tahun_akademik));
							//die(TRIM($nim)." - ".$semester);
							$kelas			= $rowData[0][6];
							$nilai			= $rowData[0][7];
							$kd_dosen		= $rowData[0][8];
							$nama_dosen		= $rowData[0][9];
						 	$rectranskip = $this->transkip_model->isuniq($nim,$mk);
						  	if (isset($rectranskip) && is_array($rectranskip) && count($rectranskip)) 
						  	{
						  		if(isset($jsonkonversi[$nilai]))
						  		{
						  			$nilai_baru = $jsonkonversi[$nilai];
						  			$nilai_lama = $jsonkonversi[$rectranskip[0]->nilai_huruf];
						  			$nilai_lama = isset($jsonkonversi[$rectranskip[0]->nilai_huruf]) ? $jsonkonversi[$rectranskip[0]->nilai_huruf] : "";
						  			if($nilai_baru > $nilai_lama)						  			
						  			{		
						  				$success++;		
						  				$kriteria = array('kode_mk '=>$mk,'nim'=>$nim);
										$this->transkip_model->delete_where($kriteria);		  				
						  				$this->generate_transkip($nim,$mk,$nama_mk,$semester,$sks,$tahun_akademik,$kelas,$nilai,$kd_dosen,$nama_dosen);
						  			}else{
						  				$sudahada++;
						  			}					
								}
							}else{
								$success++;	
								$this->generate_transkip($nim,$mk,$nama_mk,$semester,$sks,$tahun_akademik,$kelas,$nilai,$kd_dosen,$nama_dosen);
						  	}
						  	$recdata_krs = $this->datakrs_model->isuniq($nim,$mk,$semester);
						  	if (isset($recdata_krs) && is_array($recdata_krs) && count($recdata_krs)) 
						  	{
						  		if(isset($jsonkonversi[$nilai]))
						  		{
						  			$nilai_baru = $jsonkonversi[$nilai];
						  			$nilai_lama = isset($jsonkonversi[$recdata_krs[0]->nilai_huruf]) ? $jsonkonversi[$recdata_krs[0]->nilai_huruf] : "0";
						  			if($nilai_baru > $nilai_lama)						  			
						  			{	
						  				$kriteria = array('kode_mk '=>$mk,'mahasiswa'=>$nim);
										$this->datakrs_model->delete_where($kriteria);		  	
						  				
										$this->generate_krs($nim,$mk,$nama_mk,$semester,$sks,$tahun_akademik,$kelas,$nilai,$kd_dosen,$nama_dosen);
										$successkrs++;
						  			}else{
						  				$sudahadakrs++;
						  			}
						  		}
						  	}else{
						  		$successkrs++;
								$this->generate_krs($nim,$mk,$nama_mk,$semester,$sks,$tahun_akademik,$kelas,$nilai,$kd_dosen,$nama_dosen);
						  	}
				  	}
			  	} 	
		
			}
			$msgsudahada = "";
			$msgsuccess = "";
			
			$msgsudahadakrs = "";
			$msgsuccesskrs = "";
			
			if($sudahada>0)
				$msgsudahada .= "Duplikasi data : ".$sudahada." data";
			if($success>0)
				$msgsuccess .= "Berhasil : ".$success." data";
			
			if($sudahadakrs>0)
				$msgsudahadakrs .= "KRS Duplikasi data : ".$sudahadakrs." data";
			if($successkrs>0)
				$msgsuccesskrs .= " KRS Berhasil : ".$successkrs." data";
				
			log_activity($this->current_user->id, 'Upload Nilai : '. $msgsudahada . ' : '.$msgsuccess.", KRS ".$msgsudahadakrs.$msgsuccesskrs." dari : ". $this->input->ip_address(), 'datakrs');
			Template::set_message($msgsuccess.$msgsudahada." <br> ".$msgsudahadakrs.$msgsuccesskrs, 'success');	
			//echo $msgsuccess.$msgsudahada."\nUpload Selesai";
		}
		
		Template::set('toolbar_title', 'Upload Nilai');
		Template::render();
	}
	private function generate_transkip($nim="",$kode_mk="",$nama_mk="",$semester="",$sks="",$tahun_aka="",$kelas="",$nilai="",$kd_dosen ="",$nama_dosen="",$type='insert', $id=0)
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
		$data['kd_dosen']        	= $kd_dosen;
		$data['dosen']        		= $nama_dosen;
		$data['nilai_huruf']        = $nilai;
		$data['sks']        		= $sks;
		$data['jml_diambil']       	= "";
		
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
	private function generate_krs($nim="",$kode_mk="",$nama_mk="",$semester="",$sks="",$tahun_akademik ="",$kelas="",$nilai="",$kd_dosen ="",$nama_dosen ="",$type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}
		// make sure we only pass in the fields we want
		$data = array();
		$data['mahasiswa']        	= $nim;
		$data['kode_mk']        	= $kode_mk;
		$data['nama_mk']        	= $nama_mk;
		$valsemester = str_replace("semester :","",$semester);
		$data['semester']        	= trim($valsemester);
		$data['kode_dosen']        	= $kd_dosen;
		$data['namadosen']        	= $nama_dosen;
		$data['nilai_huruf']        = $nilai;
		$data['sks']        		= $sks;
		$data['kelas']       		= $kelas;
		$data['tahun_akademik']     = $tahun_akademik;
		$data['status']     		= "B";
		$data['created_date']     	= date("Y-m-d");
		
		if ($type == 'insert')
		{
			$id = $this->datakrs_model->insert($data);

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
			$return = $this->datakrs_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Nilai Mhs data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$this->load->model('transkip/transkip_model', null, true);
		$id = $this->uri->segment(5);
		$this->auth->restrict('Nilai_Mhs.Nilai.Edit');
		if (empty($id))
		{
			Template::set_message("Silahkan Pilih terlebih dahulu", 'error');
			redirect(SITE_AREA .'/nilai/nilai_mhs');
		}

		if (isset($_POST['save']))
		{
			

			if ($this->save_datakrs('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, 'Update Nilai Sukses : '. $id .' : '. $this->input->ip_address(), 'datakrs');

				Template::set_message("Save Success", 'success');
			}
			else
			{
				Template::set_message("Save data Gagal" . $this->datakrs_model->error, 'error');
			}
		}
		if (isset($_POST['publis']))
		{
			
			if ($this->save_datakrs('update', $id))
			{
				$dateadetil		= $this->datakrs_model->find($id);
				$kode_mk        = $dateadetil->kode_mk;
				$nama_mk        = $dateadetil->nama_mk;
				$kd_dosen       = $dateadetil->kode_dosen;
				$dosen      	= $dateadetil->namadosen;
				$sks        	= $dateadetil->sks;
				$nim        	= $dateadetil->mahasiswa;
				//$dosen        	= $dateadetil->nama_dosen;
				$semester       = (int)$dateadetil->semester;
				$nilai_huruf    = $dateadetil->nilai_huruf;
				$jml_diambil	= $this->input->post('jml_diambil');
				if(!$this->transkip_model->cekuniq($nim,$kode_mk))
				{
					if($this->save_transkip($nim,$kode_mk,$nama_mk,$semester,$kd_dosen,$dosen,$nilai_huruf,$sks,$jml_diambil))
					{
						// Log the activity
						log_activity($this->current_user->id, 'Update, dan Publis Nilai Sukses : '. $id .' : '. $this->input->ip_address(), 'datakrs');
						Template::set_message("Publis Nilai Success", 'success');	
					}else{
						Template::set_message("Publis Nilai gagal", 'error');
					}	
				}else{
					if($this->input->post('perbaharui') =="1"){
						$datadelete = array('nim '=>$nim,'kode_mk'=>$kode_mk);
						$this->transkip_model->delete_where($datadelete);
						
						if($this->save_transkip($nim,$kode_mk,$nama_mk,$semester,$kd_dosen,$dosen,$nilai_huruf,$sks,$jml_diambil))
						{
							// Log the activity
							log_activity($this->current_user->id, 'Perbaharuan Nilai, Update, dan Publis Nilai Sukses : '. $id .' : '. $this->input->ip_address(), 'datakrs');
							Template::set_message("Perbaharuan Nilai Success", 'success');	
						}else{
							Template::set_message("Publis Nilai gagal", 'error');
						}	
				   
					}
					//Template::set_message("Nilai sudah terdaftar", 'error');
				}
				
			}
			else
			{
				Template::set_message("Save data Gagal" . $this->datakrs_model->error, 'error');
			}
		}
		
		$dateadetil		= $this->datakrs_model->find($id);
		$kode_mk        = $dateadetil->kode_mk;
		$nim        	= $dateadetil->mahasiswa;
		$jml_diambil	= "1x";
		$msgdouble = "";
		$rectranskip = $this->transkip_model->isuniq($nim,$kode_mk);
		if (isset($rectranskip) && is_array($rectranskip) && count($rectranskip)) 
		{
			$nilai_lama = $rectranskip[0]->nilai_huruf;
			$msgdouble = "Nilai untuk matakuliah ini sudah terdaftar di transkip nilai, dengan nilai : <b>".$nilai_lama."</b> pada semester :". $rectranskip[0]->semester;
		}
		 
		Template::set('msgdouble', $msgdouble);
		Template::set('datakrs', $this->datakrs_model->find($id));
		Template::set('toolbar_title', '&nbsp;&nbsp; Ubah Data Nilai Mahasiswa');
		Template::render();
	}
	
	public function cekexist()
	{
		$this->load->model('transkip/transkip_model', null, true);
		$msgdouble = "";
		$mahasiswa	= $this->input->post('mahasiswa');
		$kode_mk	= $this->input->post('kode_mk');
		if($this->transkip_model->cekuniq($mahasiswa,$kode_mk))
		{
			$msgdouble = "Nilai untuk matakuliah ini sudah terdaftar di transkip nilai..";
		}
		echo $msgdouble;
		exit;
	}
	//--------------------------------------------------------------------
	private function save_datakrs($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['kode_mk']        = $this->input->post('datakrs_kode_mk');
		$data['nama_mk']        = $this->input->post('namamk');
		$data['sks']        = $this->input->post('datakrs_sks');
		$data['mahasiswa']        = $this->input->post('datakrs_mahasiswa');
		$data['kode_dosen']        = $this->input->post('kode_dosen');
		$data['namadosen']        = $this->input->post('namadosen');
		$data['semester']        = $this->input->post('datakrs_semester');
		//$data['kode_jadwal']        = $this->input->post('datakrs_kode_jadwal');
		$data['nilai_angka']        = $this->input->post('datakrs_nilai_angka');
		$data['nilai_huruf']        = $this->input->post('datakrs_nilai_huruf');
		$data['created_date']        = date("Y-m-d");// $this->input->post('datakrs_created_date') ? $this->input->post('datakrs_created_date') : '0000-00-00';

		if ($type == 'insert')
		{
			$id = $this->datakrs_model->insert($data);

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
			$return = $this->datakrs_model->update($id, $data);
		}

		return $return;
	}
	private function save_transkip($nim="",$kode_mk="",$nama_mk="",$semester="",$kd_dosen="",$dosen="",$nilai_huruf="",$sks="",$jml_diambil="",$type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['nim']        = $nim;
		$data['kode_mk']        = $kode_mk;
		$data['nama_mk']        = $nama_mk;
		$data['semester']        = $semester;
		$data['kd_dosen']        = $kd_dosen;
		$data['dosen']        = $dosen;
		$data['nilai_huruf']        = $nilai_huruf;
		$data['sks']        = (int)$sks;
		$data['jml_diambil']        = $jml_diambil;// $this->input->post('datakrs_created_date') ? $this->input->post('datakrs_created_date') : '0000-00-00';

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


}