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

		$this->auth->restrict('MasterMataKuliah.Master.View');
		$this->load->model('mastermatakuliah_model', null, true);
		$this->lang->load('mastermatakuliah');
		
		Template::set_block('sub_nav', 'master/_sub_nav');

		Assets::add_module_js('mastermatakuliah', 'mastermatakuliah.js');
		//master Fakultas
		$this->load->model('masterfakultas/masterfakultas_model', null, true);
		$masterfakultas = $this->masterfakultas_model->find_all();
		Template::set('masterfakultass', $masterfakultas);
		//master jurusan
		$this->load->model('masterprogramstudi/masterprogramstudi_model', null, true);
		$masterprogramstudis = $this->masterprogramstudi_model->find_all();
		Template::set('masterprogramstudis', $masterprogramstudis);
		
		//master pilihan
		$this->load->model('pilihan/pilihan_model', null, true);
		$pilihans = $this->pilihan_model->find_all("04");
		Template::set('pilihans', $pilihans);
		$pilihans10 = $this->pilihan_model->find_all("10");
		Template::set('pilihans10', $pilihans10);
		$pilihans11 = $this->pilihan_model->find_all("11");
		Template::set('pilihans11', $pilihans11);
		$pilihans28 = $this->pilihan_model->find_all("28");
		Template::set('pilihans28', $pilihans28);
		$pilihans04 = $this->pilihan_model->find_all("04");
		Template::set('pilihans04', $pilihans04);
		$pilihans14 = $this->pilihan_model->find_all("14");
		Template::set('pilihans14', $pilihans14);
		
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
					$result = $this->mastermatakuliah_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('mastermatakuliah_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('mastermatakuliah_delete_failure') . $this->mastermatakuliah_model->error, 'error');
				}
			}
		}
		$statsms 		= $this->input->get('statsms');
		$filfakultas 	= $this->input->get('filfakultas');
		$filljurusan 	= $this->input->get('filljurusan');
		$fillkodemk 	= $this->input->get('fillkodemk');
		$fillnamamk 	= $this->input->get('fillnamamk');
		$sms 			= $this->input->get('sms');
		   
		$this->load->library('pagination');
		$total = $this->mastermatakuliah_model->count_all($statsms,$filfakultas,$filljurusan,$fillkodemk,$fillnamamk,$sms);
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url() .'?statsms='.$statsms.'&filfakultas='.$filfakultas."&filljurusan=".$filljurusan."&fillkodemk=".$fillkodemk."&fillnamamk=".$fillnamamk."&sms=".$sms;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);

		$records = $this->mastermatakuliah_model->limit($limit, $offset)->find_all($statsms,$filfakultas,$filljurusan,$fillkodemk,$fillnamamk,$sms); 
		
		Template::set('total', $total);
		Template::set('sms', $sms);
		Template::set('statsms', $statsms);
		Template::set('filfakultas', $filfakultas);
		Template::set('filljurusan', $filljurusan);
		Template::set('fillkodemk', $fillkodemk);
		Template::set('fillnamamk', $fillnamamk);
		Template::set('records', $records);
		Template::set('toolbar_title', '&nbsp;&nbsp;Pengelolaan Mata Kuliah / Kurikulum');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a MasterMataKuliah object.
	 *
	 * @return void
	 */
	public function create()
	{
		
		$this->auth->restrict('MasterMataKuliah.Master.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_mastermatakuliah())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('mastermatakuliah_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'mastermatakuliah');

				Template::set_message(lang('mastermatakuliah_create_success'), 'success');
				redirect(SITE_AREA .'/master/mastermatakuliah/create');
			}
			else
			{
				Template::set_message(lang('mastermatakuliah_create_failure') . $this->mastermatakuliah_model->error, 'error');
			}
		}
		Assets::add_module_js('mastermatakuliah', 'mastermatakuliah.js');

		Template::set('toolbar_title','&nbsp;&nbsp; Tambah Data Mata Kuliah');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of MasterMataKuliah data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);
		$this->load->model('datakrs/datakrs_model', null, true);
		$this->load->model('transkip/transkip_model', null, true);
		
		if (empty($id))
		{
			Template::set_message(lang('mastermatakuliah_invalid_id'), 'error');
			redirect(SITE_AREA .'/master/mastermatakuliah');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('MasterMataKuliah.Master.Edit');

			if ($this->save_mastermatakuliah('update', $id))
			{
				// update ke tabel krs dan transkip jika ada yang beda nama matakuliahnya
				$data_detil	= $this->mastermatakuliah_model->find($id);
				//$this->datakrs_model->update_nama_matakuliah($data_detil->kode_mata_kuliah, $data_detil->nama_mata_kuliah, $data_detil->kode_prodi);
				//$this->transkip_model->update_nama_matakuliah($data_detil->kode_mata_kuliah, $data_detil->nama_mata_kuliah, $data_detil->kode_prodi);
				
				// Log the activity
				log_activity($this->current_user->id, lang('mastermatakuliah_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'mastermatakuliah');
				Template::set_message(lang('mastermatakuliah_edit_success'), 'success');
				redirect(SITE_AREA .'/master/mastermatakuliah');
			}
			else
			{
				Template::set_message(lang('mastermatakuliah_edit_failure') . $this->mastermatakuliah_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('MasterMataKuliah.Master.Delete');

			if ($this->mastermatakuliah_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('mastermatakuliah_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'mastermatakuliah');

				Template::set_message(lang('mastermatakuliah_delete_success'), 'success');

				redirect(SITE_AREA .'/master/mastermatakuliah');
			}
			else
			{
				Template::set_message(lang('mastermatakuliah_delete_failure') . $this->mastermatakuliah_model->error, 'error');
			}
		}
		$data_detil	= $this->mastermatakuliah_model->find($id);
		 
		Template::set('mastermatakuliah', $data_detil);
		Template::set('toolbar_title', '&nbsp;&nbsp; Ubah Data Mata Kuliah');
		Template::render();
	}
	
	public function getbytahun()
	{
		$tahun_akademik 	= $this->input->get('tahun_akademik');
		$jadwal_prodi 		= $this->input->get('jadwal_prodi');
		$jadwal_semester 	= $this->input->get('jadwal_semester');
		
		$json = array(); 
		$recordmk = $this->mastermatakuliah_model->getbytahun($tahun_akademik,$jadwal_prodi,$jadwal_semester);
		if(isset($recordmk) && is_array($recordmk) && count($recordmk)):
			foreach ($recordmk as $record) :
				$json['id'][] = $record->kode_mata_kuliah;
				$json['nama_mata_kuliah'][] = $record->nama_mata_kuliah;
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
	private function save_mastermatakuliah($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		if ($type != 'update')
		{
			$data['tahun_akademik']        	= $this->input->post('mastermatakuliah_tahun_akademik') != "" ? $this->input->post('mastermatakuliah_tahun_akademik') : $this->settings_lib->item('site.tahun');
		}
		$data['kode_pt']        		= $this->input->post('mastermatakuliah_kode_pt');
		$data['kode_fakultas']        = $this->input->post('mastermatakuliah_kode_fakultas');
		$data['kode_prodi']        = $this->input->post('mastermatakuliah_kode_prodi');
		$data['kode_jenjang_studi']        = $this->input->post('mastermatakuliah_kode_jenjang_studi');
		$data['kode_mata_kuliah']        = $this->input->post('mastermatakuliah_kode_mata_kuliah');
		$data['nama_mata_kuliah']        = $this->input->post('mastermatakuliah_nama_mata_kuliah');
		$data['sks']        = $this->input->post('mastermatakuliah_sks');
		$data['sks_tatap_muka']        = $this->input->post('mastermatakuliah_sks_tatap_muka');
		$data['sks_praktikum']        = $this->input->post('mastermatakuliah_sks_praktikum');
		$data['sks_praktek_lap']        = $this->input->post('mastermatakuliah_sks_praktek_lap');
		$data['semester']        = $this->input->post('mastermatakuliah_semester');
		$data['kode_kelompok']        = $this->input->post('mastermatakuliah_kode_kelompok');
		$data['kode_kurikulum']        = $this->input->post('mastermatakuliah_kode_kurikulum');
		$data['kode_matkul']        = $this->input->post('mastermatakuliah_kode_matkul');
		$data['nidn']        = $this->input->post('mastermatakuliah_nidn');
		$data['jenjang_prodi']        = $this->input->post('mastermatakuliah_jenjang_prodi');
		$data['prodi_pengampu']        = $this->input->post('mastermatakuliah_prodi_pengampu');
		$data['status_mata_kuliah']        = $this->input->post('mastermatakuliah_status_mata_kuliah');
		$data['silabus']        = $this->input->post('mastermatakuliah_silabus');
		$data['sap']        		= $this->input->post('mastermatakuliah_sap');
		$data['bahan_ajar']        	= $this->input->post('mastermatakuliah_bahan_ajar');
		$data['diktat']        		= $this->input->post('mastermatakuliah_diktat');
		$data['status_wajib']       = $this->input->post('status_wajib');
		$data['sms']        		= $this->input->post('sms');
		$data['materi']        		= $this->input->post('materi');

		$data['konsentrasi']        	= $this->input->post('konsentrasi');
		$data['nama_konsentrasi']       = $this->input->post('nama_konsentrasi');
		if ($type == 'insert')
		{
			$id = $this->mastermatakuliah_model->insert($data);

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
			$return = $this->mastermatakuliah_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}