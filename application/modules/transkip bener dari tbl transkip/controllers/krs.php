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
		$this->lang->load('transkip');
		
		Template::set_block('sub_nav', 'krs/_sub_nav');

		Assets::add_module_js('transkip', 'transkip.js');
		$this->load->model('mastermahasiswa/mastermahasiswa_model', null, true);
		
			Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
			Assets::add_js('jquery-ui-1.8.13.min.js');
		

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
		log_activity($this->current_user->id, ' Lihat Mahasiswa (Cari Transkip) ,dari : '. $this->input->ip_address(), 'mastermahasiswa');

		$this->auth->restrict('Transkip.Krs.View');
		Template::set_block('sub_nav', 'krs/_sub_nav');
		Template::set('toolbar_title', 'Manage Transkip');
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

	//--------------------------------------------------------------------


	/**
	 * Creates a Transkip object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Transkip.Krs.Create');

		Assets::add_module_js('transkip', 'transkip.js');

		Template::set('toolbar_title', lang('transkip_create') . ' Transkip');
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
		Template::set('toolbar_title', 'Upload Transkip Nilai');
		Template::render();
	}
	public function cari()
	{
		  
		$nim = $this->input->get('nim');
		$nama = $this->input->get('nama');
		$tgl = $this->input->get('tgl');
		Template::set('nim', $nim);
		Template::set('toolbar_title', 'Cari Transkip Nilai');
		Template::render();
	}
	public function caritranskip()
	{
		
	 	$this->load->model('transkip/transkip_model', null, true);
	 	$this->load->model('konversi/konversi_model', null, true);
	 	$this->load->model('predikat/predikat_model', null, true);
	 	$nim 	= $this->input->post('valnim');
	 	$nilai 	= $this->input->post('nilai');
	 	// log
	 	log_activity($this->current_user->id, ' Cari Transkip, Nim : '.$nim.',dari : '. $this->input->ip_address(), 'mastermahasiswa');
	 	
	 	//get mahasiswa
	 	$this->load->model('mastermahasiswa/mastermahasiswa_model', null, true);
		$data_mahasiswa = $this->mastermahasiswa_model->find_detil($nim); 
		//die($nilai." nilai");
		$datakrs = $this->transkip_model->find_transkip($nim,"",$nilai);
		 
		$jsonkrs[][] =array();
		$jmlsks=0;
		$semesterakhir = 1;
		if (isset($datakrs) && is_array($datakrs) && count($datakrs)) :
		foreach ($datakrs as $record) : 
			//echo $record->semester."<br>";
			if($record->kode_mk!="" and !isset($jsonkrs[$record->kode_mk][(int)$record->semester]['namamtk'])){
				$semesterakhir = $record->semester;
				$smsmk = substr($record->kode_mk,4,1);
				if($smsmk=="0")
					$smsmk = substr($record->kode_mk,3,1);
				$jmlsks = $jmlsks + (int)$record->sks;
				//echo $record->kode_mk."-".$smsmk."<br>";
				if(is_numeric($smsmk))
					$sms = 	$smsmk;
				else
					$sms = (int)str_replace("semester : ","",$record->semester);
				
				//echo $sms;
				//echo $sms." - ".$record->kode_mk."<br>";
				$jsonkrs[$sms]['kode_mk'][] = $record->kode_mk;
				$jsonkrs[$record->kode_mk][$sms]['namamtk'] = $record->nama_mk;
				$jsonkrs[$record->kode_mk][$sms]['sks'] = $record->sks;
				$jsonkrs[$record->kode_mk][$sms]['nilai'] = $record->nilai_huruf;
			}
		endforeach;
		endif;
		$recordkonversi = $this->konversi_model->find_all();
		$jsonkonversi[] =array();
		if (isset($recordkonversi) && is_array($recordkonversi) && count($recordkonversi)) :
		foreach ($recordkonversi as $record) : 
			$jsonkonversi[$record->huruf] = $record->angka;
			//echo $record->huruf;
		endforeach;
		endif;
		$output = "";
	 	$output .= $this->load->view('krs/transkip',array("datakrs"=>$datakrs,"datamahasiswa"=>$data_mahasiswa,"jsonkrs"=>$jsonkrs,"jsonkonversi"=>$jsonkonversi,"mhs"=>$nim,"nilai"=>$nilai,"semesterakhir"=>$semesterakhir),true);	
	 	echo $output;
		exit;
		
	}
	public function printtranskip()
	{
	 	$this->load->model('transkip/transkip_model', null, true);
	 	$this->load->model('konversi/konversi_model', null, true);
	 	$this->load->model('predikat/predikat_model', null, true);
	 	//$nim 	= $this->input->post('valnim');
	 	$nim = $this->uri->segment(5); 
	 	$sertakannilai = $this->uri->segment(7); 
	 	 
	 	//die($nim." sad");
	 	//get mahasiswa
	 	$this->load->model('mastermahasiswa/mastermahasiswa_model', null, true);
		$data_mahasiswa = $this->mastermahasiswa_model->find_detil($nim); 
		//print_r($data_mahasiswa);
		$datakrs = $this->transkip_model->find_transkip($nim,"",$sertakannilai);
		 
		$jsonkrs[][] =array();
		$jmlsks=0;
		$semesterakhir = 1;
		if (isset($datakrs) && is_array($datakrs) && count($datakrs)) :
		foreach ($datakrs as $record) : 
			//echo $record->semester."<br>";
			if($record->kode_mk!="" and !isset($jsonkrs[$record->kode_mk][$sms]['namamtk'])){
				$semesterakhir = $record->semester;
				$smsmk = substr($record->kode_mk,4,1);
				if($smsmk=="0")
					$smsmk = substr($record->kode_mk,3,1);
				$jmlsks = $jmlsks + (int)$record->sks;
				//echo $record->kode_mk."-".$smsmk."<br>";
				if(is_numeric($smsmk))
					$sms = 	$smsmk;
				else
					$sms = (int)str_replace("semester : ","",$record->semester);
				
				//echo $sms;
				//echo $sms." - ".$record->kode_mk."<br>";
				$jsonkrs[$sms]['kode_mk'][] = $record->kode_mk;
				$jsonkrs[$record->kode_mk][$sms]['namamtk'] = $record->nama_mk;
				$jsonkrs[$record->kode_mk][$sms]['sks'] = $record->sks;
				$jsonkrs[$record->kode_mk][$sms]['nilai'] = $record->nilai_huruf;
			}
		endforeach;
		endif;
		
		$recordkonversi = $this->konversi_model->find_all();
		$jsonkonversi[] =array();
		if (isset($recordkonversi) && is_array($recordkonversi) && count($recordkonversi)) :
		foreach ($recordkonversi as $record) : 
			$jsonkonversi[$record->huruf] = $record->angka;
			//echo $record->huruf;
		endforeach;
		endif;
		$output = "";
	 	//$output .= $this->load->view('krs/transkip',array(""=>$datakrs,""=>$data_mahasiswa,""=>$jsonkrs,""=>$jsonkonversi,""=>$nim),true);	
	 	
	 	Template::set('datakrs', $datakrs);
	 	Template::set('datamahasiswa', $data_mahasiswa);
	 	Template::set('jsonkrs', $jsonkrs);
	 	Template::set('jsonkonversi', $jsonkonversi);
	 	Template::set('mhs', $nim);
	 	Template::set('semesterakhir', $semesterakhir);
		 
		Template::set_theme('print');
		 
		Template::set_view('krs/transkip');
		Template::set('toolbar_title', 'Lihat Transkip');
		Template::render();
	}
	public function view()
	{
		$this->auth->restrict('Transkip.Krs.View');
		
		$this->load->model('datakrs/datakrs_model', null, true);
		$this->load->model('konversi/konversi_model', null, true);
		$this->load->model('predikat/predikat_model', null, true);
		$mode = $this->uri->segment(6); 
		//die($mode);
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
		$data_mahasiswa = $this->mastermahasiswa_model->find_detil($id); 
		Template::set('datamahasiswa', $data_mahasiswa);
		
		$datakrs = $this->datakrs_model->find_distinct("","",$id);
		$jsonkrs[][] =array();
		$jmlsks=0;
		if (isset($datakrs) && is_array($datakrs) && count($datakrs)) :
		foreach ($datakrs as $record) : 
			//echo $record->semester." = ".$record->sks." = ".$jmlsks." ".$record->kode_mata_kuliah." ".$record->nama_mata_kuliah."<br>";
			$jmlsks = $jmlsks + (int)$record->sks;
			
			$jsonkrs[$record->semester]['kode_mata_kuliah'][] = $record->kode_mata_kuliah;
			//echo $record->semester."-".$record->semester = $record->nama_mata_kuliah;
			$jsonkrs[$record->kode_mata_kuliah][$record->semester]['namamtk'] = $record->nama_mata_kuliah;
			$jsonkrs[$record->kode_mata_kuliah][$record->semester]['sks'] = $record->sks;
			$jsonkrs[$record->kode_mata_kuliah][$record->semester]['nilai'] = $record->nilai_huruf;
			//echo $record->huruf;
		endforeach;
		endif;
		//die("");
		Template::set('jsonkrs', $jsonkrs);
		//die($jmlsks." ");
		//print_r($datakrs);
		Template::set('datakrs', $datakrs);
		Template::set('mhs', $id);
		if($mode=="print"){
			Template::set_theme('print');
		}
		$recordkonversi = $this->konversi_model->find_all();
		$jsonkonversi[] =array();
		if (isset($recordkonversi) && is_array($recordkonversi) && count($recordkonversi)) :
		foreach ($recordkonversi as $record) : 
			$jsonkonversi[$record->huruf] = $record->angka;
			//echo $record->huruf;
		endforeach;
		endif;
		Template::set('jsonkonversi', $jsonkonversi);
		
		$semester = 0;
		 $jmlsks = 0;
		 $jmlbobot = 0;
		 $nilaiangka = "";
		 $no = 0;
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
			 $no++;
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
		//print_r($redordpredikat);
		if (isset($redordpredikat) && is_array($redordpredikat) && count($redordpredikat)) :
		foreach ($redordpredikat as $record) : 
			$predikat = $record->predikat;
		endforeach;
		endif;
		Template::set('predikat', $predikat);
		//echo $ipk; 
        		
		//print_r($data_mahasiswa);
	 
		Template::set('toolbar_title', 'Lihat Transkip');
		Template::render();
	}

	//------- View transkip Untuk Mahasiswa -------------------------------------------------------------
	public function viewmhs()
	{
		$this->auth->restrict('Transkip.Nilai.Viewmhs');
		$this->load->model('transkip/transkip_model', null, true);
	 	$this->load->model('konversi/konversi_model', null, true);
	 	$this->load->model('predikat/predikat_model', null, true);
	 	$nim = $this->current_user->nim;
	 	$sertakannilai = $this->uri->segment(7); 
	 	 
	 	//die($nim." sad");
	 	//get mahasiswa
	 	$this->load->model('mastermahasiswa/mastermahasiswa_model', null, true);
		$data_mahasiswa = $this->mastermahasiswa_model->find_detil($nim); 
		//print_r($data_mahasiswa);
		$datakrs = $this->transkip_model->find_transkip($nim,"",$sertakannilai);
		 
		$jsonkrs[][] =array();
		$jmlsks=0;
		$semesterakhir = 1;
		if (isset($datakrs) && is_array($datakrs) && count($datakrs)) :
		foreach ($datakrs as $record) : 
			//echo $record->semester."<br>";
			if($record->kode_mk!="" and !isset($jsonkrs[$record->kode_mk][$record->semester]['namamtk'])){
				$semesterakhir = $record->semester;
				$smsmk = substr($record->kode_mk,4,1);
				if($smsmk=="0")
					$smsmk = substr($record->kode_mk,3,1);
				$jmlsks = $jmlsks + (int)$record->sks;
				//echo $record->kode_mk."-".$smsmk."<br>";
				if(is_numeric($smsmk))
					$sms = 	$smsmk;
				else
					$sms = (int)str_replace("semester : ","",$record->semester);
				
				//echo $sms;
				//echo $sms." - ".$record->kode_mk."<br>";
				$jsonkrs[$sms]['kode_mk'][] = $record->kode_mk;
				$jsonkrs[$record->kode_mk][$sms]['namamtk'] = $record->nama_mk;
				$jsonkrs[$record->kode_mk][$sms]['sks'] = $record->sks;
				$jsonkrs[$record->kode_mk][$sms]['nilai'] = $record->nilai_huruf;
			}
		endforeach;
		endif;
		
		$recordkonversi = $this->konversi_model->find_all();
		$jsonkonversi[] =array();
		if (isset($recordkonversi) && is_array($recordkonversi) && count($recordkonversi)) :
		foreach ($recordkonversi as $record) : 
			$jsonkonversi[$record->huruf] = $record->angka;
			//echo $record->huruf;
		endforeach;
		endif;
		$output = "";
	 	 
	 	Template::set('datakrs', $datakrs);
	 	Template::set('datamahasiswa', $data_mahasiswa);
	 	Template::set('jsonkrs', $jsonkrs);
	 	Template::set('jsonkonversi', $jsonkonversi);
	 	Template::set('mhs', $nim);
	 	Template::set('semesterakhir', $semesterakhir);
		Template::set('toolbar_title', 'Lihat Transkip');
		Template::set_view('krs/viewmhs');
		Template::render();
	}
	public function viewmhsbak()
	{
		$this->load->model('datakrs/datakrs_model', null, true);
		$this->load->model('konversi/konversi_model', null, true);
		$this->load->model('predikat/predikat_model', null, true);
		$mode = $this->uri->segment(5); 
		//die($mode);
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
		
		$datakrs = $this->datakrs_model->find_distinct("","",$id);
		$jsonkrs[][] =array();
		$jmlsks=0;
		if (isset($datakrs) && is_array($datakrs) && count($datakrs)) :
		foreach ($datakrs as $record) : 
			//echo $record->semester." = ".$record->sks." = ".$jmlsks." ".$record->kode_mata_kuliah." ".$record->nama_mata_kuliah."<br>";
			$jmlsks = $jmlsks + (int)$record->sks;
			
			$jsonkrs[$record->semester]['kode_mata_kuliah'][] = $record->kode_mk;
			//echo $record->semester."-".$record->semester = $record->nama_mata_kuliah;
			$jsonkrs[$record->kode_mk][$record->semester]['namamtk'] = $record->nama_mk;
			$jsonkrs[$record->kode_mk][$record->semester]['sks'] = $record->sks;
			$jsonkrs[$record->kode_mk][$record->semester]['nilai'] = $record->nilai_huruf;
			//echo $record->huruf;
		endforeach;
		endif;
		//die("");
		Template::set('jsonkrs', $jsonkrs);
		//die($jmlsks." ");
		//print_r($datakrs);
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
			//echo $record->huruf;
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
		Template::set('toolbar_title', 'Lihat Transkip');
		Template::render();
	}
	


}