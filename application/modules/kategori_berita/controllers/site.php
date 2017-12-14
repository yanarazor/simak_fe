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

		$this->auth->restrict('Kategori_Berita.Site.View');
		$this->load->model('kategori_berita_model', null, true);
		$this->lang->load('kategori_berita');
		
		Template::set_block('sub_nav', 'site/_sub_nav');

		Assets::add_module_js('kategori_berita', 'kategori_berita.js');
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
					$result = $this->kategori_berita_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('kategori_berita_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('kategori_berita_delete_failure') . $this->kategori_berita_model->error, 'error');
				}
			}
		}

		$records = $this->kategori_berita_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', '&nbsp;&nbsp; Pengelolaan Kategori Berita');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Kategori Berita object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Kategori_Berita.Site.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_kategori_berita())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('kategori_berita_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'kategori_berita');

				Template::set_message(lang('kategori_berita_create_success'), 'success');
				redirect(SITE_AREA .'/site/kategori_berita');
			}
			else
			{
				Template::set_message(lang('kategori_berita_create_failure') . $this->kategori_berita_model->error, 'error');
			}
		}
		Assets::add_module_js('kategori_berita', 'kategori_berita.js');

		Template::set('toolbar_title', '&nbsp;&nbsp;'.lang('kategori_berita_create') . ' Kategori Berita');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Kategori Berita data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('kategori_berita_invalid_id'), 'error');
			redirect(SITE_AREA .'/site/kategori_berita');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Kategori_Berita.Site.Edit');

			if ($this->save_kategori_berita('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('kategori_berita_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'kategori_berita');

				Template::set_message(lang('kategori_berita_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('kategori_berita_edit_failure') . $this->kategori_berita_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Kategori_Berita.Site.Delete');

			if ($this->kategori_berita_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('kategori_berita_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'kategori_berita');

				Template::set_message(lang('kategori_berita_delete_success'), 'success');

				redirect(SITE_AREA .'/site/kategori_berita');
			}
			else
			{
				Template::set_message(lang('kategori_berita_delete_failure') . $this->kategori_berita_model->error, 'error');
			}
		}
		Template::set('kategori_berita', $this->kategori_berita_model->find($id));
		Template::set('toolbar_title', '&nbsp;&nbsp;'.lang('kategori_berita_edit') .' Kategori Berita');
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
	private function save_kategori_berita($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['category']        = $this->input->post('kategori_berita_category');
		$data['description']        = $this->input->post('kategori_berita_description');

		if ($type == 'insert')
		{
			$id = $this->kategori_berita_model->insert($data);

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
			$return = $this->kategori_berita_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}