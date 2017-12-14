<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * nilai controller
 */
class nilai extends Admin_Controller
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

		//$this->auth->restrict('Nilai_Mahasiswa.Nilai.View');
		$this->lang->load('nilai_mahasiswa');
		
		Template::set_block('sub_nav', 'nilai/_sub_nav');

		Assets::add_module_js('nilai_mahasiswa', 'nilai_mahasiswa.js');
		$this->load->model('datakrs/datakrs_model', null, true);
		
		//master matakuliah
		$this->load->model('mastermatakuliah/mastermatakuliah_model', null, true);
		$matakuliahs = $this->mastermatakuliah_model->find_all();
		Template::set('matakuliahs', $matakuliahs);
		
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
		$mhs = $this->input->get('nama');
		$sms = $this->input->get('sms');
		//die($this->current_user->nim);
		$this->load->library('pagination');
		$total = $this->datakrs_model->count_all_fromdosen($sms,$kode_mk,$mhs,$this->current_user->nim);
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url()."?sms=".$sms."&kode_mk=".$kode_mk."&mhs=".$mhs;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		$records = $this->datakrs_model->limit($limit, $offset)->find_all_fromdosen($sms,$kode_mk,$mhs,$this->current_user->nim);

		Template::set('records', $records);
		Template::set('total', $total);
		
		Template::set('sms', $sms);
		
		Template::set('kode_mk', $kode_mk);
		Template::set('mhs', $mhs);
		
		
		Template::set('toolbar_title', '&nbsp;&nbsp; Pengelolaan Data Nilai Mahasiswa');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Nilai Mahasiswa object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Nilai_Mahasiswa.Nilai.Create');

		Assets::add_module_js('nilai_mahasiswa', 'nilai_mahasiswa.js');

		
		Template::set('toolbar_title', '&nbsp;&nbsp; Tambah Data Nilai Mahasiswa');
		Template::render();
	}
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message("Silahkan Pilih terlebih dahulu", 'error');
			redirect(SITE_AREA .'/nilai/nilai_mahasiswa');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Nilai_Mahasiswa.Nilai.Create');

			if ($this->save_datakrs('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('datakrs_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'datakrs');

				Template::set_message("Save Success", 'success');
					redirect(SITE_AREA .'/nilai/nilai_mahasiswa');
			}
			else
			{
				Template::set_message("Save data Gagal" . $this->datakrs_model->error, 'error');
			}
		}
		 
		Template::set('datakrs', $this->datakrs_model->find($id));
			
		Template::set('toolbar_title', '&nbsp;&nbsp; Ubah Data Nilai Mahasiswa');
		Template::render();
	}
	private function save_datakrs($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		 
		$data['nilai_angka']        = $this->input->post('datakrs_nilai_angka');
		$data['nilai_huruf']        = $this->input->post('datakrs_nilai_huruf');
		 
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

	public function absenharian()
	{
		$this->auth->restrict('Nilai_Mahasiswa.Nilai.Create');
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
		if($mode=="simple")
		{
			//Template::set_theme('simple');
		}
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
	public function absenharianku()
	{
		//$this->auth->restrict('Nilai_Mahasiswa.Nilai.Create');
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
		//print_r($rcjadwal);
		$records = $this->jadwal_model->find_absenku($this->current_user->nim,$id,$kode_mk,$kelas,$filljurusan);
		
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
		
		Template::set('toolbar_title', '&nbsp;&nbsp; Absen Harian');
		Template::render();
	}
	
	public function lihatmateri(){
		$this->auth->restrict('Nilai_Mahasiswa.Nilai.Create');
		$this->load->model('jadwal/jadwal_model', null, true);
		$id = $this->uri->segment(5); 
		Template::set('id_materi', $id);
		$this->load->model('jadwal/materi_pertemuan_model', null, true);
		$recordmateri = $this->materi_pertemuan_model->find($id);
		Template::set('recordmateri', $recordmateri);
		
		// detil jadwal
		$recordjadwal = $this->jadwal_model->find_byid($recordmateri->kode_jadwal);
		Template::set('recordjadwal', $recordjadwal);
		
		$this->load->model('pesan/pesan_model', null, true);
		$recordpesan = $this->pesan_model->find_all($id);
		Template::set('recordpesan', $recordpesan);
		
		Template::render();
	}
	public function lihatmateriabsen(){
		$this->auth->restrict('Nilai_Mahasiswa.Nilai.Create');
		
		$this->load->model('jadwal/jadwal_model', null, true);
		$id = $this->uri->segment(5); 
		Template::set('id_materi', $id);
		
		$this->load->model('jadwal/materi_pertemuan_model', null, true);
		$recordmateri = $this->materi_pertemuan_model->find($id);
		Template::set('recordmateri', $recordmateri);
		
		// detil jadwal
		$recordjadwal = $this->jadwal_model->find_byid($recordmateri->kode_jadwal);
		Template::set('recordjadwal', $recordjadwal);
		
		$this->load->model('pesan/pesan_model', null, true);
		$recordpesan = $this->pesan_model->find_all($id);
		Template::set('recordpesan', $recordpesan);
		
		Template::render();
	}
	public function lihatmaterimhs(){
		//$this->auth->restrict('Nilai_Mahasiswa.Nilai.Create');
		
		$this->load->model('jadwal/jadwal_model', null, true);
		$id = $this->uri->segment(5); 
		Template::set('id_materi', $id);
		
		$this->load->model('jadwal/materi_pertemuan_model', null, true);
		$recordmateri = $this->materi_pertemuan_model->find($id);
		Template::set('recordmateri', $recordmateri);
		
		// detil jadwal
		$recordjadwal = $this->jadwal_model->find_byid($recordmateri->kode_jadwal);
		Template::set('recordjadwal', $recordjadwal);
		
		$this->load->model('pesan/pesan_model', null, true);
		$recordpesan = $this->pesan_model->find_all($id);
		Template::set('recordpesan', $recordpesan);
		
		Template::render();
	}
	public function saveabsenharian()
	{
		$this->auth->restrict('Nilai_Mahasiswa.Nilai.Create');
		if($this->input->post('mhs') != "" and $this->input->post('kode_mk') != "")
		{
		   $this->load->model('jadwal/absen_harian_model', null, true);
		   $data = array();
		   $data['mhs']        		= $this->input->post('mhs');
		   $data['jurusan']        	= $this->input->post('jurusan');
		   $data['dosen']        	= $this->input->post('dosen');
		   $data['kelas']        	= $this->input->post('kelas');
		   $data['kode_mk']        	= $this->input->post('kode_mk');
		   $data['pertemuan']       = $this->input->post('pertemuan');
		   $data['kode_jadwal']       = $this->input->post('kode_jadwal');
		   if($id = $this->absen_harian_model->insert($data)){
		   	echo "Ok";	
		   }else{
		   	echo "ada masalah";
		   	log_activity($this->auth->user_id(), 'Save absen harian gagal, dari' .$this->absen_harian_model->error. $this->input->ip_address(), 'absen');
		   }
		   
		}
		die();
	}
	public function saveaallbsenharian()
	{
		$this->auth->restrict('Nilai_Mahasiswa.Nilai.Create');
		$this->load->model('jadwal/jadwal_model', null, true);
		$filljurusan = $this->input->post('jurusan');
		$kode_mk = $this->input->post('kode_mk');
		$dosen 	= $this->input->post('dosen');
		$tahun 	= $this->input->post('tahun');
		$kelas 	= $this->input->post('kelas');
		$sms 	= $this->input->post('sms');
		$pertemuan 	= $this->input->post('pertemuan');
		$kode_jadwal 	= $this->input->post('kode_jadwal');
		$no = 0;
		$records = $this->jadwal_model->find_absen($kode_jadwal,$kode_mk,$kelas,$filljurusan);
		//$records = $this->datakrs_model->find_absen_dosen($tahun,$filljurusan,$kode_mk,$dosen,$sms,$kelas);
		if($kode_mk != "" and $dosen != "" and $tahun != "" and $kelas != "")
		{
		   $this->load->model('jadwal/absen_harian_model', null, true);
		   if (isset($records) && is_array($records) && count($records)) : 
				foreach ($records as $record) :
					$result = $this->db->query('delete from simak_absen_harian where kode_jadwal = "'.$kode_jadwal.'" and mhs = "'.$record->mahasiswa.'" and jurusan = "'.$filljurusan.'" and dosen = "'.$dosen.'" and kelas = "'.$kelas.'"  and kode_mk = "'.$kode_mk.'"   and pertemuan = "'.$pertemuan.'"');
					
					$data = array();
					$data['mhs']        		= $record->mahasiswa;
					$data['kode_jadwal']        = $this->input->post('kode_jadwal');
					$data['jurusan']        	= $this->input->post('jurusan');
					$data['dosen']        		= $this->input->post('dosen');
					$data['kelas']        		= $this->input->post('kelas');
					$data['kode_mk']        	= $this->input->post('kode_mk');
					$data['pertemuan']        	= $this->input->post('pertemuan');
					$id = $this->absen_harian_model->insert($data);
					$no++;
				endforeach;
			endif;
		}
		die("Update ".$no. " Mahasiswa menjadi hadir semua");
	}
	public function viewmahasiswa()
	{
		$this->auth->restrict('Nilai_Mahasiswa.Nilai.Create');
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
		if($mode=="simple")
		{
			Template::set_theme('simple');
		}
		$normatif = $this->settings_lib->item('site.normatif');
		$uts = $this->settings_lib->item('site.uts');
		$uas = $this->settings_lib->item('site.uas');
		Template::set('bobot_harian', $bobot_harian  != "" ? $bobot_harian : "");
		Template::set('normatif', $bobot_formatif != "" ? $bobot_formatif : $normatif);
		Template::set('uts', $bobot_uts  != "" ? $bobot_uts : $uts);
		Template::set('uas', $bobot_uas  != "" ? $bobot_uas : $uas);
		
		Template::set('toolbar_title', '&nbsp;&nbsp; Input Nilai Perkelas');
		Template::render();
	}
	public function viewmahasiswaprint()
	{
		$this->auth->restrict('Nilai_Mahasiswa.Nilai.Create');
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
		//$rcmatakuliah = $this->mastermatakuliah_model->find_detil($kode_mk);
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
		if($mode=="print")
		{
			Template::set_theme('print');
		}
		$normatif = $this->settings_lib->item('site.normatif');
		$uts = $this->settings_lib->item('site.uts');
		$uas = $this->settings_lib->item('site.uas');
		Template::set('bobot_harian', $bobot_harian  != "" ? $bobot_harian : "");
		Template::set('normatif', $bobot_formatif != "" ? $bobot_formatif : $normatif);
		Template::set('uts', $bobot_uts  != "" ? $bobot_uts : $uts);
		Template::set('uas', $bobot_uas  != "" ? $bobot_uas : $uas);
		
		Template::set('toolbar_title', 'Print Nilai');
		Template::render();
	}
	public function updatenilai()
	{
		Template::set_block('sub_nav', 'krs/_sub_nav');
		$this->auth->restrict('Nilai_Mahasiswa.Nilai.Create');
		//die("masuk");
		 
			$index = 0;
			$return = false;
			$id_krs = $this->input->post('id_krs');
			$harian = $this->input->post('harian');
			$normatif = $this->input->post('normatif');
			$uts = $this->input->post('nilaiuts');
			$uas = $this->input->post('nilaiuas');
			$nilaiangka = $this->input->post('nilaiangka');
			$nilaiakhir = $this->input->post('nilaiakhir');
			if (is_array($id_krs) && count($id_krs))
			{
			 
				$result = FALSE;
				foreach ($id_krs as $pid)
				{
				  //echo $nilaimhs[$index]; 	
				  	$data = array();
				  	$data['harian']       = $harian[$index]; 
				   	$data['normatif']       = $normatif[$index]; 
					$data['uts']        	= $uts[$index]; 
				  	$data['uas']        	= $uas[$index]; 
				  	$data['nilai_angka']     = $nilaiangka[$index]; 
				  	$data['nilai_huruf']    = $nilaiakhir[$index]; 
				  	$return = $this->datakrs_model->update($pid, $data);
				  	$index++;  
				}
				if($return){
					die("Update Selesai..");
				}
				
			}
		 
	 
		exit();
	}
	public function delaallbsenharian()
	{
		$this->auth->restrict('Nilai_Mahasiswa.Nilai.Create');
		$this->load->model('jadwal/jadwal_model', null, true);
		$filljurusan = $this->input->post('jurusan');
		$kode_mk = $this->input->post('kode_mk');
		$dosen 	= $this->input->post('dosen');
		$tahun 	= $this->input->post('tahun');
		$kelas 	= $this->input->post('kelas');
		$sms 	= $this->input->post('sms');
		$pertemuan = $this->input->post('pertemuan');
		$kode_jadwal 	= $this->input->post('kode_jadwal');
		$no = 0;
		$records = $this->jadwal_model->find_absen($kode_jadwal,$kode_mk,$kelas,$filljurusan);
		if($kode_mk != "" and $dosen != "" and $tahun != "" and $kelas != "")
		{
		   $this->load->model('jadwal/absen_harian_model', null, true);
		   if (isset($records) && is_array($records) && count($records)) : 
				foreach ($records as $record) :
					$data = array();
					$mhs        		= $record->mahasiswa;
					$result = $this->db->query('delete from simak_absen_harian where kode_jadwal = "'.$kode_jadwal.'" and mhs = "'.$mhs.'" and jurusan = "'.$filljurusan.'" and dosen = "'.$dosen.'" and kelas = "'.$kelas.'"  and kode_mk = "'.$kode_mk.'"   and pertemuan = "'.$pertemuan.'"');
					//echo $mhs." <br>";
					$no++;
				endforeach;
			endif;
		}
		die("Update ".$no. " Mahasiswa menjadi tidak hadir semua");
	}
	
	public function delabsenharian()
	{
		$this->auth->restrict('Nilai_Mahasiswa.Nilai.Create');
		if($this->input->post('mhs') != "" and $this->input->post('kode_mk') != "")
		{
			$mhs 		= $this->input->post('mhs');
			$jurusan 	= $this->input->post('jurusan');
			$dosen 		= $this->input->post('dosen');
			$kelas 		= $this->input->post('kelas');
			$kode_mk 	= $this->input->post('kode_mk');
			$pertemuan 	= $this->input->post('pertemuan');
			
		   $this->load->model('jadwal/absen_harian_model', null, true);
		   $result = $this->db->query('delete from simak_absen_harian where mhs = "'.$mhs.'" and jurusan = "'.$jurusan.'" and dosen = "'.$dosen.'" and kelas = "'.$kelas.'"  and kode_mk = "'.$kode_mk.'"   and pertemuan = "'.$pertemuan.'"');
		   echo "Ok";
		}
		die();
	}
	function saveberkas(){
		$this->auth->restrict('Nilai_Mahasiswa.Nilai.Create');
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
			$uploadData = handle_upload('userfile',$this->settings_lib->item('site.pathmateri'));
			//print_r($uploadData);
			 if (isset($uploadData['error']) && !empty($uploadData['error']))
			 {
			 	$tipefile=$_FILES['userfile']['type'];
			 	//$tipefile = $_FILES['userfile']['name'];
				 $upload = false;
				 log_activity($this->auth->user_id(), 'Gagal : '.$uploadData['error'].$tipefile.$this->input->ip_address(), 'jadwal');
			 }else{
			 	$namafile = $uploadData['data']['file_name'];
                log_activity($this->auth->user_id(), 'Save materi pertemuan : ' . $id_log . ' : ' . $this->input->ip_address(), 'jadwal');
			 }
		 }else{
		 	die("File tidak ditemukan");
		 	log_activity($this->auth->user_id(), 'File tidak ditemukan : ' . $this->input->ip_address(), 'jadwal');
		 } 	

       echo '{"namafile":"'.$namafile.'"}';
       exit();
	}
	public function getinfomateri()
	{
		$output=array();
		$this->load->model('jadwal/materi_pertemuan_model', null, true);
		$pertemuan = $this->input->get('pertemuan');
		$kode_jadwal = $this->input->get('kode_jadwal');
		
		$materidetil = $this->materi_pertemuan_model->find_all($kode_jadwal,$pertemuan);
		$desc_materi = isset($materidetil[0]->desc_materi) ? json_encode($materidetil[0]->desc_materi) : "";
		$file_materi = isset($materidetil[0]->file_materi) ? $materidetil[0]->file_materi : "";
		$kode = isset($materidetil[0]->id) ? $materidetil[0]->id : "";
		$kode_jadwal = isset($materidetil[0]->kode_jadwal) ? $materidetil[0]->kode_jadwal : "";
		$tanggal = isset($materidetil[0]->tanggal) ? $materidetil[0]->tanggal : "";
		$jam_mulai = isset($materidetil[0]->jam_mulai) ? $materidetil[0]->jam_mulai : "";
		$jam_selesai = isset($materidetil[0]->jam_selesai) ? $materidetil[0]->jam_selesai : "";
		
		//$output['materidetil']=$materidetil;
		$output['desc_materi']=$desc_materi;
		$output['file_materi']=$file_materi;
		$output['kode_tabel']=$kode;
		$output['kode_jadwal']=$kode_jadwal;
		$output['tanggal']=$tanggal;
		$output['jam_mulai']=$jam_mulai;
		$output['jam_selesai']=$jam_selesai;
		
		echo json_encode($output);
		//echo $msg;
		die();
	}
	public function savemateri()
    {
    	
    	$insert_id = 0;
        $this->auth->restrict("Nilai_Mahasiswa.Nilai.Create");
        $this->load->model('jadwal/materi_pertemuan_model', null, true);
        $id_data = $this->input->post("id_data");
        
        if($this->input->post("kode_jadwal") =="")
        	die("Silahkan masukan kode jadwal");
        if($this->input->post("desc_materi") =="")
        	die("Silahkan masukan deksripsi materi");
		if($id_data == ""){
			if($id = $this->save_materipertemuan()){
				log_activity($this->auth->user_id(), 'Save materi pertemuan : ' . $id . ' : ' . $this->input->ip_address(), 'jadwal');
				echo "Sukses simpan data";
			}else{
				log_activity($this->auth->user_id(), 'Save rumusan gagal, dari' .$this->materi_pertemuan_model->error. $this->input->ip_address(), 'jadwal');
				echo "Gagal ".$this->materi_pertemuan_model->error;
			}
		}else{
			if($result = $this->save_materipertemuan('update', $id_data)){
				echo "Update sukses";
			}
		}

        exit();
    }
    public function kirimpesan()
    {
    	//$this->auth->restrict('Pesan.Site.Create');
        $this->load->model('pesan/pesan_model', null, true);
        $id_materi = $this->input->post("id_materi");
        $nidn = $this->input->post("nidn");
        if($this->input->post("message") =="")
        	die("Silahkan masukan pesan anda");
			
			 $data = array();
			 $data['pesan']	 		= $this->input->post("message");
			 $data['dari']	 		= $this->auth->user_id();
			 $data['untuk']	 		= $nidn;
			 $data['id_materi']	 	= $id_materi;
			 $data['tanggal']	 	= date("Y-m-d");
			 $data['jam']	 		= date("h:i:s");
			 $return = false;
			 $id = $this->pesan_model->insert($data);
			 if (is_numeric($id)) {
				 $return = $id;
			 }
			 if($return){
			 	echo "Pesan anda telah dikirim";
			 }else{
			 	echo "Gagal dikirim";
			 }
        exit();
    }
    
    public function deletefilemateri()
	{
		$this->auth->restrict("Nilai_Mahasiswa.Nilai.Create");
		$id 	= $this->input->post('kode');
		$this->load->model('jadwal/materi_pertemuan_model', null, true);
		// data detil
		$datadetil = $this->materi_pertemuan_model->find($id);
		$filemateri = $datadetil->file_materi;
		if($filemateri != ""){
			
		}
		$data = array();
		$data['file_materi']	 	= "";
		$return = $this->materi_pertemuan_model->update($id, $data);
		exit();
	}
    private function save_materipertemuan($type = 'insert', $id = 0)
    {
        if ($type == 'update') {
            $_POST['id'] = $id;
        }
		 
        // Validate the data
        $this->form_validation->set_rules($this->materi_pertemuan_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
          //  return false;
        }

        // Make sure we only pass in the fields we want
        //die($this->input->post("id_bidang")." id bidang");
        $data = $this->materi_pertemuan_model->prep_data($this->input->post());
		$data['kode_jadwal']	 	= $this->input->post("kode_jadwal");
		$data['desc_materi']	 	= $this->input->post("desc_materi");
		$data['file_materi']	 	= $this->input->post("file_materi");
		$data['pertemuan']	 	= $this->input->post("pertemuan");
		
		$data['tanggal']	 	= $this->input->post("tanggal") ? $this->input->post("tanggal") : "0000-00-00";
		$data['jam_mulai']	 	= $this->input->post("jam_mulai");
		$data['jam_selesai']	= $this->input->post("jam_selesai");
        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        

        $return = false;
        if ($type == 'insert') {
            $id = $this->materi_pertemuan_model->insert($data);

            if (is_numeric($id)) {
                $return = $id;
            }
        } elseif ($type == 'update') {
            $return = $this->materi_pertemuan_model->update($id, $data);
        }

        return $return;
    }
}