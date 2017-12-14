<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Datakrs_model extends BF_Model {

	protected $table_name	= "datakrs";
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
			"field"		=> "datakrs_kode_mk",
			"label"		=> "Mata Kuliah",
			"rules"		=> "required|max_length[20]"
		),
		array(
			"field"		=> "datakrs_sks",
			"label"		=> "Sks",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "datakrs_mahasiswa",
			"label"		=> "Mahasiswa",
			"rules"		=> "required|max_length[20]"
		),
		array(
			"field"		=> "datakrs_kode_dosen",
			"label"		=> "Dosen",
			"rules"		=> "required|max_length[20]"
		),
		array(
			"field"		=> "datakrs_semester",
			"label"		=> "Semester",
			"rules"		=> "required|max_length[10]"
		),
		array(
			"field"		=> "datakrs_kode_jadwal",
			"label"		=> "Jadwal",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "datakrs_nilai_angka",
			"label"		=> "Nilai Angka",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "datakrs_nilai_huruf",
			"label"		=> "Nilai Huruf",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "datakrs_created_date",
			"label"		=> "Tanggal Input",
			"rules"		=> ""
		),
	);
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= TRUE;

	//--------------------------------------------------------------------
	public function rekap($sms="",$mhs="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.semester,sum(sks) as jml_sks,sum(nilai_angka) as ipk');
		}
		if($sms!=""){
			$this->db->where('datakrs.semester',(int)$sms);
		}
		$this->db->where('datakrs.mahasiswa',$mhs);
		// end session 
		//$this->db->join('masterdosen', 'masterdosen.id = datakrs.kode_dosen', 'left');
		$this->db->group_by('semester');  
		return parent::find_all();
	}
	public function get_data($ta="",$mhs="",$id="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.semester,mahasiswa,id');
		}
		if($mhs!=""){
			$this->db->where('datakrs.mahasiswa',$mhs);
		}
		$this->db->where('tahun_akademik',$ta);
		$this->db->where('id >= '.$id.'');
		//$this->db->group_by('semester');  
		return parent::find_all();
	}
	public function rekap_count($sms="",$mhs="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.semester,sum(sks) as jml_sks,sum(nilai_angka) as ipk');
		}
		if($sms!=""){
			$this->db->where('datakrs.semester',(int)$sms);
		}
		 
		$this->db->where('datakrs.mahasiswa',$mhs);
		//$this->db->group_by('semester,mahasiswa'); 
		// end session 
		
		//$this->db->join('masterdosen', 'masterdosen.id = datakrs.kode_dosen', 'left');
		 
		return parent::count_all();
	}
	//rekap admin
	public function rekapadm($sms="",$mhs="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.semester,sum(sks) as jml_sks,sum(nilai_angka) as ipk,mahasiswa,nama_mahasiswa');
		}
		//$this->db->join('mastermatakuliah mm', 'mm.kode_mata_kuliah=datakrs.kode_mk', 'left');
		if($sms!=""){
			$this->db->where('datakrs.semester',(int)$sms);
		}
		if($mhs!=""){
			$this->db->like('datakrs.mahasiswa',$mhs);
		}
		//$this->db->where('mm.tahun_akademik = simak_datakrs.tahun_akademik'); // tambahan supaya tahun akademik diikutsertakan
		//$this->db->where('mastermahasiswa.kode_prodi = mm.kode_prodi');
		 // end session 
		$this->db->join('mastermahasiswa', 'mastermahasiswa.nim_mhs = datakrs.mahasiswa', 'inner');
		$this->db->group_by('semester,mahasiswa');  
		return parent::find_all();
	}
	public function count_rekapadm($sms="",$mhs="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.semester,count(sks) as jml_sks,sum(nilai_angka) as ipk,mahasiswa');
		}
		if($sms!=""){
			$this->db->where('datakrs.semester',(int)$sms);
		}
		if($mhs!=""){
			$this->db->like('datakrs.mahasiswa',$mhs);
		}
		 // end session 
		//$this->db->join('masterdosen', 'masterdosen.id = datakrs.kode_dosen', 'left');
		//$this->db->distinct('semestera,mahasiswa');  
		$this->db->group_by('semester,mahasiswa');  
		return parent::count_all();
	}
	# end rekap untuk admin
	public function findbytahun_ajaran($tahun_ajaran="",$mhs="")
	{
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.semester,sum(sks) as jml_sks,sum(nilai_angka) as ipk,mahasiswa,nama_mahasiswa');
		}
		if($tahun_ajaran!=""){
			$this->db->where('datakrs.tahun_akademik',$tahun_ajaran);
		}
		if($mhs!=""){
			$this->db->like('datakrs.mahasiswa',$mhs);
		}
		$this->db->join('mastermahasiswa', 'mastermahasiswa.nim_mhs = datakrs.mahasiswa', 'inner');
		$this->db->group_by('semester,mahasiswa');  
		return parent::find_all();
	}
	public function find($id)
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*,kode_mk,nama_mk,nama_dosen,nim_mhs,nama_mahasiswa');
		}
		//$this->db->join('mastermatakuliah mm', 'mm.kode_mata_kuliah=datakrs.kode_mk', 'left');
		 
		//$this->db->where('mm.tahun_akademik = simak_datakrs.tahun_akademik'); // tambahan supaya tahun akademik diikutsertakan
		//$this->db->where('simak_mastermahasiswa.kode_prodi = mm.kode_prodi');
		 
		 
		$this->db->join('mastermahasiswa', 'mastermahasiswa.nim_mhs = datakrs.mahasiswa', 'left');
		$this->db->join('masterdosen', 'masterdosen.nidn = datakrs.kode_dosen', 'left');
		$this->db->order_by("datakrs.semester","asc");
		$this->db->distinct();
		  
		return parent::find($id);
	}
	public function find_all($sms="",$kode_mk="",$mhs="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*,kode_mk,nama_mk,nama_dosen,nim_mhs,nama_mahasiswa');
		}
		//$this->db->join('mastermatakuliah mm', 'mm.kode_mata_kuliah=datakrs.kode_mk', 'left');
		if($sms!=""){
			$this->db->where('datakrs.semester',(int)$sms);
		}
		if($kode_mk!=""){
			$this->db->where('datakrs.kode_mk',$kode_mk);
		}
		if($mhs!=""){
			$this->db->where('datakrs.mahasiswa',$mhs);
		}
		//$this->db->where('mm.tahun_akademik = simak_datakrs.tahun_akademik'); // tambahan supaya tahun akademik diikutsertakan
		//$this->db->where('simak_mastermahasiswa.kode_prodi = mm.kode_prodi');
		 
		 
		$this->db->join('mastermahasiswa', 'mastermahasiswa.nim_mhs = datakrs.mahasiswa', 'left');
		$this->db->join('masterdosen', 'masterdosen.nidn = datakrs.kode_dosen', 'left');
		$this->db->order_by("datakrs.semester","asc");
		$this->db->distinct();
		  
		return parent::find_all();
	}
	
	public function count_all($sms="",$kode_mk="",$mhs="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_mk,nama_dosen,namadosen');
		}
		//$this->db->join('mastermatakuliah mm', 'mm.kode_mata_kuliah=datakrs.kode_mk', 'left');
		if($sms!=""){
			$this->db->where('datakrs.semester',(int)$sms);
		}
		if($kode_mk!=""){
			$this->db->where('datakrs.kode_mk',$kode_mk);
		}
		if($mhs!=""){
			$this->db->where('datakrs.mahasiswa like "%'.$mhs.'%"');
		}
		//$this->db->where('mm.tahun_akademik = simak_datakrs.tahun_akademik'); // tambahan supaya tahun akademik diikutsertakan
		//$this->db->where('simak_mastermahasiswa.kode_prodi = mm.kode_prodi');
		 
		//jika login selain admin
		//if($this->CI->auth->role_id() =="7"){
			//$this->db->where('mahasiswa',$this->CI->auth->get_provinsi());
			//$this->db->where('infrastruktur_pelaksanaan_fisik.TahunAnggaran',$this->CI->auth->get_tahun());
			//die("masuk");
		//}
		 
		// end session 
		$this->db->join('mastermahasiswa', 'mastermahasiswa.nim_mhs = datakrs.mahasiswa', 'left');
		$this->db->join('masterdosen', 'masterdosen.nidn = datakrs.kode_dosen', 'left');
		  
		return parent::count_all();
	}
	public function count_nilaiisi($mhs="",$dosen="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		 
		if($mhs!=""){
			$this->db->where('datakrs.mahasiswa like "'.$mhs.'"');
		}
		$this->db->where('((nilai_angka != "" or nilai_angka is not null) or (nilai_huruf != "" or nilai_huruf is not null))');
		//$this->db->where('(nilai_hurup != "" or nilai_hurup is not null)');
		return parent::count_all();
	}
	public function count_nilaiblm($mhs="",$dosen="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		 
		 
		$this->db->where('datakrs.mahasiswa',$mhs);
		 
		$this->db->where('((nilai_huruf = "" or nilai_huruf is null))');
		return parent::count_all();
	}
	public function count_jadwal_mhs($mhs="",$dosen="",$sms="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		  
		$this->db->where('datakrs.mahasiswa',$mhs);
		 
		$this->db->where('(kode_jadwal != "" and kode_jadwal is not null)');
		return parent::count_all();
	}
	public function isuniq_mhs($sms="",$kode_mk="",$mhs="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		$this->db->join('mastermatakuliah', 'mastermatakuliah.kode_mata_kuliah=datakrs.kode_mk', 'left');
		 
			$this->db->where('datakrs.semester',(int)$sms);
		 
		 
			$this->db->where('datakrs.kode_mk',$kode_mk);
		 
		 
			$this->db->where('datakrs.mahasiswa',$mhs); 
		
		   
		return parent::count_all();
	}
	public function cekuniq($nim="",$mk="",$sms)
	{
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		$this->db->where('mahasiswa',$nim);
		$this->db->where('kode_mk',$mk);
		$this->db->where('semester',$sms);
		return parent::count_all()>0;
	}
	public function isuniq($nim="",$mk="",$sms)
	{
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		$this->db->where('mahasiswa',$nim);
		$this->db->where('kode_mk',$mk);
		$this->db->where('semester',$sms);
		return parent::find_all();
	}
	// untuk dosen
	public function find_all_fromdosen($sms="",$kode_mk="",$mhs="",$dosen="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_mk,nim_mhs,nama_mahasiswa');
		}
		//$this->db->join('mastermatakuliah mm', 'mm.kode_mata_kuliah=datakrs.kode_mk', 'left');
		if($sms!=""){
			$this->db->where('datakrs.semester',(int)$sms);
		}
		if($kode_mk!=""){
			$this->db->where('datakrs.kode_mk',$kode_mk);
		}
		if($mhs!=""){
			$this->db->where('mastermahasiswa.nim_mhs like "%'.$mhs.'%"');
			//$this->db->or_where('mastermahasiswa.nama_mahasiswa like "%'.$mhs.'%"');
		}
		
			$this->db->where('datakrs.kode_dosen',$dosen);
		
		//$this->db->where('mm.tahun_akademik = simak_datakrs.tahun_akademik'); // tambahan supaya tahun akademik diikutsertakan
		//$this->db->where('mastermahasiswa.kode_prodi = mm.kode_prodi');
		 
		//jika login selain admin
		//if($this->CI->auth->role_id() =="7"){
			//$this->db->where('mahasiswa',$this->CI->auth->get_provinsi());
			//$this->db->where('infrastruktur_pelaksanaan_fisik.TahunAnggaran',$this->CI->auth->get_tahun());
			//die("masuk");
		//}
		 
		// end session 
		 
		$this->db->join('mastermahasiswa', 'mastermahasiswa.nim_mhs = datakrs.mahasiswa', 'left');
		$this->db->join('masterdosen', 'masterdosen.nidn = datakrs.kode_dosen', 'left');
		 
		return parent::find_all();
	}
	public function count_all_fromdosen($sms="",$kode_mk="",$mhs="",$dosen="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_mata_kuliah,nama_dosen');
		}
		//$this->db->join('mastermatakuliah mm', 'mm.kode_mata_kuliah=datakrs.kode_mk', 'left');
		if($sms!=""){
			$this->db->where('datakrs.semester',(int)$sms);
		}
		if($kode_mk!=""){
			$this->db->where('datakrs.kode_mk',$kode_mk);
		}
		if($mhs!=""){
			$this->db->where('datakrs.mahasiswa',$mhs);
		}
		
		$this->db->where('datakrs.kode_dosen',$dosen);
		//$this->db->where('mm.tahun_akademik = simak_datakrs.tahun_akademik'); // tambahan supaya tahun akademik diikutsertakan
		//$this->db->where('mastermahasiswa.kode_prodi = mm.kode_prodi');
		 
		//jika login selain admin
		//if($this->CI->auth->role_id() =="7"){
			//$this->db->where('mahasiswa',$this->CI->auth->get_provinsi());
			//$this->db->where('infrastruktur_pelaksanaan_fisik.TahunAnggaran',$this->CI->auth->get_tahun());
			//die("masuk");
		//}
		 
		// end session 
		$this->db->join('mastermahasiswa', 'mastermahasiswa.nim_mhs = datakrs.mahasiswa', 'left');
		$this->db->join('masterdosen', 'masterdosen.id = datakrs.kode_dosen', 'left');
		  
		return parent::count_all();
	}
	public function find_nilai($sms="",$kode_mk="",$mhs="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*,kode_mk,nama_dosen,namadosen,nim_mhs,nama_mahasiswa,nama_mk');
		}
		
		if($sms!=""){
			$this->db->where('datakrs.semester',(int)$sms);
		}
		if($kode_mk!=""){
			$this->db->where('datakrs.kode_mk',$kode_mk);
		}
		if($mhs!=""){
			$this->db->where('datakrs.mahasiswa',$mhs);
		}
		//$this->db->join('mastermatakuliah mm', 'mm.kode_mata_kuliah=datakrs.kode_mk', 'left');
		//$this->db->where('mm.tahun_akademik = simak_datakrs.tahun_akademik'); // tambahan supaya tahun akademik diikutsertakan
		//$this->db->where('mastermahasiswa.kode_prodi = mm.kode_prodi');
		 
		$this->db->join('mastermahasiswa', 'mastermahasiswa.nim_mhs = datakrs.mahasiswa', 'left');
		$this->db->join('masterdosen', 'masterdosen.nidn = datakrs.kode_dosen', 'left');
		$this->db->distinct();
		  
		return parent::find_all();
	}
	public function count_nilai($sms="",$kode_mk="",$mhs="")
	{
		
		if(empty($this->selects))
		{
			$this->select('distinct.kode_mk');
		}
		
		if($sms!=""){
			$this->db->where('datakrs.semester',$sms."");
		}
		if($kode_mk!=""){
			$this->db->where('datakrs.kode_mk',$kode_mk);
		}
		if($mhs!=""){
			$this->db->where('datakrs.mahasiswa',$mhs);
		}
		//$this->db->where('mastermahasiswa.kode_prodi = mm.kode_prodi');
		 
		$this->db->join('mastermahasiswa', 'mastermahasiswa.nim_mhs = datakrs.mahasiswa', 'left');
		$this->db->join('masterdosen', 'masterdosen.nidn = datakrs.kode_dosen', 'left');
		  
		return parent::count_all();
	}
	public function find_krs($sms="",$kode_mk="",$mhs="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*,kode_mk,nama_mk,nama_dosen,namadosen,nim_mhs,nama_mahasiswa');
		}
		//$this->db->join('mastermatakuliah mm', 'mm.kode_mata_kuliah=datakrs.kode_mk', 'left');
		//die($sms." ini");
		//if($sms!=""){
			$this->db->where('datakrs.semester',(int)$sms."");
		//}
		if($kode_mk!=""){
			$this->db->where('datakrs.kode_mk',$kode_mk);
		}
		if($mhs!=""){
			$this->db->where('datakrs.mahasiswa',$mhs);
		}
		//$this->db->where('mm.tahun_akademik = simak_datakrs.tahun_akademik'); // tambahan supaya tahun akademik diikutsertakan
		//$this->db->where('simak_mastermahasiswa.kode_prodi = mm.kode_prodi');
		 
		$this->db->join('mastermahasiswa', 'mastermahasiswa.nim_mhs = datakrs.mahasiswa', 'left');
		$this->db->join('masterdosen', 'masterdosen.nidn = datakrs.kode_dosen', 'left');
		$this->db->order_by("datakrs.semester","asc");
		$this->db->distinct();
		  
		return parent::find_all();
	}
	public function find_ips($sms="",$mhs="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*,kode_mk');
		}
		$this->db->where('datakrs.semester',(int)$sms."");
		$this->db->where('datakrs.mahasiswa',$mhs);
		 
		$this->db->order_by("datakrs.semester","asc");
		$this->db->distinct();
		  
		return parent::find_all();
	}
	public function find_distinct($sms="",$kode_mk="",$mhs="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*,kode_mk,nama_mk,namadosen,nama_dosen,nim_mhs,nama_mahasiswa');
		}
		//$this->db->join('mastermatakuliah mm', 'mm.kode_mata_kuliah=datakrs.kode_mk', 'left');
		if($sms!=""){
			$this->db->where('datakrs.semester',(int)$sms);
		}
		if($kode_mk!=""){
			$this->db->where('datakrs.kode_mk',$kode_mk);
		}
		//if($mhs!=""){
			$this->db->where('datakrs.mahasiswa',$mhs);
		//}
		
		//$this->db->where('mm.tahun_akademik = simak_datakrs.tahun_akademik'); // tambahan supaya tahun akademik diikutsertakan
		//$this->db->where('simak_mastermahasiswa.kode_prodi = mm.kode_prodi');
		$this->db->join('mastermahasiswa', 'mastermahasiswa.nim_mhs = datakrs.mahasiswa', 'left');
		$this->db->join('masterdosen', 'masterdosen.nidn = datakrs.kode_dosen', 'left');
		$this->db->order_by("datakrs.semester","asc");
		$this->db->distinct();
		  
		return parent::find_all();
	}
	public function find_bysenester($sms="",$mhs="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*,datakrs.kode_mk,nama_mk,namadosen,nama_dosen,nim_mhs,nama_mahasiswa');
		}
		//$this->db->join('mastermatakuliah mm', 'mm.kode_mata_kuliah=datakrs.kode_mk', 'left');
		if($sms!=""){
			$this->db->where('datakrs.semester',(int)$sms);
		}
		$this->db->where('datakrs.mahasiswa',$mhs);
		
		//$this->db->where('mm.tahun_akademik = simak_datakrs.tahun_akademik'); // tambahan supaya tahun akademik diikutsertakan
		//$this->db->where('simak_mastermahasiswa.kode_prodi = mm.kode_prodi');
		$this->db->join('mastermahasiswa', 'mastermahasiswa.nim_mhs = datakrs.mahasiswa', 'left');
		$this->db->join('jadwal', 'datakrs.kode_jadwal = jadwal.id', 'left');
		$this->db->join('masterdosen', 'masterdosen.id = jadwal.kode_dosen', 'left');
		$this->db->order_by("datakrs.semester","asc");
		$this->db->distinct();
		  
		return parent::find_all();
	}
	public function find_mkdiambil($sms="",$kode_mk="",$mhs="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*,kode_mk,nama_mk,namadosen,nama_dosen,nim_mhs,nama_mahasiswa');
		}
		//$this->db->join('mastermatakuliah mm', 'mm.kode_mata_kuliah=datakrs.kode_mk', 'left');
		if($sms!=""){
			$this->db->where('datakrs.semester',(int)$sms);
		}
		if($kode_mk!=""){
			$this->db->where('datakrs.kode_mk',$kode_mk);
		}
		//if($mhs!=""){
			$this->db->where('datakrs.mahasiswa',$mhs);
		//}
		
		//$this->db->where('mm.tahun_akademik = simak_datakrs.tahun_akademik'); // tambahan supaya tahun akademik diikutsertakan
		//$this->db->where('simak_mastermahasiswa.kode_prodi = mm.kode_prodi');
		$this->db->join('mastermahasiswa', 'mastermahasiswa.nim_mhs = datakrs.mahasiswa', 'left');
		$this->db->join('masterdosen', 'masterdosen.nidn = datakrs.kode_dosen', 'left');
		$this->db->order_by("datakrs.semester","asc");
		//$this->db->group_by("datakrs.kode_mk");   
		return parent::find_all();
	}
	public function distinct_mk_kelas($kelas="",$kode_mk="")
	{
		
		if(empty($this->selects))
		{
			$this->select('kode_mk,nama_mk,kelas');
		}
		//$this->db->join('mastermatakuliah mm', 'mm.kode_mata_kuliah=datakrs.kode_mk', 'left');
		 
		if($kode_mk!=""){
			$this->db->where('datakrs.kode_mk',$kode_mk);
		}
		if($kelas!=""){
			$this->db->where('datakrs.kelas',$kelas);
		}
		
		//$this->db->where('mm.tahun_akademik = simak_datakrs.tahun_akademik'); // tambahan supaya tahun akademik diikutsertakan
		$this->db->join('mastermahasiswa', 'mastermahasiswa.nim_mhs = datakrs.mahasiswa', 'left');
		$this->db->group_by("datakrs.kode_mk","datakrs.kelas");
		$this->db->distinct();
		  
		return parent::find_all();
	}
	public function find_absen($ta="",$jurusan="",$kode_mk="",$dosen="",$sms="",$kelas="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*,kode_mk,nama_mk,nama_dosen,nim_mhs,nama_mahasiswa');
		}
		//$this->db->join('mastermatakuliah mm', 'mm.kode_mata_kuliah=datakrs.kode_mk', 'left');
		if($jurusan != ""){
			$this->db->where('mastermahasiswa.kode_prodi',$jurusan);
		}
		if($kode_mk != ""){
			$this->db->where('datakrs.kode_mk',$kode_mk);
		}
		if($dosen != ""){
			$this->db->where('datakrs.dosen',$dosen);
		}
		if($sms!=""){
			$this->db->where('datakrs.semester',(int)$sms);
		} 
		 
		$this->db->where('datakrs.kelas',$kelas);
		$this->db->where('datakrs.tahun_akademik',$ta);
		
		//$this->db->where('datakrs.tahun_akademik like "'.$this->settings_lib->item('site.tahun').'%"');
		//$this->db->where('mm.tahun_akademik = simak_datakrs.tahun_akademik'); // tambahan supaya tahun akademik diikutsertakan
		//$this->db->where('mastermahasiswa.kode_prodi = mm.kode_prodi');
		 
		 
		$this->db->join('mastermahasiswa', 'mastermahasiswa.nim_mhs = datakrs.mahasiswa', 'left');
		$this->db->join('masterdosen', 'masterdosen.nidn = datakrs.kode_dosen', 'left');
		$this->db->order_by("datakrs.semester","asc");
		$this->db->distinct();
		  
		return parent::find_all();
	}
	public function getsemesterterakhir($mhs="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.semester');
		}
		$this->db->where('datakrs.mahasiswa',$mhs);
		
		$this->db->order_by("datakrs.semester","desc");
		$this->db->group_by("datakrs.semester");
		$this->db->limit(1);   
		return parent::find_all();
	}
	public function Getjmlmahasiswaaktif()
	{
		
		if(empty($this->selects))
		{
			$this->select('count(distinct mahasiswa) as jumlah,tahun_akademik');
		}
		$this->db->where('datakrs.tahun_akademik',$this->settings_lib->item('site.tahun'));
		$this->db->group_by("datakrs.tahun_akademik");
		return parent::find_all();
	}
	public function Getjmlgakadanilai()
	{
		
		if(empty($this->selects))
		{
			$this->select('tahun_akademik');
		}
		$this->db->where("datakrs.tahun_akademik = '".$this->settings_lib->item('site.tahun')."' and (nilai_huruf = '' or nilai_huruf is NULL or nilai_huruf = '-')");
		return parent::count_all();
	}
}
