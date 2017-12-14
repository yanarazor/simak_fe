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

		$this->auth->restrict('MasterFakultas.Master.View');
		$this->load->model('masterfakultas_model', null, true);
		$this->lang->load('masterfakultas');
		
			Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
			Assets::add_js('jquery-ui-1.8.13.min.js');
		Template::set_block('sub_nav', 'master/_sub_nav');

		Assets::add_module_js('masterfakultas', 'masterfakultas.js');
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
					$result = $this->masterfakultas_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('masterfakultas_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('masterfakultas_delete_failure') . $this->masterfakultas_model->error, 'error');
				}
			}
		}

		$records = $this->masterfakultas_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', '&nbsp;&nbsp; Pengelolaan Data Fakultas');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a MasterFakultas object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('MasterFakultas.Master.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_masterfakultas())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('masterfakultas_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'masterfakultas');

				Template::set_message(lang('masterfakultas_create_success'), 'success');
				redirect(SITE_AREA .'/master/masterfakultas');
			}
			else
			{
				Template::set_message(lang('masterfakultas_create_failure') . $this->masterfakultas_model->error, 'error');
			}
		}
		Assets::add_module_js('masterfakultas', 'masterfakultas.js');

		Template::set('toolbar_title','&nbsp;&nbsp; Tambah Data Master Fakultas');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of MasterFakultas data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('masterfakultas_invalid_id'), 'error');
			redirect(SITE_AREA .'/master/masterfakultas');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('MasterFakultas.Master.Edit');

			if ($this->save_masterfakultas('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('masterfakultas_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'masterfakultas');

				Template::set_message(lang('masterfakultas_edit_success'), 'success');
				redirect(SITE_AREA .'/master/masterfakultas');
			}
			else
			{
				Template::set_message(lang('masterfakultas_edit_failure') . $this->masterfakultas_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('MasterFakultas.Master.Delete');

			if ($this->masterfakultas_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('masterfakultas_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'masterfakultas');

				Template::set_message(lang('masterfakultas_delete_success'), 'success');

				redirect(SITE_AREA .'/master/masterfakultas');
			}
			else
			{
				Template::set_message(lang('masterfakultas_delete_failure') . $this->masterfakultas_model->error, 'error');
			}
		}
		Template::set('masterfakultas', $this->masterfakultas_model->find($id));
		Template::set('toolbar_title','&nbsp;&nbsp; Ubah Data Master Fakultas');
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
	private function save_masterfakultas($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['kode_badan_hukum']     = $this->input->post('masterfakultas_kode_badan_hukum');
		$data['kode_pt']        	  = $this->input->post('masterfakultas_kode_pt');
		$data['dekan']        	  = $this->input->post('dekan');
		$data['kode_fakultas']        = $this->input->post('masterfakultas_kode_fakultas');
		$data['nama_fakultas']        = $this->input->post('masterfakultas_nama_fakultas');
		$data['tgl_pendirian']        = $this->input->post('masterfakultas_tgl_pendirian') ? $this->input->post('masterfakultas_tgl_pendirian') : '0000-00-00';

		if ($type =='insert')
		{
			$id = $this->masterfakultas_model->insert($data);

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
			$return = $this->masterfakultas_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}