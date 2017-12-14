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

		$this->auth->restrict('MasterPerguruanTinggi.Master.View');
		$this->load->model('masterperguruantinggi_model', null, true);
		$this->lang->load('masterperguruantinggi');
		
			Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
			Assets::add_js('jquery-ui-1.8.13.min.js');
		Template::set_block('sub_nav', 'master/_sub_nav');

		Assets::add_module_js('masterperguruantinggi', 'masterperguruantinggi.js');
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
					$result = $this->masterperguruantinggi_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('masterperguruantinggi_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('masterperguruantinggi_delete_failure') . $this->masterperguruantinggi_model->error, 'error');
				}
			}
		}

		$records = $this->masterperguruantinggi_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage MasterPerguruanTinggi');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a MasterPerguruanTinggi object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('MasterPerguruanTinggi.Master.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_masterperguruantinggi())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('masterperguruantinggi_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'masterperguruantinggi');

				Template::set_message(lang('masterperguruantinggi_create_success'), 'success');
				redirect(SITE_AREA .'/master/masterperguruantinggi');
			}
			else
			{
				Template::set_message(lang('masterperguruantinggi_create_failure') . $this->masterperguruantinggi_model->error, 'error');
			}
		}
		Assets::add_module_js('masterperguruantinggi', 'masterperguruantinggi.js');

		Template::set('toolbar_title', lang('masterperguruantinggi_create') . ' MasterPerguruanTinggi');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of MasterPerguruanTinggi data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('masterperguruantinggi_invalid_id'), 'error');
			redirect(SITE_AREA .'/master/masterperguruantinggi');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('MasterPerguruanTinggi.Master.Edit');

			if ($this->save_masterperguruantinggi('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('masterperguruantinggi_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'masterperguruantinggi');

				Template::set_message(lang('masterperguruantinggi_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('masterperguruantinggi_edit_failure') . $this->masterperguruantinggi_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('MasterPerguruanTinggi.Master.Delete');

			if ($this->masterperguruantinggi_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('masterperguruantinggi_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'masterperguruantinggi');

				Template::set_message(lang('masterperguruantinggi_delete_success'), 'success');

				redirect(SITE_AREA .'/master/masterperguruantinggi');
			}
			else
			{
				Template::set_message(lang('masterperguruantinggi_delete_failure') . $this->masterperguruantinggi_model->error, 'error');
			}
		}
		Template::set('masterperguruantinggi', $this->masterperguruantinggi_model->find($id));
		Template::set('toolbar_title', lang('masterperguruantinggi_edit') .' MasterPerguruanTinggi');
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
	private function save_masterperguruantinggi($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['kode_badan_hukum']        = $this->input->post('masterperguruantinggi_kode_badan_hukum');
		$data['kode_pt']        = $this->input->post('masterperguruantinggi_kode_pt');
		$data['nama_pt']        = $this->input->post('masterperguruantinggi_nama_pt');
		$data['alamat_pt_1']        = $this->input->post('masterperguruantinggi_alamat_pt_1');
		$data['alamat_pt_2']        = $this->input->post('masterperguruantinggi_alamat_pt_2');
		$data['kota_pt']        = $this->input->post('masterperguruantinggi_kota_pt');
		$data['kodepos_pt']        = $this->input->post('masterperguruantinggi_kodepos_pt');
		$data['telepon_pt']        = $this->input->post('masterperguruantinggi_telepon_pt');
		$data['fax_pt']        = $this->input->post('masterperguruantinggi_fax_pt');
		$data['tgl_akta_pt']        = $this->input->post('masterperguruantinggi_tgl_akta_pt') ? $this->input->post('masterperguruantinggi_tgl_akta_pt') : '0000-00-00';
		$data['no_akta_pt']        = $this->input->post('masterperguruantinggi_no_akta_pt');
		$data['email_pt']        = $this->input->post('masterperguruantinggi_email_pt');
		$data['website_pt']        = $this->input->post('masterperguruantinggi_website_pt');
		$data['tgl_pendirian_pt']        = $this->input->post('masterperguruantinggi_tgl_pendirian_pt') ? $this->input->post('masterperguruantinggi_tgl_pendirian_pt') : '0000-00-00';

		if ($type == 'insert')
		{
			$id = $this->masterperguruantinggi_model->insert($data);

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
			$return = $this->masterperguruantinggi_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}