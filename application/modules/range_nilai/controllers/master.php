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

		
		$this->load->model('range_nilai_model', null, true);
		$this->lang->load('range_nilai');
		
		Template::set_block('sub_nav', 'master/_sub_nav');

		Assets::add_module_js('range_nilai', 'range_nilai.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{
		$this->auth->restrict('Range_Nilai.Master.View');
		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$result = $this->range_nilai_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('range_nilai_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('range_nilai_delete_failure') . $this->range_nilai_model->error, 'error');
				}
			}
		}

		$records = $this->range_nilai_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Range Nilai');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Range Nilai object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Range_Nilai.Master.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_range_nilai())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('range_nilai_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'range_nilai');

				Template::set_message(lang('range_nilai_create_success'), 'success');
				redirect(SITE_AREA .'/master/range_nilai');
			}
			else
			{
				Template::set_message(lang('range_nilai_create_failure') . $this->range_nilai_model->error, 'error');
			}
		}
		Assets::add_module_js('range_nilai', 'range_nilai.js');

		Template::set('toolbar_title', lang('range_nilai_create') . ' Range Nilai');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Range Nilai data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('range_nilai_invalid_id'), 'error');
			redirect(SITE_AREA .'/master/range_nilai');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Range_Nilai.Master.Edit');

			if ($this->save_range_nilai('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('range_nilai_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'range_nilai');

				Template::set_message(lang('range_nilai_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('range_nilai_edit_failure') . $this->range_nilai_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Range_Nilai.Master.Delete');

			if ($this->range_nilai_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('range_nilai_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'range_nilai');

				Template::set_message(lang('range_nilai_delete_success'), 'success');

				redirect(SITE_AREA .'/master/range_nilai');
			}
			else
			{
				Template::set_message(lang('range_nilai_delete_failure') . $this->range_nilai_model->error, 'error');
			}
		}
		Template::set('range_nilai', $this->range_nilai_model->find($id));
		Template::set('toolbar_title', lang('range_nilai_edit') .' Range Nilai');
		Template::render();
	}
	public function getnilai()
	{
		$nilaiangka 	= $this->input->post('nilai');
		$nilaihuruf = "";
		$recordnilai = $this->range_nilai_model->find_range($nilaiangka);
		if (isset($recordnilai) && is_array($recordnilai) && count($recordnilai)) :
		foreach ($recordnilai as $record) : 
			$nilaihuruf = $record->nilai_huruf;
		endforeach;
		endif;
	 	echo $nilaihuruf;
		exit();
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
	private function save_range_nilai($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['dari']        = $this->input->post('range_nilai_dari');
		$data['sampai']        = $this->input->post('range_nilai_sampai');
		$data['nilai_huruf']        = $this->input->post('range_nilai_nilai_huruf');

		if ($type == 'insert')
		{
			$id = $this->range_nilai_model->insert($data);

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
			$return = $this->range_nilai_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}