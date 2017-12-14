<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * master controller
 */
class master extends Admin_Controller
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

		$this->auth->restrict('MasterDosen.Master.View');
		$this->load->model('masterdosen_model', null, true);
		$this->lang->load('masterdosen');
		Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
		Assets::add_js('jquery-ui-1.8.13.min.js');
		Template::set_block('sub_nav', 'master/_sub_nav');

		Assets::add_module_js('masterdosen', 'masterdosen.js');
		//master Fakultas
		$this->load->model('masterfakultas/masterfakultas_model', null, true);
		$masterfakultas = $this->masterfakultas_model->find_all();
		Template::set('masterfakultass', $masterfakultas);
		//master jurusan
		$this->load->model('masterprogramstudi/masterprogramstudi_model', null, true);
		$masterprogramstudis = $this->masterprogramstudi_model->find_all();
		Template::set('masterprogramstudis', $masterprogramstudis);
		
		//master pilihan
		$this->load->model('pilihan/pilihan_model', null, true);
		$pilihans = $this->pilihan_model->find_all("01");
		Template::set('pilihans', $pilihans);
		$pilihan02s = $this->pilihan_model->find_all("02");
		Template::set('pilihan02s', $pilihan02s);
		$pilihan03s = $this->pilihan_model->find_all("03");
		Template::set('pilihan03s', $pilihan03s);
		$pilihan08s = $this->pilihan_model->find_all("08");
		Template::set('pilihan08s', $pilihan08s);
		$pilihan15s = $this->pilihan_model->find_all("15");
		Template::set('pilihan15s', $pilihan15s);
		
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{

		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$result = $this->masterdosen_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('masterdosen_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('masterdosen_delete_failure') . $this->masterdosen_model->error, 'error');
				}
			}
		}
		$fillnidn = $this->input->get('fillnidn');
		$filfakultas = $this->input->get('filfakultas');
		$filljurusan = $this->input->get('filljurusan'); 
		$fillnama = $this->input->get('fillnama');
		   
		$this->load->library('pagination');
		$total = $this->masterdosen_model->count_all($fillnidn,$filfakultas,$filljurusan,$fillnama);
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url() .'?fillnidn='.$fillnidn.'&filfakultas='.$filfakultas."&filljurusan=".$filljurusan."&fillnamamk=".$fillnama;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		
		 
		$records = $this->masterdosen_model->limit($limit, $offset)->find_all($fillnidn,$filfakultas,$filljurusan,$fillnama); 
		
		Template::set('total', $total);
		Template::set('fillnidn', $fillnidn);
		Template::set('filfakultas', $filfakultas);
		Template::set('filljurusan', $filljurusan);

		Template::set('fillnama', $fillnama);
		Template::set('records', $records);
		
		Template::set('toolbar_title', '&nbsp;&nbsp; Pengelolaan Data Dosen');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a MasterDosen object.
	 *
	 * @return void
	 */
	public function create()
	{		
		Assets::add_js('jquery.uniform.min.js');
		Assets::add_js('jquery-ui-1.8.13.min.js');
		Assets::add_js('jquery.cleditor.min.js');
		Assets::add_js('jquery.imagesloaded.js');
		Assets::add_js('custom.js');
		$this->auth->restrict('MasterDosen.Master.Create');

		if (isset($_POST['save']))
		{
			$this->load->helper('handle_upload');
			$uploadData = array();
			$upload = true; 
			if (isset($_FILES['file_upload']) && is_array($_FILES['file_upload']) && $_FILES['file_upload']['error'] != 4)
			{
				//die($this->settings_lib->item('site.pathphoto'));
				$uploadData = handle_upload('file_upload',$this->settings_lib->item('site.pathphotodosen'));
				print_r($uploadData);
				if (isset($uploadData['error']) && !empty($uploadData['error']))
				{
					$upload = false;
					
					Template::set_message($uploadData['error'], 'error');
					redirect(SITE_AREA .'/master/masterdosen/create');
				}
			} 
		
			if ($insert_id = $this->save_masterdosen())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('masterdosen_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'masterdosen');

				Template::set_message(lang('masterdosen_create_success'), 'success');
				redirect(SITE_AREA .'/master/masterdosen');
			}
			else
			{
				Template::set_message(lang('masterdosen_create_failure') . $this->masterdosen_model->error, 'error');
			}
		}
		Assets::add_module_js('masterdosen', 'masterdosen.js');

		Template::set('toolbar_title', '&nbsp;&nbsp; Tambah Data Master Dosen');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of MasterDosen data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);
		Assets::add_js('jquery.uniform.min.js');
		Assets::add_js('jquery-ui-1.8.13.min.js');
		Assets::add_js('jquery.cleditor.min.js');
		Assets::add_js('jquery.imagesloaded.js');
		Assets::add_js('custom.js');

		if (empty($id))
		{
			Template::set_message(lang('masterdosen_invalid_id'), 'error');
			redirect(SITE_AREA .'/master/masterdosen');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('MasterDosen.Master.Edit');
			$this->load->helper('handle_upload');
			$uploadData = array();
			$upload = true;
			if (isset($_FILES['file_upload']) && is_array($_FILES['file_upload']) && $_FILES['file_upload']['error'] != 4)
			{
				//die($this->settings_lib->item('site.pathphoto'));
				$uploadData = handle_upload('file_upload',$this->settings_lib->item('site.pathphotodosen'));
				//print_r($uploadData);
				if (isset($uploadData['error']) && !empty($uploadData['error']))
				{
					$upload = false;
					
					Template::set_message($uploadData['error'], 'error');
					//redirect(SITE_AREA .'/fileupload/photo_upload/create');
				}
			}
			//die("");
				
			if ($this->save_masterdosen($uploadData,'update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('masterdosen_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'masterdosen');

				Template::set_message(lang('masterdosen_edit_success'), 'success');
				redirect(SITE_AREA .'/master/masterdosen');
			}
			else
			{
				Template::set_message(lang('masterdosen_edit_failure') . $this->masterdosen_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('MasterDosen.Master.Delete');

			if ($this->masterdosen_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('masterdosen_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'masterdosen');

				Template::set_message(lang('masterdosen_delete_success'), 'success');

				redirect(SITE_AREA .'/master/masterdosen');
			}
			else
			{
				Template::set_message(lang('masterdosen_delete_failure') . $this->masterdosen_model->error, 'error');
			}
		}
		Template::set('masterdosen', $this->masterdosen_model->find($id));
		Template::set('toolbar_title', '&nbsp;&nbsp; Ubah Data Master Dosen');
		Template::render();
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
	private function save_masterdosen($uploadData,$type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}	
		$this->form_validation->set_rules('masterdosen_kode_jenjang_studi','Jenjang Studi','required|max_length[20]');
		$this->form_validation->set_rules('masterdosen_no_ktp_dosen','KTP','required|max_length[30]');
		$this->form_validation->set_rules('masterdosen_nama_dosen','Nama Dosen','required|max_length[200]'); 
		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['kode_pt']        = $this->input->post('masterdosen_kode_pt');
		$data['kode_fakultas']        = $this->input->post('masterdosen_kode_fakultas');
		$data['kode_prodi']        = $this->input->post('masterdosen_kode_prodi');
		$data['kode_jenjang_studi']        = $this->input->post('masterdosen_kode_jenjang_studi');
		$data['no_ktp_dosen']        = $this->input->post('masterdosen_no_ktp_dosen');
		$data['nidn']        = $this->input->post('masterdosen_nidn');
		$data['nama_dosen']        = $this->input->post('masterdosen_nama_dosen');
		$data['gelar_akademik']        = $this->input->post('masterdosen_gelar_akademik');
		$data['tempat_lahir_dosen']        = $this->input->post('masterdosen_tempat_lahir_dosen');
		$data['tgl_lahir_dosen']        = $this->input->post('masterdosen_tgl_lahir_dosen') ? $this->input->post('masterdosen_tgl_lahir_dosen') : '0000-00-00';
		$data['jenis_kelamin']        = $this->input->post('masterdosen_jenis_kelamin');
		$data['kode_jabatan_akademik']        = $this->input->post('masterdosen_kode_jabatan_akademik');
		$data['kode_pendidikan_tertinggi']        = $this->input->post('masterdosen_kode_pendidikan_tertinggi');
		$data['kode_status_kerja_pts']        = $this->input->post('masterdosen_kode_status_kerja_pts');
		$data['kode_status_aktivitas_dosen']        = $this->input->post('masterdosen_kode_status_aktivitas_dosen');
		$data['tahun_semester']        = $this->input->post('masterdosen_tahun_semester');
		$data['nip_pns']        = $this->input->post('masterdosen_nip_pns');
		$data['home_base']        = $this->input->post('masterdosen_home_base');
	//	$data['photo_dosen']        = $this->input->post('masterdosen_photo_dosen');
		$data['no_telp_dosen']        = $this->input->post('masterdosen_no_telp_dosen');
	if ($uploadData !== false && is_array($uploadData) && count($uploadData) > 0 && isset($uploadData['data']['file_name']))
		{
			//die($uploadData['data']['file_name']);
			$data = $data + array('photo_mahasiswa'=>$uploadData['data']['file_name']);
		}
		if ($type == 'insert')
		{
			$id = $this->masterdosen_model->insert($data);

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
			$return = $this->masterdosen_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}