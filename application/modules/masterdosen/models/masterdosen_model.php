<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Masterdosen_model extends BF_Model {

	protected $table_name	= "masterdosen";
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
			"field"		=> "masterdosen_kode_pt",
			"label"		=> "Kode Perguruan Tinggi",
			"rules"		=> "max_length[6]"
		),
		array(
			"field"		=> "masterdosen_kode_fakultas",
			"label"		=> "Kode Fakultas",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "masterdosen_kode_prodi",
			"label"		=> "Kode Program Studi",
			"rules"		=> "max_length[15]"
		),
		array(
			"field"		=> "masterdosen_kode_jenjang_studi",
			"label"		=> "Kode Jenjang Studi",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "masterdosen_no_ktp_dosen",
			"label"		=> "No KTP Dosen",
			"rules"		=> "required|max_length[30]"
		),
		array(
			"field"		=> "masterdosen_nidn",
			"label"		=> "NIDN",
			"rules"		=> "required|max_length[30]"
		),
		array(
			"field"		=> "masterdosen_nama_dosen",
			"label"		=> "Nama Dosen",
			"rules"		=> "required|max_length[50]"
		),
		array(
			"field"		=> "masterdosen_gelar_akademik",
			"label"		=> "Gelar Akademik",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "masterdosen_tempat_lahir_dosen",
			"label"		=> "Tempat Lahir",
			"rules"		=> "max_length[50]"
		),
		array(
			"field"		=> "masterdosen_tgl_lahir_dosen",
			"label"		=> "Tanggal Lahir Dosen",
			"rules"		=> ""
		),
		array(
			"field"		=> "masterdosen_jenis_kelamin",
			"label"		=> "Jenis Kelamin",
			"rules"		=> ""
		),
		array(
			"field"		=> "masterdosen_kode_jabatan_akademik",
			"label"		=> "Kode Jabatan Akademik",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "masterdosen_kode_pendidikan_tertinggi",
			"label"		=> "kode Pendidikan Tertinggi",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "masterdosen_kode_status_kerja_pts",
			"label"		=> "Kode Status Kerja PTS",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "masterdosen_kode_status_aktivitas_dosen",
			"label"		=> "Kode Status Aktivitas Dosen",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "masterdosen_tahun_semester",
			"label"		=> "Tahun Semester",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "masterdosen_nip_pns",
			"label"		=> "NIP PNS",
			"rules"		=> "max_length[30]"
		),
		array(
			"field"		=> "masterdosen_home_base",
			"label"		=> "Home Base",
			"rules"		=> "max_length[6]"
		),
		array(
			"field"		=> "masterdosen_photo_dosen",
			"label"		=> "Foto Dosen",
			"rules"		=> "max_length[255]"
		),
		array(
			"field"		=> "masterdosen_no_telp_dosen",
			"label"		=> "No Telepon Dosen",
			"rules"		=> "max_length[25]"
		),
	);
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= TRUE;

	//--------------------------------------------------------------------
	public function find_all($nidn="",$fakultas="",$programstudi="",$fillnama="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_fakultas');
		}
		
		$this->db->join('masterfakultas', 'masterfakultas.kode_fakultas = masterdosen.kode_fakultas', 'left'); 
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = masterdosen.kode_prodi', 'left');  
		
		$this->db->order_by('masterfakultas.kode_fakultas asc, kode_status_aktivitas_dosen asc'); 
		
		
		if ($nidn != "")
		{
			$this->db->or_like('nidn',$nidn);
		}
		if ($fakultas != "")
		{
			$this->db->or_like('masterdosen.kode_fakultas',$fakultas);
		} 
		if ($programstudi != "")
		{
			$this->db->or_like('masterprogramstudi.kode_prodi',$programstudi);
		} 
		 
		if ($fillnama != "")
		{
			$this->db->or_like('nama_dosen',$fillnama);
		} 
		$this->db->order_by('nama_dosen','asc'); 

		
		return parent::find_all();

	}

	public function count_all($nidn="",$fakultas="",$programstudi="",$fillnama="")
	{
		
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_fakultas');
		}
		
		$this->db->join('masterfakultas', 'masterfakultas.kode_fakultas = masterdosen.kode_fakultas', 'left'); 
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = masterdosen.kode_prodi', 'left');  
		
		$this->db->order_by('masterfakultas.kode_fakultas asc, kode_status_aktivitas_dosen asc'); 
		
		
		if ($nidn != "")
		{
			$this->db->or_like('nidn',$nidn);
		}
		if ($fakultas != "")
		{
			$this->db->or_like('masterdosen.kode_fakultas',$fakultas);
		} 
		if ($programstudi != "")
		{
			$this->db->or_like('masterprogramstudi.kode_prodi',$programstudi);
		} 
		 
		if ($fillnama != "")
		{
			$this->db->or_like('nama_dosen',$fillnama);
		} 
		
		return parent::count_all();

	}
	public function GetcountMahasiswaBimbingan($tahun_masuk="",$fakultas = "",$prodi = "",$status = "")
	{
		if (empty($this->selects))
		{
			$this->select('nip_promotor,nama_dosen,nidn,count(nip_promotor) as jumlahmahasiswa');
		}
		if ($tahun_masuk != "")
		{
			$this->db->where("mastermahasiswa.tahun_masuk",$tahun_masuk);
		}
		if ($status != "")
		{
			$this->db->where("mastermahasiswa.status_mahasiswa",$status);
		}
		if ($fakultas != "")
		{
			$this->db->where("mastermahasiswa.kode_fakultas",$fakultas);
		}
		if ($prodi != "")
		{
			$this->db->where("mastermahasiswa.kode_prodi",$prodi);
		}
		$this->db->join('mastermahasiswa', 'masterdosen.id = mastermahasiswa.nip_promotor', 'inner');  
		$this->db->group_by('nip_promotor');
		return parent::find_all();

	}
	
	
	
	
}
