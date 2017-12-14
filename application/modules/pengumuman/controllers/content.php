<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * content controller
 */
class content extends Admin_Controller
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

		$this->auth->restrict('Pengumuman.Content.View');
		$this->load->model('pengumuman_model', null, true);
		$this->lang->load('pengumuman');
		
			Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
			Assets::add_js('jquery-ui-1.8.13.min.js');
		Template::set_block('sub_nav', 'content/_sub_nav');

		Assets::add_module_js('pengumuman', 'pengumuman.js');
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
					$result = $this->pengumuman_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('pengumuman_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('pengumuman_delete_failure') . $this->pengumuman_model->error, 'error');
				}
			}
		}

		$records = $this->pengumuman_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage pengumuman');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a pengumuman object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Pengumuman.Content.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_pengumuman())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('pengumuman_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'pengumuman');

				Template::set_message(lang('pengumuman_create_success'), 'success');
				redirect(SITE_AREA .'/content/pengumuman');
			}
			else
			{
				Template::set_message(lang('pengumuman_create_failure') . $this->pengumuman_model->error, 'error');
			}
		}
		Assets::add_module_js('pengumuman', 'pengumuman.js');

		Template::set('toolbar_title', lang('pengumuman_create') . ' pengumuman');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of pengumuman data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('pengumuman_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/pengumuman');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Pengumuman.Content.Edit');

			if ($this->save_pengumuman('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('pengumuman_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'pengumuman');

				Template::set_message(lang('pengumuman_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('pengumuman_edit_failure') . $this->pengumuman_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Pengumuman.Content.Delete');

			if ($this->pengumuman_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('pengumuman_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'pengumuman');

				Template::set_message(lang('pengumuman_delete_success'), 'success');

				redirect(SITE_AREA .'/content/pengumuman');
			}
			else
			{
				Template::set_message(lang('pengumuman_delete_failure') . $this->pengumuman_model->error, 'error');
			}
		}
		Template::set('pengumuman', $this->pengumuman_model->find($id));
		Template::set('toolbar_title', lang('pengumuman_edit') .' pengumuman');
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
	private function save_pengumuman($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['tgl_pengumuman']        = $this->input->post('pengumuman_tgl_pengumuman') ? $this->input->post('pengumuman_tgl_pengumuman') : '0000-00-00';
		$data['tgl_awal']        = $this->input->post('pengumuman_tgl_awal') ? $this->input->post('pengumuman_tgl_awal') : '0000-00-00';
		$data['tgl_akhir']        = $this->input->post('pengumuman_tgl_akhir') ? $this->input->post('pengumuman_tgl_akhir') : '0000-00-00';
		$data['judul']        = $this->input->post('pengumuman_judul');
		$data['content']        = $this->input->post('pengumuman_content');
		$data['user_id']        = $this->input->post('pengumuman_user_id');
		$data['files']        = $this->input->post('pengumuman_files');

		if ($type == 'insert')
		{
			$id = $this->pengumuman_model->insert($data);

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
			$return = $this->pengumuman_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}