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

		$this->auth->restrict('Khs.Nilai.View');
		$this->load->model('khs_model', null, true);
		$this->lang->load('khs');
		
		Template::set_block('sub_nav', 'nilai/_sub_nav');

		Assets::add_module_js('khs', 'khs.js');
		
		//master Fakultas
		$this->load->model('masterfakultas/masterfakultas_model', null, true);
		$masterfakultas = $this->masterfakultas_model->find_all();
		Template::set('masterfakultass', $masterfakultas);
		//master jurusan
		$this->load->model('masterprogramstudi/masterprogramstudi_model', null, true);
		$masterprogramstudis = $this->masterprogramstudi_model->find_all();
		Template::set('masterprogramstudis', $masterprogramstudis);
		
		$this->load->model('pilihan/pilihan_model', null, true);
		$pilihantahuns = $this->pilihan_model->find_all("ta");
		Template::set('pilihantahuns', $pilihantahuns);
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
					$result = $this->khs_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('khs_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('khs_delete_failure') . $this->khs_model->error, 'error');
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
		$total = $this->khs_model->count_all($tahun,$filfakultas,$filljurusan,$mhs,$status,$angkatan);
		$offset = $this->input->get('per_page');
		$limit = $this->settings_lib->item('site.list_limit');

		$this->pager['base_url'] 			= current_url()."?filfakultas=".$filfakultas."&tahun=".$tahun."&filljurusan=".$filljurusan."&mhs=".$mhs."&status=".$status."&angkatan=".$angkatan;
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= TRUE;
		$this->pagination->initialize($this->pager);
		$records = $this->khs_model->limit($limit, $offset)->find_all($tahun,$filfakultas,$filljurusan,$mhs,$status,$angkatan);
 
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


		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage khs');
		Template::render();
	}
	public function hitungkhs()
	{
		$this->auth->restrict('Khs.Nilai.Create');
		$this->load->model('datakrs/datakrs_model', null, true);
		$filfakultas = $this->input->post('filfakultas');
		$tahun = $this->input->post('tahun');
		$mhs = $this->input->post('mhs');
		$filljurusan = $this->input->post('filljurusan');
		$status = $this->input->post('status');
		$angkatan = $this->input->post('angkatan');
		
		$records = $this->datakrs_model->distinctmahasiswa($tahun,$filfakultas,$filljurusan,$mhs,$status,$angkatan);
		$jmlmahasiswa = 0;	
		if (isset($records) && is_array($records) && count($records)) :
			foreach ($records as $record) :
				$semester 		= $record->semester;
				$mahasiswa 		= $record->mahasiswa;
				$ipk 			= $this->hitung_ipsemester($semester,$mahasiswa);
				$ipkkumulatif 	= $this->hitung_ipk($semester,$mahasiswa);
				//echo $ipkkumulatif;
				if($ipk != 0 and $ipk != ""){
					$wheres = array(
					"nim"    => $record->mahasiswa,
					"tahun_ajaran"    => $record->tahun_akademik,
					"semester"    => $record->semester
					);
					$this->khs_model->delete_where($wheres);

					 $data = array();
					 $data['nim']        	= $record->mahasiswa;
					 $data['tahun_ajaran']  = $record->tahun_akademik;
					 $data['semester']      = $record->semester;
					 $data['jml_sks']       = $record->jml_sks;
					 $data['ipk']        	= $ipk;
					 $data['ipkk']        	= $ipkkumulatif;
					 if($id = $this->khs_model->insert($data)){
					 	$jmlmahasiswa = $jmlmahasiswa + 1;
					 }
				}
			
				
			endforeach;
		endif;	
		$output = $this->load->view('nilai/mahasiswa',array("total"=>$jmlmahasiswa),true);	
	 	echo $output;
		exit();
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
		
		if (isset($datakrs) && is_array($datakrs) && count($datakrs)) : 
							    
		 $no = 1;
			foreach ($datakrs as $record) :
				$nilaiangka = 0;
				$jmlsks = $jmlsks + (int)$record->sks;
		  		if(isset($jsonkonversi[$record->nilai_huruf])){
				  	$nilaiangka = $jsonkonversi[$record->nilai_huruf];
				}
				//echo $record->sks;
				  $jmlbobot = $jmlbobot + ((int)$record->sks*(int)$nilaiangka);
			   
			  	//echo ((int)$record->sks*(int)$nilaiangka);
			endforeach;
		endif;
		
		$ipk = 0;
		if($jmlbobot!="" and $jmlsks != "")
		{
			$ipk = round($jmlbobot/$jmlsks, 2);
			//echo $jmlbobot."/".$jmlsks." ini";
		}
		return $ipk; 
		
	}
	private function hitung_ipk($semester, $nim)
	{
		$this->load->model('konversi/konversi_model', null, true);
		$sms = $semester;
		$mhs = $nim; 
		$ipk = 0;
		$recordkonversi = $this->konversi_model->find_all();
		$jsonkonversi[] =array();
		if (isset($recordkonversi) && is_array($recordkonversi) && count($recordkonversi)) :
		foreach ($recordkonversi as $record) : 
			$jsonkonversi[$record->huruf] = $record->angka;
			//echo $record->huruf;
		endforeach;
		endif;
		 
		$semester = 0;
		 $jmlsks = 0;
		 $jmlbobot = 0;
		 $nilaiangka = "";
		 $no = 0;
		 $datakrs = $this->datakrs_model->find_transkip($mhs,"","1");
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
			 $no++;
			 endforeach; 
		 endif;
		 $ipk = 0;
		 if($jmlbobot!="" and $jmlsks != "")
		 {
			 $ipk = round($jmlbobot/$jmlsks, 2);
		 }
		return $ipk; 
		
	}
		
	//--------------------------------------------------------------------


	/**
	 * Creates a khs object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Khs.Nilai.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_khs())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('khs_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'khs');

				Template::set_message(lang('khs_create_success'), 'success');
				redirect(SITE_AREA .'/nilai/khs');
			}
			else
			{
				Template::set_message(lang('khs_create_failure') . $this->khs_model->error, 'error');
			}
		}
		Assets::add_module_js('khs', 'khs.js');

		Template::set('toolbar_title', lang('khs_create') . ' khs');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of khs data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('khs_invalid_id'), 'error');
			redirect(SITE_AREA .'/nilai/khs');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Khs.Nilai.Edit');

			if ($this->save_khs('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('khs_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'khs');

				Template::set_message(lang('khs_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('khs_edit_failure') . $this->khs_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Khs.Nilai.Delete');

			if ($this->khs_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('khs_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'khs');

				Template::set_message(lang('khs_delete_success'), 'success');

				redirect(SITE_AREA .'/nilai/khs');
			}
			else
			{
				Template::set_message(lang('khs_delete_failure') . $this->khs_model->error, 'error');
			}
		}
		Template::set('khs', $this->khs_model->find($id));
		Template::set('toolbar_title', lang('khs_edit') .' khs');
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
	private function save_khs($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['nim']        = $this->input->post('khs_nim');
		$data['tahun_ajaran']        = $this->input->post('khs_tahun_ajaran');
		$data['semester']        = $this->input->post('khs_semester');
		$data['jml_sks']        = $this->input->post('khs_jml_sks');
		$data['ipk']        = $this->input->post('khs_ipk');

		if ($type == 'insert')
		{
			$id = $this->khs_model->insert($data);

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
			$return = $this->khs_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}