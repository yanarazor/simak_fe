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

		$this->auth->restrict('MasterMahasiswa.Master.View');
		$this->load->model('mastermahasiswa_model', null, true);
		$this->lang->load('mastermahasiswa');
		
			Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
			Assets::add_js('jquery-ui-1.8.13.min.js');
		Template::set_block('sub_nav', 'master/_sub_nav');

		Assets::add_module_js('mastermahasiswa', 'mastermahasiswa.js');
		//master Fakultas
		$this->load->model('masterfakultas/masterfakultas_model', null, true);
		$masterfakultas = $this->masterfakultas_model->find_all();
		Template::set('masterfakultass', $masterfakultas);
			//master pilihan
		$this->load->model('pilihan/pilihan_model', null, true);
		$pilihans04 = $this->pilihan_model->find_all("04"); // kode 01 untuk jenjang studi
		Template::set('pilihans04', $pilihans04);
		$pilihans05 = $this->pilihan_model->find_all("05"); // kode 01 untuk jenjang studi
		Template::set('pilihans05', $pilihans05);
		$pilihans06 = $this->pilihan_model->find_all("06"); // kode 01 untuk jenjang studi
		Template::set('pilihans06', $pilihans06);
		//master jurusan
		$this->load->model('masterprogramstudi/masterprogramstudi_model', null, true);
		$masterprogramstudis = $this->masterprogramstudi_model->find_all();
		Template::set('masterprogramstudis', $masterprogramstudis);
		
		$this->load->model('masterdosen/masterdosen_model', null, true);
		$dosens = $this->masterdosen_model->find_all();
		Template::set('dosens', $dosens);
		Assets::add_css('jquery.wysiwyg.css');  
		Assets::add_css('font-awesome.min.css');  
		Assets::add_js('jquery.wysiwyg.js');
		
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{
		// Log the activity
		log_activity($this->current_user->id, 'Lihat Mahasiswa (Master Mahasiswa), dari : '. $this->input->ip_address(), 'mastermahasiswa');
		//die("masuk");
		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$result = $this->mastermahasiswa_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('mastermahasiswa_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('mastermahasiswa_delete_failure') . $this->mastermahasiswa_model->error, 'error');
				}
			}
		}
		$fillnim = $this->input->get('fillnim');
		$fillnama = $this->input->get('fillnama');
		$filfakultas = $this->input->get('filfakultas');
		$filljurusan = $this->input->get('filljurusan');
		 
		$this->load->library('pagination');
		$total = $this->mastermahasiswa_model->count_all($fillnim,$fillnama,$filfakultas,$filljurusan);
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url() .'?fillnim='.$fillnim.'&fillnama='.$fillnama."&filfakultas=".$filfakultas."&filljurusan=".$filljurusan;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		
		 
		$records = $this->mastermahasiswa_model->limit($limit, $offset)->find_all($fillnim,$fillnama,$filfakultas,$filljurusan); 
		
		Template::set('total', $total);
		Template::set('fillnim', $fillnim);
		Template::set('fillnama', $fillnama);
		Template::set('filfakultas', $filfakultas);
		Template::set('filljurusan', $filljurusan); 
		Template::set('records', $records);

		Template::set('toolbar_title', '&nbsp;&nbsp; Pengelolaan Data Mahasiswa');
		Template::render();
	}
	public function viewall()
	{
	 
		$tahun = $this->input->get('tahun');
		$fakultas = $this->input->get('fakultas');
		$prodi = $this->input->get('prodi');
		$status = $this->input->get('status');
		 
		$this->load->library('pagination');
		$total = $this->mastermahasiswa_model->CountMhsaktif_all($tahun,$fakultas,$prodi,$status);
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url() .'?tahun='.$tahun.'&fakultas='.$fakultas."&prodi=".$prodi."&status=".$status;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		
		 
		$records = $this->mastermahasiswa_model->limit($limit, $offset)->Mhsaktif_all($tahun,$fakultas,$prodi,$status); 
		
		Template::set('total', $total);
		Template::set('tahun', $tahun);
		Template::set('fakultas', $fakultas);
		Template::set('prodi', $prodi);
		Template::set('records', $records);
		Template::set('status', $status);
		Template::set_theme('simple');
		Template::set('toolbar_title', 'Mahasiswa Aktif (Status Mahasiswa Aktif)');
		Template::render();
	}
	
	public function viewallin()
	{
	 
		$tahun = $this->input->get('tahun');
		$fakultas = $this->input->get('fakultas');
		$prodi = $this->input->get('prodi');
		$status = $this->input->get('status');
		 
		$this->load->library('pagination');
		$total = $this->mastermahasiswa_model->CountNonMhsaktif_all($tahun,$fakultas,$prodi,$status);
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url() .'?tahun='.$tahun.'&fakultas='.$fakultas."&prodi=".$prodi."&status=".$status;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		
		 
		$records = $this->mastermahasiswa_model->limit($limit, $offset)->MhsNonaktif_all($tahun,$fakultas,$prodi,$status); 
		
		Template::set('total', $total);
		Template::set('tahun', $tahun);
		Template::set('fakultas', $fakultas);
		Template::set('prodi', $prodi);
		Template::set('records', $records);
		Template::set('status', $status);
		Template::set_theme('simple');
		Template::set_view('master/viewall');
		Template::set('toolbar_title', 'Mahasiswa Tidak Aktif (Status Mahasiswa Tidak Aktif atau (Cuti, Droput, Keluar, Lulus, Non Aktif, atau sedang Double Degree))');
		Template::render();
	}
	public function viewabyDosenpa()
	{
	 
		$tahun = $this->input->get('tahun');
		$fakultas = $this->input->get('fakultas');
		$prodi = $this->input->get('prodi');
		$status = $this->input->get('status');
		 
		$this->load->library('pagination');
		$total = count($this->mastermahasiswa_model->GetCountMahasiswaIsiKrs($tahun,$fakultas,$prodi,$status));
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url() .'?tahun='.$tahun.'&fakultas='.$fakultas."&prodi=".$prodi."&status=".$status;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		
		 
		$records = $this->mastermahasiswa_model->limit($limit, $offset)->GetMahasiswaIsiKrs($tahun,$fakultas,$prodi,$status); 
		
		Template::set('total', $total);
		Template::set('tahun', $tahun);
		Template::set('fakultas', $fakultas);
		Template::set('prodi', $prodi);
		Template::set('records', $records);
		Template::set('status', $status);
		Template::set_theme('simple');
		Template::set_view('master/viewall');
		Template::set('toolbar_title', 'Mahasiswa Aktif (Yang sudah isi KRS))');
		Template::render();
	}
	public function viewallkrs()
	{
	 
		$tahun = $this->input->get('tahun');
		$fakultas = $this->input->get('fakultas');
		$prodi = $this->input->get('prodi');
		$status = $this->input->get('status');
		 
		$this->load->library('pagination');
		$total = count($this->mastermahasiswa_model->GetCountMahasiswaIsiKrs($tahun,$fakultas,$prodi,$status));
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url() .'?tahun='.$tahun.'&fakultas='.$fakultas."&prodi=".$prodi."&status=".$status;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		
		 
		$records = $this->mastermahasiswa_model->limit($limit, $offset)->GetMahasiswaIsiKrs($tahun,$fakultas,$prodi,$status); 
		
		Template::set('total', $total);
		Template::set('tahun', $tahun);
		Template::set('fakultas', $fakultas);
		Template::set('prodi', $prodi);
		Template::set('records', $records);
		Template::set('status', $status);
		Template::set_theme('simple');
		Template::set_view('master/viewall');
		Template::set('toolbar_title', 'Mahasiswa Aktif (Yang sudah isi KRS))');
		Template::render();
	}
	//--------------------------------------------------------------------


	/**
	 * Creates a MasterMahasiswa object.
	 *
	 * @return void
	 */
	public function create()
	{
		Assets::add_js('jquery.uniform.min.js');
		Assets::add_js('jquery-ui-1.8.13.min.js');
		Assets::add_js('jquery.cleditor.min.js');
		Assets::add_js('jquery.imagesloaded.js');
		Assets::add_js('custom.js'); 
		
		$this->auth->restrict('MasterMahasiswa.Master.Create');
		//add user
		$this->load->model('users/user_model');
		
			
		if (isset($_POST['save']))
		{
			 
			$this->load->helper('handle_upload');
			$uploadData = array();
			$upload = true; 
			
			if (isset($_FILES['file_upload']) && is_array($_FILES['file_upload']) && $_FILES['file_upload']['error'] != 4)
			{
				
				$uploadData = handle_upload('file_upload',$this->settings_lib->item('site.pathphotomahasiswa'));
				print_r($uploadData);
				if (isset($uploadData['error']) && !empty($uploadData['error']))
				{
					$upload = false;
					
					Template::set_message($uploadData['error'], 'error');
					redirect(SITE_AREA .'/master/mastermahasiswa/create');
				}
			}
			 
			if ($insert_id = $this->save_mastermahasiswa($uploadData))
			{
				// Log the activity
				$msguser = "";
				log_activity($this->current_user->id, lang('mastermahasiswa_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'mastermahasiswa');
				if($this->input->post('useradd') == "1"){
					if ($id = $this->save_user('insert', NULL, ""))
					{
						$msguser = ", Membuat user Sukses";
						log_activity($this->current_user->id, 'Sukses create user id : '. $di .', dari: '. $this->input->ip_address(), 'users');
					}else{
						$msguser = ", Membuat user Gagal, Mungkin karena user sudah terdaftar, silahkan cek";
						log_activity($this->current_user->id, 'Gagal create user id, dari: '. $this->input->ip_address(), 'users');
					}
				}
				
				Template::set_message(lang('mastermahasiswa_create_success').$msguser, 'success');
				redirect(SITE_AREA .'/master/mastermahasiswa');
			}
			else
			{
				Template::set_message(lang('mastermahasiswa_create_failure') . $this->mastermahasiswa_model->error, 'error');
			}
		}
		Assets::add_module_js('mastermahasiswa', 'mastermahasiswa.js');

		Template::set('toolbar_title','&nbsp;&nbsp; Tambah Data Mahasiswa');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of MasterMahasiswa data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);
		Assets::add_js('jquery.uniform.min.js');
		Assets::add_js('jquery-ui-1.8.13.min.js');
		Assets::add_js('jquery.cleditor.min.js');
		Assets::add_js('jquery.imagesloaded.js');
		Assets::add_js('custom.js');
		if (empty($id))
		{
			Template::set_message(lang('mastermahasiswa_invalid_id'), 'error');
			redirect(SITE_AREA .'/master/mastermahasiswa');
		}
 
		if (isset($_POST['save']))
		{
			$this->auth->restrict('MasterMahasiswa.Master.Edit');
			$this->load->helper('handle_upload');
			$uploadData = array();
			$upload = true;
			if (isset($_FILES['file_upload']) && is_array($_FILES['file_upload']) && $_FILES['file_upload']['error'] != 4)
			{
				
				$uploadData = handle_upload('file_upload',$this->settings_lib->item('site.pathphotomahasiswa'));
				//print_r($uploadData);
				if (isset($uploadData['error']) && !empty($uploadData['error']))
				{
					$upload = false;
					
					Template::set_message($uploadData['error'], 'error');
					//redirect(SITE_AREA .'/fileupload/photo_upload/create');
				}
			}
			
			if ($this->save_mastermahasiswa($uploadData,'update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('mastermahasiswa_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'mastermahasiswa');
				$msguser = "";
				if($this->input->post('useradd') == "1"){
					if ($id = $this->save_user('insert', NULL, ""))
					{
						$msguser = ", Membuat user Sukses";
						log_activity($this->current_user->id, 'Sukses create user id : '. $di .', dari: '. $this->input->ip_address(), 'users');
					}else{
						$msguser = ", Membuat user Gagal, Mungkin karena user sudah terdaftar, silahkan cek";
						log_activity($this->current_user->id, 'Gagal create user id, dari: '. $this->input->ip_address(), 'users');
					}
				}
				
				Template::set_message(lang('mastermahasiswa_edit_success').$msguser, 'success');
			}
			else
			{
				Template::set_message(lang('mastermahasiswa_edit_failure') . $this->mastermahasiswa_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('MasterMahasiswa.Master.Delete');

			if ($this->mastermahasiswa_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('mastermahasiswa_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'mastermahasiswa');

				Template::set_message(lang('mastermahasiswa_delete_success'), 'success');

				redirect(SITE_AREA .'/master/mastermahasiswa');
			}
			else
			{
				Template::set_message(lang('mastermahasiswa_delete_failure') . $this->mastermahasiswa_model->error, 'error');
			}
		}
		Template::set('mastermahasiswa', $this->mastermahasiswa_model->find($id));
		Template::set('toolbar_title', '&nbsp;&nbsp; Ubah Data Mahasiswa');
		Template::render();
	}
	public function upload()
	{
		$this->auth->restrict('MasterMahasiswa.Master.Create');
		Assets::add_css('uploadify.css');
		Assets::add_js('jquery.uploadify.js');
		Assets::add_js('jquery.uniform.min.js');
		Assets::add_js('jquery-ui-1.8.13.min.js');
		Assets::add_js('jquery.cleditor.min.js');
		Assets::add_js('jquery.imagesloaded.js');
		Assets::add_js('custom.js');
		 
		$nip = $this->input->get('nip');
		$nama = $this->input->get('nama');
		$tgl = $this->input->get('tgl');
		  
		Template::set('toolbar_title', 'Upload Absen');
		Template::render();
	}
	public function viewbydosen()
	{
		$dosen = $this->input->get('dosen');
		$prodi = $this->input->get('prodi');
		 
		$this->load->library('pagination');
		$total = $this->mastermahasiswa_model->count_all_dosen($dosen,$prodi);
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url() .'?dosen='.$dosen."&prodi=".$prodi;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		
		$records = $this->mastermahasiswa_model->limit($limit, $offset)->find_all_dosen($dosen,$prodi); 
		
		Template::set('total', $total);
		Template::set('dosen', $dosen);
		Template::set('prodi', $prodi); 
		Template::set('records', $records);
		Template::set_theme('simple');
		Template::set('toolbar_title', '&nbsp;&nbsp; Bimbingan dosen');
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
	private function save_mastermahasiswa($uploadData,$type='insert', $id=0)
	{
		$extra_unique_rule = '';
		if ($type == 'update')
		{
			$_POST['id'] = $id;
			$extra_unique_rule = ',mastermahasiswa.id';
		}
		 
		$this->form_validation->set_rules('mastermahasiswa_kode_fakultas','Fakultas','is_natural|required|max_length[20]');
		$this->form_validation->set_rules('mastermahasiswa_kode_prodi','Prodi','is_natural|required|max_length[20]');
		$this->form_validation->set_rules('mastermahasiswa_kode_jenjang_studi','Jenjang Studi','required|max_length[20]');
		$this->form_validation->set_rules('mastermahasiswa_nim_mhs','NIM','required|max_length[100]|unique[mastermahasiswa.nim_mhs' . $extra_unique_rule . ']');
		$this->form_validation->set_rules('mastermahasiswa_nama_mahasiswa','Nama','required|max_length[200]');
		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['kode_pt']        = $this->input->post('mastermahasiswa_kode_pt');
		$data['kode_fakultas']        = $this->input->post('mastermahasiswa_kode_fakultas');
		$data['kode_prodi']        = $this->input->post('mastermahasiswa_kode_prodi');
		$data['kode_jenjang_studi']        = $this->input->post('mastermahasiswa_kode_jenjang_studi');
		$data['nim_mhs']        = $this->input->post('mastermahasiswa_nim_mhs');
		$data['nama_mahasiswa']        = $this->input->post('mastermahasiswa_nama_mahasiswa');
		$data['tempat_lahir']        = $this->input->post('mastermahasiswa_tempat_lahir');
		$data['tgl_lahir']        = $this->input->post('mastermahasiswa_tgl_lahir') ? $this->input->post('mastermahasiswa_tgl_lahir') : '0000-00-00';
		$data['jenis_kelamin']        = $this->input->post('mastermahasiswa_jenis_kelamin');
		$data['nama_ibu_kandung']        = $this->input->post('nama_ibu_kandung');
		$data['tahun_masuk']        = $this->input->post('mastermahasiswa_tahun_masuk');
		$data['semester_awal']        = $this->input->post('mastermahasiswa_semester_awal');
		$data['semester']        = $this->input->post('mastermahasiswa_semester');
		$data['batas_studi']        		= $this->input->post('mastermahasiswa_batas_studi');
		$data['asal_propinsi']        		= $this->input->post('mastermahasiswa_asal_propinsi');
		$data['tgl_masuk']        			= $this->input->post('mastermahasiswa_tgl_masuk') ? $this->input->post('mastermahasiswa_tgl_masuk') : '0000-00-00';
		$data['tgl_lulus']        			= $this->input->post('mastermahasiswa_tgl_lulus') ? $this->input->post('mastermahasiswa_tgl_lulus') : '0000-00-00';
		$data['status_aktivitas']        	= $this->input->post('mastermahasiswa_status_aktivitas');
		$data['status_awal']        		= $this->input->post('mastermahasiswa_status_awal');
		$data['jml_sks_diakui']        		= $this->input->post('mastermahasiswa_jml_sks_diakui');
		$data['nim_asal']        			= $this->input->post('mastermahasiswa_nim_asal');
		$data['asal_pt']        			= $this->input->post('mastermahasiswa_asal_pt');
		$data['asal_jenjang_studi']        	= $this->input->post('mastermahasiswa_asal_jenjang_studi');
		$data['asal_prodi']        			= $this->input->post('mastermahasiswa_asal_prodi');
		$data['kode_biaya_studi']        	= $this->input->post('mastermahasiswa_kode_biaya_studi');
		$data['kode_pekerjaan']        		= $this->input->post('mastermahasiswa_kode_pekerjaan');
		$data['tempat_kerja']        		= $this->input->post('mastermahasiswa_tempat_kerja');
		$data['kode_pt_kerja']        		= $this->input->post('mastermahasiswa_kode_pt_kerja');
		$data['kode_ps_kerja']        		= $this->input->post('mastermahasiswa_kode_ps_kerja');
		$data['nip_promotor']        		= $this->input->post('mastermahasiswa_nip_promotor');
		$data['nip_co_promotor1']        	= $this->input->post('mastermahasiswa_nip_co_promotor1');
		$data['nip_co_promotor2']        	= $this->input->post('mastermahasiswa_nip_co_promotor2');
		$data['nip_co_promotor3']        	= $this->input->post('mastermahasiswa_nip_co_promotor3');
		$data['nip_co_promotor4']        	= $this->input->post('mastermahasiswa_nip_co_promotor4');
		$data['keterangan']        			= $this->input->post('keterangan');
		$data['status_bayar']        		= $this->input->post('status_bayar');
		$data['status_mahasiswa']        	= $this->input->post('status_mahasiswa');
		$data['buka_krs']        	= $this->input->post('buka_krs');
		
		if ($uploadData !== false && is_array($uploadData) && count($uploadData) > 0 && isset($uploadData['data']['file_name']))
		{
			//die($uploadData['data']['file_name']);
			$data = $data + array('photo_mahasiswa'=>$uploadData['data']['file_name']);
		}
		if ($type == 'insert')
		{
			$id = $this->mastermahasiswa_model->insert($data);

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
			$return = $this->mastermahasiswa_model->update($id, $data);
		}

		return $return;
	}
	private function save_user($type='insert', $id=0, $meta_fields=array(), $cur_role_name = '')
	{
        
        $extra_unique_rule = '';
		$username_required = '';

        if ($type != 'insert') {
			$_POST['id'] = $id;
    		$extra_unique_rule = ',users.id';
		}
  
		 

		// Compile our core user elements to save.
		$data =  array();
        $data['timezone'] 		= "UTC";
        $data['password'] 		= "123456789"; 
		$data['active'] 		= 1; 
		$nim 					= $this->input->post('mastermahasiswa_nim_mhs');
		$data['nim'] 			= $nim;
		$data['display_name'] 	= $this->input->post('mastermahasiswa_nama_mahasiswa');
		$data['username'] 		= $nim;
		$data['email']			= $nim."@gmail.com";
		$data['role_id'] 		= "7";
		if ($type == 'insert') {
			$activation_method = $this->settings_lib->item('auth.user_activation_method');
			
			// No activation method
			if ($activation_method == 0) {
				// Activate the user automatically
				$data['active'] = 1;
			}

			$return = $this->user_model->insert($data);
			
			$id = $return;
		} else {	// Update
			$return = $this->user_model->update($id, $data);
		}
		
		return $return;

	}//end save_user()
	//--------------------------------------------------------------------


}