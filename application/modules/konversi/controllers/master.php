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

		$this->auth->restrict('Konversi.Master.View');
		$this->load->model('konversi_model', null, true);
		$this->lang->load('konversi');
		
		Template::set_block('sub_nav', 'master/_sub_nav');

		Assets::add_module_js('konversi', 'konversi.js');
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
					$result = $this->konversi_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('konversi_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('konversi_delete_failure') . $this->konversi_model->error, 'error');
				}
			}
		}

		$records = $this->konversi_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Konversi');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Konversi object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Konversi.Master.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_konversi())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('konversi_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'konversi');

				Template::set_message(lang('konversi_create_success'), 'success');
				redirect(SITE_AREA .'/master/konversi');
			}
			else
			{
				Template::set_message(lang('konversi_create_failure') . $this->konversi_model->error, 'error');
			}
		}
		Assets::add_module_js('konversi', 'konversi.js');

		Template::set('toolbar_title', lang('konversi_create') . ' Konversi');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Konversi data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('konversi_invalid_id'), 'error');
			redirect(SITE_AREA .'/master/konversi');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Konversi.Master.Edit');

			if ($this->save_konversi('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('konversi_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'konversi');

				Template::set_message(lang('konversi_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('konversi_edit_failure') . $this->konversi_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Konversi.Master.Delete');

			if ($this->konversi_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('konversi_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'konversi');

				Template::set_message(lang('konversi_delete_success'), 'success');

				redirect(SITE_AREA .'/master/konversi');
			}
			else
			{
				Template::set_message(lang('konversi_delete_failure') . $this->konversi_model->error, 'error');
			}
		}
		Template::set('konversi', $this->konversi_model->find($id));
		Template::set('toolbar_title', lang('konversi_edit') .' Konversi');
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
	private function save_konversi($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['huruf']        = $this->input->post('konversi_huruf');
		$data['angka']        = $this->input->post('konversi_angka');

		if ($type == 'insert')
		{
			$id = $this->konversi_model->insert($data);

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
			$return = $this->konversi_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}