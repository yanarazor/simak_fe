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

		$this->auth->restrict('Pilihan.Master.View');
		$this->load->model('pilihan_model', null, true);
		$this->lang->load('pilihan');
		
		Template::set_block('sub_nav', 'master/_sub_nav');

		Assets::add_module_js('pilihan', 'pilihan.js');
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
					$result = $this->pilihan_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('pilihan_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('pilihan_delete_failure') . $this->pilihan_model->error, 'error');
				}
			}
		}
		$fillnama = $this->input->get('fillnama');
		$filpilihan = $this->input->get('filpilihan');
		   
		$this->load->library('pagination');
		$total = $this->pilihan_model->count_all($fillnama,$filpilihan);
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url() .'?fillnama='.$fillnama."&filpilihan=".$filpilihan;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		
		 
		$records = $this->pilihan_model->limit($limit, $offset)->find_all($fillnama,$filpilihan); 
		
		Template::set('total', $total);
		Template::set('fillnama', $fillnama);
		Template::set('filpilihan', $filpilihan);
		Template::set('records', $records);
		Template::set('toolbar_title', '&nbsp;&nbsp; Pengelolaan Pilihan');
		Template::render();
	}
	//--------------------------------------------------------------------


	/**
	 * Creates a Pilihan object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Pilihan.Master.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_pilihan())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('pilihan_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'pilihan');

				Template::set_message(lang('pilihan_create_success'), 'success');
				redirect(SITE_AREA .'/master/pilihan');
			}
			else
			{
				Template::set_message(lang('pilihan_create_failure') . $this->pilihan_model->error, 'error');
			}
		}
		Assets::add_module_js('pilihan', 'pilihan.js');

		Template::set('toolbar_title', '&nbsp;&nbsp; Tambah Data Pilihan');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Pilihan data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('pilihan_invalid_id'), 'error');
			redirect(SITE_AREA .'/master/pilihan');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Pilihan.Master.Edit');

			if ($this->save_pilihan('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('pilihan_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'pilihan');

				Template::set_message(lang('pilihan_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('pilihan_edit_failure') . $this->pilihan_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Pilihan.Master.Delete');

			if ($this->pilihan_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('pilihan_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'pilihan');

				Template::set_message(lang('pilihan_delete_success'), 'success');

				redirect(SITE_AREA .'/master/pilihan');
			}
			else
			{
				Template::set_message(lang('pilihan_delete_failure') . $this->pilihan_model->error, 'error');
			}
		}
		Template::set('pilihan', $this->pilihan_model->find($id));
		Template::set('toolbar_title','&nbsp;&nbsp; Ubah Data Pilihan');
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
	private function save_pilihan($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['kode']        = $this->input->post('pilihan_kode');
		$data['nama']        = $this->input->post('pilihan_nama');
		$data['value']        = $this->input->post('pilihan_value');
		$data['label']        = $this->input->post('pilihan_label');

		if ($type == 'insert')
		{
			$id = $this->pilihan_model->insert($data);

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
			$return = $this->pilihan_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}