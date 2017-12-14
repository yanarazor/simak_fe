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

		$this->auth->restrict('KonfirmasiPembayaran.Pembayaran.View');
		$this->load->model('konfirmasipembayaran_model', null, true);
		$this->lang->load('konfirmasipembayaran');
		
			Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
			Assets::add_js('jquery-ui-1.8.13.min.js');
		Template::set_block('sub_nav', 'pembayaran/_sub_nav');

		Assets::add_module_js('konfirmasipembayaran', 'konfirmasipembayaran.js');
		
		Assets::add_js('jquery.uniform.min.js');
		Assets::add_js('jquery-ui-1.8.13.min.js');
		Assets::add_js('jquery.cleditor.min.js'); 
		Assets::add_js('custom.js');
		Assets::add_css('jquery.wysiwyg.css');  
		Assets::add_js('jquery.wysiwyg.js');
		Assets::add_js('autoNumeric.js');
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

		$pilihanbank = $this->pilihan_model->find_all("bank");
		Template::set('pilihanbank', $pilihanbank);

		$pilihanpembayaran = $this->pilihan_model->find_all("pembayaran");
		Template::set('pilihanpembayaran', $pilihanpembayaran);
		 
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
		if (isset($_POST['ver']))
		{
			$checked = $this->input->post('checked');
			$nimchk = $this->input->post('nimchk');
			$this->load->model('mastermahasiswa/mastermahasiswa_model', null, true);
			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{ 
					//die($this->input->post('konfirmasipembayaran_semester')."masuk");
					// update Pembayaran
					$data_pembayaran = $this->konfirmasipembayaran_model->find($pid);
					$this->konfirmasipembayaran_model->skip_validation(true);
					$datastatus = array('status '=>"1");
					$this->konfirmasipembayaran_model->update_where("id",$pid,$datastatus);
					
					$this->mastermahasiswa_model->skip_validation(true);
					$data = array('semester '=>$data_pembayaran->semester);
					$result = $this->mastermahasiswa_model->update_where("nim_mhs",$nimchk[$pid],$data);
				
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. "Verifikasi Konfirmasi Pembayaran Success", 'success');
				}
				else
				{
					Template::set_message("Verifikasi Konfirmasi Pembayaran " . $this->konfirmasipembayaran_model->error, 'error');
				}
			}
		}

		$fillnim = $this->input->get('fillnim');
		$fillnama = $this->input->get('fillnama');
		$filfakultas = $this->input->get('filfakultas');
		$filljurusan = $this->input->get('filljurusan');
		 
		$this->load->library('pagination');
		$total = $this->konfirmasipembayaran_model->count_all($fillnim,$fillnama,$filfakultas,$filljurusan);
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url() .'?fillnim='.$fillnim.'&fillnama='.$fillnama."&filfakultas=".$filfakultas."&filljurusan=".$filljurusan;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		
		 
		$records = $this->konfirmasipembayaran_model->limit($limit, $offset)->find_all($fillnim,$fillnama,$filfakultas,$filljurusan); 
		
		Template::set('total', $total);
		Template::set('fillnim', $fillnim);
		Template::set('fillnama', $fillnama);
		Template::set('filfakultas', $filfakultas);
		Template::set('filljurusan', $filljurusan); 
		Template::set('records', $records);
		
		Template::set('toolbar_title', '&nbsp;&nbsp;Pengelolaan Konfirmasi Pembayaran');
		Template::render();
	}
	public function nover()
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
		if (isset($_POST['ver']))
		{
			$checked = $this->input->post('checked');
			$nimchk = $this->input->post('nimchk');
			$this->load->model('mastermahasiswa/mastermahasiswa_model', null, true);
			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{ 
					//die($this->input->post('konfirmasipembayaran_semester')."masuk");
					// update Pembayaran
					$data_pembayaran = $this->konfirmasipembayaran_model->find($pid);
					$this->konfirmasipembayaran_model->skip_validation(true);
					$datastatus = array('status '=>"1");
					$this->konfirmasipembayaran_model->update_where("id",$pid,$datastatus);
					
					$this->mastermahasiswa_model->skip_validation(true);
					$data = array('semester '=>$data_pembayaran->semester);
					$result = $this->mastermahasiswa_model->update_where("nim_mhs",$nimchk[$pid],$data);
				
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. "Verifikasi Konfirmasi Pembayaran Success", 'success');
				}
				else
				{
					Template::set_message("Verifikasi Konfirmasi Pembayaran " . $this->konfirmasipembayaran_model->error, 'error');
				}
			}
		}

		$fillnim = $this->input->get('fillnim');
		$fillnama = $this->input->get('fillnama');
		$filfakultas = $this->input->get('filfakultas');
		$filljurusan = $this->input->get('filljurusan');
		 
		$this->load->library('pagination');
		$total = $this->konfirmasipembayaran_model->count_nover($fillnim,$fillnama,$filfakultas,$filljurusan);
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url() .'?fillnim='.$fillnim.'&fillnama='.$fillnama."&filfakultas=".$filfakultas."&filljurusan=".$filljurusan;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		
		 
		$records = $this->konfirmasipembayaran_model->limit($limit, $offset)->get_nover($fillnim,$fillnama,$filfakultas,$filljurusan); 
		
		Template::set('total', $total);
		Template::set('fillnim', $fillnim);
		Template::set('fillnama', $fillnama);
		Template::set('filfakultas', $filfakultas);
		Template::set('filljurusan', $filljurusan); 
		Template::set('records', $records);
		
		Template::set('toolbar_title', '&nbsp;&nbsp;Pengelolaan Konfirmasi Pembayaran');
		Template::render();
	}
	//--------------------------------------------------------------------


	/**
	 * Creates a KonfirmasiPembayaran object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('KonfirmasiPembayaran.Pembayaran.Create');

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
				log_activity($this->current_user->id, lang('konfirmasipembayaran_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'konfirmasipembayaran');

				Template::set_message(lang('konfirmasipembayaran_create_success'), 'success');
				//redirect(SITE_AREA .'/pembayaran/konfirmasipembayaran');
			}
			else
			{
				Template::set_message(lang('konfirmasipembayaran_create_failure') . $this->konfirmasipembayaran_model->error, 'error');
			}
		}
		Assets::add_module_js('konfirmasipembayaran', 'konfirmasipembayaran.js');

		Template::set('toolbar_title','&nbsp;&nbsp; Tambah Data Konfirmasi Pembayaran');
		Template::render();
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

		if (empty($id))
		{
			Template::set_message(lang('konfirmasipembayaran_invalid_id'), 'error');
			redirect(SITE_AREA .'/pembayaran/konfirmasipembayaran');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('KonfirmasiPembayaran.Pembayaran.Edit');

			if ($this->save_konfirmasipembayaran(false,'update', $id))
			{
				// update semester mahasiswa
				if($this->input->post('status')=="1"){
					
					$this->load->model('mastermahasiswa/mastermahasiswa_model', null, true);
					$this->mastermahasiswa_model->skip_validation(true);
					$data = array('semester '=>$this->input->post('konfirmasipembayaran_semester'));
					$this->mastermahasiswa_model->update_where("nim_mhs",$this->input->post('konfirmasipembayaran_nim'),$data);
				
				 }
				
				// Log the activity
				log_activity($this->current_user->id, lang('konfirmasipembayaran_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'konfirmasipembayaran');

				Template::set_message(lang('konfirmasipembayaran_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('konfirmasipembayaran_edit_failure') . $this->konfirmasipembayaran_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('KonfirmasiPembayaran.Pembayaran.Delete');

			if ($this->konfirmasipembayaran_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('konfirmasipembayaran_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'konfirmasipembayaran');

				Template::set_message(lang('konfirmasipembayaran_delete_success'), 'success');

				redirect(SITE_AREA .'/pembayaran/konfirmasipembayaran');
			}
			else
			{
				Template::set_message(lang('konfirmasipembayaran_delete_failure') . $this->konfirmasipembayaran_model->error, 'error');
			}
		}
		Template::set('konfirmasipembayaran', $this->konfirmasipembayaran_model->find($id));
			Template::set('toolbar_title','&nbsp;&nbsp; Ubah Data Konfirmasi Pembayaran');
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
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		$this->form_validation->set_rules('konfirmasipembayaran_nim','NIM','max_length[60]');
		$this->form_validation->set_rules('konfirmasipembayaran_pembayaran','Pembayaran','max_length[60]');
		$this->form_validation->set_rules('konfirmasipembayaran_semester','Semester','is_natural|required|max_length[20]');
		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		$data = array();
		$data['nim']        = $this->input->post('konfirmasipembayaran_nim');
		$data['pembayaran']        = $this->input->post('konfirmasipembayaran_pembayaran');
		$data['semester']        = $this->input->post('konfirmasipembayaran_semester');
		$data['jumlah']        = str_replace('.', '', $this->input->post('konfirmasipembayaran_jumlah'));
		$data['tanggal']        = $this->input->post('konfirmasipembayaran_tanggal') ? $this->input->post('konfirmasipembayaran_tanggal') : '0000-00-00';
		$data['bank']        = $this->input->post('konfirmasipembayaran_bank');
		//$data['file']        = $this->input->post('konfirmasipembayaran_file');
		$data['keterangan']        = $this->input->post('konfirmasipembayaran_keterangan');
		$data['date_created']        = date("Y-m-d");
		//die($this->input->post('status'));
		if($this->input->post('status')!=""){
			$data['status']        = $this->input->post('status');
		}
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

	//--------------------------------------------------------------------


}