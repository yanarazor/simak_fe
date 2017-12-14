<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mastermatakuliah_model extends BF_Model {

	protected $table_name	= "mastermatakuliah";
	protected $key			= "id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";

	protected $log_user 	= FALSE;

	protected $set_created	= false;
	protected $set_modified = false;

	/*
		Customize the operations of the model without recreating the insert, update,
		etc methods by adding the method names to act as callbacks here.
	 */
	protected $before_insert 	= array();
	protected $after_insert 	= array();
	protected $before_update 	= array();
	protected $after_update 	= array();
	protected $before_find 		= array();
	protected $after_find 		= array();
	protected $before_delete 	= array();
	protected $after_delete 	= array();

	/*
		For performance reasons, you may require your model to NOT return the
		id of the last inserted row as it is a bit of a slow method. This is
		primarily helpful when running big loops over data.
	 */
	protected $return_insert_id 	= TRUE;

	// The default type of element data is returned as.
	protected $return_type 			= "object";

	// Items that are always removed from data arrays prior to
	// any inserts or updates.
	protected $protected_attributes = array();

	/*
		You may need to move certain rules (like required) into the
		$insert_validation_rules array and out of the standard validation array.
		That way it is only required during inserts, not updates which may only
		be updating a portion of the data.
	 */
	protected $validation_rules 		= array(
		array(
			"field"		=> "mastermatakuliah_tahun_akademik",
			"label"		=> "Tahun Akademik",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "mastermatakuliah_kode_pt",
			"label"		=> "Kode Perguruan Tinggi",
			"rules"		=> "max_length[6]"
		),
		array(
			"field"		=> "mastermatakuliah_kode_fakultas",
			"label"		=> "Kode Fakultas",
			"rules"		=> "required|max_length[5]"
		),
		array(
			"field"		=> "mastermatakuliah_kode_prodi",
			"label"		=> "Kode Program Studi",
			"rules"		=> "required|max_length[15]"
		),
		array(
			"field"		=> "mastermatakuliah_kode_jenjang_studi",
			"label"		=> "Kode Jenjang Studi",
			"rules"		=> "required|max_length[5]"
		),
		array(
			"field"		=> "mastermatakuliah_kode_mata_kuliah",
			"label"		=> "Kode Mata Kuliah",
			"rules"		=> "required|max_length[15]"
		),
		array(
			"field"		=> "mastermatakuliah_nama_mata_kuliah",
			"label"		=> "Nama Mata Kuliah",
			"rules"		=> "required|max_length[50]"
		),
		array(
			"field"		=> "mastermatakuliah_sks",
			"label"		=> "SKS",
			"rules"		=> "required|max_length[5]"
		),
		array(
			"field"		=> "mastermatakuliah_sks_tatap_muka",
			"label"		=> "SKS Tatap Muka",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "mastermatakuliah_sks_praktikum",
			"label"		=> "SKS Praktikum",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "mastermatakuliah_sks_praktek_lap",
			"label"		=> "SKS Praktek Lapangan",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "mastermatakuliah_semester",
			"label"		=> "Semester",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "mastermatakuliah_kode_kelompok",
			"label"		=> "Kode Kelompok",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "mastermatakuliah_kode_kurikulum",
			"label"		=> "Kode Kurikulum",
			"rules"		=> "max_length[50]"
		),
		array(
			"field"		=> "mastermatakuliah_kode_matkul",
			"label"		=> "Kode Matkul",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "mastermatakuliah_nidn",
			"label"		=> "NO Dosen",
			"rules"		=> "max_length[25]"
		),
		array(
			"field"		=> "mastermatakuliah_jenjang_prodi",
			"label"		=> "Jenjang Program Studi",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "mastermatakuliah_prodi_pengampu",
			"label"		=> "Program Studi Pengampu",
			"rules"		=> "max_length[50]"
		),
		array(
			"field"		=> "mastermatakuliah_status_mata_kuliah",
			"label"		=> "Status Mata Kuliah",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "mastermatakuliah_silabus",
			"label"		=> "Silabus",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "mastermatakuliah_sap",
			"label"		=> "SAP",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "mastermatakuliah_bahan_ajar",
			"label"		=> "Bahan Ajar",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "mastermatakuliah_diktat",
			"label"		=> "Diktat",
			"rules"		=> "max_length[5]"
		),
	);
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= FALSE;

	//--------------------------------------------------------------------
	public function find_distinctall($tahun="",$fakultas="",$programstudi="",$kodemk="",$nama_mk="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.kode_mata_kuliah,nama_mata_kuliah');
		}
		if ($tahun != "")
		{
			$this->db->or_like('tahun_akademik',$tahun);
		}
		if ($fakultas != "")
		{
			$this->db->where('mastermatakuliah.kode_fakultas',$fakultas);
		} 
		if ($programstudi != "")
		{
			$this->db->where('kode_prodi',$programstudi);
		} 
		if ($kodemk != "")
		{
			$this->db->or_like('kode_mata_kuliah',$kodemk);
		}
		if ($nama_mk != "")
		{
			$this->db->or_like('nama_mata_kuliah',$nama_mk);
		} 
		//$this->db->join('masterfakultas', 'masterfakultas.kode_fakultas = mastermatakuliah.kode_fakultas', 'left'); 
		$this->db->order_by('nama_mata_kuliah asc'); 
		$this->db->distinct(); 
		return parent::find_all();

	}
	public function find_all($semester="",$fakultas="",$programstudi="",$kodemk="",$nama_mk="",$sms="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_fakultas,nama_prodi');
		}
		if ($semester != "")
		{
			$this->db->where('sms',$semester);
		}
		if ($fakultas != "")
		{
			$this->db->where('mastermatakuliah.kode_fakultas',$fakultas);
		} 
		if ($programstudi != "")
		{
			$this->db->where('mastermatakuliah.kode_prodi',$programstudi);
		} 
		if ($kodemk != "")
		{
			$this->db->or_like('kode_mata_kuliah',$kodemk);
		}
		if ($nama_mk != "")
		{
			$this->db->or_like('nama_mata_kuliah',$nama_mk);
		}
		if ($sms != "")
		{
			$this->db->or_like('semester',$sms);
		} 
		$this->db->join('masterfakultas', 'masterfakultas.kode_fakultas = mastermatakuliah.kode_fakultas', 'left'); 
		$this->db->join('masterprogramstudi', 'mastermatakuliah.kode_prodi = masterprogramstudi.kode_prodi', 'left'); 
		 $this->db->order_by('mastermatakuliah.kode_prodi asc,semester asc'); 
		return parent::find_all();

	}
	public function count_all($semester="",$fakultas="",$programstudi="",$kodemk="",$nama_mk="",$sms="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_fakultas');
		}
		if ($semester != "")
		{
			$this->db->where('sms',$semester);
		}
		if ($fakultas != "")
		{
			$this->db->where('mastermatakuliah.kode_fakultas',$fakultas);
		} 
		if ($programstudi != "")
		{
			$this->db->where('mastermatakuliah.kode_prodi',$programstudi);
		} 
		if ($kodemk != "")
		{
			$this->db->or_like('kode_mata_kuliah',$kodemk);
		}
		if ($nama_mk != "")
		{
			$this->db->or_like('nama_mata_kuliah',$nama_mk);
		}
		if ($sms != "")
		{
			$this->db->or_like('semester',$sms);
		} 
		//$this->db->join('masterfakultas', 'masterfakultas.kode_fakultas = mastermatakuliah.kode_fakultas', 'left'); 
		//$this->db->order_by('tahun_akademik desc, kode_mata_kuliah asc'); 
		return parent::count_all();

	}
	public function find_by_ditawarkan($sms="",$programstudi="",$statsemester="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_prodi');
		}
		 
		$this->db->where('sms',$statsemester);
		 
		if ($sms != "")
		{
			$this->db->where('semester',$sms);
		}
		 
		$this->db->where('mastermatakuliah.kode_prodi',$programstudi);
		 
		$this->db->where('semester != 0');
		$this->db->where('mastermatakuliah.status_mata_kuliah',"A");
		//$this->db->where('mastermatakuliah.tahun_akademik like "'.$this->settings_lib->item('site.tahun').'%"');
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = mastermatakuliah.kode_prodi', 'left'); 
		$this->db->distinct();
		$this->db->order_by("semester","ASC");
		return parent::find_all();

	}
	public function find_by_ditawarkanlainnya($sms="",$programstudi="",$statsemester="")
	{
		if (empty($this->selects))
		{
			$this->select('mastermatakuliah.tahun_akademik,kode_mata_kuliah,nama_mata_kuliah,mastermatakuliah.sks,sks_tatap_muka,sks_praktikum,sks_praktek_lap,mastermatakuliah.semester,nama_prodi');
		}
		if ($sms != "")
		{
			$this->db->where('mastermatakuliah.semester != "'.$sms.'"');
		}
		$this->db->where('sms',$statsemester);
		if ($programstudi != "")
		{
			$this->db->where('mastermatakuliah.kode_prodi',$programstudi);
		} 
		$this->db->where('mastermatakuliah.status_mata_kuliah',"A");
		$this->db->where('mastermatakuliah.tahun_akademik like "'.$this->settings_lib->item('site.tahun').'%"');
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = mastermatakuliah.kode_prodi', 'inner'); 
		$this->db->join('datakrs', 'mastermatakuliah.kode_mata_kuliah=datakrs.kode_mk', 'inner');
		$this->db->distinct();
		return parent::find_all();

	}
	public function find_lainnya($sms="",$programstudi="")
	{
		if (empty($this->selects))
		{
			$this->select('tahun_akademik,kode_mata_kuliah,nama_mata_kuliah,sks,sks_tatap_muka,sks_praktikum,sks_praktek_lap,semester,nama_prodi');
		}
		 
		$this->db->where('semester != "'.$sms.'"');
		$this->db->where('mastermatakuliah.kode_prodi',$programstudi);
		//$this->db->where('mastermatakuliah.kode_prodi',$programstudi);
		
		
		$this->db->where('mastermatakuliah.tahun_akademik like "'.$this->settings_lib->item('site.tahun').'%"');
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = mastermatakuliah.kode_prodi', 'left'); 
		$this->db->distinct();
		$this->db->order_by("semester","ASC");
		return parent::find_all();

	}
	
	
	public function find_distinct($tahun="",$fakultas="",$programstudi="",$kodemk="",$nama_mk="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.kode_mata_kuliah,nama_mata_kuliah');
		}
		if ($tahun != "")
		{
			$this->db->like('tahun_akademik',$tahun);
		}
		if ($fakultas != "")
		{
			$this->db->where('mastermatakuliah.kode_fakultas',$fakultas);
		} 
		if ($programstudi != "")
		{
			$this->db->where('kode_prodi',$programstudi);
		} 
		if ($kodemk != "")
		{
			$this->db->where('kode_mata_kuliah',$kodemk);
		}
		if ($nama_mk != "")
		{
			$this->db->where('nama_mata_kuliah',$nama_mk);
		} 
		//$this->db->where('tahun_akademik like "'.$tahun.'%"');
		$this->db->join('masterfakultas', 'masterfakultas.kode_fakultas = mastermatakuliah.kode_fakultas', 'left'); 
		$this->db->distinct("kode_mata_kuliah,nama_mata_kuliah");
		$this->db->order_by('nama_mata_kuliah asc'); 
		return parent::find_all();

	}
	public function getbytahun($tahun="",$jadwal_prodi="",$semester = "")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.kode_mata_kuliah,nama_mata_kuliah');
		}
		 
		if ($tahun != "")
		{
			//$this->db->where('tahun_akademik',$tahun);
		}
		if ($jadwal_prodi != "")
		{
			$this->db->where('kode_prodi',$jadwal_prodi);
		}
		if ($semester != "")
		{
			$this->db->where('semester',$semester);
		}
		$this->db->where('status_mata_kuliah',"A");
		return parent::find_all();

	}
	public function find_detil($kode_mk="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		 
		if ($kode_mk != "")
		{
			$this->db->where('kode_mata_kuliah',$kode_mk);
		} 
		return parent::find_all();

	}
	
	public function find_detil_mk($kode_mk="",$kode_fakultas="",$kode_prodi="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		 
		if ($kode_mk != "")
		{
			$this->db->where('kode_mata_kuliah',$kode_mk);
		} 
		if ($kode_fakultas != "")
		{
			$this->db->where('kode_fakultas',$kode_fakultas);
		} 
		if ($kode_prodi != "")
		{
			$this->db->where('kode_prodi',$kode_prodi);
		} 
		$this->db->where('status_mata_kuliah',"A");
		return parent::find_all();

	}
	
}
