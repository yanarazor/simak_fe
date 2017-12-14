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

		$this->auth->restrict('Predikat.Master.View');
		$this->load->model('predikat_model', null, true);
		$this->lang->load('predikat');
		
		Template::set_block('sub_nav', 'master/_sub_nav');

		Assets::add_module_js('predikat', 'predikat.js');
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
					$result = $this->predikat_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('predikat_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('predikat_delete_failure') . $this->predikat_model->error, 'error');
				}
			}
		}

		$records = $this->predikat_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage predikat');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a predikat object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Predikat.Master.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_predikat())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('predikat_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'predikat');

				Template::set_message(lang('predikat_create_success'), 'success');
				redirect(SITE_AREA .'/master/predikat');
			}
			else
			{
				Template::set_message(lang('predikat_create_failure') . $this->predikat_model->error, 'error');
			}
		}
		Assets::add_module_js('predikat', 'predikat.js');

		Template::set('toolbar_title', lang('predikat_create') . ' predikat');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of predikat data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('predikat_invalid_id'), 'error');
			redirect(SITE_AREA .'/master/predikat');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Predikat.Master.Edit');

			if ($this->save_predikat('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('predikat_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'predikat');

				Template::set_message(lang('predikat_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('predikat_edit_failure') . $this->predikat_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Predikat.Master.Delete');

			if ($this->predikat_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('predikat_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'predikat');

				Template::set_message(lang('predikat_delete_success'), 'success');

				redirect(SITE_AREA .'/master/predikat');
			}
			else
			{
				Template::set_message(lang('predikat_delete_failure') . $this->predikat_model->error, 'error');
			}
		}
		Template::set('predikat', $this->predikat_model->find($id));
		Template::set('toolbar_title', lang('predikat_edit') .' predikat');
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
	private function save_predikat($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['ipk_dari']        = $this->input->post('predikat_ipk_dari');
		$data['ipk_sampai']        = $this->input->post('predikat_ipk_sampai');
		$data['predikat']        = $this->input->post('predikat_predikat');

		if ($type == 'insert')
		{
			$id = $this->predikat_model->insert($data);

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
			$return = $this->predikat_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}