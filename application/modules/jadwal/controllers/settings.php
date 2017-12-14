<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * settings controller
 */
class settings extends Admin_Controller
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

	
		$this->load->model('jadwal_model', null, true);
		$this->lang->load('jadwal');
		
		Template::set_block('sub_nav', 'settings/_sub_nav');

		Assets::add_module_js('jadwal', 'jadwal.js');
		//master jurusan
		$this->load->model('masterprogramstudi/masterprogramstudi_model', null, true);
		$masterprogramstudis = $this->masterprogramstudi_model->find_all();
		Template::set('masterprogramstudis', $masterprogramstudis);
		//master jurusan
		$this->load->model('masterkelas/masterkelas_model', null, true);
		$kelass = $this->masterkelas_model->find_all();
		Template::set('kelass', $kelass);
		
		//master jurusan
		$this->load->model('masterruangan/masterruangan_model', null, true);
		$ruangans = $this->masterruangan_model->find_all();
		Template::set('ruangans', $ruangans);
		//master matakuliah
		$this->load->model('mastermatakuliah/mastermatakuliah_model', null, true);
		$matakuliahs = $this->mastermatakuliah_model->find_distinct();
		Template::set('matakuliahs', $matakuliahs);
		//master Dosen
		$this->load->model('masterdosen/masterdosen_model', null, true);
		$dosens = $this->masterdosen_model->find_all();
		Template::set('dosens', $dosens);
		
		//master pilihan
		$this->load->model('pilihan/pilihan_model', null, true);
		
		$pilihansemester = $this->pilihan_model->find_all("sms");
		Template::set('pilihansemesters', $pilihansemester);
		
		$pilihantahuns = $this->pilihan_model->find_all("ta");
		Template::set('pilihantahuns', $pilihantahuns);

		$pilihanhari = $this->pilihan_model->find_all("hari");
		Template::set('pilihanhari', $pilihanhari);

		$pilihansesi = $this->pilihan_model->find_all("sesi");
		Template::set('pilihansesi', $pilihansesi);
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{
		$this->auth->restrict('Jadwal.Settings.View');

		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$result = $this->jadwal_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('jadwal_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('jadwal_delete_failure') . $this->jadwal_model->error, 'error');
				}
			}
		}
		$mk = $this->input->get('mk');
		$prodi = $this->input->get('prodi');
		$tahun_akademik = $this->input->get('tahun_akademik');
		$this->load->library('pagination');
		$total = $this->jadwal_model->count_all($mk,$prodi,"","",$tahun_akademik);
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url() .'?mk='.$mk.'&prodi='.$prodi.'&tahun_akademik='.$tahun_akademik;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		
		 
		$records = $this->jadwal_model->limit($limit, $offset)->find_all($mk,$prodi,"","",$tahun_akademik); 
		
		Template::set('total', $total);
		Template::set('mk', $mk);
		Template::set('prodi', $prodi);
		Template::set('tahun_akademik', $tahun_akademik);
		
		Template::set('records', $records);
		Template::set('toolbar_title', '&nbsp;&nbsp; Pengelolaan Jadwal Kuliah');
		Template::render();
	}
	public function printjadwal()
	{
		$mode = $this->uri->segment(5); 
		//die($mode);
		$mk = $this->input->get('mk');
		$prodi = $this->input->get('prodi');
		$tahun_akademik = $this->input->get('tahun_akademik');
		if (empty($tahun_akademik))
		{
			Template::set_message("Tahun Akademik : .", 'tahun_akademik');
			 
		}
		$records = $this->jadwal_model->find_all($mk,$prodi,"","",$tahun_akademik);
		Template::set('records', $records);
		
		 
		Template::set_view('settings/printjadwal');
		Template::set('tahun_akademik', $tahun_akademik);
		Template::set('mk', $mk);
		Template::set('prodi', $prodi);
		if($mode=="print"){
			//Assets::add_css('style.css');  
			Template::set_theme('print');
		}
			Template::set('toolbar_title', '&nbsp;&nbsp; Cetak Jadwal Kuliah');
		Template::render();
	}
	public function lihat()
	{
		//$this->auth->restrict('Jadwal.Settings.lihat');

		 
		$mk = $this->input->get('mk');
		$prodi = $this->input->get('prodi');
		$sms = $this->input->get('sms');
		$idkrs = $this->input->get('idkrs');
		
		$total = count($this->jadwal_model->find_all_forkrs($mk,$prodi,$sms)); 
		$records = $this->jadwal_model->find_all_forkrs($mk,$prodi,$sms); 
		$recterpakai = $this->jadwal_model->find_terisi($mk,$prodi,$sms); 
		$jsonjumlah[] =array();
		if (isset($recterpakai) && is_array($recterpakai) && count($recterpakai)) :
			foreach ($recterpakai as $record) :
				$jsonjumlah[$record->id] = $record->jmlterisi;
				//echo $record->id." - ".$record->jmlterisi;
			endforeach;
		endif;
		
		//print_r($recterpakai);
		//die();
		//Template::set('total', $total);
		Template::set('jsonjumlah', $jsonjumlah);
		Template::set('mk', $mk);
		Template::set('prodi', $prodi);
		Template::set('sms', $sms);
		Template::set('idkrs', $idkrs);
		Template::set('total', $total);
		Template::set('records', $records);
		Template::set('toolbar_title', '&nbsp;&nbsp; Pengelolaan Jadwal Kuliah');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Jadwal object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Jadwal.Settings.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_jadwal())
			{
				//die($insert_id);
				// Log the activity
				log_activity($this->current_user->id, lang('jadwal_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'jadwal');

				Template::set_message(lang('jadwal_create_success'), 'success');
				redirect(SITE_AREA .'/settings/jadwal');
			}
			else
			{
				Template::set_message(lang('jadwal_create_failure') . $this->jadwal_model->error, 'error');
			}
		}
		Assets::add_module_js('jadwal', 'jadwal.js');
		Template::set('toolbar_title', '&nbsp;&nbsp; Tambah Data Jadwal Kuliah');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Jadwal data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('jadwal_invalid_id'), 'error');
			redirect(SITE_AREA .'/settings/jadwal');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Jadwal.Settings.Edit');

			if ($this->save_jadwal('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('jadwal_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'jadwal');

				Template::set_message(lang('jadwal_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('jadwal_edit_failure') . $this->jadwal_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Jadwal.Settings.Delete');

			if ($this->jadwal_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('jadwal_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'jadwal');

				Template::set_message(lang('jadwal_delete_success'), 'success');

				redirect(SITE_AREA .'/settings/jadwal');
			}
			else
			{
				Template::set_message(lang('jadwal_delete_failure') . $this->jadwal_model->error, 'error');
			}
		}
		$jadwals = $this->jadwal_model->find($id);
		Template::set('jadwal', $jadwals);
		$tahun_pilihan = "";
		if(isset($jadwals->tahun_akademik))
			$tahun_pilihan = $jadwals->tahun_akademik;
		Template::set('matakuliahs', $this->mastermatakuliah_model->getbytahun($tahun_pilihan));
		
				Template::set('toolbar_title', '&nbsp;&nbsp; Ubah Data Jadwal Kuliah');
		Template::render();
	}
	public function getkelas()
	{
		$ta = $this->input->get('tahun_akademik');
		$mk = $this->input->get('valmk');
		$prodi = $this->input->get('prodi');
		$semester = $this->input->get('semester');
		$json = array(); 
		$recordkelas = $this->jadwal_model->getkelas($ta,$mk,$prodi,$semester);
		if(isset($recordkelas) && is_array($recordkelas) && count($recordkelas)):
			foreach ($recordkelas as $record) :
				$json['id'][] = $record->kelas;
				$json['kelas'][] = $record->nama_kelas;
			endforeach;
		endif;
		echo json_encode($json);
		die();
	}
	public function printjadwaldosen()
	{
		$mode = $this->uri->segment(5); 
		//die($mode);
		$mk = $this->input->get('mk');
		$prodi = $this->input->get('prodi');
		$this->load->library('akademik');
		$akademik = new Akademik();	
		$recakademikaktf = $this->akademik->GetTahunAktif();
		$tahunakademik = isset($recakademikaktf[0]->tahun_id) ? $recakademikaktf[0]->tahun_id : $this->settings_lib->item('site.tahun');
		
		$tahun_akademik = $this->input->get('tahun_akademik') != "" ? $this->input->get('tahun_akademik') : $tahunakademik;
		if (empty($tahun_akademik))
		{
			//Template::set_message("Tahun Akademik : .", 'tahun_akademik');
			Template::set_message("Tahun Akademik Belum ditentukan", 'error');
			 
		}
		//die($this->current_user->nim);
		$nidn 			=  $this->current_user->nim;
		$records 	= $this->jadwal_model->getjadwaldosen($nidn,$tahunakademik);
		Template::set('records', $records);
		
		 
		Template::set_view('settings/printjadwaldosen');
		Template::set('tahun_akademik', $tahun_akademik);
		Template::set('mk', $mk);
		Template::set('prodi', $prodi);
			//Assets::add_css('style.css');  
			Template::set_theme('print');
			Template::set('toolbar_title', '&nbsp;&nbsp; Cetak Jadwal Kuliah');
		Template::render();
	}
	public function addmateri()
	{
		//die("masuk");
		$this->auth->restrict('Nilai_Mahasiswa.Nilai.Create');
		/*
		Assets::add_js('jquery.uniform.min.js');
		Assets::add_js('jquery-ui-1.8.13.min.js');
		Assets::add_js('jquery.cleditor.min.js');
		Assets::add_js('jquery.imagesloaded.js');
		Assets::add_js('custom.js'); 
		*/
		$mode = $this->uri->segment(5); 
		$id = $this->uri->segment(6);
		Template::set('id', $id);
		
		$filfakultas = $this->input->get('filfakultas');
		$filljurusan = $this->input->get('filljurusan');
		
		$kode_mk = $this->input->get('kode_mk');
		$dosen = $this->input->get('dosen');
		$tahun = $this->input->get('tahun');
		$kelas = $this->input->get('kelas');
		$sms = $this->input->get('sms');
		$jml = $this->input->get('jml');
		$mode = $this->uri->segment(5); 
		//die($filljurusan);
		if (isset($_POST['save']))
		{
			$this->load->helper('handle_upload');
			$uploadData = array();
			$upload = true;
			if (isset($_FILES['file_upload']) && is_array($_FILES['file_upload']) && $_FILES['file_upload']['error'] != 4)
			{
				
				$uploadData = handle_upload('file_upload',$this->settings_lib->item('site.pathmateri'));

				if (isset($uploadData['error']) && !empty($uploadData['error']))
				{
					$upload = false;
					
					Template::set_message($uploadData['error'], 'error');
					//redirect(SITE_AREA .'/fileupload/photo_upload/create');
				}
			}
			if ($this->save_presensi($uploadData,'update', $id))
			{
		
			}
		}
		$this->load->model('masterprogramstudi/masterprogramstudi_model', null, true);
		$prodi = $this->masterprogramstudi_model->find_detil($filljurusan);
		
		$this->load->model('mastermatakuliah/mastermatakuliah_model', null, true);
		$rcmatakuliah = $this->mastermatakuliah_model->find_detil_mk($kode_mk,$filfakultas,$filljurusan);
		
		$this->load->model('jadwal/jadwal_model', null, true);
		
		$rcjadwal = $this->jadwal_model->find_byid($id,$kode_mk,$kelas,$filljurusan);
		$dosen 		= isset($rcjadwal[0]->nama_dosen) ? $rcjadwal[0]->nama_dosen : "";
		$waktu 		= isset($rcjadwal[0]->hari) ? $rcjadwal[0]->hari."-". $rcjadwal[0]->jam : "";
		$kelas 		= isset($rcjadwal[0]->kelas) ? $rcjadwal[0]->kelas: "";
		$nama_mk 	= $rcmatakuliah[0]->kode_mata_kuliah." - ".$rcmatakuliah[0]->nama_mata_kuliah;
		$nidn 		= isset($rcjadwal[0]->nidn) ? $rcjadwal[0]->nidn : "";
		$bobot_harian 		= isset($rcjadwal[0]->bobot_harian) ? $rcjadwal[0]->bobot_harian : "";
		$bobot_formatif 		= isset($rcjadwal[0]->bobot_formatif) ? $rcjadwal[0]->bobot_formatif : "";
		$bobot_uts 				= isset($rcjadwal[0]->bobot_uts) ? $rcjadwal[0]->bobot_uts : "";
		$bobot_uas 				= isset($rcjadwal[0]->bobot_uas) ? $rcjadwal[0]->bobot_uas : "";
		$jml_pertemuan 				= isset($rcjadwal[0]->jml_pertemuan) ? $rcjadwal[0]->jml_pertemuan : "";
		
		 
		// getdetil taun akademik
		$this->load->model('tahunakademik/tahunakademik_model', null, true);
		$recordtahunakademik = $this->tahunakademik_model->find_all($tahun);
		if($recordtahunakademik){
			$tahunakademik = $recordtahunakademik[0]->nama_tahun;
		}
		Template::set('rcjadwal', $rcjadwal);
		Template::set('fakultas', $filfakultas);
		Template::set('jurusan', $filljurusan);
		Template::set('nama_jurusan', $prodi[0]->nama_prodi);
		Template::set('kode_mk', $kode_mk);
		Template::set('nama_mk', $rcmatakuliah[0]->kode_mata_kuliah." - ".$rcmatakuliah[0]->nama_mata_kuliah);
		Template::set('dosen', $dosen);
		Template::set('nidn', $nidn);
		Template::set('waktu',  $waktu);
		Template::set('tahun', $tahun);
		Template::set('kelas', $kelas);
		Template::set('jml', $jml);
		
		Template::set('tahunakademik', $tahunakademik);
		if($mode=="simple"){
			//Assets::add_css('style.css');  
			Template::set_theme('simple');
		}
		
		
		$this->load->model('mastermatakuliah/mastermatakuliah_model', null, true);
		$this->mastermatakuliah_model->where("kode_prodi",$filljurusan);
		$this->mastermatakuliah_model->where("status_mata_kuliah","A");
		$data_detil	= $this->mastermatakuliah_model->find_by("kode_mata_kuliah",$kode_mk); 
		Template::set('mastermatakuliah', $data_detil);
		
		Template::set('toolbar_title', 'Input Presensi Dosen');
		Template::render();
	}
	public function savemateri()
    {
        $this->auth->restrict('Nilai_Mahasiswa.Nilai.Create');
        $mode = $this->uri->segment(5); 
		$id = $this->input->post('id');
        if ($this->save_presensi("",'update', $id))
		{
			echo "Update data sukses";
		}

        exit();
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
	private function save_presensi($uploadData = false,$type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}
		 
		// make sure we only pass in the fields we want
		
		$data = array();
		$data['presensi']        = $this->input->post('presensi');
		$data['bobot_harian']  	 = $this->input->post('harian');
		$data['bobot_formatif']  = $this->input->post('normatif');
		$data['bobot_uts']       = $this->input->post('uts');
		$data['bobot_uas']       = $this->input->post('uas');
		$data['jml_pertemuan']       = $this->input->post('jml_pertemuan');
		
		if ($uploadData !== false && is_array($uploadData) && count($uploadData) > 0 && isset($uploadData['data']['file_name']))
		{
			//die($uploadData['data']['file_name']);
			$data = $data + array('materi'=>$uploadData['data']['file_name']);
		}
		if ($type == 'insert')
		{
			$id = $this->jadwal_model->insert($data);

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
			$return = $this->jadwal_model->update($id, $data);
		}

		return $return;
	}
	private function save_jadwal($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}
		$this->form_validation->set_rules('tahun_akademik','Tahun Akademik','required|max_length[10]');
		//$this->form_validation->set_rules('jadwal_hari','Hari','required|max_length[20]');
		$this->form_validation->set_rules('jadwal_kode_mk','Mata Kuliah','required|max_length[20]');
		$this->form_validation->set_rules('jadwal_semester','Semester','required|max_length[10]');
		$this->form_validation->set_rules('jadwal_prodi','Prodi','required|max_length[20]');
		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		// make sure we only pass in the fields we want
		
		$data = array();
		$data['hari']        = $this->input->post('jadwal_hari');
		$data['jam']        = $this->input->post('jadwal_jam');
		$data['kode_mk']        = $this->input->post('jadwal_kode_mk');
		$data['kode_dosen']        = $this->input->post('jadwal_kode_dosen');
		$data['semester']        = $this->input->post('jadwal_semester');
		$data['kd_ruangan']        = $this->input->post('jadwal_ruangan');
		$data['kelas']        = $this->input->post('jadwal_kelas');
		$data['kuota_kelas']        = $this->input->post('kuota_kelas');
		$data['prodi']        = $this->input->post('jadwal_prodi');
		$data['tahun_akademik']        = $this->input->post('tahun_akademik');

		if ($type == 'insert')
		{
			$id = $this->jadwal_model->insert($data);

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
			$return = $this->jadwal_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}