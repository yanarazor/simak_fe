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

		$this->auth->restrict('MasterRuangan.Master.View');
		$this->load->model('masterruangan_model', null, true);
		$this->lang->load('masterruangan');
		
		Template::set_block('sub_nav', 'master/_sub_nav');

		Assets::add_module_js('masterruangan', 'masterruangan.js');
		//master pilihan
		$this->load->model('pilihan/pilihan_model', null, true);
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
		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$result = $this->masterruangan_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('masterruangan_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('masterruangan_delete_failure') . $this->masterruangan_model->error, 'error');
				}
			}
		}
		$tahun = $this->input->get('tahun');
		$kode = $this->input->get('kode');
		$nama = $this->input->get('nama');
		
		$this->load->library('pagination');
		$total = $this->masterruangan_model->count_all($tahun,$kode,$nama);
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url()."?tahun=".$tahun."&kode=".$kode."&nama=".$nama;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		$records = $this->masterruangan_model->limit($limit, $offset)->find_all($tahun,$kode,$nama);

		Template::set('records', $records);
		Template::set('total', $total);
		
		Template::set('tahun', $tahun);
		Template::set('nama', $nama);
		Template::set('kode', $kode);
		
		Template::set('toolbar_title', '&nbsp;&nbsp; Pengelolaan Data Ruangan');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a MasterRuangan object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('MasterRuangan.Master.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_masterruangan())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('masterruangan_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'masterruangan');

				Template::set_message(lang('masterruangan_create_success'), 'success');
				redirect(SITE_AREA .'/master/masterruangan');
			}
			else
			{
				Template::set_message(lang('masterruangan_create_failure') . $this->masterruangan_model->error, 'error');
			}
		}
		Assets::add_module_js('masterruangan', 'masterruangan.js');

		Template::set('toolbar_title', '&nbsp;&nbsp; Tambah Data Master Ruangan');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of MasterRuangan data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('masterruangan_invalid_id'), 'error');
			redirect(SITE_AREA .'/master/masterruangan');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('MasterRuangan.Master.Edit');

			if ($this->save_masterruangan('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('masterruangan_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'masterruangan');

				Template::set_message(lang('masterruangan_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('masterruangan_edit_failure') . $this->masterruangan_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('MasterRuangan.Master.Delete');

			if ($this->masterruangan_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('masterruangan_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'masterruangan');

				Template::set_message(lang('masterruangan_delete_success'), 'success');

				redirect(SITE_AREA .'/master/masterruangan');
			}
			else
			{
				Template::set_message(lang('masterruangan_delete_failure') . $this->masterruangan_model->error, 'error');
			}
		}
		Template::set('masterruangan', $this->masterruangan_model->find($id));
		Template::set('toolbar_title',  ' &nbsp;&nbsp; Ubah Data Master Ruangan');
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
	private function save_masterruangan($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		$this->form_validation->set_rules('tahun_akademik','Tahun Akademik','is_natural|required|max_length[20]');
		$this->form_validation->set_rules('masterruangan_kode_ruangan','Kode Ruangan','required|max_length[20]');
		$this->form_validation->set_rules('masterruangan_Nama_ruangan','Nama Ruangan','required|max_length[100]');
		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		
		$data = array();
		$data['tahun_akademik']        = $this->input->post('tahun_akademik');
		$data['kode_ruangan']        = $this->input->post('masterruangan_kode_ruangan');
		$data['Nama_ruangan']        = $this->input->post('masterruangan_Nama_ruangan');
		$data['status']        = $this->input->post('masterruangan_status');
		$data['waktu_awal']        = $this->input->post('masterruangan_waktu_awal');
		$data['waktu_akhir']        = $this->input->post('masterruangan_waktu_akhir');
		$data['keterangan']        = $this->input->post('masterruangan_keterangan');

		if ($type == 'insert')
		{
			$id = $this->masterruangan_model->insert($data);

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
			$return = $this->masterruangan_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}