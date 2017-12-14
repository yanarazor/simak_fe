<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Khs_model extends BF_Model {

	protected $table_name	= "khs";
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
			"field"		=> "khs_nim",
			"label"		=> "Nim",
			"rules"		=> "max_length[25]"
		),
		array(
			"field"		=> "khs_tahun_ajaran",
			"label"		=> "Tahun",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "khs_semester",
			"label"		=> "Semester",
			"rules"		=> "max_length[2]"
		),
		array(
			"field"		=> "khs_jml_sks",
			"label"		=> "SKS",
			"rules"		=> "max_length[3]"
		),
		array(
			"field"		=> "khs_ipk",
			"label"		=> "IPK",
			"rules"		=> "max_length[10]"
		),
	);
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= true;

	//--------------------------------------------------------------------
	public function find_all($tahun = "",$filfakultas = "",$filljurusan = "",$mhs="",$status = "",$angkatan = "")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_mahasiswa,tahun_ajaran,nama_prodi');
		}
		if($tahun!=""){
			$this->db->where('tahun_ajaran',$tahun);
		}
		if($filljurusan!=""){
			$this->db->where('mastermahasiswa.kode_prodi',$filljurusan);
		}
		if($filfakultas!=""){
			$this->db->where('mastermahasiswa.kode_fakultas',$filfakultas);
		}
		if($status!=""){
			$this->db->where('mastermahasiswa.status_mahasiswa',$status);
		}
		if($mhs!=""){
			$this->db->where('nim',$mhs);
		}
		if($angkatan!=""){
			$this->db->where('mastermahasiswa.nim_mhs like "'.$angkatan.'%"');
		}
		if($status!=""){
			$this->db->where('mastermahasiswa.status_mahasiswa',$status);
		}
		
		if($angkatan!=""){
			$this->db->where('mastermahasiswa.nim_mhs like "'.$angkatan.'%"');
		}
		$this->db->join('mastermahasiswa', 'mastermahasiswa.nim_mhs = khs.nim', 'inner');
		//$this->db->join('masterfakultas', 'masterfakultas.id = mastermahasiswa.kode_fakultas', 'left'); 
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = mastermahasiswa.kode_prodi', 'left');  
		$this->db->order_by('ipk',"desc");  
		$this->db->order_by('ipkk',"desc");  
		return parent::find_all();
	}
}
