<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * krs controller
 */
class krs extends Admin_Controller
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

		$this->load->model('datakrs_model', null, true);
		$this->lang->load('datakrs');
		
		Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
		Assets::add_js('jquery-ui-1.8.13.min.js');
		

		Assets::add_module_js('datakrs', 'datakrs.js');
		
		//master matakuliah
		$this->load->model('mastermatakuliah/mastermatakuliah_model', null, true);
		$matakuliahs = $this->mastermatakuliah_model->find_all();
		Template::set('matakuliahs', $matakuliahs);
		$this->load->model('mastermahasiswa/mastermahasiswa_model', null, true);
		
		Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
		Assets::add_js('jquery-ui-1.8.13.min.js');
		Assets::add_css('fancybox/jquery.fancybox-1.3.4.css');
		Assets::add_js('fancybox/jquery.fancybox-1.3.4.js');
		
		//master pilihan
		$this->load->model('pilihan/pilihan_model', null, true);
		$pilihansemester = $this->pilihan_model->find_all("sms");
		Template::set('pilihansemesters', $pilihansemester);
		
		$jenjangs = $this->pilihan_model->find_all("01");
		Template::set('jenjangs', $jenjangs);
		
		//master Dosen
		$this->load->model('masterdosen/masterdosen_model', null, true);
		$dosens = $this->masterdosen_model->find_all();
		Template::set('dosens', $dosens);
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{
		
		$this->auth->restrict('DataKrs.Krs.View');
		Template::set_block('sub_nav', 'krs/_sub_nav');
		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$result = $this->datakrs_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('datakrs_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('datakrs_delete_failure') . $this->datakrs_model->error, 'error');
				}
			}
		}
		$sms = $this->input->get('sms');
		$kode_mk = $this->input->get('kode_mk');
		$mhs = $this->input->get('mhs');
		
		$this->load->library('pagination');
		$total = $this->datakrs_model->rekap_count($sms,$this->current_user->nim);
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url()."?sms=".$sms."&kode_mk=".$kode_mk."&mhs=".$mhs;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		$records = $this->datakrs_model->limit($limit, $offset)->rekap($sms,$this->current_user->nim);

		Template::set('records', $records);
		Template::set('total', $total);
		
		Template::set('sms', $sms);
		
		Template::set('kode_mk', $kode_mk);
		Template::set('mhs', $mhs);
		Template::set('toolbar_title', '&nbsp;&nbsp; Pengelolaan Kartu Rencana Studi Mahasiswa');
		Template::render();
	}

	public function detil()
	{
		Template::set_block('sub_nav', 'krs/_sub_nav');
		$sms = $this->uri->segment(5);
		 
		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$result = $this->datakrs_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('datakrs_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('datakrs_delete_failure') . $this->datakrs_model->error, 'error');
				}
			}
		}
		$kode_mk = $this->input->get('kode_mk');
		$mhs = $this->current_user->nim;
		 
		
		$this->load->library('pagination');
		$total = $this->datakrs_model->count_all($sms,$kode_mk,$mhs);
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url()."?sms=".$sms."&kode_mk=".$kode_mk."&mhs=".$mhs;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		$records = $this->datakrs_model->limit($limit, $offset)->find_distinct($sms,$kode_mk,$mhs);

		Template::set('records', $records);
		Template::set('total', $total);
		
		Template::set('sms', $sms);
		
		Template::set('kode_mk', $kode_mk);
		Template::set('mhs', $mhs);
			Template::set('toolbar_title', '&nbsp;&nbsp; Pengelolaan Kartu Rencana Studi Mahasiswa');
		Template::render();
	}

	public function listdata()
	{
		Template::set_block('sub_nav', 'krs/_sub_nav');
		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$result = $this->datakrs_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('datakrs_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('datakrs_delete_failure') . $this->datakrs_model->error, 'error');
				}
			}
		}
		$sms = $this->input->get('sms');
		$kode_mk = $this->input->get('kode_mk');
		$mhs = $this->input->get('mhs');
		 
		
		$this->load->library('pagination');
		$total = $this->datakrs_model->count_all($sms,$kode_mk,$mhs);
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url()."?sms=".$sms."&kode_mk=".$kode_mk."&mhs=".$mhs;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		$records = $this->datakrs_model->limit($limit, $offset)->find_all($sms,$kode_mk,$mhs);

		Template::set('records', $records);
		Template::set('total', $total);
		
		Template::set('sms', $sms);
		
		Template::set('kode_mk', $kode_mk);
		Template::set('mhs', $mhs);
		Template::set('toolbar_title', '&nbsp;&nbsp; Pengelolaan Kartu Rencana Studi Mahasiswa');
		Template::render();
	}
	
	//--------------------------------------------------------------------


	/**
	 * Creates a DataKrs object.
	 *
	 * @return void
	 */
	public function create()
	{
		Template::set_block('sub_nav', 'krs/_sub_nav');
		$this->auth->restrict('DataKrs.Krs.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_datakrs())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('datakrs_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'datakrs');

				Template::set_message(lang('datakrs_create_success'), 'success');
				redirect(SITE_AREA .'/krs/datakrs');
			}
			else
			{
				Template::set_message(lang('datakrs_create_failure') . $this->datakrs_model->error, 'error');
			}
		}
		Assets::add_module_js('datakrs', 'datakrs.js');

		Template::set('toolbar_title', lang('datakrs_create') . ' DataKrs');
		Template::render();
	}

	public function input()
	{
		Template::set_block('sub_nav', 'krs/_sub_nav');
		//die($this->current_user->nim." nim");
		$this->auth->restrict('DataKrs.Krs.Input');
		$this->load->model('mastermahasiswa/mastermahasiswa_model', null, true);
		$recordmahasiswa = $this->mastermahasiswa_model->get_by_nim($this->current_user->nim); 
		$sms = "1";
		$kode_prodi = "";
		$bypass = "0";
		if($recordmahasiswa){
				//$sms = $recordmahasiswa[0]->semester;
				$kode_prodi = $recordmahasiswa[0]->kode_prodi;
				$bypass = $recordmahasiswa[0]->status_bayar;
		}
		// ambil semester aktif
		$this->load->library('convert');
		$convert = new convert();	
		$sms = $this->convert->getsemester($this->current_user->nim,$this->settings_lib->item('site.tahun'));
		// cek pembayaran apakah sudah 
		$status_bayar = "0";
		$this->load->model('konfirmasipembayaran/konfirmasipembayaran_model', null, true);
		if($this->konfirmasipembayaran_model->cekpembayaran($sms,$this->current_user->nim)>0 or $bypass =="1")
		{
			$status_bayar = "1";
		} else{
			$status_bayar = "0";
		}
		
		//die($status_bayar);
		Template::set('status_bayar', $status_bayar);
		Template::set('kode_prodi', $kode_prodi);
		
	 	//die($sms."ini");
		$recordmks = $this->mastermatakuliah_model->find_by_ditawarkan("",$kode_prodi); 
		$total = 0;
		if(isset($recordmks) && is_array($recordmks) && count($recordmks))
			$total =  count($recordmks);
			
		Template::set('recordmks', $recordmks);
		 
		Template::set('total',$total);
		Template::set('sms', $sms);
		
		if (isset($_POST['ambil']))
		{
			$checked = $this->input->post('checked');
			$sudahada = 0;
			$berhasil = 0;
			if (is_array($checked) && count($checked))
			{
			//die($sms." sks");
				$result = FALSE;
				foreach ($checked as $pid)
				{
					if($this->datakrs_model->isuniq_mhs($sms,$this->input->post('kodemk_'.$pid),$this->current_user->nim)>0){
						$sudahada = $sudahada+1;
					}else{
						$berhasil = $berhasil+1;
						 
						$result = $this->save_datakrs($this->input->post('kodemk_'.$pid),$this->input->post('nama_mk_'.$pid),$this->input->post('mksks_'.$pid),$this->current_user->nim,"","",$sms,"B",$this->input->post('sms_'.$pid),$this->input->post('txtkdjadwal_'.$pid),$this->input->post('txtkelas_'.$pid));
					}
					//$kode_mk="",$sks="",$mahasiswa="",$kode_dosen="",$semester=""
				}

				if ($result)
				{
					// Log the activity
					log_activity($this->current_user->id, 'Submit KRS, dari IP :'. $this->input->ip_address(), 'datakrs');
					Template::set_message($berhasil .' Mata kuliah sudah di tambahkan pada krs anda , Gagal :'.$sudahada, 'success');
				}
				else
				{
					Template::set_message($berhasil .' Mata kuliah tambahkan pada krs anda , Gagal :'.$sudahada.' Karena data mata kuliah sudah dimasukan' . $this->datakrs_model->error, 'error');
				}
			}
		}
		$recordkrss = $this->datakrs_model->find_all($sms,"",$this->current_user->nim);
		$jsonkrs[] =array();
		if (isset($recordkrss) && is_array($recordkrss) && count($recordkrss)) :
		foreach ($recordkrss as $record) : 
			//echo $record->id."<br>";
			$jsonkrs['idkrs'][$record->kode_mk] = $record->id;
			$jsonkrs['kode_mk'][$record->kode_mk] = $record->kode_mk;
			$jsonkrs['sks'][$record->kode_mk] = $record->sks;
			$jsonkrs['kode_jadwal'][$record->kode_mk] = $record->kode_jadwal;
			$jsonkrs['semester'][$record->kode_mk] = $record->semester;
			$jsonkrs['semester_matakuliah'][$record->kode_mk] = $record->semester_matakuliah;
			$jsonkrs['kelas'][$record->kode_mk] = $record->kelas;
		endforeach;
		endif;
		//die("");
		//$sms = 4;
		$ipsemesterini = $this->hitung_ipsemester($sms-1, $this->current_user->nim);
		$ips = $ipsemesterini;//"1.5";
		$mak_sks = $this->getmaksks($ips);
		Template::set('ips', $ips);
		Template::set('mak_sks', $mak_sks);
		Template::set('recordkrss', $recordkrss);
		Template::set('jsonkrs', $jsonkrs);
		Assets::add_module_js('datakrs', 'datakrs.js');
		Template::set('toolbar_title', '&nbsp;&nbsp; Tambah Data Kartu Rencana Studi Mahasiswa');
		Template::render();
	}
	private function hitung_ipsemester($semester, $nim)
	{
		$this->load->model('konversi/konversi_model', null, true);
		$sms = $semester;
		$mhs = $nim; 
		//die($mhs);
		$recordkonversi = $this->konversi_model->find_all();
		$jsonkonversi[] =array();
		if (isset($recordkonversi) && is_array($recordkonversi) && count($recordkonversi)) :
		foreach ($recordkonversi as $record) : 
			$jsonkonversi[$record->huruf] = $record->angka;
			 
		endforeach;
		endif;
		$jmlsks = 0;
		$jmlbobot = 0;
		$datakrs = $this->datakrs_model->find_ips($sms,$mhs);
		$nilaiangka= 0;
		if (isset($datakrs) && is_array($datakrs) && count($datakrs)) : 
		 	$no = 1;
			foreach ($datakrs as $record) :
			   if(isset($jsonkonversi[$record->nilai_huruf]))
					$nilaiangka = $jsonkonversi[$record->nilai_huruf];
			   if($nilaiangka!=""){
				 	$jmlsks = $jmlsks + (int)$record->sks;
		  
				  	$nilaiangka = $jsonkonversi[$record->nilai_huruf];
				  	$jmlbobot = $jmlbobot + ((int)$record->sks*(int)$nilaiangka);
			   }
			  // echo $jmlsks;
			endforeach;
		endif;
		
		$ipk = 0;
		if($jmlbobot!="" and $jmlsks != "")
		{
			$ipk = round($jmlbobot/$jmlsks, 2);
			//echo $jmlbobot." ini";
		}
		return $ipk; 
		
	}
	private function getmaksks($ips="")
	{
		$mak_sks = 0;
		$this->load->model('role_krs/role_krs_model', null, true);
		$record_role = $this->role_krs_model->get_mak($ips);
		if (isset($record_role) && is_array($record_role) && count($record_role)) :
			$mak_sks = $record_role[0]->maksimal_sks;
		endif;
		return $mak_sks;
		
	}
	public function lainnya()
	{
		Template::set_block('sub_nav', 'krs/_sub_nav');
		//die($this->current_user->nim." nim");
		$this->auth->restrict('DataKrs.Krs.Input');
		$this->load->model('mastermahasiswa/mastermahasiswa_model', null, true);
		$recordmahasiswa = $this->mastermahasiswa_model->get_by_nim($this->current_user->nim); 
		$sms = "1";
		$kode_prodi = "";
		if($recordmahasiswa){
				$sms = $recordmahasiswa[0]->semester;
				$kode_prodi = $recordmahasiswa[0]->kode_prodi;
		}
		// cek pembayaran apakah sudah 
		$status_bayar = "0";
		$this->load->model('konfirmasipembayaran/konfirmasipembayaran_model', null, true);
		if($this->konfirmasipembayaran_model->cekpembayaran($sms,$this->current_user->nim)>0)
		{
			$status_bayar = "1";
		} else{
			$status_bayar = "0";
		}
		//die($status_bayar);
		Template::set('status_bayar', $status_bayar);
		Template::set('kode_prodi', $kode_prodi);
		
	 	//die($sms."ini");
		$recordmks = $this->mastermatakuliah_model->find_lainnya($sms,$kode_prodi); 
		$total = 0;
		if(isset($recordmks) && is_array($recordmks) && count($recordmks))
			$total =  count($recordmks);
		Template::set('recordmks', $recordmks);
		Template::set('total',$total);
		Template::set('sms', $sms);
		
		if (isset($_POST['ambil']))
		{
			$checked = $this->input->post('checked');
			$sudahada = 0;
			$berhasil = 0;
			if (is_array($checked) && count($checked))
			{
			//die($sms." sks");
				$result = FALSE;
				foreach ($checked as $pid)
				{
					//echo $this->input->post('kodemk_'.$pid)."<br>";]
					//die($this->datakrs_model->isuniq_mhs($sms,$this->input->post('kodemk_'.$pid),$this->current_user->nim)." ini");
					if($this->datakrs_model->isuniq_mhs($sms,$this->input->post('kodemk_'.$pid),$this->current_user->nim)>0){
						$sudahada = $sudahada+1;
					}else{
						$berhasil = $berhasil+1;
						 
						$result = $this->save_datakrs($this->input->post('kodemk_'.$pid),$this->input->post('nama_mk_'.$pid),$this->input->post('mksks_'.$pid),$this->current_user->nim,"","",$sms,"N",$this->input->post('sms_'.$pid));
					}
					//$kode_mk="",$sks="",$mahasiswa="",$kode_dosen="",$semester=""
				}

				if ($result)
				{
					Template::set_message($berhasil .' Mata kuliah sudah di tambahkan pada krs anda , Gagal :'.$sudahada, 'success');
				}
				else
				{
					Template::set_message($berhasil .' Mata kuliah tambahkan pada krs anda , Gagal :'.$sudahada.' Karena data mata kuliah sudah dimasukan' . $this->datakrs_model->error, 'error');
				}
			}
			//redirect ke halaman input
			redirect(SITE_AREA .'/krs/datakrs/input');
		}
		$recordkrss = $this->datakrs_model->find_all($sms,"",$this->current_user->nim);
		$jsonkrs[] =array();
		if (isset($recordkrss) && is_array($recordkrss) && count($recordkrss)) :
		foreach ($recordkrss as $record) : 
			$jsonkrs['idkrs'][$record->kode_mk] = $record->id;
			$jsonkrs['kode_mk'][$record->kode_mk] = $record->kode_mk;
			$jsonkrs['sks'][$record->kode_mk] = $record->sks;
			$jsonkrs['kode_jadwal'][$record->kode_mk] = $record->kode_jadwal;
			$jsonkrs['semester'][$record->kode_mk] = $record->semester;
		endforeach;
		endif;
		Template::set('recordkrss', $recordkrss);
		Template::set('jsonkrs', $jsonkrs); 
		
		Assets::add_module_js('datakrs', 'datakrs.js');

			Template::set('toolbar_title', '&nbsp;&nbsp; Tambah Data Kartu Rencana Studi Mahasiswa');
		Template::render();
	}
	public function view()
	{
		Template::set_block('sub_nav', 'krs/_sub_nav');
		//die($this->current_user->nim." nim");
		$this->auth->restrict('DataKrs.Krs.Input');
		$this->load->model('mastermahasiswa/mastermahasiswa_model', null, true);
		$recordmahasiswa = $this->mastermahasiswa_model->get_by_nim($this->current_user->nim); 
		$sms = "1";
		$kode_prodi = "";
		if($recordmahasiswa){
		//print_r($recordmahasiswa);
				$sms = $recordmahasiswa[0]->semester;
				$kode_prodi = $recordmahasiswa[0]->kode_prodi;
		}
		// cek pembayaran apakah sudah 
		$status_bayar = "0";
		$this->load->model('konfirmasipembayaran/konfirmasipembayaran_model', null, true);
		if($this->konfirmasipembayaran_model->cekpembayaran($sms,$this->current_user->nim)>0)
		{
			$status_bayar = "1";
		} else{
			$status_bayar = "0";
		}
		//die($status_bayar);
		Template::set('status_bayar', $status_bayar);
		Template::set('kode_prodi', $kode_prodi);
		
	 	//die($sms."ini");
		$recordmks = $this->mastermatakuliah_model->find_by_ditawarkan($sms,$kode_prodi); 
		$total = 0;
		if(isset($recordmks) && is_array($recordmks) && count($recordmks))
			$total =  count($recordmks);
		Template::set('recordmks', $recordmks);
		Template::set('total',$total);
		Template::set('sms', $sms);
		
		if (isset($_POST['ambil']))
		{
			$checked = $this->input->post('checked');
			$sudahada = 0;
			$berhasil = 0;
			if (is_array($checked) && count($checked))
			{
			//die($sms." sks");
				$result = FALSE;
				foreach ($checked as $pid)
				{
					//echo $this->input->post('kodemk_'.$pid)."<br>";]
					//die($this->datakrs_model->isuniq_mhs($sms,$this->input->post('kodemk_'.$pid),$this->current_user->nim)." ini");
					if($this->datakrs_model->isuniq_mhs($sms,$this->input->post('kodemk_'.$pid),$this->current_user->nim)>0){
						$sudahada = $sudahada+1;
					}else{
						$berhasil = $berhasil+1;
						 
						$result = $this->save_datakrs($this->input->post('kodemk_'.$pid) ,$this->input->post('nama_mk_'.$pid),$this->input->post('mksks_'.$pid),$this->current_user->nim,"","",$sms);
					}
					//$kode_mk="",$sks="",$mahasiswa="",$kode_dosen="",$semester=""
				}

				if ($result)
				{
					redirect(SITE_AREA .'/krs/datakrs/view/');
					Template::set_message($berhasil .' Mata kuliah sudah di tambahkan pada krs anda , Gagal :'.$sudahada, 'success');
				}
				else
				{
					Template::set_message($berhasil .' Mata kuliah tambahkan pada krs anda , Gagal :'.$sudahada.' Karena data mata kuliah sudah dimasukan' . $this->datakrs_model->error, 'error');
				}
			}
		}
	 
		$recordkrss = $this->datakrs_model->find_all($sms,"",$this->current_user->nim);
		$jsonkrs[] =array();
		if (isset($recordkrss) && is_array($recordkrss) && count($recordkrss)) :
		foreach ($recordkrss as $record) : 
			
			$jsonkrs['idkrs'][$record->kode_mk] = $record->id;
			$jsonkrs['kode_mk'][$record->kode_mk] = $record->kode_mk;
			$jsonkrs['sks'][$record->kode_mk] = $record->sks;
			$jsonkrs['kode_jadwal'][$record->kode_mk] = $record->kode_jadwal;
			$jsonkrs['semester'][$record->kode_mk] = $record->semester;
		endforeach;
		endif;
		Template::set('recordkrss', $recordkrss);
		Template::set('jsonkrs', $jsonkrs);
		//print_r($jsonkrs);
		//die();
		
		Assets::add_module_js('datakrs', 'datakrs.js');

		Template::set('toolbar_title', '&nbsp;&nbsp; Pengelolaan Kartu Rencana Studi Mahasiswa');
		Template::render();
	}

	public function printkrs()
	{
		Template::set_block('sub_nav', 'krs/_sub_nav');
		$sms = $this->uri->segment(5);
		$mode = $this->uri->segment(6); 
		if (empty($sms))
		{
			Template::set_message("Semua Semester.", 'warning');
			 
		}
		Template::set('sms', $sms);
		 
		$datakrs = $this->datakrs_model->find_all($sms,"",$this->current_user->nim);
		Template::set('datakrs', $datakrs);
		
		//detil mahasiswa
		$datamahasiswa = $this->mastermahasiswa_model->find_detil($this->current_user->nim);
		Template::set('datamahasiswa', $datamahasiswa);
		//print_r($datamahasiswa);
		//die();
		//die();
		Template::set_view('krs/printkrs');
		
		if($mode=="print"){
			//Assets::add_css('style.css');  
			
			Template::set_theme('print');
		}
	Template::set('toolbar_title', '&nbsp;&nbsp; Cetak Kartu Rencana Studi Mahasiswa');
		Template::render();
	}

	public function updatekrs()
	{
		$kode_jadwal = $this->input->get('kode_jadwal');
		$id_krs = $this->input->get('id_krs');
		$kelas = $this->input->get('kelas');
		
		$this->load->model('jadwal/jadwal_model', null, true);
		$jadwal = $this->jadwal_model->find($kode_jadwal);
		 
		$this->update_krs("","","",$jadwal->kode_dosen,"",$kode_jadwal,$kelas,'update', $id_krs);
		
		die();
	}
	//--------------------------------------------------------------------


	/**
	 * Allows editing of DataKrs data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);
		Template::set_block('sub_nav', 'krs/_sub_nav');
		if (empty($id))
		{
			Template::set_message(lang('datakrs_invalid_id'), 'error');
			redirect(SITE_AREA .'/krs/datakrs');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('DataKrs.Krs.Edit');

			if ($this->edit_datakrs('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('datakrs_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'datakrs');

				Template::set_message(lang('datakrs_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('datakrs_edit_failure') . $this->datakrs_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('DataKrs.Krs.Delete');

			if ($this->datakrs_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('datakrs_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'datakrs');

				Template::set_message(lang('datakrs_delete_success'), 'success');

				redirect(SITE_AREA .'/krs/datakrs');
			}
			else
			{
				Template::set_message(lang('datakrs_delete_failure') . $this->datakrs_model->error, 'error');
			}
		}
		Template::set('datakrs', $this->datakrs_model->find($id));
	Template::set('toolbar_title', '&nbsp;&nbsp; Ubah Data Kartu Rencana Studi Mahasiswa');
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
	//------- View transkip Untuk Mahasiswa -------------------------------------------------------------
	public function lihatmatakuliahyangdiambil()
	{
		$this->load->model('datakrs/datakrs_model', null, true);
		$this->load->model('konversi/konversi_model', null, true);
		$this->load->model('predikat/predikat_model', null, true);
		$mode = $this->uri->segment(5); 
		$id = $this->current_user->nim;
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
		$data_mahasiswa = $this->mastermahasiswa_model->find_detil($id); 
		Template::set('datamahasiswa', $data_mahasiswa);
		//semester terakhir
		$semesterakhir = 1;
		$semesterterakhir = $this->datakrs_model->getsemesterterakhir($id);
		if(isset($semesterterakhir[0]->semester))
			$semesterakhir = $semesterterakhir[0]->semester;
			
		Template::set('semesterakhir', $semesterakhir);
		 
		$datakrs = $this->datakrs_model->find_mkdiambil("","",$id);
		$jsonkrs[][] =array();
		$jmlsks=0;
		if (isset($datakrs) && is_array($datakrs) && count($datakrs)) :
		foreach ($datakrs as $record) : 
			$jmlsks = $jmlsks + (int)$record->sks;
			$jsonkrs[$record->semester]['kode_mata_kuliah'][] = $record->kode_mk;
			//echo $record->semester."-".$record->semester = $record->nama_mata_kuliah;
			$jsonkrs[$record->kode_mk][$record->semester]['namamtk'] = $record->nama_mk;
			$jsonkrs[$record->kode_mk][$record->semester]['sks'] = $record->sks;
			$jsonkrs[$record->kode_mk][$record->semester]['nilai'] = $record->nilai_huruf;
		endforeach;
		endif;
		Template::set('jsonkrs', $jsonkrs);
		Template::set('datakrs', $datakrs);
		Template::set('mhs', $id);
		if($mode=="print"){
			Template::set_theme('print');
		}
		if($mode=="simple"){
			//die($mode);
			Template::set_theme('simple');
		}
		$recordkonversi = $this->konversi_model->find_all();
		$jsonkonversi[] =array();
		if (isset($recordkonversi) && is_array($recordkonversi) && count($recordkonversi)) :
		foreach ($recordkonversi as $record) : 
			$jsonkonversi[$record->huruf] = $record->angka;
		endforeach;
		endif;
		Template::set('jsonkonversi', $jsonkonversi);
		
		$semester = 0;
		 $jmlsks = 0;
		 $jmlbobot = 0;
		 $nilaiangka = "";
		 if (isset($datakrs) && is_array($datakrs) && count($datakrs)) : 
		 
			 foreach ($datakrs as $record) :
			 
			 if(isset($jsonkonversi[$record->nilai_huruf]))
			 {
				 $nilaiangka = $jsonkonversi[$record->nilai_huruf];
				// echo $record->semester." = ".$record->sks." = ".$record->nama_mata_kuliah."<br>";
				 $jmlsks = $jmlsks + (int)$record->sks;
				
				//$nilaiangka = $jsonkonversi[$record->nilai_huruf];
				$jmlbobot = $jmlbobot + ((int)$record->sks*(int)$nilaiangka);
			 }else{
				 //echo $record->nilai_huruf."NIlai huruf<br>";
				 
			 }
			 
			 endforeach; 
		 endif;
		 $ipk = 0;
		 if($jmlbobot!="" and $jmlsks != "")
		 {
			 $ipk = round($jmlbobot/$jmlsks, 2);
		 }
		 //predikat
		 $predikat = "";
		$redordpredikat = $this->predikat_model->find_predikat($ipk);
		if (isset($redordpredikat) && is_array($redordpredikat) && count($redordpredikat)) :
		foreach ($redordpredikat as $record) : 
			$predikat = $record->predikat;
			
		endforeach;
		endif;
		
		Template::set('predikat', $predikat);
		
		//echo $ipk; 
        		
		//print_r($data_mahasiswa);
		//die();
		Template::set('toolbar_title', 'Lihat Matakuliah Yang Telah diambil');
		Template::render();
	}
	
	private function save_datakrs($kode_mk="",$nama_mk="",$sks="",$mahasiswa="",$kode_dosen="",$nama_dosen,$semester="",$status="",$semester_matakuliah="",$kode_jadwal="",$kelas="",$type='insert', $id=0)
	{
		//die($this->input->post('tahun_ajaran').(int)$this->input->post('semester'));
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['kode_mk']        = $kode_mk;
		$data['nama_mk']        = $nama_mk;
		$data['sks']        	= $sks;
		$data['mahasiswa']      = $mahasiswa;
		$data['kode_dosen']     = $kode_dosen;
		$data['namadosen']        = $nama_dosen;
		$data['semester']       = (int)$semester;
		$data['tahun_akademik']        = $this->input->post('tahun_ajaran');
		
		$data['created_date']        = date("Y-m-d");
		$data['status']        = $status;
		if($kode_jadwal!="")
			$data['kode_jadwal']        = $kode_jadwal;
		if($kelas!="")
			$data['kelas']        = $kelas;
		$data['semester_matakuliah']        = (int)$semester_matakuliah;
		// $this->input->post('datakrs_created_date') ? $this->input->post('datakrs_created_date') : '0000-00-00';

		if ($type == 'insert')
		{
			$id = $this->datakrs_model->insert($data);

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
			$return = $this->datakrs_model->update($id, $data);
		}

		return $return;
	}
	private function edit_datakrs($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['kode_mk']       	 = $this->input->post('datakrs_kode_mk');
		$data['sks']      		  = $this->input->post('datakrs_sks');
		$data['mahasiswa']        = $this->input->post('datakrs_mahasiswa');
		$data['kode_dosen']        = $this->input->post('datakrs_kode_dosen');
		$data['semester']        = $this->input->post('datakrs_semester');
		$data['kode_jadwal']        = $this->input->post('datakrs_kode_jadwal');
		$data['nilai_angka']        = $this->input->post('datakrs_nilai_angka');
		$data['nilai_huruf']        = $this->input->post('datakrs_nilai_huruf');
		//$data['created_date']        = date("Y-m-d");// $this->input->post('datakrs_created_date') ? $this->input->post('datakrs_created_date') : '0000-00-00';

		if ($type == 'insert')
		{
			$id = $this->datakrs_model->insert($data);

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
			$return = $this->datakrs_model->update($id, $data);
		}

		return $return;
	}
	
	private function update_krs($kode_mk="",$sks="",$mahasiswa="",$kode_dosen="",$semester="",$kode_jadwal="",$kelas="",$type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		if($kode_mk!="")
			$data['kode_mk']        = $kode_mk;
		if($sks!="")
			$data['sks']        = $sks;
		if($mahasiswa!="")
			$data['mahasiswa']        = $mahasiswa;
		if($kode_dosen!="")
			$data['kode_dosen']        = $kode_dosen;
		if($semester!="")
			$data['semester']        = $semester;
		if($kode_jadwal!="")
			$data['kode_jadwal']        = $kode_jadwal;
		if($kelas!="")
			$data['kelas']        = $kelas;
		if ($type == 'insert')
		{
			$id = $this->datakrs_model->insert($data);

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
			$return = $this->datakrs_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}