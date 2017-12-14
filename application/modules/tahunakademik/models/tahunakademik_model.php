<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tahunakademik_model extends BF_Model {

	protected $table_name	= "tahunakademik";
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
			"field"		=> "tahunakademik_tahun_id",
			"label"		=> "Tahun Id",
			"rules"		=> "required|unique[simak_tahunakademik.tahun_id,simak_tahunakademik.id]|max_length[5]"
		),
		array(
			"field"		=> "tahunakademik_tahun",
			"label"		=> "Tahun",
			"rules"		=> "required|max_length[4]"
		),
		array(
			"field"		=> "tahunakademik_semester",
			"label"		=> "Semester",
			"rules"		=> "required|max_length[2]"
		),
		array(
			"field"		=> "tahunakademik_nama_tahun",
			"label"		=> "Nama Tahun",
			"rules"		=> "required|unique[simak_tahunakademik.nama_tahun,simak_tahunakademik.id]|max_length[50]"
		),
		array(
			"field"		=> "tahunakademik_krs_mulai",
			"label"		=> "Krs Mulai",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_krs_selesai",
			"label"		=> "Krs Selesai",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_krs_online_mulai",
			"label"		=> "Krs Online Mulai",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_krs_online_selesai",
			"label"		=> "Krs Online Selesai",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_krs_ubah_mulai",
			"label"		=> "Krs Ubah Mulai",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_krs_ubah_selesai",
			"label"		=> "Krs Ubah Selesai",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_kss_cetak_mulai",
			"label"		=> "Kss Cetak Mulai",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_kss_cetak_selesai",
			"label"		=> "Kss Cetak Selesai",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_cuti",
			"label"		=> "Cuti",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_mundur",
			"label"		=> "Mundur",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_bayar_mulai",
			"label"		=> "Bayar Mulai",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_bayar_selesai",
			"label"		=> "Bayar Selesai",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_kuliah_mulai",
			"label"		=> "Kuliah Mulai",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_kuliah_selesai",
			"label"		=> "Kuliah Selesai",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_uts_mulai",
			"label"		=> "Uts Mulai",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_uts_selesai",
			"label"		=> "Uts Selesai",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_uas_mulai",
			"label"		=> "Uas Mulai",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_uas_selesai",
			"label"		=> "Uas Selesai",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_nilai",
			"label"		=> "Nilai",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_akhir_kss",
			"label"		=> "Akhir Kss",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_proses_buka",
			"label"		=> "Proses Buka",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_proses_ipk",
			"label"		=> "Proses Ipk",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_proses_tutup",
			"label"		=> "Proses Tutup",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_buka",
			"label"		=> "Buka",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_syarat_krs",
			"label"		=> "Syarat Krs",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_syarat_krs_ips",
			"label"		=> "Syarat Krs Ips",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_cuti_selesai",
			"label"		=> "Cuti Selesai",
			"rules"		=> ""
		),
		array(
			"field"		=> "tahunakademik_max_sks",
			"label"		=> "Max Sks",
			"rules"		=> "max_length[10]"
		),
	);
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= true;

	//--------------------------------------------------------------------
	public function find_all($tahun = "")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		if($tahun != ""){
			$this->db->where('tahun_id',$tahun);
		}
		$this->db->order_by("tahun_id","asc");
		return parent::find_all();

	} 
	public function getaktif()
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		$this->db->where('buka',"Y");
		$this->db->order_by("tahun_id","asc");
		return parent::find_all();

	} 
	
}
