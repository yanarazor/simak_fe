<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * krs controller
 */
class krs extends Admin_Controller
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

		$this->auth->restrict('Role_KRS.Krs.View');
		$this->load->model('role_krs_model', null, true);
		$this->lang->load('role_krs');
		
		Template::set_block('sub_nav', 'krs/_sub_nav');

		Assets::add_module_js('role_krs', 'role_krs.js');
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
					$result = $this->role_krs_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('role_krs_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('role_krs_delete_failure') . $this->role_krs_model->error, 'error');
				}
			}
		}

		$records = $this->role_krs_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Role KRS');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Role KRS object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Role_KRS.Krs.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_role_krs())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('role_krs_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'role_krs');

				Template::set_message(lang('role_krs_create_success'), 'success');
				redirect(SITE_AREA .'/krs/role_krs');
			}
			else
			{
				Template::set_message(lang('role_krs_create_failure') . $this->role_krs_model->error, 'error');
			}
		}
		Assets::add_module_js('role_krs', 'role_krs.js');

		Template::set('toolbar_title', lang('role_krs_create') . ' Role KRS');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Role KRS data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('role_krs_invalid_id'), 'error');
			redirect(SITE_AREA .'/krs/role_krs');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Role_KRS.Krs.Edit');

			if ($this->save_role_krs('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('role_krs_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'role_krs');

				Template::set_message(lang('role_krs_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('role_krs_edit_failure') . $this->role_krs_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Role_KRS.Krs.Delete');

			if ($this->role_krs_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('role_krs_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'role_krs');

				Template::set_message(lang('role_krs_delete_success'), 'success');

				redirect(SITE_AREA .'/krs/role_krs');
			}
			else
			{
				Template::set_message(lang('role_krs_delete_failure') . $this->role_krs_model->error, 'error');
			}
		}
		Template::set('role_krs', $this->role_krs_model->find($id));
		Template::set('toolbar_title', lang('role_krs_edit') .' Role KRS');
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
	private function save_role_krs($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['dari']        = $this->input->post('role_krs_dari');
		$data['sampai']        = $this->input->post('role_krs_sampai');
		$data['maksimal_sks']        = $this->input->post('role_krs_maksimal_sks');

		if ($type == 'insert')
		{
			$id = $this->role_krs_model->insert($data);

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
			$return = $this->role_krs_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}