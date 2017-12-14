<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kuesioner_jawaban_model extends BF_Model {

	protected $table_name	= "kuesioner_jawaban";
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
			"field"		=> "kuesioner_kode",
			"label"		=> "Kode",
			"rules"		=> "required|unique[simak_kuesioner.kode,simak_kuesioner.id]|max_length[5]"
		),
		array(
			"field"		=> "kuesioner_pertanyaan",
			"label"		=> "Pertanyaan",
			"rules"		=> "required|max_length[255]"
		),
	);
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= true;

	//--------------------------------------------------------------------
	public function find_all($kode = "",$nim = "")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		if ($kode != "")
		{
			$this->db->where('kode_jadwal',$kode);
		}
		if ($nim != "")
		{
			$this->db->where('nim',$nim);
		} 
		return parent::find_all();

	}
	public function find_result($kode = "")
	{
		if (empty($this->selects))
		{
			$this->select('kode_soal,avg(jawaban) as ratarata');
		}
		if ($kode != "")
		{
			$this->db->where('kode_jadwal',$kode);
		}
		$this->db->where('kode_soal != "srn"');
		$this->db->group_by('kode_soal');
		return parent::find_all();

	}
	public function find_saran($kode = "")
	{
		if (empty($this->selects))
		{
			$this->select('kode_soal,saran');
		}
		if ($kode != "")
		{
			$this->db->where('kode_jadwal',$kode);
		}
		$this->db->where('kode_soal = "srn"');
		return parent::find_all();

	}
	public function find_group($nim = "")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.kode_jadwal,count(*) as jumlah');
		}
		$this->db->where('jawaban != 0');
		$this->db->where("jawaban != ''");
		$this->db->where('nim',$nim); 
		//$this->db->group_by("nim");
		$this->db->group_by("kode_jadwal");
		return parent::find_all();

	}
	public function find_avgdosen($dosen = "")
	{
		if (empty($this->selects))
		{
			$this->select('avg(jawaban) as ratarata');
		}
		if ($dosen != "")
		{
			$this->db->where('kode_dosen',$dosen);
		}
		$this->db->join('jadwal', 'jadwal.id = kuesioner_jawaban.kode_jadwal', 'inner'); 

		$this->db->where('kode_soal != "srn"');
		$this->db->group_by('kode_dosen');
		return parent::find_all();

	}
	public function find_avgprodi($tahun = "")
	{
		if (empty($this->selects))
		{
			$this->select('nama_prodi,prodi,avg(jawaban) as ratarata');
		}
		if ($tahun != "")
		{
			$this->db->where('tahun_akademik',$tahun);
		}
		$this->db->join('jadwal', 'jadwal.id = kuesioner_jawaban.kode_jadwal', 'inner'); 
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = jadwal.prodi', 'inner'); 
		$this->db->where('kode_soal != "srn"');
		$this->db->group_by('prodi');
		return parent::find_all();

	}
}
