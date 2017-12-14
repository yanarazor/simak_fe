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

		$this->auth->restrict('Event.Site.View');
		$this->load->model('event_model', null, true);
		$this->lang->load('event');
		
			Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
			Assets::add_js('jquery-ui-1.8.13.min.js');
		Template::set_block('sub_nav', 'site/_sub_nav');

		Assets::add_module_js('event', 'event.js');
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
					$result = $this->event_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('event_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('event_delete_failure') . $this->event_model->error, 'error');
				}
			}
		}

		$records = $this->event_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', '&nbsp;&nbsp;Pengelolaan Kegiatan/Event');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Event object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Event.Site.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_event())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('event_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'event');

				Template::set_message(lang('event_create_success'), 'success');
				redirect(SITE_AREA .'/site/event');
			}
			else
			{
				Template::set_message(lang('event_create_failure') . $this->event_model->error, 'error');
			}
		}
		Assets::add_module_js('event', 'event.js');

		Template::set('toolbar_title','&nbsp;&nbsp;'.lang('event_create') . ' Event');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Event data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('event_invalid_id'), 'error');
			redirect(SITE_AREA .'/site/event');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Event.Site.Edit');

			if ($this->save_event('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('event_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'event');

				Template::set_message(lang('event_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('event_edit_failure') . $this->event_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Event.Site.Delete');

			if ($this->event_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('event_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'event');

				Template::set_message(lang('event_delete_success'), 'success');

				redirect(SITE_AREA .'/site/event');
			}
			else
			{
				Template::set_message(lang('event_delete_failure') . $this->event_model->error, 'error');
			}
		}
		Template::set('event', $this->event_model->find($id));
		Template::set('toolbar_title', '&nbsp;&nbsp;'.lang('event_edit') .' Event');
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
	private function save_event($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}
		$this->form_validation->set_rules('event_tanggal','Tanggal','required|max_length[20]');
		$this->form_validation->set_rules('event_judul','Judul','required|max_length[255]');
		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['tanggal']        = $this->input->post('event_tanggal') ? $this->input->post('event_tanggal') : '0000-00-00';
		$data['judul']        = $this->input->post('event_judul');
		$data['mulai']        = $this->input->post('event_mulai');
		$data['selesai']        = $this->input->post('event_selesai');
		$data['tempat']        = $this->input->post('event_tempat');
		$data['keterangan']        = $this->input->post('event_keterangan');

		if ($type == 'insert')
		{
			$id = $this->event_model->insert($data);

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
			$return = $this->event_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}