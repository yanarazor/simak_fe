<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * master controller
 */
class master extends Admin_Controller
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

		
		$this->load->model('kuesioner_model', null, true);
		$this->load->model('kuesioner/kuesioner_jawaban_model', null, true);
		$this->lang->load('kuesioner');
		
		Template::set_block('sub_nav', 'master/_sub_nav');

		Assets::add_module_js('kuesioner', 'kuesioner.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{
		$this->auth->restrict('Kuesioner.Master.View');
		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$result = $this->kuesioner_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('kuesioner_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('kuesioner_delete_failure') . $this->kuesioner_model->error, 'error');
				}
			}
		}

		$records = $this->kuesioner_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage kuesioner');
		Template::render();
	}
	public function isi()
	{
		$idjadwal = $this->uri->segment(5);
		Template::set('idjadwal', $idjadwal);
		
		$records = $this->kuesioner_model->find_all("1");
		Template::set('records', $records);
		$record2s = $this->kuesioner_model->find_all("2");
		Template::set('record2s', $record2s);
		$record3s = $this->kuesioner_model->find_all("3");
		Template::set('record3s', $record3s);
		$record4s = $this->kuesioner_model->find_all("4");
		Template::set('record4s', $record4s);
		// cek isi data sebelumnya
		$recordjawaban = $this->kuesioner_jawaban_model->find_all($idjadwal,$this->current_user->nim);
		$jsonjawaban[] =array();
		if (isset($recordjawaban) && is_array($recordjawaban) && count($recordjawaban)) :
		foreach ($recordjawaban as $record) : 
			if($record->kode_soal == "srn"){
				$jsonjawaban['id'][$record->kode_soal] = $record->saran;
			}else{
				$jsonjawaban['id'][$record->kode_soal] = $record->jawaban;
			}
		endforeach;
		endif;
		Template::set('jsonjawaban', $jsonjawaban);
		Template::set('toolbar_title', 'Pengisian Kuesioner');
		Template::set_theme("adminlte");
		Template::render();
	}
	
	public function save(){
		$kode_jadwal = $this->input->post('kode_jadwal');
		$saran = $this->input->post('saran');
		
		$nim = $this->current_user->nim;
         // Validate the data
        $this->form_validation->set_rules($this->kuesioner_jawaban_model->get_validation_rules());
        $response = array(
            'success'=>false,
            'msg'=>'Unknown error'
        );
        $data = array('kode_jadwal'=>$kode_jadwal,'nim'=>$nim);
		$this->kuesioner_jawaban_model->delete_where($data);
		$soal = $this->input->post('soal'); 
		$nilai = $this->input->post('nilai'); 
		$nilaival = $this->input->post('nilaival'); 
		if(isset($_POST['soal'])){
			foreach($this->input->post("soal") as $value )
			{
				$valuenilai = isset($nilai[$value])?$nilai[$value]:0;
				//die($valuenilai."");
				$this->save_kuesioner_jawaban($value,$kode_jadwal,$valuenilai);
			}
		}
		if($saran != ""){
			$this->save_kuesioner_jawaban("srn",$kode_jadwal,"",$saran);
		}
        $response ['success']= true;
        $response ['msg']= "Transaksi berhasil";
        echo json_encode($response);    

    }
    public function hasil()
	{
		$idjadwal = $this->uri->segment(5);
		Template::set('idjadwal', $idjadwal);
		
		$records = $this->kuesioner_model->find_all("1");
		Template::set('records', $records);
		$record2s = $this->kuesioner_model->find_all("2");
		Template::set('record2s', $record2s);
		$record3s = $this->kuesioner_model->find_all("3");
		Template::set('record3s', $record3s);
		$record4s = $this->kuesioner_model->find_all("4");
		Template::set('record4s', $record4s);
		// cek isi data sebelumnya
		$recordjawaban = $this->kuesioner_jawaban_model->find_result($idjadwal);
		$jsonjawaban[] =array();
		if (isset($recordjawaban) && is_array($recordjawaban) && count($recordjawaban)) :
		foreach ($recordjawaban as $record) : 
			 $jsonjawaban['id'][$record->kode_soal] = (double)$record->ratarata;
		endforeach;
		endif;
		
		// get saran
		$recordsaran = $this->kuesioner_jawaban_model->find_saran($idjadwal);
		Template::set('recordsaran', $recordsaran);
		Template::set('jsonjawaban', $jsonjawaban);
		Template::set('toolbar_title', 'Lihat Hasil');
		Template::set_theme("adminlte");
		Template::render();
	}
    private function save_kuesioner_jawaban($kode_soal,$kode_jadwal,$jawaban = "",$saran = "",$type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		$data = array();
		$data['kode_jadwal']      = $kode_jadwal;
		$data['kode_soal']        = $kode_soal;
		$data['jawaban']        = $jawaban ? $jawaban : 0;
		$data['saran']        = $saran;
		$data['nim']		= $this->current_user->nim;
		if ($type == 'insert')
		{
			$id = $this->kuesioner_jawaban_model->insert($data);

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
			$return = $this->kuesioner_jawaban_model->update($id, $data);
		}

		return $return;
	}
	//--------------------------------------------------------------------


	/**
	 * Creates a kuesioner object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Kuesioner.Master.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_kuesioner())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('kuesioner_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'kuesioner');

				Template::set_message(lang('kuesioner_create_success'), 'success');
				redirect(SITE_AREA .'/master/kuesioner');
			}
			else
			{
				Template::set_message(lang('kuesioner_create_failure') . $this->kuesioner_model->error, 'error');
			}
		}
		Assets::add_module_js('kuesioner', 'kuesioner.js');

		Template::set('toolbar_title', lang('kuesioner_create') . ' kuesioner');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of kuesioner data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('kuesioner_invalid_id'), 'error');
			redirect(SITE_AREA .'/master/kuesioner');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Kuesioner.Master.Edit');

			if ($this->save_kuesioner('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('kuesioner_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'kuesioner');

				Template::set_message(lang('kuesioner_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('kuesioner_edit_failure') . $this->kuesioner_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Kuesioner.Master.Delete');

			if ($this->kuesioner_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('kuesioner_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'kuesioner');

				Template::set_message(lang('kuesioner_delete_success'), 'success');

				redirect(SITE_AREA .'/master/kuesioner');
			}
			else
			{
				Template::set_message(lang('kuesioner_delete_failure') . $this->kuesioner_model->error, 'error');
			}
		}
		Template::set('kuesioner', $this->kuesioner_model->find($id));
		Template::set('toolbar_title', lang('kuesioner_edit') .' kuesioner');
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
	private function save_kuesioner($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['kode']        = $this->input->post('kuesioner_kode');
		$data['pertanyaan']        = $this->input->post('kuesioner_pertanyaan');

		if ($type == 'insert')
		{
			$id = $this->kuesioner_model->insert($data);

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
			$return = $this->kuesioner_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}