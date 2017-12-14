<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * site controller
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

		$this->auth->restrict('Informasi_dan_Berita.Content.View');
		$this->load->model('informasi_dan_berita_model', null, true);
		$this->lang->load('informasi_dan_berita');
		
			Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
			Assets::add_js('jquery-ui-1.8.13.min.js');
			Assets::add_css('jquery-ui-timepicker.css');
			Assets::add_js('jquery-ui-timepicker-addon.js');
			
			Assets::add_js('jquery.uniform.min.js');
		Assets::add_js('jquery.cleditor.min.js');
		Assets::add_js('jquery.imagesloaded.js');
		Assets::add_js('custom.js'); 
		
		Template::set_block('sub_nav', 'content/_sub_nav');

		Assets::add_module_js('informasi_dan_berita', 'informasi_dan_berita.js');
		
		$this->load->model('kategori_informasi/kategori_informasi_model', null, true);
		$kategoris = $this->kategori_informasi_model->find_all();
		Template::set('kategoris', $kategoris);
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
					$result = $this->informasi_dan_berita_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('informasi_dan_berita_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('informasi_dan_berita_delete_failure') . $this->informasi_dan_berita_model->error, 'error');
				}
			}
		}
		
		$kat = $this->input->get('kat');
		$title = $this->input->get('title');
		
		$this->load->library('pagination');
		$total = count($this->informasi_dan_berita_model->find_all($kat,$title));
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url()."?kat=".$kat."&title=".$title;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		$records = $this->informasi_dan_berita_model->limit($limit, $offset)->find_all($kat,$title);

		Template::set('records', $records);
		Template::set('total', $total);
		Template::set('kat', $kat);
		Template::set('title', $title);
		Template::set('toolbar_title', 'Manage Informasi dan Berita');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Informasi dan Berita object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Informasi_dan_Berita.Content.Create');

		if (isset($_POST['save']))
		{
			$this->load->helper('handle_upload');
			$uploadData = array();
			$upload = true;
			
			
			if (isset($_FILES['file_upload']) && is_array($_FILES['file_upload']) && $_FILES['file_upload']['error'] != 4)
			{
				//die($this->settings_lib->item('site.pathimages'));
				$uploadData = handle_upload('file_upload',$this->settings_lib->item('site.pathimages'));
				 
				if (isset($uploadData['error']) && !empty($uploadData['error']))
				{
					$upload = false;
				}
			} 		
			if ($insert_id = $this->save_informasi_dan_berita($uploadData))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('informasi_dan_berita_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'informasi_dan_berita');

				Template::set_message(lang('informasi_dan_berita_create_success'), 'success');
				redirect(SITE_AREA .'/content/informasi_dan_berita');
			}
			else
			{
				Template::set_message(lang('informasi_dan_berita_create_failure') . $this->informasi_dan_berita_model->error, 'error');
			}
		}
		Assets::add_module_js('informasi_dan_berita', 'informasi_dan_berita.js');

		Template::set('toolbar_title', lang('informasi_dan_berita_create') . ' Informasi dan Berita');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Informasi dan Berita data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('informasi_dan_berita_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/informasi_dan_berita');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Informasi_dan_Berita.Content.Edit');
			$this->load->helper('handle_upload');
			$uploadData = array();
			$upload = true;
			if (isset($_FILES['file_upload']) && is_array($_FILES['file_upload']) && $_FILES['file_upload']['error'] != 4)
			{
				
				$uploadData = handle_upload('file_upload',$this->settings_lib->item('site.pathimages'));
				if (isset($uploadData['error']) && !empty($uploadData['error']))
				{
					//die($uploadData['error']);
					$upload = false;
				}
			}
			if ($this->save_informasi_dan_berita($uploadData,'update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('informasi_dan_berita_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'informasi_dan_berita');

				Template::set_message(lang('informasi_dan_berita_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('informasi_dan_berita_edit_failure') . $this->informasi_dan_berita_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Informasi_dan_Berita.Content.Delete');

			if ($this->informasi_dan_berita_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('informasi_dan_berita_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'informasi_dan_berita');

				Template::set_message(lang('informasi_dan_berita_delete_success'), 'success');

				redirect(SITE_AREA .'/content/informasi_dan_berita');
			}
			else
			{
				Template::set_message(lang('informasi_dan_berita_delete_failure') . $this->informasi_dan_berita_model->error, 'error');
			}
		}
		Template::set('informasi_dan_berita', $this->informasi_dan_berita_model->find($id));
		Template::set('toolbar_title', lang('informasi_dan_berita_edit') .' Informasi dan Berita');
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
	private function save_informasi_dan_berita($uploadData = false,$type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id_berita'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['judul']        = $this->input->post('informasi_dan_berita_judul');
		$data['headline']        = $this->input->post('informasi_dan_berita_headline');
		$data['id_category']        = $this->input->post('informasi_dan_berita_id_category');
		$data['content']        = $this->input->post('informasi_dan_berita_content');
		$data['createdby']        = $this->current_user->id;
		$data['tgl_create']        = date("Y-m-d");;
		//$data['foto']        = $this->input->post('informasi_dan_berita_foto');
		$data['jam']        = date("Y-m-d H:i:s");
		$data['auth_komen']        = $this->input->post('informasi_dan_berita_auth_komen');
		$data['jml_dilihat']        = $this->input->post('informasi_dan_berita_jml_dilihat');
		if ($uploadData !== false && is_array($uploadData) && count($uploadData) > 0 && isset($uploadData['data']['file_name']))
		{
			//die(serialize($uploadData['data']));
			$data = $data + array('foto'=>$uploadData['data']['file_name']);
			
		} 
		if ($type == 'insert')
		{
			$id = $this->informasi_dan_berita_model->insert($data);

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
			$return = $this->informasi_dan_berita_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}