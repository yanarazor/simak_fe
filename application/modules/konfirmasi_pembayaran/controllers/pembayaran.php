<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * pembayaran controller
 */
class pembayaran extends Admin_Controller
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

		$this->auth->restrict('Konfirmasi_Pembayaran.Pembayaran.View');
		$this->lang->load('konfirmasi_pembayaran');
		$this->load->model('konfirmasipembayaran/konfirmasipembayaran_model', null, true);
		
		Template::set_block('sub_nav', 'pembayaran/_sub_nav');
		
		Template::set_block('sub_nav', 'pembayaran/_sub_nav');
		 
				//master Fakultas
		$this->load->model('masterfakultas/masterfakultas_model', null, true);
		$masterfakultas = $this->masterfakultas_model->find_all();
		Template::set('masterfakultass', $masterfakultas);
	
		//master jurusan
		$this->load->model('masterprogramstudi/masterprogramstudi_model', null, true);
		$masterprogramstudis = $this->masterprogramstudi_model->find_all();
		Template::set('masterprogramstudis', $masterprogramstudis);
		
		$this->load->model('pilihan/pilihan_model', null, true);
		$pilihansemester = $this->pilihan_model->find_all("sms");
		Template::set('pilihansemesters', $pilihansemester);

		$pilihanpembayaran = $this->pilihan_model->find_all("pembayaran");
		Template::set('pilihanpembayaran', $pilihanpembayaran);
		
		$pilihanbank = $this->pilihan_model->find_all("bank");
		Template::set('pilihanbank', $pilihanbank);
		
		Template::set_theme("adminlte");
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
					$result = $this->konfirmasipembayaran_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('konfirmasipembayaran_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('konfirmasipembayaran_delete_failure') . $this->konfirmasipembayaran_model->error, 'error');
				}
			}
		}

		$fillnim = $this->current_user->nim;
		$sms = $this->input->get('sms');
		 
		$this->load->library('pagination');
		$total = $this->konfirmasipembayaran_model->count_all($fillnim,"","","",$sms);
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url() .'?sms='.$sms;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		
		//die($fillnim);
		$records = $this->konfirmasipembayaran_model->limit($limit, $offset)->find_all($fillnim,"","","",$sms); 
		
		Template::set('total', $total);
		Template::set('sms', $sms);
		 
		Template::set('records', $records);
		
		Template::set('toolbar_title', '&nbsp;&nbsp; Konfirmasi Pembayaran Kuliah');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Konfirmasi Pembayaran object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Konfirmasi_Pembayaran.Pembayaran.Create');
		if (isset($_POST['save']))
		{
			$this->load->helper('handle_upload');
			$uploadData = array();
			$upload = true; 
			if (isset($_FILES['file_upload']) && is_array($_FILES['file_upload']) && $_FILES['file_upload']['error'] != 4)
			{
				$uploadData = handle_upload('file_upload',$this->settings_lib->item('site.pathuploaded'));
				//print_r($uploadData);
				if (isset($uploadData['error']) && !empty($uploadData['error']))
				{
					$upload = false;
				}
			}
			if ($insert_id = $this->save_konfirmasipembayaran($uploadData))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('konfirmasi_pembayaran_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'konfirmasipembayaran');

				Template::set_message(lang('konfirmasi_pembayaran_create_success'), 'success');
				//redirect(SITE_AREA .'/pembayaran/konfirmasipembayaran');
			}
			else
			{
				Template::set_message(lang('konfirmasi_pembayaran_create_failure') . $this->konfirmasipembayaran_model->error, 'error');
			}
		}

		Template::set('toolbar_title', '&nbsp;&nbsp; Konfirmasi Pembayaran Kuliah');
		Template::render();
	}
	public function savekonfirmasi()
    {
    	$insert_id = 0;
        $this->auth->restrict('Konfirmasi_Pembayaran.Pembayaran.Create');
        $id_data = $this->input->post("id_data");
        if($this->input->post("konfirmasipembayaran_pembayaran") =="")
        	die("Silahkan Pilih jenis Pembayaran");
        if($this->input->post("konfirmasipembayaran_semester") =="")
        	die("Silahkan pilih semester");
		if($id_data == ""){
			if($id = $this->save_data()){
				log_activity($this->auth->user_id(), 'Save materi pertemuan : ' . $id . ' : ' . $this->input->ip_address(), 'konfirmasipembayaran');
				echo "Sukses simpan data";
			}else{
				log_activity($this->auth->user_id(), 'Save rumusan gagal, dari' .$this->konfirmasipembayaran_model->error. $this->input->ip_address(), 'konfirmasipembayaran');
				echo "Gagal ".$this->konfirmasipembayaran_model->error;
			}
		}else{
			if($result = $this->save_data('update', $id_data)){
				echo "Update sukses";
			}
		}

        exit();
    }
    function saveberkas(){
		$this->auth->restrict('Konfirmasi_Pembayaran.Pembayaran.Create');
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
				 log_activity($this->auth->user_id(), 'Gagal : '.$uploadData['error'].$tipefile.$this->input->ip_address(), 'konfirmasipembayaran');
			 }else{
			 	$namafile = $uploadData['data']['file_name'];
                log_activity($this->auth->user_id(), 'Save Berkas konfirmasi pembayaran : ' . $id_log . ' : ' . $this->input->ip_address(), 'konfirmasipembayaran');
			 }
		 }else{
		 	die("File tidak ditemukan");
		 	log_activity($this->auth->user_id(), 'File tidak ditemukan : ' . $this->input->ip_address(), 'konfirmasipembayaran');
		 } 	

       echo '{"namafile":"'.$namafile.'"}';
       exit();
	}
	//--------------------------------------------------------------------


	/**
	 * Allows editing of KonfirmasiPembayaran data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);
		//die($this->current_user->nim);
		if (empty($id))
		{
			Template::set_message(lang('konfirmasi_pembayaran_invalid_id'), 'error');
			redirect(SITE_AREA .'/pembayaran/konfirmasipembayaran');
		}

		if (isset($_POST['save']))
		{
		
			$this->auth->restrict('Konfirmasi_Pembayaran.Pembayaran.Edit');
			if ($this->save_konfirmasipembayaran(false,'update', $id))
			{
				// update semester mahasiswa
				/*
				if($this->input->post('status')=="1"){
					
					$this->load->model('mastermahasiswa/mastermahasiswa_model', null, true);
					$this->mastermahasiswa_model->skip_validation(true);
					$data = array('semester'=>$this->input->post('konfirmasipembayaran_semester'));
					$this->mastermahasiswa_model->update_where("nim_mhs",$this->input->post('konfirmasipembayaran_nim'),$data);
				
				 }
				*/
				// Log the activity
				log_activity($this->current_user->id, lang('konfirmasi_pembayaran_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'konfirmasipembayaran');

				Template::set_message(lang('konfirmasi_pembayaran_edit_success'), 'success');
				
			}
			else
			{
				Template::set_message(lang('konfirmasi_pembayaran_edit_failure') . $this->konfirmasipembayaran_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Konfirmasi_Pembayaran.Pembayaran.Delete');

			if ($this->konfirmasipembayaran_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('konfirmasi_pembayaran_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'konfirmasipembayaran');

				Template::set_message(lang('konfirmasi_pembayaran_delete_success'), 'success');

				redirect(SITE_AREA .'/pembayaran/konfirmasipembayaran');
			}
			else
			{
				Template::set_message(lang('konfirmasi_pembayaran_delete_failure') . $this->konfirmasipembayaran_model->error, 'error');
			}
		}
		Template::set('konfirmasipembayaran', $this->konfirmasipembayaran_model->find($id));
		Template::set('toolbar_title', '&nbsp;&nbsp; Konfirmasi Pembayaran Kuliah');
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
	private function save_konfirmasipembayaran($uploadData=false,$type='insert', $id=0)
	{
		//die($this->input->post('konfirmasipembayaran_semester'));
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		$this->form_validation->set_rules('konfirmasipembayaran_pembayaran','Pembayaran','max_length[60]');
		$this->form_validation->set_rules('konfirmasipembayaran_semester','Semester','is_natural|required|max_length[20]');
		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		$data = array();
		$data['nim']        = $this->current_user->nim;
		$data['pembayaran']        = $this->input->post('konfirmasipembayaran_pembayaran');
		$data['semester']        = $this->input->post('konfirmasipembayaran_semester');
		$data['jumlah']        = str_replace('.', '', $this->input->post('konfirmasipembayaran_jumlah'));
		$data['tanggal']        = $this->input->post('konfirmasipembayaran_tanggal') ? $this->input->post('konfirmasipembayaran_tanggal') : '0000-00-00';
		$data['bank']        = $this->input->post('konfirmasipembayaran_bank');
		//$data['file']        = $this->input->post('konfirmasipembayaran_file');
		$data['keterangan']        = $this->input->post('konfirmasipembayaran_keterangan');
		$data['date_created']        = date("Y-m-d");
		 
		if ($uploadData !== false && is_array($uploadData) && count($uploadData) > 0)
		{
			//die(serialize($uploadData['data']));
			$data = $data + array('file'=>serialize($uploadData['data']));
			
		} 
		if ($type == 'insert')
		{
			$id = $this->konfirmasipembayaran_model->insert($data);

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
			$return = $this->konfirmasipembayaran_model->update($id, $data);
		}

		return $return;
	}
	private function save_data($type='insert', $id=0)
	{
		//die($this->input->post('konfirmasipembayaran_semester'));
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		$this->form_validation->set_rules('konfirmasipembayaran_pembayaran','Pembayaran','max_length[60]');
		$this->form_validation->set_rules('konfirmasipembayaran_semester','Semester','is_natural|required|max_length[20]');
		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		$data = array();
		$data['nim']        = $this->current_user->nim;
		$data['pembayaran']        = $this->input->post('konfirmasipembayaran_pembayaran');
		$data['semester']        = $this->input->post('konfirmasipembayaran_semester');
		$data['jumlah']        = str_replace('.', '', $this->input->post('konfirmasipembayaran_jumlah'));
		$data['tanggal']        = $this->input->post('konfirmasipembayaran_tanggal') ? $this->input->post('konfirmasipembayaran_tanggal') : '0000-00-00';
		$data['bank']        = $this->input->post('konfirmasipembayaran_bank');
		$data['file']        = $this->input->post('file_bukti');
		$data['keterangan']        = $this->input->post('konfirmasipembayaran_keterangan');
		$data['date_created']        = date("Y-m-d");
		 
		if ($type == 'insert')
		{
			$id = $this->konfirmasipembayaran_model->insert($data);

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
			$return = $this->konfirmasipembayaran_model->update($id, $data);
		}

		return $return;
	}
	 



}