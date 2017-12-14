<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * frm controller
 */
class frm extends Admin_Controller
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

		$this->auth->restrict('Forum.Frm.View');
		$this->load->model('forum_model', null, true);
		$this->load->model('forum/komen_model', null, true);
		$this->lang->load('forum');
		
			Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
			Assets::add_js('jquery-ui-1.8.13.min.js');
		Template::set_block('sub_nav', 'frm/_sub_nav');

		Assets::add_module_js('forum', 'forum.js');
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
					$result = $this->forum_model->delete($pid);
					$data = array('id_berita '=>$pid);
					$this->komen_model->delete_where($data);
					
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('forum_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('forum_delete_failure') . $this->forum_model->error, 'error');
				}
			}
		}
		  
		$keyword = $this->input->get('keyword');
		$this->load->library('pagination');
		$total = count($this->forum_model->find_all($keyword));
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url()."?keyword=".$keyword;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		$records = $this->forum_model->limit($limit, $offset)->find_all($keyword);
		
		$forumpopulers = $this->forum_model->limit(10)->find_populer(date("Y"));
		Template::set('forumpopulers', $forumpopulers);
		$komenterbanyaks = $this->forum_model->limit(10)->find_komenterbanyak(date("Y"));
		Template::set('komenterbanyaks', $komenterbanyaks);
  		if(isset($komenterbanyaks[0]->id))
			Template::set('komen_record', $this->komen_model->getbyforum($komenterbanyaks[0]->id));
		
		
		
		$current_user_id = $this->current_user->id;
		Template::set('current_user_id', $current_user_id);
		
		Template::set('records', $records);
		Template::set('total', $total); 
		Template::set('keyword', $keyword); 
		Template::set('toolbar_title', 'Manage Forum');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Forum object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Forum.Frm.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_forum())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('forum_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'forum');

				Template::set_message(lang('forum_create_success'), 'success');
				redirect(SITE_AREA .'/frm/forum');
			}
			else
			{
				Template::set_message(lang('forum_create_failure') . $this->forum_model->error, 'error');
			}
		}
		Assets::add_module_js('forum', 'forum.js');

		Template::set('toolbar_title', lang('forum_create') . ' Forum');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Forum data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('forum_invalid_id'), 'error');
			redirect(SITE_AREA .'/frm/forum');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Forum.Frm.Edit');

			if ($this->save_forum('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('forum_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'forum');

				Template::set_message(lang('forum_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('forum_edit_failure') . $this->forum_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Forum.Frm.Delete');

			if ($this->forum_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('forum_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'forum');

				Template::set_message(lang('forum_delete_success'), 'success');

				redirect(SITE_AREA .'/frm/forum');
			}
			else
			{
				Template::set_message(lang('forum_delete_failure') . $this->forum_model->error, 'error');
			}
		}
		Template::set('forum', $this->forum_model->find($id));
		Template::set('toolbar_title', lang('forum_edit') .' Forum');
		Template::render();
	}
	public function view()
	{
		$id = $this->uri->segment(5);
		Assets::add_css('jquery.wysiwyg.css');  
		Assets::add_css('font-awesome.min.css');  
		Assets::add_js('jquery.wysiwyg.js');

		if (empty($id))
		{
			Template::set_message(lang('forum_invalid_id'), 'error');
			redirect(SITE_AREA .'/frm/forum');
		}

		if (isset($_POST['reply']))
		{
			//$this->auth->restrict('Forum.Frm.Edit');

			if ($this->save_komen())
			{
				// Log the activity
				log_activity($this->current_user->id,' Insert Komen, Pada Thread ID : '. $id .' : '. $this->input->ip_address(), 'forum');

				Template::set_message("Save Komen Sukses", 'success');
			}
			else
			{
				Template::set_message(lang('forum_edit_failure') . $this->forum_model->error, 'error');
			}
		}
		 
		Template::set('forum', $this->forum_model->find($id));
		Template::set('komen_record', $this->komen_model->getbyforum($id));
		Template::set('toolbar_title', lang('forum_edit') .' Forum');
		Template::render();
	}
	public function deletevia_ajax()
	{
		$kode = $this->input->post('id');
		$result = $this->komen_model->delete($kode);
		die();
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
	private function save_forum($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['judul']        = $this->input->post('forum_judul');
		$data['isi']        = $this->input->post('forum_isi');
		$data['usr_id']        = $this->current_user->id;
		$data['tanggal']        = date("Y-m-d");

		if ($type == 'insert')
		{
			$id = $this->forum_model->insert($data);

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
			$return = $this->forum_model->update($id, $data);
		}

		return $return;
	}
	private function save_komen($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}
		$this->form_validation->set_rules('pesan','Pesan','required');
		 if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		
		// make sure we only pass in the fields we want
		
		$data = array();
		$data['id_berita']        = $this->input->post('id_forum');
		$data['isi']        = $this->input->post('pesan');
		$data['usr_id']        = $this->current_user->id;
		$data['tanggal']        = date("Y-m-d");

		if ($type == 'insert')
		{
			$id = $this->komen_model->insert($data);

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
			$return = $this->komen_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}