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

		$this->auth->restrict('Dashboar_Dsn.Reports.View');
		$this->lang->load('dashboar_dsn');
		
		Template::set_block('sub_nav', 'reports/_sub_nav');

		Assets::add_module_js('dashboar_dsn', 'dashboar_dsn.js');
		Template::set('collapse', true);
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{
		$this->load->model('kuesioner/kuesioner_jawaban_model', null, true);
		$this->load->model('masterdosen/masterdosen_model', null, true);
		//die($this->current_user->foto."ad");
		//Assets::add_css('fancybox/jquery.fancybox-1.3.4.css');
		//Assets::add_js('fancybox/jquery.fancybox-1.3.4.js');
		//aktifitas
		$this->load->library('akademik');
		$akademik = new Akademik();	
		$recakademikaktf = $this->akademik->GetTahunAktif();
		$tahunakademik = isset($recakademikaktf[0]->tahun_id) ? $recakademikaktf[0]->tahun_id : $this->settings_lib->item('site.tahun');
		
		$this->load->model('jadwal/jadwal_model');
		$nidn 			=  $this->current_user->nim;
		$jadwalngajars 	= $this->jadwal_model->getjadwaldosen($nidn,$tahunakademik);
		Template::set('jadwalngajars', $jadwalngajars);
		$recdosen = $this->masterdosen_model->find_by("nidn",$nidn);
		$recordavgdosen = $this->kuesioner_jawaban_model->find_avgdosen($recdosen->id);
		$rataratakuesdosen = isset($recordavgdosen[0]->ratarata) ? $recordavgdosen[0]->ratarata : 0;
		Template::set('rataratakuesdosen', round($rataratakuesdosen,2));
		// jumlah mk diajar
		//$jmlmk 	= $this->jadwal_model->countdosenta($nidn,$tahunakademik);
		//$jumlahmk = isset($jmlmk[0]->jmlmk) ? $jmlmk[0]->jmlmk : 0;
		//Template::set('jmlmk', $jumlahmk);
		//jumlah sks
		//$jmlsks 	= $this->jadwal_model->countsksdosen($nidn,$tahunakademik);
		//$jumlahsks = isset($jmlsks[0]->jmlsks) ? $jmlsks[0]->jmlsks : 0;
		//Template::set('jmlsks', $jumlahsks);
		
		//$this->load->model('datakrs/datakrs_model');
		//$jmlmahasiswa = $this->datakrs_model->countmhs_bydosen($tahunakademik,"","",$nidn,"","");
		//$jumlahmahasiswa = isset($jmlmahasiswa[0]->jmlmahasiswa) ? $jmlmahasiswa[0]->jmlmahasiswa : 0;
		//Template::set('jumlahmahasiswa', $jumlahmahasiswa);
		
		
		
		Template::set('toolbar_title', 'Dashboard Dosen');
		Template::render();
	}
	
	//--------------------------------------------------------------------



}