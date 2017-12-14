<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * site controller
 */
class site extends Admin_Controller
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

		
		$this->load->model('pesan_model', null, true);
		$this->lang->load('pesan');
		
		Template::set_block('sub_nav', 'site/_sub_nav');

		Assets::add_module_js('pesan', 'pesan.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{
		$this->auth->restrict('Pesan.Site.View');
		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$result = $this->pesan_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('pesan_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('pesan_delete_failure') . $this->pesan_model->error, 'error');
				}
			}
		}

		$records = $this->pesan_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage pesan');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a pesan object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Pesan.Site.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_pesan())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('pesan_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'pesan');

				Template::set_message(lang('pesan_create_success'), 'success');
				redirect(SITE_AREA .'/site/pesan');
			}
			else
			{
				Template::set_message(lang('pesan_create_failure') . $this->pesan_model->error, 'error');
			}
		}
		Assets::add_module_js('pesan', 'pesan.js');

		Template::set('toolbar_title', lang('pesan_create') . ' pesan');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of pesan data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('pesan_invalid_id'), 'error');
			redirect(SITE_AREA .'/site/pesan');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Pesan.Site.Edit');

			if ($this->save_pesan('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('pesan_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'pesan');

				Template::set_message(lang('pesan_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('pesan_edit_failure') . $this->pesan_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Pesan.Site.Delete');

			if ($this->pesan_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('pesan_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'pesan');

				Template::set_message(lang('pesan_delete_success'), 'success');

				redirect(SITE_AREA .'/site/pesan');
			}
			else
			{
				Template::set_message(lang('pesan_delete_failure') . $this->pesan_model->error, 'error');
			}
		}
		Template::set('pesan', $this->pesan_model->find($id));
		Template::set('toolbar_title', lang('pesan_edit') .' pesan');
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
	private function save_pesan($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['dari']        = $this->input->post('pesan_dari');
		$data['untuk']        = $this->input->post('pesan_untuk');
		$data['pesan']        = $this->input->post('pesan_pesan');
		$data['id_materi']        = $this->input->post('pesan_id_materi');

		if ($type == 'insert')
		{
			$id = $this->pesan_model->insert($data);

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
			$return = $this->pesan_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}