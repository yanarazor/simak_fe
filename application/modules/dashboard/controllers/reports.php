<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * reports controller
 */
class reports extends Admin_Controller
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

		$this->auth->restrict('Dashboard.Reports.View');
		$this->lang->load('dashboard');
		
		Assets::add_js('jquery-ui-1.8.13.min.js');
		Assets::add_css('fancybox/jquery.fancybox-1.3.4.css');
		Assets::add_js('fancybox/jquery.fancybox-1.3.4.js');
		Template::set_block('sub_nav', 'reports/_sub_nav');

		Assets::add_module_js('dashboard', 'dashboard.js');
		$this->load->model('datakrs/datakrs_model', null, true);
		$this->load->model('mastermahasiswa/mastermahasiswa_model', null, true);
		
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{
		$this->load->library('Convert');
		$convert = new Convert();	
 
		$sms = $this->convert->getsemester($this->current_user->nim,$this->settings_lib->item('site.tahun'));
		Template::set('sms', $sms);
		
		$fillnim 	= $this->current_user->nim;
		Template::set('nim', $fillnim);
		$ips = $this->hitung_ipk($fillnim);
		Template::set('ips', $ips);
		
		$jmlsks = $this->hitungjmlsks($fillnim);
		Template::set('jmlsks', $jmlsks);
		// ip semester sekarang
		$recordmahasiswa = $this->mastermahasiswa_model->find_detil($fillnim); 
		$nama_dosen_promotor = "";
		$kode_prodi = "";
		if($recordmahasiswa){
			$kode_prodi = $recordmahasiswa[0]->kode_prodi;
			$nama_dosen_promotor = $recordmahasiswa[0]->nama_dosen;
		}
		
		$ipsemesterini = $this->hitung_ipsemester($sms, $fillnim);
		Template::set('ipsemesterini', $ipsemesterini);
		Template::set('nama_dosen_promotor', $nama_dosen_promotor);
		
		//matakuliah semester berjalan
		//$recordmks = $this->datakrs_model->find_bysenester($sms,$fillnim);
		//Template::set('recordmks', $recordmks);
		
		//jumlah sudah ada nilai
		$jumlahadanilai = $this->datakrs_model->count_nilaiisi($fillnim,"");
		Template::set('jumlahadanilai', $jumlahadanilai);
		//jmlah nilai belum diisi
		$jumlahnilaiblm = $this->datakrs_model->count_nilaiblm($fillnim,"");
		Template::set('jmlbelumadanilai', $jumlahnilaiblm);
		//Jadwal Mahasiwa
		$jumlahjadwal = $this->datakrs_model->count_jadwal_mhs($fillnim,"",$sms);
		Template::set('jumlahjadwal', $jumlahjadwal);
		
		
		//aktifitas
		/*
		$this->load->model('activities/activity_model');
		 
		$modules = array('users');
		$this->activity_model->where("user_id",$this->current_user->id);
		$activities = $this->activity_model->order_by('created_on', 'desc')->limit(10)->find_by_module($modules);
		Template::set('activities', $activities);
		*/
		// Log the activity
		log_activity($this->current_user->id, 'Lihat Dashboard Mahasiswa, dari : '. $this->input->ip_address(), 'dashboard');
		Template::set_theme("adminlte");
		Template::set('toolbar_title', 'Dashboard');
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
		$datakrs = $this->datakrs_model->find_krs($sms,"",$mhs);
		$nilaiangka= 0;
		if (isset($datakrs) && is_array($datakrs) && count($datakrs)) : 
		 $no = 1;
			foreach ($datakrs as $record) :
			   if(isset($jsonkonversi[$record->nilai_huruf]))
					$nilaiangka = $jsonkonversi[$record->nilai_huruf];
			   if($nilaiangka!=""){
				 $jmlsks = $jmlsks + (int)$record->sks;
		  
				  $nilaiangka = isset($jsonkonversi[$record->nilai_huruf]) ? $jsonkonversi[$record->nilai_huruf] : "";
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
	private function hitungjmlsks($nim)
	{
		$this->load->model('transkip/transkip_model', null, true);
		$datakrs = $this->transkip_model->getjumlahsks($nim);
		$jsonkrs[][] =array();
		$jmlsks=0;
		if (isset($datakrs) && is_array($datakrs) && count($datakrs)) :
		foreach ($datakrs as $record) : 
			 
				$jmlsks = $jmlsks + (int)$record->jumlahsks;
			 
		endforeach;
		endif;
		return $jmlsks; 
		
	}
	private function hitung_ipk($nim)
	{
		$this->load->model('konversi/konversi_model', null, true);
		$this->load->model('transkip/transkip_model', null, true);
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
		$datakrs = $this->transkip_model->find_transkip($nim,"","1");
		$jsonkrs[][] =array();
		$jmlsks=0;
		$semesterakhir = 1;
		
		$semester = 0;
		$jmlsks = 0;
		$jmlbobot = 0;
		$nilaiangka = "";
		if (isset($datakrs) && is_array($datakrs) && count($datakrs)) : 
		
			foreach ($datakrs as $record) :
			
			if(isset($jsonkonversi[$record->nilai_huruf]))
			{
				$nilaiangka = $jsonkonversi[$record->nilai_huruf];
				$jmlsks = $jmlsks + (int)$record->sks;
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
		//die($jmlsks." ini");
		return $ipk; 
		
	}

	//--------------------------------------------------------------------



}