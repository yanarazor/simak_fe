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

		$this->auth->restrict('Dashboard_adm.Reports.View');
		$this->lang->load('dashboard_adm');
		
		Template::set_block('sub_nav', 'reports/_sub_nav');

		Assets::add_module_js('dashboard_adm', 'dashboard_adm.js');
		$this->load->model('datakrs/datakrs_model', null, true);
		$this->load->model('mastermahasiswa/mastermahasiswa_model', null, true);
		$this->load->model('konfirmasipembayaran/konfirmasipembayaran_model', null, true);
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{
		Assets::add_js('jquery-ui-1.8.13.min.js');
		Assets::add_css('fancybox/jquery.fancybox-1.3.4.css');
		Assets::add_js('fancybox/jquery.fancybox-1.3.4.js');
		$this->load->model('jadwal/jadwal_model');
		//aktifitas
		//master jurusan
		$this->load->model('masterprogramstudi/masterprogramstudi_model', null, true);
		$masterprogramstudis = $this->masterprogramstudi_model->find_all();
		Template::set('masterprogramstudis', $masterprogramstudis);
		//master Fakultas
		$this->load->model('masterfakultas/masterfakultas_model', null, true);
		$masterfakultas = $this->masterfakultas_model->find_all();
		Template::set('masterfakultass', $masterfakultas);
		
		$this->load->model('activities/activity_model');
		 
		$modules = array('users',"transkip","jadwal","datakrs","event","forum","gallery","informasi_dan_berita","jadwal","konfirmasipembayaran","masterdosen","masterfakultas","masterkelas","mastermahasiswa","mastermatakuliah","masterruangan","pilihan","predikat","dashboard");
		$activities = $this->activity_model->order_by('created_on', 'desc')->limit(10)->find_by_module($modules);
		Template::set('activities', $activities);
		$jmlsubmitkrs = 0;
		$datakrssubmit = $this->datakrs_model->Getjmlmahasiswaaktif(); 
		if(isset($datakrssubmit) && is_array($datakrssubmit) && count($datakrssubmit)):
		  foreach ($datakrssubmit as $rec) :
		  		$jmlsubmitkrs = $rec->jumlah;
		  endforeach; 
		  endif;
	 	Template::set('jmlsubmitkrs', $jmlsubmitkrs);
		
		// data belum dinilai
	 	$jmlkrsgakadanilai = $this->datakrs_model->Getjmlgakadanilai(); 
	 	Template::set('jmlkrsgakadanilai', $jmlkrsgakadanilai);
	 	// data konfirmasi pembayaran
	 	$tahun = substr($this->settings_lib->item('site.tahun'),0,4);
	 	$jmlkonfirmasipembayaran = $this->konfirmasipembayaran_model->getjumlah_konfirmasi($tahun); 
	 	Template::set('jmlkonfirmasipembayaran', $jmlkonfirmasipembayaran);
	 	// mahasiswa aktif
	 	$jmlmahasiswaaktif = 0;
	 	Template::set('jmlmahasiswaaktif', $jmlmahasiswaaktif);
	 	$tahunakademik = $this->settings_lib->item('site.tahun');
	 	$jumlahjadwal 	= $this->jadwal_model->jumlahjadwal($tahunakademik,"");
		Template::set('jumlahjadwal', $jumlahjadwal);
		
		Template::set('toolbar_title', 'Manage Dashboard adm');
		Template::render();
	}
	public function showstatistikmahasiswa()
	{
		$fakultas 	= $this->input->post('fakultas');
		$prodi 		= $this->input->post('prodi');
		//reguler
		// ambil data tahun mahasiswa yang masih aktif
		$TahunRecordReg = $this->mastermahasiswa_model->gettahunAktif("1",$fakultas,$prodi);// 1 : reguler 
		//end tahun
		
		$grupmahasiswatahun = $this->mastermahasiswa_model->grupby_tahunnstatus("","1",$fakultas,$prodi);// 1 : reguler 
		$mahasiswaisikrs 		= array(); 
		if(isset($grupmahasiswatahun) && is_array($grupmahasiswatahun) && count($grupmahasiswatahun)):
			 $i=1;
			 foreach ($grupmahasiswatahun as $record) :
			 	//echo $record->tahun_masuk ." : ". $record->jumlah."<br>";
				$mahasiswaisikrs[$record->tahun_masuk] = $record->jumlah;
			 endforeach;
		endif;
		// untuk mendapatkan jumlah mahasiswa pertahun masuk reguler
		$mahasiswatahun 		= array(); 
		$mahasiswapertahun = $this->mastermahasiswa_model->getcountmahasiswaAktif("","1",$fakultas,$prodi);// 1 : reguler 
		if(isset($mahasiswapertahun) && is_array($mahasiswapertahun) && count($mahasiswapertahun)):
			 $i=1;
			 foreach ($mahasiswapertahun as $record) :
				$mahasiswatahun[$record->tahun_masuk] = $record->jumlah;
			 endforeach;
		endif;
		// untuk mendapatkan jumlah mahasiswa tidak aktif dari status mahasiswa selain A
		$MhstidakAktif 		= array(); 
		$recordmhstidakaktif = $this->mastermahasiswa_model->getcountmahasiswatdkAktif("","1",$fakultas,$prodi);// 1 : reguler 
		if(isset($recordmhstidakaktif) && is_array($recordmhstidakaktif) && count($recordmhstidakaktif)):
			 $i=1;
			 foreach ($recordmhstidakaktif as $record) :
				$MhstidakAktif[$record->tahun_masuk] = $record->jumlah;
			 endforeach;
		endif;
		//end reguler
		// intensif
		$TahunRecordIn = $this->mastermahasiswa_model->gettahunAktif("2",$fakultas,$prodi); 
		 
		$grupmahasiswatahunin = $this->mastermahasiswa_model->grupby_tahunnstatus("","2",$fakultas,$prodi);// 1 : Intensif 
		$mahasiswaisikrsin 		= array(); 
		if(isset($grupmahasiswatahunin) && is_array($grupmahasiswatahunin) && count($grupmahasiswatahunin)):
			 $i=1;
			 foreach ($grupmahasiswatahunin as $record) :
			 	
				$mahasiswaisikrsin[$record->tahun_masuk] = $record->jumlah;
			 endforeach;
		endif;
		 
		// untuk mendapatkan jumlah mahasiswa pertahun masuk intensif
		$mahasiswatahunsore 		= array(); 
		$mahasiswapertahunsore = $this->mastermahasiswa_model->getcountmahasiswaAktif("","2",$fakultas,$prodi);// 2 : intensif 
		
		if(isset($mahasiswapertahunsore) && is_array($mahasiswapertahunsore) && count($mahasiswapertahunsore)):
			 foreach ($mahasiswapertahunsore as $record) :
				$mahasiswatahunsore[$record->tahun_masuk] = $record->jumlah;
			 endforeach;
		endif;
		//Template::set('mahasiswatahunsore', $mahasiswatahunsore);
		
		// untuk mendapatkan jumlah mahasiswa tidak aktif dari status mahasiswa selain A
		$MhstidakAktifsore 		= array(); 
		$recordmhstidakaktifsore = $this->mastermahasiswa_model->getcountmahasiswatdkAktif("","2",$fakultas,$prodi);
		if(isset($recordmhstidakaktifsore) && is_array($recordmhstidakaktifsore) && count($recordmhstidakaktifsore)):
			 $i=1;
			 foreach ($recordmhstidakaktifsore as $record) :
				$MhstidakAktifsore[$record->tahun_masuk] = $record->jumlah;
			 endforeach;
		endif;
		//Template::set('MhstidakAktifsore', $MhstidakAktifsore);
		
		$output=""; 
		$output .= $this->load->view('reports/statistikmahasiswa',array("TahunRecordReg"=>$TahunRecordReg,"TahunRecordIn"=>$TahunRecordIn,"mahasiswaisikrs"=>$mahasiswaisikrs,"mahasiswaisikrsin"=>$mahasiswaisikrsin,"MhstidakAktifsore"=>$MhstidakAktifsore,"mahasiswatahunsore"=>$mahasiswatahunsore,"MhstidakAktif"=>$MhstidakAktif,"mahasiswatahun"=>$mahasiswatahun,"fakultas"=>$fakultas,"prodi"=>$prodi),true);	
		 
		echo $output;
		die();
	}
	public function showdosenpa()
	{
		$this->load->model('masterdosen/masterdosen_model', null, true);
		$fakultas 	= $this->input->post('fakultas');
		$prodi 		= $this->input->post('prodi');
		// reguler
		$recorddosen = $this->masterdosen_model->GetcountMahasiswaBimbingan("",$fakultas,$prodi,"1");
		$output=""; 
		$output .= $this->load->view('reports/statdosenpa',array("recorddosen"=>$recorddosen,"fakultas"=>$fakultas,"prodi"=>$prodi),true);	
		 
		echo $output;
		die();
	}

	//--------------------------------------------------------------------



}