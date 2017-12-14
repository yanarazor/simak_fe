<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jadwal_model extends BF_Model {

	protected $table_name	= "jadwal";
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
			"field"		=> "jadwal_hari",
			"label"		=> "Hari",
			"rules"		=> "required|max_length[30]"
		),
		array(
			"field"		=> "jadwal_jam",
			"label"		=> "Jam",
			"rules"		=> "required"
		),
		array(
			"field"		=> "jadwal_kode_mk",
			"label"		=> "Mata Kuliah",
			"rules"		=> "required|max_length[20]"
		),
		array(
			"field"		=> "jadwal_kode_dosen",
			"label"		=> "Dosen",
			"rules"		=> "required|max_length[20]"
		),
		array(
			"field"		=> "jadwal_semester",
			"label"		=> "Semester",
			"rules"		=> "required|max_length[5]"
		),
		array(
			"field"		=> "jadwal_kelas",
			"label"		=> "Kelas",
			"rules"		=> "required|max_length[10]"
		),
		array(
			"field"		=> "jadwal_prodi",
			"label"		=> "Prodi",
			"rules"		=> "required|max_length[10]"
		),
	);
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= true;

	//--------------------------------------------------------------------
	public function find_all($mk="",$prodi="",$semester="",$nip="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_dosen,nama_mata_kuliah,nama_prodi,nama_kelas');
		}
		/*
		if ($kelas != "")
		{
			$this->db->where('nim_mhs',$nim);
		}
		if ($nip != "")
		{
			$this->db->where('dosen.id',$nip);
		} 
		*/
		if ($semester != "")
		{
			$this->db->where('jadwal.semester',$semester);
		} 
		
		if ($mk != "")
		{
			$this->db->where('jadwal.kode_mk',$mk);
		}
		if ($prodi != "")
		{
			$this->db->where('prodi',$prodi);
		}
		$this->db->where('jadwal.tahun_akademik like "'.$this->settings_lib->item('site.tahun').'%"');
		
		$this->db->where('simak_mastermatakuliah.tahun_akademik = simak_jadwal.tahun_akademik'); // tambahan supaya tahun akademik diikutsertakan
		//$this->db->where('masterruangan.tahun_akademik = simak_jadwal.tahun_akademik');
		
		$this->db->join('masterdosen', 'masterdosen.nidn = jadwal.kode_dosen', 'left'); 
		$this->db->join('mastermatakuliah', 'mastermatakuliah.kode_mata_kuliah = jadwal.kode_mk', 'left');  
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = jadwal.prodi', 'left');  
		$this->db->join('masterkelas', 'masterkelas.kd_kelas = jadwal.kelas', 'left');  
		//$this->db->join('masterruangan', 'masterruangan.kode_ruangan = jadwal.kd_ruangan', 'left');  
		return parent::find_all();

	}
	public function count_all($mk="",$prodi="",$semester="",$nip="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_dosen,nama_mata_kuliah,nama_prodi');
		}
		/*
		if ($kelas != "")
		{
			$this->db->where('nim_mhs',$nim);
		}
		if ($nip != "")
		{
			$this->db->where('dosen.id',$nip);
		} 
		*/
		if ($semester != "")
		{
			$this->db->where('jadwal.semester',$semester);
		} 
		
		if ($mk != "")
		{
			$this->db->where('kode_mk',$mk);
		}
		if ($prodi != "")
		{
			$this->db->where('prodi',$prodi);
		}
		$this->db->where('jadwal.tahun_akademik like "'.$this->settings_lib->item('site.tahun').'%"');
		
		$this->db->where('simak_mastermatakuliah.tahun_akademik = simak_jadwal.tahun_akademik'); // tambahan supaya tahun akademik diikutsertakan
		$this->db->where('masterruangan.tahun_akademik = simak_jadwal.tahun_akademik');
		$this->db->join('masterdosen', 'masterdosen.nidn = jadwal.kode_dosen', 'left'); 
		$this->db->join('mastermatakuliah', 'mastermatakuliah.kode_mata_kuliah = jadwal.kode_mk', 'left');  
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = jadwal.prodi', 'left');  
		$this->db->join('masterkelas', 'masterkelas.kd_kelas = jadwal.kelas', 'left');  
		$this->db->join('masterruangan', 'masterruangan.kode_ruangan = jadwal.kd_ruangan', 'left');   
		return parent::count_all();

	}
	
	public function find_all_forkrs($mk="",$prodi="",$semester="",$nip="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_dosen,nama_mata_kuliah,nama_kelas,kuota,count(kode_jadwal) as jmlterisi');
		}
		/*
		if ($kelas != "")
		{
			$this->db->where('nim_mhs',$nim);
		}
		if ($nip != "")
		{
			$this->db->where('dosen.id',$nip);
		} 
		*/
		if ($semester != "")
		{
			$this->db->where('jadwal.semester',$semester);
		} 
		
		if ($mk != "")
		{
			$this->db->where('jadwal.kode_mk',$mk);
		}
		if ($prodi != "")
		{
			$this->db->where('prodi',$prodi);
		}
		$this->db->where('jadwal.tahun_akademik like "'.$this->settings_lib->item('site.tahun').'%"');
		
		$this->db->where('simak_mastermatakuliah.tahun_akademik = simak_jadwal.tahun_akademik'); // tambahan supaya tahun akademik diikutsertakan
		//$this->db->where('masterruangan.tahun_akademik = simak_jadwal.tahun_akademik');
		
		$this->db->join('masterdosen', 'masterdosen.nidn = jadwal.kode_dosen', 'left'); 
		$this->db->join('mastermatakuliah', 'mastermatakuliah.kode_mata_kuliah = jadwal.kode_mk', 'left');  
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = jadwal.prodi', 'left');  
		$this->db->join('masterkelas', 'masterkelas.kd_kelas = jadwal.kelas', 'left');  
		//$this->db->join('masterruangan', 'masterruangan.kode_ruangan = jadwal.kd_ruangan', 'left');     
		$this->db->join('datakrs', 'datakrs.kode_jadwal = jadwal.id', 'left');  
		$this->db->group_by("datakrs.id");
		return parent::find_all();

	}

}
