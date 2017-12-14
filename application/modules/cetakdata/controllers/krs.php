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

		
		$this->lang->load('cetakdata');
		
		Template::set_block('sub_nav', 'krs/_sub_nav');

		Assets::add_module_js('cetakdata', 'cetakdata.js');
		$this->load->model('datakrs/datakrs_model', null, true);
		
		//master matakuliah
		$this->load->model('mastermatakuliah/mastermatakuliah_model', null, true);
		$matakuliahs = $this->mastermatakuliah_model->find_distinct();
		Template::set('matakuliahs', $matakuliahs);
		
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
		$this->auth->restrict('Cetakdata.Krs.View');
		Template::set('toolbar_title', 'Manage Cetakdata');
		Template::render();
		//master Fakultas
		
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Cetakdata object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Cetakdata.Krs.Create');

		Assets::add_module_js('cetakdata', 'cetakdata.js');

		Template::set('toolbar_title', lang('cetakdata_create') . ' Cetakdata');
		Template::render();
	}
	public function daftarhadir()
	{
		$this->auth->restrict('Cetakdata.Krs.View');
		//master pilihan
		$this->load->model('pilihan/pilihan_model', null, true);
		$pilihantahuns = $this->pilihan_model->find_all("ta");
		Template::set('pilihantahuns', $pilihantahuns);
		$this->load->model('masterfakultas/masterfakultas_model', null, true);
		$masterfakultas = $this->masterfakultas_model->find_all();
		Template::set('masterfakultass', $masterfakultas);
			//master pilihan
		//master jurusan
		$this->load->model('masterprogramstudi/masterprogramstudi_model', null, true);
		$masterprogramstudis = $this->masterprogramstudi_model->find_all();
		Template::set('masterprogramstudis', $masterprogramstudis);
		 
		 
		Template::set('toolbar_title', 'Daftar Hadir');
		Template::render();
	}
	public function daftarhadirujian()
	{
		$this->auth->restrict('Cetakdata.Krs.View');
		//master pilihan
		$this->load->model('pilihan/pilihan_model', null, true);
		$pilihantahuns = $this->pilihan_model->find_all("ta");
		Template::set('pilihantahuns', $pilihantahuns);
		$this->load->model('masterfakultas/masterfakultas_model', null, true);
		$masterfakultas = $this->masterfakultas_model->find_all();
		Template::set('masterfakultass', $masterfakultas);
			//master pilihan
		//master jurusan
		$this->load->model('masterprogramstudi/masterprogramstudi_model', null, true);
		$masterprogramstudis = $this->masterprogramstudi_model->find_all();
		Template::set('masterprogramstudis', $masterprogramstudis);
		 
		 
		Template::set('toolbar_title', 'Daftar Hadir');
		Template::render();
	}
	public function daftarhadiruas()
	{
		//master pilihan
		$this->load->model('pilihan/pilihan_model', null, true);
		$pilihantahuns = $this->pilihan_model->find_all("ta");
		Template::set('pilihantahuns', $pilihantahuns);
		$this->load->model('masterfakultas/masterfakultas_model', null, true);
		$masterfakultas = $this->masterfakultas_model->find_all();
		Template::set('masterfakultass', $masterfakultas);
		//master pilihan
		//master jurusan
		$this->load->model('masterprogramstudi/masterprogramstudi_model', null, true);
		$masterprogramstudis = $this->masterprogramstudi_model->find_all();
		Template::set('masterprogramstudis', $masterprogramstudis);
		 
		 
		Template::set('toolbar_title', 'Daftar Hadir');
		Template::render();
	}
	public function dpna()
	{
		//master pilihan
		$this->load->model('pilihan/pilihan_model', null, true);
		$pilihantahuns = $this->pilihan_model->find_all("ta");
		Template::set('pilihantahuns', $pilihantahuns);
		$this->load->model('masterfakultas/masterfakultas_model', null, true);
		$masterfakultas = $this->masterfakultas_model->find_all();
		Template::set('masterfakultass', $masterfakultas);
		//master pilihan
		//master jurusan
		$this->load->model('masterprogramstudi/masterprogramstudi_model', null, true);
		$masterprogramstudis = $this->masterprogramstudi_model->find_all();
		Template::set('masterprogramstudis', $masterprogramstudis);
		 
		 
		Template::set('toolbar_title', 'Daftar Hadir');
		Template::render();
	}
	public function printdaftarhadir()
	{
		$this->auth->restrict('Cetakdata.Krs.View');
		$mode = $this->uri->segment(5); 
		$filfakultas = $this->input->get('filfakultas');
		$filljurusan = $this->input->get('filljurusan');
		
		$kode_mk = $this->input->get('kode_mk');
		$dosen = $this->input->get('dosen');
		$tahun = $this->input->get('tahun');
		$kelas = $this->input->get('kelas');
		$sms = $this->input->get('sms');
		$jml = $this->input->get('jml');
		
		$this->load->model('masterprogramstudi/masterprogramstudi_model', null, true);
		$prodi = $this->masterprogramstudi_model->find_detil($filljurusan);
		
		$this->load->model('mastermatakuliah/mastermatakuliah_model', null, true);
		$rcmatakuliah = $this->mastermatakuliah_model->find_detil($kode_mk);
		
		$this->load->model('jadwal/jadwal_model', null, true);
		$rcjadwal = $this->jadwal_model->find_detil($kode_mk,$kelas,$filljurusan,$tahun);
		//die(print_r($rcjadwal));
		
		$records = $this->datakrs_model->find_absen($tahun,$filljurusan,$kode_mk,$dosen,$sms,$kelas);
		Template::set('records', $records);
		Template::set('fakultas', $filfakultas);
		Template::set('jurusan', $filljurusan);
		Template::set('nama_jurusan', $prodi[0]->nama_prodi);
		Template::set('kode_mk', $kode_mk);
		Template::set('nama_mk', $rcmatakuliah[0]->kode_mata_kuliah." - ".$rcmatakuliah[0]->nama_mata_kuliah);
		Template::set('dosen', $rcjadwal[0]->nama_dosen.", ".$rcjadwal[0]->gelar_akademik);
		Template::set('waktu',  $rcjadwal[0]->hari." - ". $rcjadwal[0]->jam);
		Template::set('tahun', $tahun);
		Template::set('kelas', $rcjadwal[0]->kelas);
		Template::set('jml', $jml);
		Template::set('sms', $tahun);
		Template::set('toolbar_title', 'Daftar Hadir');
		//die($mode."masuk");
		if($mode=="print"){
			Template::set_theme('print');
		}
		Template::render();
	}
	public function printdaftarhadirnew()
	{
		$this->auth->restrict('Cetakdata.Krs.View');
		$mode = $this->uri->segment(5); 
		$id = $this->input->get('kode_jadwal');
		$filfakultas = $this->input->get('filfakultas');
		$filljurusan = $this->input->get('filljurusan');
		
		$kode_mk = $this->input->get('kode_mk');
		$dosen = $this->input->get('dosen');
		$tahun = $this->input->get('tahun');
		$kelas = $this->input->get('kelas');
		$sms = $this->input->get('sms');
		$jml = $this->input->get('jml');
		$mode = $this->uri->segment(5); 
		//die($filljurusan);
		$this->load->model('masterprogramstudi/masterprogramstudi_model', null, true);
		$prodi = $this->masterprogramstudi_model->find_detil($filljurusan);
		
		$this->load->model('mastermatakuliah/mastermatakuliah_model', null, true);
		$rcmatakuliah = $this->mastermatakuliah_model->find_detil($kode_mk);
		
		$this->load->model('jadwal/jadwal_model', null, true);
		$rcjadwal = $this->jadwal_model->find_byid($id,$kode_mk,$kelas,$filljurusan);
		//die(print_r($rcjadwal));
		
		//$records = $this->datakrs_model->find_absen($tahun,$filljurusan,$kode_mk,$dosen,$sms,$kelas);
		$records = $this->jadwal_model->find_absen($id,$kode_mk,$kelas,$filljurusan);
		
		$dosen 		= isset($rcjadwal[0]->nama_dosen) ? $rcjadwal[0]->nama_dosen : "";
		$waktu 		= isset($rcjadwal[0]->hari) ? $rcjadwal[0]->hari."-". $rcjadwal[0]->jam : "";
		$kelas 		= isset($rcjadwal[0]->kelas) ? $rcjadwal[0]->kelas: "";
		$nama_mk 	= $rcmatakuliah[0]->kode_mata_kuliah." - ".$rcmatakuliah[0]->nama_mata_kuliah;
		$nidn 		= isset($rcjadwal[0]->nidn) ? $rcjadwal[0]->nidn : "";
		$bobot_harian 		= isset($rcjadwal[0]->bobot_harian) ? $rcjadwal[0]->bobot_harian : "";
		$bobot_formatif 		= isset($rcjadwal[0]->bobot_formatif) ? $rcjadwal[0]->bobot_formatif : "";
		$bobot_uts 				= isset($rcjadwal[0]->bobot_uts) ? $rcjadwal[0]->bobot_uts : "";
		$bobot_uas 				= isset($rcjadwal[0]->bobot_uas) ? $rcjadwal[0]->bobot_uas : "";
		
		// getdetil taun akademik
		$this->load->model('tahunakademik/tahunakademik_model', null, true);
		$recordtahunakademik = $this->tahunakademik_model->find_all($tahun);
		if($recordtahunakademik){
			$tahunakademik = $recordtahunakademik[0]->nama_tahun;
		}
		// get data absen harian
		$dataabsen 		= array(); 
		$this->load->model('jadwal/absen_harian_model', null, true);
		$recordabsen = $this->absen_harian_model->find_all($kode_mk,$filljurusan,$nidn);
		//print_r($recordabsen);
		if(isset($recordabsen) && is_array($recordabsen) && count($recordabsen)):
			foreach ($recordabsen as $record) :
				$dataabsen[$record->mhs."_".$record->pertemuan] = "1";
			endforeach;
		endif;
		Template::set('dataabsen', $dataabsen);
		
		Template::set('records', $records);
		Template::set('fakultas', $filfakultas);
		Template::set('jurusan', $filljurusan);
		Template::set('nama_jurusan', $prodi[0]->nama_prodi);
		Template::set('kode_mk', $kode_mk);
		Template::set('nama_mk', $rcmatakuliah[0]->kode_mata_kuliah." - ".$rcmatakuliah[0]->nama_mata_kuliah);
		Template::set('dosen', $dosen);
		Template::set('nidn', $nidn);
		Template::set('waktu',  $waktu);
		Template::set('tahun', $tahun);
		Template::set('kelas', $kelas);
		Template::set('jml', $jml);
		Template::set('kode_jadwal', $id);
		
		Template::set('tahunakademik', $tahunakademik);
		if($mode=="simple")
		{
			Template::set_theme('simple');
		}
		$normatif = $this->settings_lib->item('site.normatif');
		$uts = $this->settings_lib->item('site.uts');
		$uas = $this->settings_lib->item('site.uas');
		Template::set('bobot_harian', $bobot_harian != "" ? $bobot_harian : $bobot_harian);
		Template::set('normatif', $bobot_formatif != "" ? $bobot_formatif : $normatif);
		Template::set('uts', $bobot_uts  != "" ? $bobot_uts : $uts);
		Template::set('uas', $bobot_uas  != "" ? $bobot_uas : $uas);
		Template::set('toolbar_title', 'Daftar Hadir');
		//die($mode."masuk");
		if($mode=="print"){
			Template::set_theme('print');
		}
		Template::render();
	}
	public function printdaftarhadirujian()
	{
		$this->auth->restrict('Cetakdata.Krs.View');
		$mode = $this->uri->segment(5); 
		$filfakultas = $this->input->get('filfakultas');
		$filljurusan = $this->input->get('filljurusan');
		
		$kode_mk = $this->input->get('kode_mk');
		$dosen = $this->input->get('dosen');
		$tahun = $this->input->get('tahun');
		$kelas = $this->input->get('kelas');
		$sms = $this->input->get('sms');
		$jml = $this->input->get('jml');
		
		$this->load->model('masterprogramstudi/masterprogramstudi_model', null, true);
		$prodi = $this->masterprogramstudi_model->find_detil($filljurusan);
		
		$this->load->model('mastermatakuliah/mastermatakuliah_model', null, true);
		$rcmatakuliah = $this->mastermatakuliah_model->find_detil($kode_mk);
		
		$this->load->model('jadwal/jadwal_model', null, true);
		$rcjadwal = $this->jadwal_model->find_detil($kode_mk,$kelas,$filljurusan,$tahun);
		//die(print_r($rcjadwal));
		
		$records = $this->datakrs_model->find_absen($tahun,$filljurusan,$kode_mk,$dosen,$sms,$kelas);
		Template::set('records', $records);
		Template::set('fakultas', $filfakultas);
		Template::set('jurusan', $filljurusan);
		Template::set('nama_jurusan', $prodi[0]->nama_prodi);
		Template::set('kode_mk', $kode_mk);
		Template::set('nama_mk', $rcmatakuliah[0]->kode_mata_kuliah." - ".$rcmatakuliah[0]->nama_mata_kuliah);
		Template::set('dosen', $rcjadwal[0]->nama_dosen.", ".$rcjadwal[0]->gelar_akademik);
		Template::set('waktu',  $rcjadwal[0]->hari." - ". $rcjadwal[0]->jam);
		Template::set('tahun', $tahun);
		Template::set('kelas', $rcjadwal[0]->kelas);
		Template::set('jml', $jml);
		Template::set('sms', $tahun);
		Template::set('toolbar_title', 'Daftar Hadir');
		//die($mode."masuk");
		if($mode=="print"){
			Template::set_theme('print');
		}
		Template::render();
	}
	public function printdpna()
	{
		$this->auth->restrict('Cetakdata.Krs.View');
		$mode = $this->uri->segment(5); 
		$filfakultas = $this->input->get('filfakultas');
		$filljurusan = $this->input->get('filljurusan');
		
		$kode_mk = $this->input->get('kode_mk');
		$dosen = $this->input->get('dosen');
		$tahun = $this->input->get('tahun');
		$kelas = $this->input->get('kelas');
		$sms = $this->input->get('sms');
		$jml = $this->input->get('jml');
		
		$this->load->model('masterprogramstudi/masterprogramstudi_model', null, true);
		$prodi = $this->masterprogramstudi_model->find_detil($filljurusan);
		
		$this->load->model('mastermatakuliah/mastermatakuliah_model', null, true);
		$rcmatakuliah = $this->mastermatakuliah_model->find_detil($kode_mk);
		
		$this->load->model('jadwal/jadwal_model', null, true);
		$rcjadwal = $this->jadwal_model->find_detil($kode_mk,$kelas,$filljurusan,$tahun);
		//die(print_r($rcjadwal));
		
		$records = $this->datakrs_model->find_absen($tahun,$filljurusan,$kode_mk,$dosen,$sms,$kelas);
		Template::set('records', $records);
		Template::set('fakultas', $filfakultas);
		Template::set('jurusan', $filljurusan);
		Template::set('nama_jurusan', $prodi[0]->nama_prodi);
		Template::set('kode_mk', $kode_mk);
		Template::set('nama_mk', $rcmatakuliah[0]->kode_mata_kuliah." - ".$rcmatakuliah[0]->nama_mata_kuliah);
		Template::set('dosen', $rcjadwal[0]->nama_dosen.", ".$rcjadwal[0]->gelar_akademik);
		Template::set('waktu',  $rcjadwal[0]->hari." - ". $rcjadwal[0]->jam);
		Template::set('tahun', $tahun);
		Template::set('kelas', $rcjadwal[0]->kelas);
		Template::set('jml', $jml);
		Template::set('sms', $tahun);
		Template::set('toolbar_title', 'Daftar Hadir');
		//die($mode."masuk");
		if($mode=="print"){
			Template::set_theme('print');
		}
		Template::render();
	}
	public function printdaftarhadiruas()
	{
		$this->auth->restrict('Cetakdata.Krs.View');
		$mode = $this->uri->segment(5); 
		$filfakultas = $this->input->get('filfakultas');
		$filljurusan = $this->input->get('filljurusan');
		
		$kode_mk = $this->input->get('kode_mk');
		$dosen = $this->input->get('dosen');
		$tahun = $this->input->get('tahun');
		$kelas = $this->input->get('kelas');
		$sms = $this->input->get('sms');
		$jml = $this->input->get('jml');
		
		$this->load->model('masterprogramstudi/masterprogramstudi_model', null, true);
		$prodi = $this->masterprogramstudi_model->find_detil($filljurusan);
		
		$this->load->model('mastermatakuliah/mastermatakuliah_model', null, true);
		$rcmatakuliah = $this->mastermatakuliah_model->find_detil($kode_mk);
		
		$this->load->model('jadwal/jadwal_model', null, true);
		$rcjadwal = $this->jadwal_model->find_detil($kode_mk,$kelas,$filljurusan,$tahun);
		//die(print_r($rcjadwal));
		
		$records = $this->datakrs_model->find_absen($tahun,$filljurusan,$kode_mk,$dosen,$sms,$kelas);
		 
		Template::set('records', $records);
		Template::set('fakultas', $filfakultas);
		Template::set('jurusan', $filljurusan);
		Template::set('nama_jurusan', $prodi[0]->nama_prodi);
		Template::set('kode_mk', $kode_mk);
		Template::set('nama_mk', $rcmatakuliah[0]->kode_mata_kuliah." - ".$rcmatakuliah[0]->nama_mata_kuliah);
		Template::set('dosen', $rcjadwal[0]->nama_dosen.", ".$rcjadwal[0]->gelar_akademik);
		Template::set('waktu',  $rcjadwal[0]->hari." - ". $rcjadwal[0]->jam);
		Template::set('tahun', $tahun);
		Template::set('kelas', $rcjadwal[0]->kelas);
		Template::set('jml', $jml);
		Template::set('sms', $tahun);
		Template::set('toolbar_title', 'Daftar Hadir');
		//die($mode."masuk");
		if($mode=="print"){
			Template::set_theme('print');
		}
		Template::render();
	}
	public function perkelas()
	{
		$this->auth->restrict('Cetakdata.Krs.View');
		$mode = $this->uri->segment(5); 
		$filfakultas = $this->input->get('filfakultas');
		$filljurusan = $this->input->get('filljurusan');
		$kode_mk = $this->input->get('kode_mk');
		/*
		$this->load->model('pilihan/pilihan_model', null, true);
		$pilihantahuns = $this->pilihan_model->find_all("ta");
		Template::set('pilihantahuns', $pilihantahuns);
		$this->load->model('masterfakultas/masterfakultas_model', null, true);
		$masterfakultas = $this->masterfakultas_model->find_all();
		Template::set('masterfakultass', $masterfakultas);
			//master pilihan
		//master jurusan
		$this->load->model('masterprogramstudi/masterprogramstudi_model', null, true);
		$masterprogramstudis = $this->masterprogramstudi_model->find_all();
		Template::set('masterprogramstudis', $masterprogramstudis);
		$this->load->model('jadwal/jadwal_model', null, true);
		$mode = $this->uri->segment(5); 
		$tahun = $this->input->get('tahun');
		$records = $this->jadwal_model->group_bykelas($tahun,$filljurusan,$kode_mk);
		Template::set('records', $records);
		
		Template::set('toolbar_title', 'Grup Matapelajaran');
		//die($mode."masuk");
		if($mode=="print"){
			Template::set_theme('print');
		}
		Template::set('fakultas', $filfakultas);
		Template::set('filljurusan', $filljurusan);
		Template::set('kode_mk', $kode_mk);
		
		Template::set('tahun', $tahun);
		*/
		Template::render();
	}
	public function kartuujian()
	{
		$this->auth->restrict('Cetakdata.Krs.View');
		//master Fakultas
		$this->load->model('masterfakultas/masterfakultas_model', null, true);
		$masterfakultas = $this->masterfakultas_model->find_all();
		Template::set('masterfakultass', $masterfakultas);
		
		$this->load->model('masterprogramstudi/masterprogramstudi_model', null, true);
		$masterprogramstudis = $this->masterprogramstudi_model->find_all();
		Template::set('masterprogramstudis', $masterprogramstudis);
		
		 $this->load->model('mastermahasiswa/mastermahasiswa_model', null, true);
		$grupmahasiswatahun = $this->mastermahasiswa_model->grupby_tahunnstatus("","1");// 1 : reguler 
		Template::set('grupmahasiswatahun', $grupmahasiswatahun);
		
		$grupmahasiswatahunin = $this->mastermahasiswa_model->grupby_tahunnstatus("","2");// 1 : Intensif 
		Template::set('grupmahasiswatahunin', $grupmahasiswatahunin);
		 
		Template::set('toolbar_title', 'Cetak Kartu Ujian');
		Template::render();
	}
	//--------------------------------------------------------------------
	public function showstatistikmahasiswa()
	{
		$this->auth->restrict('Cetakdata.Krs.View');
		$this->load->model('mastermahasiswa/mastermahasiswa_model', null, true);
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
		$output .= $this->load->view('krs/statistikmahasiswa',array("TahunRecordReg"=>$TahunRecordReg,"TahunRecordIn"=>$TahunRecordIn,"mahasiswaisikrs"=>$mahasiswaisikrs,"mahasiswaisikrsin"=>$mahasiswaisikrsin,"MhstidakAktifsore"=>$MhstidakAktifsore,"mahasiswatahunsore"=>$mahasiswatahunsore,"MhstidakAktif"=>$MhstidakAktif,"mahasiswatahun"=>$mahasiswatahun,"fakultas"=>$fakultas,"prodi"=>$prodi),true);	
		 
		echo $output;
		die();
	}


}