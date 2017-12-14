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

		$this->auth->restrict('Dokumen.Master.View');
		$this->load->model('dokumen_model', null, true);
		$this->lang->load('dokumen');
		
		Template::set_block('sub_nav', 'master/_sub_nav');

		Assets::add_module_js('dokumen', 'dokumen.js');
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
					$result = $this->dokumen_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('dokumen_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('dokumen_delete_failure') . $this->dokumen_model->error, 'error');
				}
			}
		}

		$records = $this->dokumen_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage dokumen');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a dokumen object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Dokumen.Master.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_dokumen())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('dokumen_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'dokumen');

				Template::set_message(lang('dokumen_create_success'), 'success');
				redirect(SITE_AREA .'/master/dokumen');
			}
			else
			{
				Template::set_message(lang('dokumen_create_failure') . $this->dokumen_model->error, 'error');
			}
		}
		Assets::add_module_js('dokumen', 'dokumen.js');

		Template::set('toolbar_title', lang('dokumen_create') . ' dokumen');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of dokumen data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('dokumen_invalid_id'), 'error');
			redirect(SITE_AREA .'/master/dokumen');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Dokumen.Master.Edit');

			if ($this->save_dokumen('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('dokumen_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'dokumen');

				Template::set_message(lang('dokumen_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('dokumen_edit_failure') . $this->dokumen_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Dokumen.Master.Delete');

			if ($this->dokumen_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('dokumen_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'dokumen');

				Template::set_message(lang('dokumen_delete_success'), 'success');

				redirect(SITE_AREA .'/master/dokumen');
			}
			else
			{
				Template::set_message(lang('dokumen_delete_failure') . $this->dokumen_model->error, 'error');
			}
		}
		Template::set('dokumen', $this->dokumen_model->find($id));
		Template::set('toolbar_title', lang('dokumen_edit') .' dokumen');
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
	function saveberkas(){
		$this->auth->restrict('Dokumen.Master.Create');
    	//die("masuk");
    	 $this->load->helper('handle_upload');
		 $uploadData = array();
		 $upload = true;
		 $id_log = $this->input->post('id_log');
		
		 $id = "";
		 $namafile = "";
		 if (isset($_FILES['userfile']) && is_array($_FILES['userfile']) && $_FILES['userfile']['error'] != 4)
		 {
			$tmp_name = pathinfo($_FILES['userfile']['name'], PATHINFO_FILENAME);
			$uploadData = handle_upload('userfile',$this->settings_lib->item('site.pathuploaded'));
			 if (isset($uploadData['error']) && !empty($uploadData['error']))
			 {
			 	$tipefile=$_FILES['userfile']['type'];
			 	//$tipefile = $_FILES['userfile']['name'];
				 $upload = false;
				 log_activity($this->auth->user_id(), 'Gagal : '.$uploadData['error'].$tipefile.$this->input->ip_address(), 'dokumen');
			 }else{
			 	$namafile = $uploadData['data']['file_name'];
                log_activity($this->auth->user_id(), 'Save dokumen : ' . $id_log . ' : ' . $this->input->ip_address(), 'dokumen');
			 }
		 }else{
		 	die("File tidak ditemukan");
		 	log_activity($this->auth->user_id(), 'File tidak ditemukan : ' . $this->input->ip_address(), 'dokumen');
		 } 	

       echo '{"namafile":"'.$namafile.'"}';
       exit();
	}
	private function save_dokumen($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['nama_dokumen']        = $this->input->post('dokumen_nama_dokumen');
		$data['file']        = $this->input->post('dokumen_file');
		$data['keterangan']        = $this->input->post('dokumen_keterangan');

		if ($type == 'insert')
		{
			$id = $this->dokumen_model->insert($data);

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
			$return = $this->dokumen_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}