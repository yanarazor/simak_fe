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

		$this->auth->restrict('MasterBadanHukum.Master.View');
		$this->load->model('masterbadanhukum_model', null, true);
		$this->lang->load('masterbadanhukum');
		
			Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
			Assets::add_js('jquery-ui-1.8.13.min.js');
		Template::set_block('sub_nav', 'master/_sub_nav');

		Assets::add_module_js('masterbadanhukum', 'masterbadanhukum.js');
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
					$result = $this->masterbadanhukum_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('masterbadanhukum_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('masterbadanhukum_delete_failure') . $this->masterbadanhukum_model->error, 'error');
				}
			}
		}

		$records = $this->masterbadanhukum_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage MasterBadanHukum');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a MasterBadanHukum object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('MasterBadanHukum.Master.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_masterbadanhukum())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('masterbadanhukum_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'masterbadanhukum');

				Template::set_message(lang('masterbadanhukum_create_success'), 'success');
				redirect(SITE_AREA .'/master/masterbadanhukum');
			}
			else
			{
				Template::set_message(lang('masterbadanhukum_create_failure') . $this->masterbadanhukum_model->error, 'error');
			}
		}
		Assets::add_module_js('masterbadanhukum', 'masterbadanhukum.js');

		Template::set('toolbar_title', lang('masterbadanhukum_create') . ' MasterBadanHukum');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of MasterBadanHukum data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('masterbadanhukum_invalid_id'), 'error');
			redirect(SITE_AREA .'/master/masterbadanhukum');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('MasterBadanHukum.Master.Edit');

			if ($this->save_masterbadanhukum('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('masterbadanhukum_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'masterbadanhukum');

				Template::set_message(lang('masterbadanhukum_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('masterbadanhukum_edit_failure') . $this->masterbadanhukum_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('MasterBadanHukum.Master.Delete');

			if ($this->masterbadanhukum_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('masterbadanhukum_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'masterbadanhukum');

				Template::set_message(lang('masterbadanhukum_delete_success'), 'success');

				redirect(SITE_AREA .'/master/masterbadanhukum');
			}
			else
			{
				Template::set_message(lang('masterbadanhukum_delete_failure') . $this->masterbadanhukum_model->error, 'error');
			}
		}
		Template::set('masterbadanhukum', $this->masterbadanhukum_model->find($id));
		Template::set('toolbar_title', lang('masterbadanhukum_edit') .' MasterBadanHukum');
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
	private function save_masterbadanhukum($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['kode_badan_hukum']        = $this->input->post('masterbadanhukum_kode_badan_hukum');
		$data['nama_badan_hukum']        = $this->input->post('masterbadanhukum_nama_badan_hukum');
		$data['alamat1']        = $this->input->post('masterbadanhukum_alamat1');
		$data['alamat2']        = $this->input->post('masterbadanhukum_alamat2');
		$data['kota']        = $this->input->post('masterbadanhukum_kota');
		$data['kode_pos']        = $this->input->post('masterbadanhukum_kode_pos');
		$data['telepon']        = $this->input->post('masterbadanhukum_telepon');
		$data['fax']        = $this->input->post('masterbadanhukum_fax');
		$data['tgl_akta']        = $this->input->post('masterbadanhukum_tgl_akta') ? $this->input->post('masterbadanhukum_tgl_akta') : '0000-00-00';
		$data['no_akta']        = $this->input->post('masterbadanhukum_no_akta');
		$data['tgl_pengesahan']        = $this->input->post('masterbadanhukum_tgl_pengesahan') ? $this->input->post('masterbadanhukum_tgl_pengesahan') : '0000-00-00';
		$data['no_pengesahan']        = $this->input->post('masterbadanhukum_no_pengesahan');
		$data['email_badan_hukum']        = $this->input->post('masterbadanhukum_email_badan_hukum');
		$data['website_badan_hukum']        = $this->input->post('masterbadanhukum_website_badan_hukum');
		$data['tgl_pendirian']        = $this->input->post('masterbadanhukum_tgl_pendirian') ? $this->input->post('masterbadanhukum_tgl_pendirian') : '0000-00-00';

		if ($type == 'insert')
		{
			$id = $this->masterbadanhukum_model->insert($data);

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
			$return = $this->masterbadanhukum_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}