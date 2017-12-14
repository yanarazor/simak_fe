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

		$this->load->model('kuesioner/kuesioner_jawaban_model', null, true);
		
		$this->lang->load('dashboard_kprd');
		
		Template::set_block('sub_nav', 'reports/_sub_nav');
		Template::set('collapse', true);
		Assets::add_module_js('dashboard_kprd', 'dashboard_kprd.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{

		$this->auth->restrict('Dashboard_kprd.Reports.View');

		//aktifitas
		$this->load->library('akademik');
		$akademik = new Akademik();	
		$recakademikaktf = $this->akademik->GetTahunAktif();
		$tahunakademik = isset($recakademikaktf[0]->tahun_id) ? $recakademikaktf[0]->tahun_id : $this->settings_lib->item('site.tahun');
		$this->load->model('datakrs/datakrs_model');
		$this->load->model('jadwal/jadwal_model');
		$kode_prodi 			=  $this->current_user->nim;
		$jadwalngajars 	= $this->jadwal_model->getjadwalkaprodi($tahunakademik,$kode_prodi);
		Template::set('jadwalngajars', $jadwalngajars);
		$jumlahjadwal 	= $this->jadwal_model->jumlahjadwal($tahunakademik,$kode_prodi);
		Template::set('jumlahjadwal', $jumlahjadwal);
		
		$jumlahmahasiswa 	= $this->datakrs_model->getjmlmahasiswa($tahunakademik,$kode_prodi);
		Template::set('jmlmahasiswa', isset($jumlahmahasiswa[0]->jml_mahasiswa) ? $jumlahmahasiswa[0]->jml_mahasiswa : 0);
		
		$recordjmldosen 	= $this->jadwal_model->jmldosen($tahunakademik,$kode_prodi);
		Template::set('jumlahdosen', isset($recordjmldosen[0]->jml_dosen) ? $recordjmldosen[0]->jml_dosen : 0);
		
		Template::set('kode_prodi', $kode_prodi);

		// kueseioner
		

		Template::set('toolbar_title', 'Dashboard');
		Template::render();
	}
	public function adm()
	{
		//aktifitas
		$tahun = $this->input->get('tahun');
		$this->load->library('akademik');
		$akademik = new Akademik();	
		$recakademikaktf = $this->akademik->GetTahunAktif();
		$tahunakademik = isset($recakademikaktf[0]->tahun_id) ? $recakademikaktf[0]->tahun_id : $this->settings_lib->item('site.tahun');
		if($tahun != ""){
			$tahunakademik = $tahun;
		}
		$this->load->model('datakrs/datakrs_model');
		$this->load->model('jadwal/jadwal_model');
		$kode_prodi 	=  $this->current_user->nim;
		$jadwalngajars 	= $this->jadwal_model->getjadwalkaprodi($tahunakademik,$kode_prodi);
		Template::set('jadwalngajars', $jadwalngajars);
		$jumlahjadwal 	= $this->jadwal_model->jumlahjadwal($tahunakademik,$kode_prodi);
		Template::set('jumlahjadwal', $jumlahjadwal);
		
		$jumlahmahasiswa 	= $this->datakrs_model->getjmlmahasiswa($tahunakademik,$kode_prodi);
		Template::set('jmlmahasiswa', isset($jumlahmahasiswa[0]->jml_mahasiswa) ? $jumlahmahasiswa[0]->jml_mahasiswa : 0);
		
		$recordjmldosen 	= $this->jadwal_model->jmldosen($tahunakademik,$kode_prodi);
		Template::set('jumlahdosen', isset($recordjmldosen[0]->jml_dosen) ? $recordjmldosen[0]->jml_dosen : 0);
		
		Template::set('kode_prodi', $kode_prodi);
		Template::set('toolbar_title', 'Dashboard Pembelajaran');
		//Template::set_theme('adminlte');
		// kuesioner
		$recordavgprodi = $this->kuesioner_jawaban_model->find_avgprodi();
		Template::set('recordavgprodi', $recordavgprodi);

		Template::render();
	}
	public function dosen()
	{
		//aktifitas
		$tahun = $this->input->get('tahun');
		$this->load->library('akademik');
		$akademik = new Akademik();	
		$recakademikaktf = $this->akademik->GetTahunAktif();
		$tahunakademik = isset($recakademikaktf[0]->tahun_id) ? $recakademikaktf[0]->tahun_id : $this->settings_lib->item('site.tahun');
		if($tahun != ""){
			$tahunakademik = $tahun;
		}
		$this->load->model('jadwal/jadwal_model');
		$kode_prodi 	=  $this->current_user->nim;
		$jadwalngajars 	= $this->jadwal_model->dosenmengajar($tahunakademik,$kode_prodi);
		Template::set('jadwalngajars', $jadwalngajars);
 
		
		Template::set('tahunakademik', $tahunakademik);
		Template::set('kode_prodi', $kode_prodi);
		Template::set('toolbar_title', 'Dosen Tahun ini');
		//Template::set_theme('adminlte');
		// kuesioner
		$recordavgprodi = $this->kuesioner_jawaban_model->find_avgprodi();
		Template::set('recordavgprodi', $recordavgprodi);

		Template::render();
	}
	public function detilevaluasi()
	{
		$this->load->model('jadwal/jadwal_model');
		$this->load->model('masterdosen/masterdosen_model');
		$mode = $this->uri->segment(5); 
		
		$dosen = $this->input->get('dosen');
		$tahun = $this->input->get('tahun');
		$mode = $this->uri->segment(5); 
		
		$recdosen = $this->masterdosen_model->find($dosen);
		Template::set('namadosen', $recdosen->nama_dosen);

		$this->load->library('akademik');
		$akademik = new Akademik();	
		$recakademikaktf = $this->akademik->GetTahunAktif();
		$tahunakademik = isset($recakademikaktf[0]->tahun_id) ? $recakademikaktf[0]->tahun_id : $this->settings_lib->item('site.tahun');
		if($tahun != ""){
			$tahunakademik = $tahun;
		}
		Template::set('tahunakademik', $tahunakademik);
		$jadwalngajars 	= $this->jadwal_model->nilaiperdosen($tahun,$dosen);
		Template::set('jadwalngajars', $jadwalngajars);
		
		Template::set('toolbar_title', '&nbsp;&nbsp; Detil Evaluasi Dosen');
		Template::render();
	}
	public function absenharian()
	{
		$mode = $this->uri->segment(5); 
		$filfakultas = $this->input->get('filfakultas');
		$filljurusan = $this->input->get('filljurusan');
		
		$kode_mk = $this->input->get('kode_mk');
		$dosen = $this->input->get('dosen');
		$tahun = $this->input->get('tahun');
		$kelas = $this->input->get('kelas');
		$sms = $this->input->get('sms');
		$jml = $this->input->get('jml');
		$mode = $this->uri->segment(5); 
		$id = $this->uri->segment(6); 
		//die($filljurusan);
		$this->load->model('masterprogramstudi/masterprogramstudi_model', null, true);
		$prodi = $this->masterprogramstudi_model->find_detil($filljurusan);
		
		$this->load->model('mastermatakuliah/mastermatakuliah_model', null, true);
		$rcmatakuliah = $this->mastermatakuliah_model->find_detil_mk($kode_mk,$filfakultas,$filljurusan);
		
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
		$jml_pertemuan 				= isset($rcjadwal[0]->jml_pertemuan) ? $rcjadwal[0]->jml_pertemuan : "";
		
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
		// materi perpertemuan
		$datamateri 		= array(); 
		$this->load->model('jadwal/materi_pertemuan_model', null, true);
		$recordmateri = $this->materi_pertemuan_model->find_all($id);
		if(isset($recordmateri) && is_array($recordmateri) && count($recordmateri)):
			foreach ($recordmateri as $record) :
				$datamateri[$record->pertemuan] = $record->id;
			endforeach;
		endif;
		Template::set('datamateri', $datamateri);
		
		
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
		Template::set('jml_pertemuan', $jml_pertemuan);
		Template::set('tahunakademik', $tahunakademik);
		Template::set('sms', $sms);
		$normatif = $this->settings_lib->item('site.normatif');
		$uts = $this->settings_lib->item('site.uts');
		$uas = $this->settings_lib->item('site.uas');
		Template::set('bobot_harian', $bobot_harian != "" ? $bobot_harian : $bobot_harian);
		Template::set('normatif', $bobot_formatif != "" ? $bobot_formatif : $normatif);
		Template::set('uts', $bobot_uts  != "" ? $bobot_uts : $uts);
		Template::set('uas', $bobot_uas  != "" ? $bobot_uas : $uas);
		
		Template::set('toolbar_title', '&nbsp;&nbsp; Absen Harian');
		Template::render();
	}
	public function printlaporandosen()
	{
		$mode = $this->uri->segment(5); 
		$filfakultas = $this->input->get('filfakultas');
		$filljurusan = $this->input->get('filljurusan');
		
		$kode_mk = $this->input->get('kode_mk');
		$dosen = $this->input->get('dosen');
		$tahun = $this->input->get('tahun');
		$kelas = $this->input->get('kelas');
		$sms = $this->input->get('sms');
		$jml = $this->input->get('jml');
		$mode = $this->uri->segment(5); 
		$id = $this->uri->segment(6); 
		//die($filljurusan);
		$this->load->model('masterprogramstudi/masterprogramstudi_model', null, true);
		$prodi = $this->masterprogramstudi_model->find_detil($filljurusan);
		
		$this->load->model('mastermatakuliah/mastermatakuliah_model', null, true);
		$rcmatakuliah = $this->mastermatakuliah_model->find_detil_mk($kode_mk,$filfakultas,$filljurusan);
		
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
		$jml_pertemuan 				= isset($rcjadwal[0]->jml_pertemuan) ? $rcjadwal[0]->jml_pertemuan : "";
		
		// getdetil taun akademik
		$this->load->model('tahunakademik/tahunakademik_model', null, true);
		$recordtahunakademik = $this->tahunakademik_model->find_all($tahun);
		if($recordtahunakademik){
			$tahunakademik = $recordtahunakademik[0]->nama_tahun;
		}
		 
		// materi perpertemuan
		$datamateri 		= array(); 
		$this->load->model('jadwal/materi_pertemuan_model', null, true);
		$recordmateri = $this->materi_pertemuan_model->find_all($id);
		Template::set('recordmateri', $recordmateri);
		
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
		Template::set('jml_pertemuan', $jml_pertemuan);
		Template::set('tahunakademik', $tahunakademik);
		$normatif = $this->settings_lib->item('site.normatif');
		$uts = $this->settings_lib->item('site.uts');
		$uas = $this->settings_lib->item('site.uas');
		Template::set('bobot_harian', $bobot_harian != "" ? $bobot_harian : $bobot_harian);
		Template::set('normatif', $bobot_formatif != "" ? $bobot_formatif : $normatif);
		Template::set('uts', $bobot_uts  != "" ? $bobot_uts : $uts);
		Template::set('uas', $bobot_uas  != "" ? $bobot_uas : $uas);
		Template::set_theme('print');
		Template::set('toolbar_title', '&nbsp;&nbsp; Absen Harian');
		Template::render();
	}
	public function viewmahasiswa()
	{
		$mode = $this->uri->segment(5); 
		$filfakultas = $this->input->get('filfakultas');
		$filljurusan = $this->input->get('filljurusan');
		
		$kode_mk = $this->input->get('kode_mk');
		$dosen = $this->input->get('dosen');
		$tahun = $this->input->get('tahun');
		$kelas = $this->input->get('kelas');
		$sms = $this->input->get('sms');
		$jml = $this->input->get('jml');
		$mode = $this->uri->segment(5); 
		$id = $this->uri->segment(6); 
		//die($filljurusan);
		$this->load->model('masterprogramstudi/masterprogramstudi_model', null, true);
		$prodi = $this->masterprogramstudi_model->find_detil($filljurusan);
		
		$this->load->model('mastermatakuliah/mastermatakuliah_model', null, true);
		$rcmatakuliah = $this->mastermatakuliah_model->find_detil_mk($kode_mk,$filfakultas,$filljurusan);
		
		$this->load->model('jadwal/jadwal_model', null, true);
		$rcjadwal = $this->jadwal_model->find_byid($id,$kode_mk,$kelas,$filljurusan);
		//die(print_r($rcjadwal));
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
		$normatif = $this->settings_lib->item('site.normatif');
		$uts = $this->settings_lib->item('site.uts');
		$uas = $this->settings_lib->item('site.uas');
		Template::set('bobot_harian', $bobot_harian  != "" ? $bobot_harian : "");
		Template::set('normatif', $bobot_formatif != "" ? $bobot_formatif : $normatif);
		Template::set('uts', $bobot_uts  != "" ? $bobot_uts : $uts);
		Template::set('uas', $bobot_uas  != "" ? $bobot_uas : $uas);
		
		Template::set('toolbar_title', '&nbsp;&nbsp; Nilai Perkelas');
		Template::render();
	}
	//--------------------------------------------------------------------


	/**
	 * Creates a dashboard kprd object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Dashboard_kprd.Reports.Create');

		Assets::add_module_js('dashboard_kprd', 'dashboard_kprd.js');

		Template::set('toolbar_title', lang('dashboard_kprd_create') . ' Dashboard');
		Template::render();
	}

	//--------------------------------------------------------------------



}