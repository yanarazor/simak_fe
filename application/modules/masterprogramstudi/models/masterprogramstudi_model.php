<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Masterprogramstudi_model extends BF_Model {

	protected $table_name	= "masterprogramstudi";
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
			"field"		=> "masterprogramstudi_kode_fakultas",
			"label"		=> "Kode Fakultas",
			"rules"		=> "required|max_length[5]"
		),
		array(
			"field"		=> "masterprogramstudi_kode_prodi",
			"label"		=> "Kode Program Studi",
			"rules"		=> "required|max_length[15]"
		),
		array(
			"field"		=> "masterprogramstudi_kode_jenjang_studi",
			"label"		=> "Kode Jenjang Studi",
			"rules"		=> "required|max_length[5]"
		),
		array(
			"field"		=> "masterprogramstudi_nama_prodi",
			"label"		=> "Nama Program Studi",
			"rules"		=> "required|max_length[50]"
		),
		array(
			"field"		=> "masterprogramstudi_semester_awal",
			"label"		=> "Semester Awal",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "masterprogramstudi_no_sk_dikti",
			"label"		=> "No SK DIKTI",
			"rules"		=> "max_length[50]"
		),
		array(
			"field"		=> "masterprogramstudi_tgl_sk_dikti",
			"label"		=> "Tanggal SK DIKTI",
			"rules"		=> ""
		),
		array(
			"field"		=> "masterprogramstudi_tgl_akhir_sk_dikti",
			"label"		=> "Tanggal Akhir SK DIKTI",
			"rules"		=> ""
		),
		array(
			"field"		=> "masterprogramstudi_jml_sks_lulus",
			"label"		=> "Jumlah SKS Lulus",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "masterprogramstudi_kode_status",
			"label"		=> "Kode Status",
			"rules"		=> ""
		),
		array(
			"field"		=> "masterprogramstudi_tahun_semester_mulai",
			"label"		=> "Tahun Semester Mulai",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "masterprogramstudi_email_prodi",
			"label"		=> "E-Mail Program Studi",
			"rules"		=> "max_length[50]"
		),
		array(
			"field"		=> "masterprogramstudi_tgl_pendirian_program_studi",
			"label"		=> "Tanggal Pendirian Progran Studi",
			"rules"		=> ""
		),
		array(
			"field"		=> "masterprogramstudi_no_sk_akreditasi",
			"label"		=> "No SK Akreditasi",
			"rules"		=> "max_length[25]"
		),
		array(
			"field"		=> "masterprogramstudi_tgl_sk_akreditasi",
			"label"		=> "Tanggal SK Akeditasi",
			"rules"		=> ""
		),
		array(
			"field"		=> "masterprogramstudi_tgl_akhir_sk_akreditasi",
			"label"		=> "Tanggal Akhir SK Akreditasi",
			"rules"		=> ""
		),
		array(
			"field"		=> "masterprogramstudi_kode_status_akreditasi",
			"label"		=> "Kode Status Akreditasi",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "masterprogramstudi_frekuensi_kurikulum",
			"label"		=> "Frekuensi Pemuktahiran Kurikulum",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "masterprogramstudi_pelaksanaan_kurikulum",
			"label"		=> "Pelaksanaan Frekuensi Pemuktahiran Kurikulum",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "masterprogramstudi_nidn_ketua_prodi",
			"label"		=> "NIDN Ketua Program Studi",
			"rules"		=> "max_length[25]"
		),
		array(
			"field"		=> "masterprogramstudi_telp_ketua_prodi",
			"label"		=> "Telepon Ketua Progra Studi",
			"rules"		=> "max_length[25]"
		),
		array(
			"field"		=> "masterprogramstudi_fax_prodi",
			"label"		=> "Fax Program Studi",
			"rules"		=> "max_length[25]"
		),
		array(
			"field"		=> "masterprogramstudi_nama_operator",
			"label"		=> "Nama Operator",
			"rules"		=> "max_length[50]"
		),
		array(
			"field"		=> "masterprogramstudi_hp_operator",
			"label"		=> "Handphone Operator",
			"rules"		=> "max_length[25]"
		),
		array(
			"field"		=> "masterprogramstudi_telepon_program_studi",
			"label"		=> "Telepon Program Studi",
			"rules"		=> "max_length[25]"
		),
	);
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= FALSE;

	//--------------------------------------------------------------------
	public function find_all($nama="",$fakultas="")
	{
		if (empty($this->selects))
		{
				$this->select($this->table_name .'.*,nama_fakultas');
		}
		
		$this->db->join('masterfakultas', 'masterfakultas.kode_fakultas = masterprogramstudi.kode_fakultas', 'left'); 
		$this->db->order_by('masterfakultas.kode_fakultas desc, kode_prodi asc'); 
		
		if ($nama != "")
		{
			$this->db->or_like('nama_prodi',$nama);
			$this->db->or_like('kode_prodi',$nama);
		}
		if ($fakultas != "")
		{
			$this->db->or_like('masterfakultas.kode_fakultas',$fakultas);
		} 

		
		return parent::find_all();

	}
	public function count_all($nama="",$fakultas="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_fakultas');
		}
		
		$this->db->join('masterfakultas', 'masterfakultas.kode_fakultas = masterprogramstudi.kode_fakultas', 'left'); 
		
		$this->db->order_by('masterfakultas.kode_fakultas desc, kode_prodi asc'); 
		 
		if ($nama != "")
		{
			$this->db->or_like('nama_prodi',$nama);
			$this->db->or_like('kode_prodi',$nama);
		}
		if ($fakultas != "")
		{
			$this->db->or_like('masterfakultas.kode_fakultas',$fakultas);
		} 
		 
		 
		return parent::count_all();

	}
	public function find_detil($kode_prodi="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		 
		if ($kode_prodi != "")
		{
			$this->db->or_like('kode_prodi',$kode_prodi);
		} 
		return parent::find_all();

	}
	public function getbyfakultas($kodefak = "")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		  
		$this->db->or_like('kode_fakultas',$kodefak);
		return parent::find_all();

	}
}
