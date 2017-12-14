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
		    
		$this->load->library('pagination');
		$total = $this->jadwal_model->count_all($mk,$prodi);
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url() .'?mk='.$mk.'&prodi='.$prodi;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		
		 
		$records = $this->jadwal_model->limit($limit, $offset)->find_all($mk,$prodi); 
		
		Template::set('total', $total);
		Template::set('mk', $mk);
		Template::set('prodi', $prodi);
		
		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Jadwal');
		Template::render();
	}
	public function lihat()
	{
		//$this->auth->restrict('Jadwal.Settings.lihat');

		 
		$mk = $this->input->get('mk');
		$prodi = $this->input->get('prodi');
		$sms = $this->input->get('sms');
		$idkrs = $this->input->get('idkrs');
		
		$total = $this->jadwal_model->count_all($mk,$prodi,$sms); 
		$records = $this->jadwal_model->find_all_forkrs($mk,$prodi,$sms); 
		 
		//Template::set('total', $total);
		Template::set('mk', $mk);
		Template::set('prodi', $prodi);
		Template::set('sms', $sms);
		Template::set('idkrs', $idkrs);
		Template::set('total', $total);
		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Jadwal');
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

		Template::set('toolbar_title', lang('jadwal_create') . ' Jadwal');
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
		Template::set('jadwal', $this->jadwal_model->find($id));
		Template::set('toolbar_title', lang('jadwal_edit') .' Jadwal');
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
	private function save_jadwal($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}
		$this->form_validation->set_rules('tahun_akademik','Tahun Akademik','required|max_length[10]');
		$this->form_validation->set_rules('jadwal_hari','Hari','required|max_length[20]');
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