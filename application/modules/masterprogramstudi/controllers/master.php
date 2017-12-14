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

		$this->auth->restrict('MasterProgramStudi.Master.View');
		$this->load->model('masterprogramstudi_model', null, true);
		$this->lang->load('masterprogramstudi');
		
			Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
			Assets::add_js('jquery-ui-1.8.13.min.js');
		Template::set_block('sub_nav', 'master/_sub_nav');

		Assets::add_module_js('masterprogramstudi', 'masterprogramstudi.js');
		//master Fakultas
		$this->load->model('masterfakultas/masterfakultas_model', null, true);
		$masterfakultas = $this->masterfakultas_model->find_all();
		Template::set('masterfakultass', $masterfakultas);
		
		//master pilihan
		$this->load->model('pilihan/pilihan_model', null, true);
		$pilihans = $this->pilihan_model->find_all("01");
		Template::set('pilihans', $pilihans);
		$pilihans07 = $this->pilihan_model->find_all("07");
		Template::set('pilihans07', $pilihans07);
		$pilihans29 = $this->pilihan_model->find_all("29");
		Template::set('pilihans29', $pilihans29);
		$pilihans30 = $this->pilihan_model->find_all("30");
		Template::set('pilihans30', $pilihans30);
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
					$result = $this->masterprogramstudi_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('masterprogramstudi_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('masterprogramstudi_delete_failure') . $this->masterprogramstudi_model->error, 'error');
				}
			}
		}
		$fillnama = $this->input->get('fillnama');
		$fillfakultas = $this->input->get('fillfakultas');
		   
		$this->load->library('pagination');
		$total = $this->masterprogramstudi_model->count_all($fillnama,$fillfakultas);
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url() .'?fillnama='.$fillnama."&fillfakultas=".$fillfakultas;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		
		 
		$records = $this->masterprogramstudi_model->limit($limit, $offset)->find_all($fillnama,$fillfakultas); 
		
		Template::set('total', $total);
		Template::set('fillnama', $fillnama);
		Template::set('fillfakultas', $fillfakultas);
		
		Template::set('records', $records);
		Template::set('toolbar_title', ' &nbsp;&nbsp; Pengelolaan Data Program Studi');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a MasterProgramStudi object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('MasterProgramStudi.Master.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_masterprogramstudi())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('masterprogramstudi_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'masterprogramstudi');

				Template::set_message(lang('masterprogramstudi_create_success'), 'success');
				redirect(SITE_AREA .'/master/masterprogramstudi');
			}
			else
			{
				Template::set_message(lang('masterprogramstudi_create_failure') . $this->masterprogramstudi_model->error, 'error');
			}
		}
		Assets::add_module_js('masterprogramstudi', 'masterprogramstudi.js');

		Template::set('toolbar_title', '&nbsp;&nbsp; Tambah Data Program Studi');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of MasterProgramStudi data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('masterprogramstudi_invalid_id'), 'error');
			redirect(SITE_AREA .'/master/masterprogramstudi');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('MasterProgramStudi.Master.Edit');

			if ($this->save_masterprogramstudi('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('masterprogramstudi_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'masterprogramstudi');
				Template::set_message(lang('masterprogramstudi_edit_success'), 'success');
				redirect(SITE_AREA .'/master/masterprogramstudi');
			}
			else
			{
				Template::set_message(lang('masterprogramstudi_edit_failure') . $this->masterprogramstudi_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('MasterProgramStudi.Master.Delete');

			if ($this->masterprogramstudi_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('masterprogramstudi_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'masterprogramstudi');

				Template::set_message(lang('masterprogramstudi_delete_success'), 'success');

				redirect(SITE_AREA .'/master/masterprogramstudi');
			}
			else
			{
				Template::set_message(lang('masterprogramstudi_delete_failure') . $this->masterprogramstudi_model->error, 'error');
			}
		}
		Template::set('masterprogramstudi', $this->masterprogramstudi_model->find($id));
		Template::set('toolbar_title', '&nbsp;&nbsp; Ubah Data Program Studi');
		Template::render();
	}
	public function getbyfakultas()
	{
		$fak 	= $this->input->get('fak');
		 
		$json = array(); 
		$records = $this->masterprogramstudi_model->getbyfakultas($fak);
		if(isset($records) && is_array($records) && count($records)):
			foreach ($records as $record) :
				$json['id'][] = $record->kode_prodi;
				$json['nama_prodi'][] = $record->nama_prodi;
			endforeach;
		endif;
		echo json_encode($json);
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
	private function save_masterprogramstudi($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['kode_fakultas']        = $this->input->post('masterprogramstudi_kode_fakultas');
		$data['kode_prodi']        = $this->input->post('masterprogramstudi_kode_prodi');
		$data['kode_jenjang_studi']        = $this->input->post('masterprogramstudi_kode_jenjang_studi');
		$data['nama_prodi']        = $this->input->post('masterprogramstudi_nama_prodi');
		$data['semester_awal']        = $this->input->post('masterprogramstudi_semester_awal');
		$data['no_sk_dikti']        = $this->input->post('masterprogramstudi_no_sk_dikti');
		$data['tgl_sk_dikti']        = $this->input->post('masterprogramstudi_tgl_sk_dikti') ? $this->input->post('masterprogramstudi_tgl_sk_dikti') : '0000-00-00';
		$data['tgl_akhir_sk_dikti']        = $this->input->post('masterprogramstudi_tgl_akhir_sk_dikti') ? $this->input->post('masterprogramstudi_tgl_akhir_sk_dikti') : '0000-00-00';
		$data['jml_sks_lulus']        = $this->input->post('masterprogramstudi_jml_sks_lulus');
		$data['kode_status']        = $this->input->post('masterprogramstudi_kode_status');
		$data['tahun_semester_mulai']        = $this->input->post('masterprogramstudi_tahun_semester_mulai');
		$data['email_prodi']        = $this->input->post('masterprogramstudi_email_prodi');
		$data['tgl_pendirian_program_studi']        = $this->input->post('masterprogramstudi_tgl_pendirian_program_studi') ? $this->input->post('masterprogramstudi_tgl_pendirian_program_studi') : '0000-00-00';
		$data['no_sk_akreditasi']        = $this->input->post('masterprogramstudi_no_sk_akreditasi');
		$data['tgl_sk_akreditasi']        = $this->input->post('masterprogramstudi_tgl_sk_akreditasi') ? $this->input->post('masterprogramstudi_tgl_sk_akreditasi') : '0000-00-00';
		$data['tgl_akhir_sk_akreditasi']        = $this->input->post('masterprogramstudi_tgl_akhir_sk_akreditasi') ? $this->input->post('masterprogramstudi_tgl_akhir_sk_akreditasi') : '0000-00-00';
		$data['kode_status_akreditasi']        = $this->input->post('masterprogramstudi_kode_status_akreditasi');
		$data['frekuensi_kurikulum']        = $this->input->post('masterprogramstudi_frekuensi_kurikulum');
		$data['pelaksanaan_kurikulum']        = $this->input->post('masterprogramstudi_pelaksanaan_kurikulum');
		$data['nidn_ketua_prodi']        = $this->input->post('masterprogramstudi_nidn_ketua_prodi');
		$data['telp_ketua_prodi']        = $this->input->post('masterprogramstudi_telp_ketua_prodi');
		$data['fax_prodi']        = $this->input->post('masterprogramstudi_fax_prodi');
		$data['nama_operator']        = $this->input->post('masterprogramstudi_nama_operator');
		$data['hp_operator']        = $this->input->post('masterprogramstudi_hp_operator');
		$data['telepon_program_studi']        = $this->input->post('masterprogramstudi_telepon_program_studi');

		if ($type == 'insert')
		{
			$id = $this->masterprogramstudi_model->insert($data);

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
			$return = $this->masterprogramstudi_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}