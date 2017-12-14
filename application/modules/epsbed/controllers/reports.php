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

		$this->auth->restrict('Epsbed.Reports.View');
		$this->lang->load('epsbed');
		
		Template::set_block('sub_nav', 'reports/_sub_nav');

		Assets::add_module_js('epsbed', 'epsbed.js');
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

		Template::set('toolbar_title', 'Manage Epsbed');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Epsbed object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Epsbed.Reports.Create');

		Assets::add_module_js('epsbed', 'epsbed.js');

		Template::set('toolbar_title', lang('epsbed_create') . ' Epsbed');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Epsbed data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('epsbed_invalid_id'), 'error');
			redirect(SITE_AREA .'/reports/epsbed');
		}

		Template::set('toolbar_title', lang('epsbed_edit') .' Epsbed');
		Template::render();
	}

	//--------------------------------------------------------------------
	public function getreport()
	{
		$this->auth->restrict('Transkip.Nilai.Create');
	 	$this->load->model('datakrs/datakrs_model', null, true);
		$ta 	= $this->input->post('ta');
	 	$kode_prodi 	= $this->input->post('kode_prodi');
	 	
	 	// log
	 	log_activity($this->current_user->id, ' Buat report epsbed, dari : '. $this->input->ip_address(), 'epsbed');
	 	
	 	//get mahasiswa
	 	//die($kode_prodi);
	 	$datanilai = $this->datakrs_model->find_bytahun($ta,$kode_prodi); 
		//print_r($datanilai);
		$total = count($datanilai);
		$output = "";
		// diset semester akhirnya adalah 8 semester
		$semesterakhir = 8;
		
	 	$output .= $this->load->view('reports/nilai',array("datanilai"=>$datanilai,"tahun_ajaran"=>$ta,"kode_prodi"=>$kode_prodi,"total"=>$total),true);	
	 	echo $output;
		exit;
		
	}
	public function downloadnilai()
	{
		$this->auth->restrict('Transkip.Nilai.Create');
	 	$this->load->model('datakrs/datakrs_model', null, true);
		$ta 	= $this->input->get('ta');
		$kode_prodi 	= $this->input->get('kode_prodi');
	 	// log
	 	log_activity($this->current_user->id, ' export report epsbed, dari : '. $this->input->ip_address(), 'epsbed');
	 	
	 	//get mahasiswa
	 	$datanilai = $this->datakrs_model->find_bytahun($ta,$kode_prodi); 
	 	//$datanilai = $this->datakrs_model->find_bytahun($ta); 
		//print_r($datanilai);
		$total = count($datanilai);
		//include PHPExcel library
		$this->load->library('Excel');
		//require_once "Classes/PHPExcel/IOFactory.php";
		$objTpl = PHPExcel_IOFactory::load($this->settings_lib->item('site.pathxls').'nilai.xlsx');
		 
		//load Excel template file
		//$objTpl = PHPExcel_IOFactory::load("template.xls");
		$objTpl->setActiveSheetIndex(0);  //set first sheet as active
		// bulan pelaporan
		//$objTpl->getActiveSheet()->setCellValue('C12', ": ".$Class_Convert->GetMonth($bulan) ." ".$tahun);
		 
		
		if (isset($datanilai) && is_array($datanilai) && count($datanilai)) :
			$no=1;
			$row = 2;
			$col = 2;
			$jumlahall = 0;
			foreach ($datanilai as $record) :
				 
					$nilaiangka = "0.00"; 
					$nilaihuruf = $record->nilai_huruf;
					if($record->nilai_huruf == "A")
					{
						$nilaiangka = "4.00"; 
					}
					if($record->nilai_huruf == "B")
					{
						$nilaiangka = "3.00"; 
					}
					if($record->nilai_huruf == "C")
					{
						$nilaiangka = "2.00"; 
					}
					if($record->nilai_huruf == "D")
					{
						$nilaiangka = "1.00"; 
					}
					if($record->nilai_huruf == "-")
						$nilaihuruf = "E";
						$kelas = "01";
						switch ($record->kelas) {
						   case "A":
							   $kelas = "01";
							   break;
						   case "B":
							   $kelas = "02";
							   break;
							case "C":
							   $kelas = "03";
							   break;
							case "D":
							   $kelas = "04";
							   break;
							   case "E":
							   $kelas = "05";
							   break;
							   case "F":
							   $kelas = "06";
							   break;
							case "G":
							   $kelas = "07";
							   break;
							case "H":
							   $kelas = "08";
							   break;
							case "I":
							   $kelas = "09";
							   break;
							case "J":
							   $kelas = "10";
							   break;
						   default:
							   $kelas = "01";
					   }
				
				$objTpl->getActiveSheet()->setCellValueByColumnAndRow(0, $row,$record->tahun_akademik);
				$objTpl->getActiveSheet()->setCellValueByColumnAndRow(1, $row,"031011");
				$objTpl->getActiveSheet()->setCellValueByColumnAndRow(2, $row,"C");
				$objTpl->getActiveSheet()->setCellValueByColumnAndRow(3, $row,$record->kode_prodi);
				$objTpl->getActiveSheet()->setCellValueByColumnAndRow(4, $row,$record->mahasiswa);
				$objTpl->getActiveSheet()->setCellValueByColumnAndRow(5, $row,$record->kode_mk);
				$objTpl->getActiveSheet()->setCellValueByColumnAndRow(6, $row,$nilaihuruf);
				$objTpl->getActiveSheet()->setCellValueByColumnAndRow(7, $row,$nilaiangka);
				//$objTpl->getActiveSheet()->setCellValueByColumnAndRow(8, $row,$kelas);
				$objTpl->getActiveSheet()->setCellValueByColumnAndRow(8, $row,$record->kelas);
			$no++;
			$row = $row+1;
			endforeach;
		endif;
		
		//prepare download
		$filename = "Nilai_".mt_rand(1,100000).'.xlsx'; //just some random filename
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');

		//$objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
		$objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007'); 
		$objWriter->save('php://output');  //send it to user, of course you can save it to disk also!

		exit; //done.. exiting!
		
	}


}