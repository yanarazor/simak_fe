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
		$this->load->model('datakrs/datakrs_model', null, true);
		$this->lang->load('datakrs/datakrs');
		$this->auth->restrict('Krs_Mahasiswa.Krs.View');
		
		Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
		Assets::add_js('jquery-ui-1.8.13.min.js');
		Template::set_block('sub_nav', 'krs/_sub_nav');
		
		Assets::add_module_js('datakrs', 'datakrs.js');
		$this->load->model('mastermatakuliah/mastermatakuliah_model', null, true);
		$this->load->model('mastermahasiswa/mastermahasiswa_model', null, true);
		/*
		//master matakuliah
		
		$matakuliahs = $this->mastermatakuliah_model->find_distinctall();
		Template::set('matakuliahs', $matakuliahs);
		
		
		//master pilihan
		$this->load->model('pilihan/pilihan_model', null, true);
		$pilihansemester = $this->pilihan_model->find_all("sms");
		Template::set('pilihansemesters', $pilihansemester);
		
		//master Dosen
		$this->load->model('masterdosen/masterdosen_model', null, true);
		$dosens = $this->masterdosen_model->find_all();
		Template::set('dosens', $dosens);
		$pilihantahuns = $this->pilihan_model->find_all("ta");
		Template::set('pilihantahuns', $pilihantahuns);
		*/
		Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
		Assets::add_js('jquery-ui-1.8.13.min.js');
		Assets::add_css('fancybox/jquery.fancybox-1.3.4.css');
		Assets::add_js('fancybox/jquery.fancybox-1.3.4.js');
		
		//master Fakultas
		$this->load->model('masterfakultas/masterfakultas_model', null, true);
		$masterfakultas = $this->masterfakultas_model->find_all();
		Template::set('masterfakultass', $masterfakultas);
		//master jurusan
		$this->load->model('masterprogramstudi/masterprogramstudi_model', null, true);
		$masterprogramstudis = $this->masterprogramstudi_model->find_all();
		Template::set('masterprogramstudis', $masterprogramstudis);
		
		 
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{
		$this->load->model('pilihan/pilihan_model', null, true);
		$pilihantahuns = $this->pilihan_model->find_all("ta");
		Template::set('pilihantahuns', $pilihantahuns);
		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$this->load->model('transkip/transkip_model', null, true);
				$result = FALSE;
				foreach ($checked as $pid)
				{
					
					$datadetil = $this->datakrs_model->find($pid);
					$datadelete = array('nim '=>$datadetil->mahasiswa,'kode_mk'=>$datadetil->kode_mk,'nilai_huruf'=>$datadetil->nilai_huruf);
					$this->transkip_model->delete_where($datadelete);
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
		$filfakultas = $this->input->get('filfakultas');
		$tahun = $this->input->get('tahun');
		$mhs = $this->input->get('mhs');
		$filljurusan = $this->input->get('filljurusan');
		$status = $this->input->get('status');
		$angkatan = $this->input->get('angkatan');
		
		$this->load->library('pagination');
		$total = count($this->datakrs_model->krsbytahunanakademik($tahun,$filfakultas,$filljurusan,$mhs,$status,$angkatan));
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url()."?filfakultas=".$filfakultas."&tahun=".$tahun."&filljurusan=".$filljurusan."&mhs=".$mhs."&status=".$status."&angkatan=".$angkatan;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		$records = $this->datakrs_model->limit($limit, $offset)->krsbytahunanakademik($tahun,$filfakultas,$filljurusan,$mhs,$status,$angkatan);
 
		Template::set('records', $records);
		if(isset($records) && is_array($records) && count($records))
			$total = $total;
		else
			$total = 0;
		Template::set('total', $total);
		Template::set('limit', $offset!="" ? $offset+1 : 1);
		Template::set('status', $status); 
		Template::set('angkatan', $angkatan); 
		
		Template::set('tahun', $tahun); 
		Template::set('filfakultas', $filfakultas); 
		Template::set('filljurusan', $filljurusan); 
		Template::set('mhs', $mhs);
		Template::set('toolbar_title', '&nbsp;&nbsp; Pengelolaan Kartu Rencana Studi Mahasiswa');
		Template::render(); 
	}
	public function printlist()
	{
		 
		$filfakultas = $this->input->get('filfakultas');
		$tahun = $this->input->get('tahun');
		$mhs = $this->input->get('mhs');
		$filljurusan = $this->input->get('filljurusan');
		$status = $this->input->get('status');
		$angkatan = $this->input->get('angkatan');
		
		 
		$records = $this->datakrs_model->krsbytahunanakademik($tahun,$filfakultas,$filljurusan,$mhs,$status,$angkatan);
 
		Template::set('records', $records);
		 
		Template::set('status', $status); 
		Template::set('angkatan', $angkatan); 
		
		Template::set('tahun', $tahun); 
		Template::set('filfakultas', $filfakultas); 
		Template::set('filljurusan', $filljurusan); 
		Template::set('mhs', $mhs);
		Template::set('toolbar_title', '&nbsp;&nbsp; Pengelolaan Kartu Rencana Studi Mahasiswa');
		Template::set_theme('print');
		Template::render(); 
	}
	public function lihat()
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
		$mhs 	= $this->input->get('mhs');
		$ta 	= $this->settings_lib->item('site.tahun');
		$this->load->library('pagination');
		$total 	= count($this->datakrs_model->findbytahun_ajaran($ta,$mhs));
		$offset = $this->input->get('per_page');
		$limit 	= $this->settings_lib->item('site.list_limit');
		$this->pager['base_url'] 			= current_url()."?ta=".$ta."&mhs=".$mhs;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		$records = $this->datakrs_model->limit($limit, $offset)->findbytahun_ajaran($ta,$mhs);
 
		Template::set('records', $records);
		if(isset($records) && is_array($records) && count($records))
			$total = $total;
		else
			$total = 0;
		Template::set('total', $total);
		Template::set('ta', $ta); 
		Template::set('mhs', $mhs);
		Template::set('toolbar_title', '&nbsp;&nbsp; Pengelolaan Kartu Rencana Studi Mahasiswa');
		Template::render(); 
	}
	public function khs()
	{
		 
		$mhs 	= $this->input->get('mhs');
		$ta 	= $this->settings_lib->item('site.tahun');
		$this->load->library('pagination');
		$total 	= count($this->datakrs_model->findbyangkatan($ta,$mhs));
		$offset = $this->input->get('per_page');
		$limit 	= $this->settings_lib->item('site.list_limit');
		$this->pager['base_url'] 			= current_url()."?ta=".$ta."&mhs=".$mhs;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		$records = $this->datakrs_model->limit($limit, $offset)->findbyangkatan($ta,$mhs);
 
		Template::set('records', $records);
		if(isset($records) && is_array($records) && count($records))
			$total = $total;
		else
			$total = 0;
		Template::set('total', $total);
		Template::set('ta', $ta); 
		Template::set('mhs', $mhs);
		Template::set('toolbar_title', '&nbsp;&nbsp; Pengelolaan Kartu Rencana Studi Mahasiswa');
		Template::render(); 
	}
	//----------------------------------------------------------------------------------------------------------------------------------------
	/**
	 * Creates a Krs Mahasiswa object.
	 *
	 * @return void
	 */
	public function create()
	{
		// Log the activity
		$this->auth->restrict('Krs_Mahasiswa.Krs.Create');
		Template::set('toolbar_title', 'Buat KRS');
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

		 
		Template::render();
	}
	public function input()
	{
		$this->auth->restrict('Krs_Mahasiswa.Krs.Create');
		Template::set_block('sub_nav', 'krs/_sub_nav');
		$nim = $this->uri->segment(5);
		$this->load->model('mastermahasiswa/mastermahasiswa_model', null, true);
		$kode_prodi = "";
		$namamahasiswa = "";
		$recordmahasiswa = $this->mastermahasiswa_model->get_by_nim($nim); 
		if($recordmahasiswa){
				//$sms = $recordmahasiswa[0]->semester;
				$kode_prodi = $recordmahasiswa[0]->kode_prodi;
				$bypass = $recordmahasiswa[0]->status_bayar;
				$namamahasiswa = $recordmahasiswa[0]->nama_mahasiswa;
		}
		Template::set('namamahasiswa', $namamahasiswa);
		
		$sms 		= "1";
		$bypass 	= "1";
		
		// ambil semester aktif
		$this->load->library('convert');
		$convert = new convert();	
		$sms = $this->convert->getsemester($nim,$this->settings_lib->item('site.tahun'));
		// cek pembayaran apakah sudah 
		$status_bayar = "0";
		$this->load->model('konfirmasipembayaran/konfirmasipembayaran_model', null, true);
		if($this->konfirmasipembayaran_model->cekpembayaran($sms,$nim)>0 or $bypass =="1")
		{
			$status_bayar = "1";
		} else{
			$status_bayar = "0";
			
		}
		if($this->settings_lib->item('site.tahun')%2===0)
		{
		 
			$stat_semester = "2";
			$arraysms 	= array("2","4","6","8");
			$recsemester2 = $this->mastermatakuliah_model->find_by_ditawarkan("2",$kode_prodi,$stat_semester); 
			$recsemester4 = $this->mastermatakuliah_model->find_by_ditawarkan("4",$kode_prodi,$stat_semester); 
			$recsemester6 = $this->mastermatakuliah_model->find_by_ditawarkan("6",$kode_prodi,$stat_semester); 
			$recsemester8 = $this->mastermatakuliah_model->find_by_ditawarkan("8",$kode_prodi,$stat_semester);
			//print_r($recsemester8); 
			//die("ini"."$recsemester8");
			Template::set("recsemester2", $recsemester2);
			Template::set("recsemester4", $recsemester4);
			Template::set("recsemester6", $recsemester6);
			Template::set("recsemester8", $recsemester8);
			$total = 0;
			if(isset($recsemester2) && is_array($recsemester2) && count($recsemester2))
				$total =  count($recsemester2);
		}else{
			$stat_semester = "1";
			$arraysms = array("1","3","5","7");
			$recsemester1 = $this->mastermatakuliah_model->find_by_ditawarkan("1",$kode_prodi,$stat_semester); 
			$recsemester3 = $this->mastermatakuliah_model->find_by_ditawarkan("3",$kode_prodi,$stat_semester); 
			$recsemester5 = $this->mastermatakuliah_model->find_by_ditawarkan("5",$kode_prodi,$stat_semester); 
			$recsemester7 = $this->mastermatakuliah_model->find_by_ditawarkan("7",$kode_prodi,$stat_semester); 
			Template::set("recsemester1", $recsemester1);
			Template::set("recsemester3", $recsemester3);
			Template::set("recsemester5", $recsemester5);
			Template::set("recsemester7", $recsemester7);
			$total = 0;
			if(isset($recsemester1) && is_array($recsemester1) && count($recsemester1))
				$total =  count($recsemester1);
		}
		
		Template::set('status_bayar', $status_bayar);
		Template::set('kode_prodi', $kode_prodi);
		Template::set('sms', $sms);
		Template::set('stat_semester', $stat_semester);
		
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
					if($this->datakrs_model->isuniq_mhs($sms,$this->input->post('kodemk_'.$pid),$nim)>0){
						$sudahada = $sudahada+1;
					}else{
						$berhasil = $berhasil+1;
						 
						$result = $this->save_datakrs_manual($this->input->post('kodemk_'.$pid),$this->input->post('nama_mk_'.$pid),$this->input->post('mksks_'.$pid),$nim,"","",$sms,"B",$this->input->post('sms_'.$pid),$this->input->post('txtkdjadwal_'.$pid),$this->input->post('txtkelas_'.$pid));
					}
				}

				if ($result)
				{
					// Log the activity
					log_activity($this->current_user->id, 'Submit KRS '.$nim.', dari IP :'. $this->input->ip_address(), 'datakrs');
					Template::set_message($berhasil .' Mata kuliah sudah di tambahkan pada krs NIM : '.$nim.' , Gagal :'.$sudahada, 'success');
				}
				else
				{
					Template::set_message($berhasil .' Mata kuliah tambahkan pada krs anda , Gagal :'.$sudahada.' Karena data mata kuliah sudah dimasukan' . $this->datakrs_model->error, 'error');
				}
			}
		}
		$recordkrss = $this->datakrs_model->find_all($sms,"",$nim);
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
		$ipsemesterini = $this->hitung_ipsemester($sms-1, $nim);
		$ips = $ipsemesterini;//"1.5";
		$mak_sks = $this->getmaksks($ips);
		Template::set('ips', $ips);
		Template::set('mak_sks', $mak_sks);
		Template::set('recordkrss', $recordkrss);
		Template::set('jsonkrs', $jsonkrs);
		Assets::add_module_js('datakrs', 'datakrs.js');
		Template::set('toolbar_title', '&nbsp;&nbsp; Tambah Data Kartu Rencana Studi Mahasiswa'.$nim);
		Template::render();
	}
	public function lihatmatakuliahyangdiambil()
	{
		$this->load->model('datakrs/datakrs_model', null, true);
		$this->load->model('konversi/konversi_model', null, true);
		$this->load->model('predikat/predikat_model', null, true);
		$mode 	= $this->uri->segment(5); 
		$id 	= $this->uri->segment(6);
		
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
		// Log the activity
		log_activity($this->current_user->id, 'Lihat KRS Lengkap, Dari : '. $this->input->ip_address(), 'datakrs');

		//echo $ipk; 
        		
		//print_r($data_mahasiswa);
		//die();
		Template::set('toolbar_title', 'Lihat Matakuliah Yang Telah diambil');
		Template::render();
	}
	 
	public function create1()
	{
		$this->auth->restrict('Krs_Mahasiswa.Krs.Create');
		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_datakrs())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('datakrs_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'datakrs');

				Template::set_message("Create data KRS Success", 'success');
				redirect(SITE_AREA .'/krs/krs_mahasiswa');
			}
			else
			{
				Template::set_message("Create Gagal". $this->datakrs_model->error, 'error');
			}
		}
		Assets::add_module_js('krs_mahasiswa', 'krs_mahasiswa.js');

		Template::set('toolbar_title', '&nbsp; Tambah Data Kartu Rencana Studi Mahasiswa');
		Template::render();
	}
	public function update_semester()
	{
		// cek 2014320100
		$this->load->library('Convert');
		$ta 			= "20142";
		$jmlsama 		= 0;
		$jmlsmsupdate 	= 0;
		$records = $this->datakrs_model->get_data($ta,"","195983");
		if(isset($records) && is_array($records) && count($records))
		{
			foreach ($records as $record) :
				$sms = $this->convert->getsemester($record->mahasiswa,$ta);
				if($sms == $record->semester){
					$jmlsama = $jmlsama + 1;
				}else{
					$jmlsmsupdate = $jmlsmsupdate + 1;
					$data = array();
					$data['semester']      = $sms;
					$return = $this->datakrs_model->update($record->id, $data);
					//die("id : ". $record->id." - ".$record->mahasiswa." - sms : ".$sms." semester :".$record->semester);
					echo "id : ". $record->id." - ".$record->mahasiswa." - sms : ".$sms." semester :".$record->semester." <br>";
				}
			endforeach;
			echo "Semester sama : ".$jmlsama."<br>";
			echo "Semester Update : ".$jmlsmsupdate."<br>";
		}
	}
	//--------------------------------------------------------------------


	/**
	 * Allows editing of Krs Mahasiswa data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('datakrs_invalid_id'), 'error');
			redirect(SITE_AREA .'/krs/datakrs');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('DataKrs.Krs.Edit');

			if ($this->save_datakrs('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('datakrs_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'datakrs');

				Template::set_message("Edit Success", 'success');
			}
			else
			{
				Template::set_message("Save error" . $this->datakrs_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('DataKrs.Krs.Delete');
			
			$this->load->model('transkip/transkip_model', null, true);
			$datadetil = $this->datakrs_model->find($id);
			$datadelete = array('nim '=>$datadetil->mahasiswa,'kode_mk'=>$datadetil->kode_mk,'nilai_huruf'=>$datadetil->nilai_huruf);
			$this->transkip_model->delete_where($datadelete);
			
			if ($this->datakrs_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, 'Delete data KRS id : '. $id .' : '. $this->input->ip_address(), 'datakrs');

				Template::set_message("Delete success", 'success');

				redirect(SITE_AREA .'/krs/krs_mahasiswa');
			}
			else
			{
				Template::set_message("Delete gagal" . $this->datakrs_model->error, 'error');
			}
		}
		Template::set('datakrs', $this->datakrs_model->find($id));

			Template::set('toolbar_title', '&nbsp; Ubah Data Kartu Rencana Studi Mahasiswa');

		Template::render();
	}

	public function detil()
	{
		$sms = $this->uri->segment(5);
		$mhs = $this->uri->segment(6);
		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$this->load->model('transkip/transkip_model', null, true);
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$datadetil = $this->datakrs_model->find($pid);
					$datadelete = array('nim '=>$datadetil->mahasiswa,'kode_mk'=>$datadetil->kode_mk,'nilai_huruf'=>$datadetil->nilai_huruf);
					$this->transkip_model->delete_where($datadelete);
					
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
		$kode_mk 	= $this->input->get('kode_mk'); 
		$this->load->library('pagination');
		$total 		= count($this->datakrs_model->find_distinct($sms,$kode_mk,$mhs));
		$offset 	= $this->input->get('per_page');
		$limit 		= $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url()."?sms=".$sms."&kode_mk=".$kode_mk."&mhs=".$mhs;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		$records = $this->datakrs_model->limit($limit, $offset)->find_distinct($sms,$kode_mk,$mhs);

		Template::set('records', $records);
		Template::set('total', $total);
		
		Template::set('sms', $sms);
		//die($kode_mk);
		Template::set('kode_mk', $kode_mk);
		Template::set('mhs', $mhs);
		Template::set('toolbar_title', '&nbsp;&nbsp; Detail Kartu Rencana Studi Mahasiswa');
		Template::render();
	}
	public function listdata()
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

	public function printkrs()
	{
		$sms = $this->uri->segment(5);
		$mhs = $this->uri->segment(6); 
		$mode = $this->uri->segment(7); 
		//die($mode);
		if (empty($sms))
		{
			Template::set_message("Silahkan Pilih Semester Terlebih dahulu.", 'warning');	 
		}
		//die($sms."sms");
		Template::set('sms', $sms);
		Template::set('mhs', $mhs);
		$datakrs = $this->datakrs_model->find_krs($sms,"",$mhs);
		Template::set('datakrs', $datakrs);
		
		//detil mahasiswa
		$datamahasiswa = $this->mastermahasiswa_model->find_detil($mhs);
		Template::set('datamahasiswa', $datamahasiswa);
		//print_r($datamahasiswa);
		Template::set_view('krs/printkrs');
		
		if($mode=="print"){
			//Assets::add_css('style.css');  
			Template::set_theme('print');
		}
	Template::set('toolbar_title', '&nbsp;&nbsp; Cetak Kartu Rencana Studi Mahasiswa');
		Template::render();
	}
	//--------------------------------------------------------------------
	public function printkhs()
	{
		$this->load->model('konversi/konversi_model', null, true);
		$sms = $this->uri->segment(5);
		$mhs = $this->uri->segment(6); 
		$mode = $this->uri->segment(7); 
		$ipklalu = 0;
		//die($sms);
		if (empty($sms))
		{
			Template::set_message("Silahkan Pilih Semester Terlebih dahulu.", 'warning');
		}
		// ipk semester sebelumnya
		$smssebelum = 1;
		if((int)$sms>1 and (int)$sms<10)
		{	
			$smssebelum = "0".((int)$sms-1);
		}
		if($sms=="PP")
			$smssebelum = "07";
		
		//die($smssebelum."");
		$ipklalu = $this->hitung_ipsemester($smssebelum, $mhs);
		Template::set('ipklalu', $ipklalu);
		
		$ipsemesterskr = $this->hitung_ipsemester($sms, $mhs);
		Template::set('ipksms', $ipsemesterskr);
		
		$ips = $this->hitung_ips($mhs);
		Template::set('ips', $ips);
		
		Template::set('sms', $sms);
		Template::set('mhs', $mhs);
		$datakrs = $this->datakrs_model->find_krs($sms,"",$mhs);
		Template::set('datakrs', $datakrs);
		
		//detil mahasiswa
		$datamahasiswa = $this->mastermahasiswa_model->find_detil($mhs);
		Template::set('datamahasiswa', $datamahasiswa);
		//print_r($datamahasiswa);
		Template::set_view('krs/printkhs');
		
		$recordkonversi = $this->konversi_model->find_all();
		$jsonkonversi[] =array();
		if (isset($recordkonversi) && is_array($recordkonversi) && count($recordkonversi)) :
		foreach ($recordkonversi as $record) : 
			$jsonkonversi[$record->huruf] = $record->angka;
			//echo $record->huruf;
		endforeach;
		endif;
		
		Template::set('jsonkonversi', $jsonkonversi);
		
		$mak_sks = $this->getmaksks($ipsemesterskr);
		Template::set('mak_sks', $mak_sks);
		
		if($mode=="print"){
			//Assets::add_css('style.css');  
			Template::set_theme('print');
		}
			Template::set('toolbar_title', '&nbsp;&nbsp; Cetak Kartu Hasil Studi');
		Template::render();
	}
	public function cetakkhs()
	{
		$this->load->model('konversi/konversi_model', null, true);
		$angkatan = $this->uri->segment(5); 
		$ta 	= $this->settings_lib->item('site.tahun');
		$records = $this->datakrs_model->findbyangkatan($ta,$angkatan);
 		Template::set('ta', $ta); 
 		Template::set('records', $records); 
		Template::set('angkatan', $angkatan);
		
		Template::set('toolbar_title', '&nbsp;&nbsp; Cetak Kartu Hasil Studi');
		Template::set_theme('print');
		Template::render();
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
			//echo $record->huruf;
		endforeach;
		endif;
		$jmlsks = 0;
		$jmlbobot = 0;
		$datakrs = $this->datakrs_model->find_krs($sms,"",$mhs);
		$nilaiangka = "";
		if (isset($datakrs) && is_array($datakrs) && count($datakrs)) : 
							    
		 $no = 1;
			foreach ($datakrs as $record) :
			   if(isset($jsonkonversi[$record->nilai_huruf]))
					$nilaiangka = $jsonkonversi[$record->nilai_huruf];
					
			   if($nilaiangka!="" and isset($jsonkonversi[$record->nilai_huruf])){
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
	private function hitung_ips($nim)
	{
		$this->load->model('konversi/konversi_model', null, true);
		$mhs = $nim; 
		//die($mhs);
		$recordkonversi = $this->konversi_model->find_all();
		$jsonkonversi[] =array();
		if (isset($recordkonversi) && is_array($recordkonversi) && count($recordkonversi)) :
		foreach ($recordkonversi as $record) : 
			$jsonkonversi[$record->huruf] = $record->angka;
			//echo $record->huruf;
		endforeach;
		endif;
		$jmlsks = 0;
		$jmlbobot = 0;
		$datakrs = $this->datakrs_model->find_distinct("","",$mhs);
		//print_r($datakrs);
		if (isset($datakrs) && is_array($datakrs) && count($datakrs)) : 
							    
		 $no = 1;
			foreach ($datakrs as $record) :
				//echo $record->semester." = ".$record->sks." = ".$jmlsks." ".$record->kode_mata_kuliah." ".$record->nama_mata_kuliah."<br>";
			   if(isset($jsonkonversi[$record->nilai_huruf]))
			   {
					$nilaiangka = $jsonkonversi[$record->nilai_huruf];
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
		}
		//die($jmlsks." ini");
		return $ipk; 
		
	}
	public function runimport()
	{
		
		ini_set('memory_limit', '1024M'); 
		$success = 0;
		$sudahada = 0;
		$upload = true;
		 
				  // end handle upload
				  $this->load->library('Convert');
				  $Class_Convert = new Convert;
				  $file = $this->settings_lib->item('site.pathxls').'akuntansi1.xlsx';
				  $this->load->library('Excel');
				  $objPHPExcel = PHPExcel_IOFactory::load($file);
		 
				  //  Get worksheet dimensions
				  $sheet = $objPHPExcel->getSheet(0); 
				  $highestRow = $sheet->getHighestRow(); 
				  $highestColumn = $sheet->getHighestColumn();

				  //  Loop through each row of the worksheet in turn
				for ($row = 2; $row <= $highestRow; $row++){ 
					 //  Read a row of data into an array
					 $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
													 NULL,
													 TRUE,
													 FALSE);
					 //  Insert row data array into your database of choice here
				  
					 $nim	= preg_replace("/\s+/", "",$rowData[0][0]);
					 //echo $nim;
					//die($nim);
					if($rowData[0][1] != ""){
						$insert_id = $this->generate_datakrs($nim,$rowData[0][2],$rowData[0][1],$rowData[0][3],$rowData[0][4],$rowData[0][5],$rowData[0][6],$rowData[0][7]);
						if($insert_id){
							$success++;
						}
					}
						 
					 
			  	}
			  	
		   
		$msgsudahada = "";
		$msgsuccess = "";
		if($sudahada>0)
			$msgsudahada .= "Duplikasi data : ".$sudahada." data";
		if($success>0)
			$msgsuccess .= "Berhasil : ".$success." data";
		echo $msgsuccess.$msgsudahada."\nUpload Selesai";
	   //send the data in an array format
	 	exit;
		 
	}
	private function generate_datakrs($nim="",$nama_mk="",$kode_mk="",$semester="",$dosen="",$nilai_huruf="",$sks="",$jml_diambil="",$type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}
		// make sure we only pass in the fields we want
		$data = array();
		$data['mahasiswa']        		= $nim;
		$data['kode_mk']        	= $kode_mk;
		$data['nama_mk']        	= $nama_mk;
		$valsemester = str_replace("semester :","",$semester);
		$data['semester']        	= trim($valsemester);
		$data['namadosen']        		= $dosen;
		$data['nilai_huruf']        = $nilai_huruf;
		$data['sks']        		= $sks;
		
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
	public function printkartu()
	{
		$sms = $this->uri->segment(5);
		$mhs = $this->uri->segment(6); 
		$mode = $this->uri->segment(7); 
		//die($mode);
		if (empty($sms))
		{
			Template::set_message("Silahkan Pilih Semester Terlebih dahulu.", 'warning'); 
		}
		Template::set('sms', $sms);
		Template::set('mhs', $mhs);
		//Template::set('sms', $sms);
		$datakrs = $this->datakrs_model->find_krs($sms,"",$mhs);
		Template::set('datakrs', $datakrs);
		
		//detil mahasiswa
		$datamahasiswa = $this->mastermahasiswa_model->find_detil($mhs);
		Template::set('datamahasiswa', $datamahasiswa);
		//print_r($datamahasiswa);
		Template::set_view('krs/printkartu');
		
		if($mode=="print"){
			//Assets::add_css('style.css');  
			Template::set_theme('print');
		}
	Template::set('toolbar_title', '&nbsp;&nbsp; Cetak Kartu');
		Template::render();
	}
	public function printkartuall()
	{
		$status = $this->uri->segment(5);
		$tahun_masuk = $this->uri->segment(6); 
		//$mode = $this->uri->segment(7);
		$mode = $this->input->get('mode');
		$prodi = $this->uri->segment(7); 
		
		Template::set('tahun_masuk', $tahun_masuk);
		Template::set('status', $status);
		Template::set('prodi', $prodi);
		//Template::set('sms', $sms);
		//$datakrs = $this->datakrs_model->find_krs($sms,"",$mhs);
		//Template::set('datakrs', $datakrs);
		
		//detil mahasiswa
		$datamahasiswa = $this->mastermahasiswa_model->find_detilbytahunmasukandprodi($tahun_masuk,$status,$prodi);
		 
		Template::set('datamahasiswa', $datamahasiswa);
		Template::set('total', count($datamahasiswa));
		Template::set_view('krs/printkartuall');
		
		if($mode=="print"){
			//Assets::add_css('style.css');  
			Template::set_theme('print');
		}
		 
		Template::set_message("Total data : ".count($datamahasiswa), 'warning'); 
		
		Template::set('toolbar_title', '&nbsp;&nbsp; Cetak Kartu Rencana Studi Mahasiswa');
		Template::render();
	}
	//--------
	private function save_datakrs_manual($kode_mk="",$nama_mk="",$sks="",$mahasiswa="",$kode_dosen="",$nama_dosen,$semester="",$status="",$semester_matakuliah="",$kode_jadwal="",$kelas="",$type='insert', $id=0)
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
	private function save_datakrs($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}
		$this->form_validation->set_rules('tahun_akademik','Tahun Akademik','required|max_length[6]');
		$this->form_validation->set_rules('datakrs_kode_mk','Mata kuliah','required|max_length[20]');
		$this->form_validation->set_rules('datakrs_sks','sks','required|max_length[5]');
		$this->form_validation->set_rules('datakrs_mahasiswa','Nim Mahasiswa','required|max_length[30]');
		$this->form_validation->set_rules('datakrs_kode_dosen','Dosen','required|max_length[20]');
		$this->form_validation->set_rules('datakrs_semester','Semester','required|max_length[3]');
		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['kode_mk']        = $this->input->post('datakrs_kode_mk');
		$data['sks']        = $this->input->post('datakrs_sks');
		$data['mahasiswa']        = $this->input->post('datakrs_mahasiswa');
		$data['kode_dosen']        = $this->input->post('datakrs_kode_dosen');
		$data['semester']        = $this->input->post('datakrs_semester');
		$data['kode_jadwal']        = $this->input->post('datakrs_kode_jadwal');
		$data['nilai_angka']        = $this->input->post('datakrs_nilai_angka');
		$data['nilai_huruf']        = $this->input->post('datakrs_nilai_huruf');
		$data['tahun_akademik']        = $this->input->post('tahun_akademik');
		$data['created_date']        = date("Y-m-d");// $this->input->post('datakrs_created_date') ? $this->input->post('datakrs_created_date') : '0000-00-00';

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

}