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

		$this->auth->restrict('TahunAkademik.Master.View');
		$this->load->model('tahunakademik_model', null, true);
		$this->lang->load('tahunakademik');
		
			Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
			Assets::add_js('jquery-ui-1.8.13.min.js');
		Template::set_block('sub_nav', 'master/_sub_nav');

		Assets::add_module_js('tahunakademik', 'tahunakademik.js');
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
					$result = $this->tahunakademik_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('tahunakademik_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('tahunakademik_delete_failure') . $this->tahunakademik_model->error, 'error');
				}
			}
		}

		$records = $this->tahunakademik_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage TahunAkademik');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a TahunAkademik object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('TahunAkademik.Master.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_tahunakademik())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('tahunakademik_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'tahunakademik');

				Template::set_message(lang('tahunakademik_create_success'), 'success');
				redirect(SITE_AREA .'/master/tahunakademik');
			}
			else
			{
				Template::set_message(lang('tahunakademik_create_failure') . $this->tahunakademik_model->error, 'error');
			}
		}
		Assets::add_module_js('tahunakademik', 'tahunakademik.js');

		Template::set('toolbar_title', lang('tahunakademik_create') . ' TahunAkademik');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of TahunAkademik data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('tahunakademik_invalid_id'), 'error');
			redirect(SITE_AREA .'/master/tahunakademik');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('TahunAkademik.Master.Edit');

			if ($this->save_tahunakademik('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('tahunakademik_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'tahunakademik');

				Template::set_message(lang('tahunakademik_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('tahunakademik_edit_failure') . $this->tahunakademik_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('TahunAkademik.Master.Delete');

			if ($this->tahunakademik_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('tahunakademik_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'tahunakademik');

				Template::set_message(lang('tahunakademik_delete_success'), 'success');

				redirect(SITE_AREA .'/master/tahunakademik');
			}
			else
			{
				Template::set_message(lang('tahunakademik_delete_failure') . $this->tahunakademik_model->error, 'error');
			}
		}
		Template::set('tahunakademik', $this->tahunakademik_model->find($id));
		Template::set('toolbar_title', lang('tahunakademik_edit') .' TahunAkademik');
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
	private function save_tahunakademik($type='insert', $id=0)
	{
		$extra_unique_rule = "";
		if ($type == 'update')
		{
			$_POST['id'] = $id;
			$extra_unique_rule = ',tahunakademik.id';
		}else{
			$data['buka']        = "N";
		}

		// make sure we only pass in the fields we want
		$this->form_validation->set_rules('tahunakademik_tahun','Tahun','is_natural|required|max_length[4]');
		$this->form_validation->set_rules('tahunakademik_semester','Semester','is_natural|required|max_length[1]');
		$this->form_validation->set_rules('tahunakademik_nama_tahun','Nama','required|max_length[100]');
		$this->form_validation->set_rules('tahunakademik_tahun_id','Tahun Akademik','required|max_length[5]|unique[tahunakademik.tahun_id' . $extra_unique_rule . ']');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		
		$data = array();
		$data['tahun_id']     	= $this->input->post('tahunakademik_tahun').$this->input->post('tahunakademik_semester');
		$data['tahun']        	= $this->input->post('tahunakademik_tahun');
		$data['semester']        = $this->input->post('tahunakademik_semester');
		$data['nama_tahun']        = $this->input->post('tahunakademik_nama_tahun');
		$data['krs_mulai']        = $this->input->post('tahunakademik_krs_mulai') ? $this->input->post('tahunakademik_krs_mulai') : '0000-00-00';
		$data['krs_selesai']        = $this->input->post('tahunakademik_krs_selesai') ? $this->input->post('tahunakademik_krs_selesai') : '0000-00-00';
		$data['krs_online_mulai']        = $this->input->post('tahunakademik_krs_online_mulai') ? $this->input->post('tahunakademik_krs_online_mulai') : '0000-00-00';
		$data['krs_online_selesai']        = $this->input->post('tahunakademik_krs_online_selesai') ? $this->input->post('tahunakademik_krs_online_selesai') : '0000-00-00';
		$data['krs_ubah_mulai']        = $this->input->post('tahunakademik_krs_ubah_mulai') ? $this->input->post('tahunakademik_krs_ubah_mulai') : '0000-00-00';
		$data['krs_ubah_selesai']        = $this->input->post('tahunakademik_krs_ubah_selesai') ? $this->input->post('tahunakademik_krs_ubah_selesai') : '0000-00-00';
		$data['kss_cetak_mulai']        = $this->input->post('tahunakademik_kss_cetak_mulai') ? $this->input->post('tahunakademik_kss_cetak_mulai') : '0000-00-00';
		$data['kss_cetak_selesai']        = $this->input->post('tahunakademik_kss_cetak_selesai') ? $this->input->post('tahunakademik_kss_cetak_selesai') : '0000-00-00';
		$data['cuti']        = $this->input->post('tahunakademik_cuti') ? $this->input->post('tahunakademik_cuti') : '0000-00-00';
		$data['mundur']        = $this->input->post('tahunakademik_mundur') ? $this->input->post('tahunakademik_mundur') : '0000-00-00';
		$data['bayar_mulai']        = $this->input->post('tahunakademik_bayar_mulai') ? $this->input->post('tahunakademik_bayar_mulai') : '0000-00-00';
		$data['bayar_selesai']        = $this->input->post('tahunakademik_bayar_selesai') ? $this->input->post('tahunakademik_bayar_selesai') : '0000-00-00';
		$data['kuliah_mulai']        = $this->input->post('tahunakademik_kuliah_mulai') ? $this->input->post('tahunakademik_kuliah_mulai') : '0000-00-00';
		$data['kuliah_selesai']        = $this->input->post('tahunakademik_kuliah_selesai') ? $this->input->post('tahunakademik_kuliah_selesai') : '0000-00-00';
		$data['uts_mulai']        = $this->input->post('tahunakademik_uts_mulai') ? $this->input->post('tahunakademik_uts_mulai') : '0000-00-00';
		$data['uts_selesai']        = $this->input->post('tahunakademik_uts_selesai') ? $this->input->post('tahunakademik_uts_selesai') : '0000-00-00';
		$data['uas_mulai']        = $this->input->post('tahunakademik_uas_mulai') ? $this->input->post('tahunakademik_uas_mulai') : '0000-00-00';
		$data['uas_selesai']        = $this->input->post('tahunakademik_uas_selesai') ? $this->input->post('tahunakademik_uas_selesai') : '0000-00-00';
		$data['nilai']        = $this->input->post('tahunakademik_nilai') ? $this->input->post('tahunakademik_nilai') : '0000-00-00';
		$data['akhir_kss']        = $this->input->post('tahunakademik_akhir_kss') ? $this->input->post('tahunakademik_akhir_kss') : '0000-00-00';
		$data['proses_buka']        = $this->input->post('tahunakademik_proses_buka');
		$data['proses_ipk']        = $this->input->post('tahunakademik_proses_ipk');
		$data['proses_tutup']        = $this->input->post('tahunakademik_proses_tutup');
		
		$data['syarat_krs']        = $this->input->post('tahunakademik_syarat_krs');
		$data['syarat_krs_ips']        = $this->input->post('tahunakademik_syarat_krs_ips');
		$data['cuti_selesai']        = $this->input->post('tahunakademik_cuti_selesai') ? $this->input->post('tahunakademik_cuti_selesai') : '0000-00-00';
		$data['max_sks']        = $this->input->post('tahunakademik_max_sks');

		if ($type == 'insert')
		{
			$id = $this->tahunakademik_model->insert($data);

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
			$return = $this->tahunakademik_model->update($id, $data);
		}

		return $return;
	}
	public function changestatusbuka()
	{
		$this->auth->restrict('TahunAkademik.Master.Create');
		$kdtahun 	= $this->input->post('kdtahun');
		$stat 	= $this->input->post('stat');
		//die($stat);
		$this->db->query('update simak_tahunakademik set buka = "N"');
		//$this->db->query('update simak_mastermatakuliah set status_mata_kuliah = "N" where tahun_akademik != "'.$kdtahun.'"');
		//$this->db->query('update simak_mastermatakuliah set status_mata_kuliah = "A" where tahun_akademik = "'.$kdtahun.'"');
		$this->db->query('update simak_settings set value = "'.$kdtahun.'" where name = "site.tahun"');
			
		$data = array();
		$data['buka']        = $stat;
		$return = $this->tahunakademik_model->update_where("tahun_id",$kdtahun, $data);
		die("sukses");
		exit();
	}
	//--------------------------------------------------------------------


}