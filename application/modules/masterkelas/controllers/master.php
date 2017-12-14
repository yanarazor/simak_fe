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

		$this->auth->restrict('MasterKelas.Master.View');
		$this->load->model('masterkelas_model', null, true);
		$this->lang->load('masterkelas');
		
		Template::set_block('sub_nav', 'master/_sub_nav');

		Assets::add_module_js('masterkelas', 'masterkelas.js');


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
					$result = $this->masterkelas_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('masterkelas_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('masterkelas_delete_failure') . $this->masterkelas_model->error, 'error');
				}
			}
		}

		$filltahun = $this->input->get('filltahun');
		$fillnama = $this->input->get('fillnama');
		$fillkode = $this->input->get('fillkode');
		   
		$this->load->library('pagination');
		$total = $this->masterkelas_model->count_all($filltahun,$fillnama,$fillkode);
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url() .'?filltahun='.$filltahun.'&fillnama='.$fillnama."&fillkode=".$fillkode;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		
		 
		$records = $this->masterkelas_model->limit($limit, $offset)->find_all($filltahun,$fillnama,$fillkode); 
		
		Template::set('total', $total);
		Template::set('filltahun', $filltahun);
		Template::set('fillnama', $fillnama);
		Template::set('fillkode', $fillkode);
		Template::set('records', $records);
		Template::set('toolbar_title', '&nbsp;&nbsp; Pengelolaan Data Kelas');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a MasterKelas object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('MasterKelas.Master.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_masterkelas())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('masterkelas_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'masterkelas');

				Template::set_message(lang('masterkelas_create_success'), 'success');
				redirect(SITE_AREA .'/master/masterkelas');
			}
			else
			{
				Template::set_message(lang('masterkelas_create_failure') . $this->masterkelas_model->error, 'error');
			}
		}
		Assets::add_module_js('masterkelas', 'masterkelas.js');

		Template::set('toolbar_title', '&nbsp;&nbsp; Tambah Data Kelas');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of MasterKelas data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('masterkelas_invalid_id'), 'error');
			redirect(SITE_AREA .'/master/masterkelas');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('MasterKelas.Master.Edit');

			if ($this->save_masterkelas('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('masterkelas_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'masterkelas');

				Template::set_message(lang('masterkelas_edit_success'), 'success');
				redirect(SITE_AREA .'/settings/jadwal');
			}
			else
			{
				Template::set_message(lang('masterkelas_edit_failure') . $this->masterkelas_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('MasterKelas.Master.Delete');

			if ($this->masterkelas_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('masterkelas_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'masterkelas');

				Template::set_message(lang('masterkelas_delete_success'), 'success');

				redirect(SITE_AREA .'/master/masterkelas');
			}
			else
			{
				Template::set_message(lang('masterkelas_delete_failure') . $this->masterkelas_model->error, 'error');
			}
		}
		Template::set('masterkelas', $this->masterkelas_model->find($id));
		Template::set('toolbar_title','&nbsp;&nbsp; Ubah Data MasterKelas');
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
	private function save_masterkelas($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['tahun_akademik']        = $this->input->post('masterkelas_tahun_akademik');
		$data['kd_kelas']        = $this->input->post('masterkelas_kd_kelas');
		$data['nama_kelas']        = $this->input->post('masterkelas_nama_kelas');
		$data['kuota']        = $this->input->post('masterkelas_kuota');
		$data['keterangan']        = $this->input->post('masterkelas_keterangan');

		if ($type == 'insert')
		{
			$id = $this->masterkelas_model->insert($data);

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
			$return = $this->masterkelas_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}