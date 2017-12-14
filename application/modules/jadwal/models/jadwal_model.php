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
	public function find_all($mk="",$prodi="",$semester="",$nip="",$ta="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_dosen,nama_mata_kuliah,nama_prodi,sks');
		}
		if ($semester != "")
		{
			$this->db->where('jadwal.semester',$semester);
		} 
		
		if ($mk != "")
		{
			$this->db->where('jadwal.kode_mk',$mk);
		}
		if ($ta != "")
		{
			$this->db->where('jadwal.tahun_akademik',$ta);
		}else{
			$this->db->where('jadwal.tahun_akademik like "'.$this->settings_lib->item('site.tahun').'%"');
		}
		if ($prodi != "")
		{
			$this->db->where('prodi',$prodi);
		}
		//$this->db->where('status_mata_kuliah',"A");
		//$this->db->where('simak_mastermatakuliah.tahun_akademik = simak_jadwal.tahun_akademik'); // tambahan supaya tahun akademik diikutsertakan
		$this->db->where('simak_mastermatakuliah.kode_prodi = simak_jadwal.prodi');
		$this->db->join('masterdosen', 'masterdosen.id = jadwal.kode_dosen', 'left'); 
		$this->db->join('mastermatakuliah', 'mastermatakuliah.kode_mata_kuliah = jadwal.kode_mk', 'left');  
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = jadwal.prodi', 'left');  
		return parent::find_all();

	}
	public function count_all($mk="",$prodi="",$semester="",$nip="",$ta="")
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
		if ($ta != "")
		{
			$this->db->where('jadwal.tahun_akademik',$ta);
		}else{
			$this->db->where('jadwal.tahun_akademik like "'.$this->settings_lib->item('site.tahun').'%"');
		}
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
		$this->db->where('status_mata_kuliah',"A");
		$this->db->where('jadwal.tahun_akademik like "'.$this->settings_lib->item('site.tahun').'%"');
		
		//$this->db->where('simak_mastermatakuliah.tahun_akademik = simak_jadwal.tahun_akademik'); // tambahan supaya tahun akademik diikutsertakan
		$this->db->where('simak_mastermatakuliah.kode_prodi = simak_jadwal.prodi');
		
		$this->db->join('masterdosen', 'masterdosen.id = jadwal.kode_dosen', 'left'); 
		$this->db->join('mastermatakuliah', 'mastermatakuliah.kode_mata_kuliah = jadwal.kode_mk', 'left');  
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = jadwal.prodi', 'left');  
		$this->db->join('masterkelas', 'masterkelas.kd_kelas = jadwal.kelas', 'left');  
		
		return parent::count_all();

	}
	
	public function find_all_forkrs($mk="",$prodi="",$semester="",$nip="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_dosen,nama_mata_kuliah,kuota_kelas as kuota');
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
			$this->db->where('jadwal.semester',(int)$semester);
		} 
		
		if ($mk != "")
		{
			$this->db->where('jadwal.kode_mk',$mk);
		}
		if ($prodi != "")
		{
			$this->db->where('prodi',$prodi);
		}
		$this->db->where('status_mata_kuliah',"A");
		$this->db->where('jadwal.tahun_akademik like "'.$this->settings_lib->item('site.tahun').'%"');
		
		//$this->db->where('simak_mastermatakuliah.tahun_akademik = simak_jadwal.tahun_akademik'); // tambahan supaya tahun akademik diikutsertakan
		$this->db->where('simak_mastermatakuliah.kode_prodi = simak_jadwal.prodi');
		$this->db->join('masterdosen', 'masterdosen.id = jadwal.kode_dosen', 'left'); 
		$this->db->join('mastermatakuliah', 'mastermatakuliah.kode_mata_kuliah = jadwal.kode_mk', 'left');  
		//$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = jadwal.prodi', 'left');  
		//$this->db->join('masterkelas', 'masterkelas.kd_kelas = jadwal.kelas', 'left');  
		//$this->db->join('masterruangan', 'masterruangan.kode_ruangan = jadwal.kd_ruangan', 'left');     
		//$this->db->join('datakrs', 'datakrs.kode_jadwal = jadwal.id', 'left');  
		//$this->db->group_by("datakrs.id");
		return parent::find_all();

	}

	public function find_terisi($mk="",$prodi="",$semester="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,count(kode_jadwal) as jmlterisi');
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
		
		 
			$this->db->where('jadwal.kode_mk',$mk);
		 
		if ($prodi != "")
		{
			$this->db->where('prodi',$prodi);
		}
		$this->db->where('jadwal.tahun_akademik like "'.$this->settings_lib->item('site.tahun').'%"');
		//$this->db->where('datakrs.tahun_akademik = simak_jadwal.tahun_akademik'); // tambahan supaya tahun akademik diikutsertakan
		$this->db->join('datakrs', 'datakrs.kode_jadwal = jadwal.id', 'right');  
		$this->db->group_by("simak_jadwal.id");
		return parent::find_all();

	}
	
	public function getkelas($ta="",$mk="",$prodi="",$semester="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.kelas,nama_kelas');
		}
		 
		if ($semester != "")
		{
			$this->db->where('jadwal.semester',$semester);
		} 
		
		if ($mk != "")
		{
			$this->db->where('jadwal.kode_mk',$mk);
		}
		if ($ta != "")
		{
			$this->db->where('jadwal.tahun_akademik',$ta);
		}
		 
		$this->db->join('masterkelas', 'masterkelas.kd_kelas = jadwal.kelas', 'left');  
		$this->db->group_by('kelas');  
		return parent::find_all();

	}
	public function group_bykelas($ta="",$prodi="",$mk="",$kelas="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.kelas,jadwal.kode_mk,count(kode_jadwal) as jml_mahasiswa,jadwal.tahun_akademik');
		}
		 
		if ($kelas != "")
		{
			$this->db->where('jadwal.kelas',$kelas);
		} 
		
		if ($mk != "")
		{
			$this->db->where('jadwal.kode_mk',$mk);
		}
		if ($ta != "")
		{
			$this->db->where('jadwal.tahun_akademik',$ta);
		}
		if ($prodi != "")
		{
			$this->db->where('jadwal.prodi',$prodi);
		}
		$this->db->group_by('kode_mk,kelas,prodi');  
		$this->db->order_by('jadwal.kode_mk',"ASC");  
		$this->db->where('jadwal.tahun_akademik like "'.$this->settings_lib->item('site.tahun').'%"');
		$this->db->join('datakrs', 'datakrs.kode_jadwal = jadwal.id', 'left');  
		return parent::find_all();

	}
	public function find_detil($kode_mk="",$kelas="",$kode_prodi="",$tahun_akademik = "")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_dosen,gelar_akademik');
		}
		if ($kode_mk != "")
		{
			$this->db->where('kode_mk',$kode_mk);
		} 
		if ($kelas != "")
		{
			$this->db->where('kelas',$kelas);
		} 
		if ($kode_prodi != "")
		{
			$this->db->where('prodi',$kode_prodi);
		} 
		if ($tahun_akademik != "")
		{
			$this->db->where('tahun_akademik',$tahun_akademik);
		} 
		$this->db->join('masterdosen', 'masterdosen.id = jadwal.kode_dosen', 'left'); 
		return parent::find_all();

	}
	public function getjadwaldosen($dosen ="",$tahunakademik = "",$kode_prodi = "",$kode_mk = "")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_dosen,gelar_akademik,nama_mata_kuliah,nama_prodi,masterprogramstudi.kode_prodi,simak_mastermatakuliah.sks,(select count(simak_datakrs.kode_jadwal) from simak_datakrs where kode_jadwal = simak_jadwal.id) as jumlah');
		}
		if ($dosen != "")
		{
			$this->db->where('masterdosen.nidn',$dosen);
		} 
		if ($kode_mk != "")
		{
			$this->db->where('kode_mk',$kode_mk);
		}
		if ($kode_prodi != "")
		{
			$this->db->where('prodi',$kode_prodi);
		} 
		if ($tahunakademik != "")
		{
			$this->db->where('simak_jadwal.tahun_akademik',$tahunakademik);
		} 
		$this->db->where('status_mata_kuliah',"A");
		//$this->db->where('simak_mastermatakuliah.tahun_akademik = simak_jadwal.tahun_akademik'); // tambahan supaya tahun akademik diikutsertakan
		$this->db->where('simak_mastermatakuliah.kode_prodi = simak_jadwal.prodi');
		
		$this->db->join('masterdosen', 'masterdosen.id = jadwal.kode_dosen', 'left'); 
		$this->db->join('mastermatakuliah', 'mastermatakuliah.kode_mata_kuliah = jadwal.kode_mk', 'inner');  
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = jadwal.prodi', 'left');  
		$this->db->group_by("jadwal.id");
		$this->db->order_by("nama_mata_kuliah");
		return parent::find_all();

	}
	public function countdosenta($dosen ="",$tahunakademik = "",$kode_prodi = "",$kode_mk = "")
	{
		if (empty($this->selects))
		{
			$this->select('count(distinct nama_mata_kuliah) as jmlmk');
		}
		if ($dosen != "")
		{
			$this->db->where('masterdosen.nidn',$dosen);
		} 
		if ($kode_mk != "")
		{
			$this->db->where('kode_mk',$kode_mk);
		}
		if ($kode_prodi != "")
		{
			$this->db->where('prodi',$kode_prodi);
		} 
		if ($tahunakademik != "")
		{
			$this->db->where('simak_jadwal.tahun_akademik',$tahunakademik);
		} 
		$this->db->where('status_mata_kuliah',"A");
		//$this->db->where('simak_mastermatakuliah.tahun_akademik = simak_jadwal.tahun_akademik'); // tambahan supaya tahun akademik diikutsertakan
		$this->db->where('simak_mastermatakuliah.kode_prodi = simak_jadwal.prodi');
		
		$this->db->join('masterdosen', 'masterdosen.id = jadwal.kode_dosen', 'left'); 
		$this->db->join('mastermatakuliah', 'mastermatakuliah.kode_mata_kuliah = jadwal.kode_mk', 'inner');  
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = jadwal.prodi', 'left');  
		//$this->db->group_by('kode_mk');  
		return parent::find_all();

	}
	public function countsksdosen($dosen ="",$tahunakademik = "",$kode_prodi = "",$kode_mk = "")
	{
		if (empty($this->selects))
		{
			$this->select('sum(simak_mastermatakuliah.sks) as jmlsks');
		}
		if ($dosen != "")
		{
			$this->db->where('masterdosen.nidn',$dosen);
		} 
		if ($kode_mk != "")
		{
			$this->db->where('kode_mk',$kode_mk);
		}
		if ($kode_prodi != "")
		{
			$this->db->where('prodi',$kode_prodi);
		} 
		if ($tahunakademik != "")
		{
			$this->db->where('simak_jadwal.tahun_akademik',$tahunakademik);
		} 
		$this->db->where('status_mata_kuliah',"A");
		//$this->db->where('simak_mastermatakuliah.tahun_akademik = simak_jadwal.tahun_akademik'); // tambahan supaya tahun akademik diikutsertakan
		$this->db->where('simak_mastermatakuliah.kode_prodi = simak_jadwal.prodi');
		
		$this->db->join('masterdosen', 'masterdosen.id = jadwal.kode_dosen', 'left'); 
		$this->db->join('mastermatakuliah', 'mastermatakuliah.kode_mata_kuliah = jadwal.kode_mk', 'inner');  
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = jadwal.prodi', 'left');  
		$this->db->distinct("simak_jadwal.kode_mk");
		return parent::find_all();

	}
	public function count_epsbed($ta = "",$fakultas="",$prodi="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		 
		if ($ta != "")
		{
			$this->db->where('jadwal.tahun_akademik',$ta);
		} 
		if ($fakultas != "")
		{
			$this->db->where('jadwal.fakultas',$fakultas);
		} 
		if ($prodi != "")
		{
			$this->db->where('prodi',$prodi);
		}
		return parent::count_all();
	}
	public function find_epsbed($ta = "",$fakultas="",$prodi="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		 
		if ($ta != "")
		{
			$this->db->where('jadwal.tahun_akademik',$ta);
		} 
		if ($fakultas != "")
		{
			$this->db->where('jadwal.fakultas',$fakultas);
		} 
		if ($prodi != "")
		{
			$this->db->where('prodi',$prodi);
		}
		return parent::find_all();
	}
	public function find_byid($id = "",$kode_mk="",$kelas="",$kode_prodi="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_dosen,gelar_akademik,masterdosen.nidn,nama_mata_kuliah,nama_prodi');
		}
		//if ($id != "")
		//{
			$this->db->where('jadwal.id',$id);
		//} 
		if ($kode_mk != "")
		{
			$this->db->where('kode_mk',$kode_mk);
		} 
		if ($kelas != "")
		{
			$this->db->where('kelas',$kelas);
		} 
		if ($kode_prodi != "")
		{
			$this->db->where('prodi',$kode_prodi);
		} 
		$this->db->where('status_mata_kuliah',"A");
		$this->db->where('simak_mastermatakuliah.kode_prodi = simak_jadwal.prodi');
		$this->db->join('masterdosen', 'masterdosen.id = jadwal.kode_dosen', 'left'); 
		$this->db->join('mastermatakuliah', 'mastermatakuliah.kode_mata_kuliah = jadwal.kode_mk', 'inner');  
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = jadwal.prodi', 'left');  
		return parent::find_all();

	}
	public function find_absen($id = "",$kode_mk="",$kelas="",$kode_prodi="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.id,nim_mhs as mahasiswa,nama_mahasiswa,datakrs.id as id_krs,harian,normatif,uts,uas,nilai_angka,nilai_huruf');
		}
		$this->db->where('jadwal.id',$id);
		//$this->db->join('mastermatakuliah mm', 'mm.kode_mata_kuliah=datakrs.kode_mk', 'left');
		//if($jurusan != ""){
			//$this->db->where('mastermahasiswa.kode_prodi',$kode_prodi);
		//}
		//if($kode_mk != ""){
			$this->db->where('datakrs.kode_mk',$kode_mk);
		//}
		//$this->db->where('datakrs.kelas',$kelas);
		$this->db->join('datakrs', 'datakrs.kode_jadwal = jadwal.id', 'inner');
		$this->db->join('mastermahasiswa', 'mastermahasiswa.nim_mhs = datakrs.mahasiswa', 'left');
		$this->db->join('masterdosen', 'masterdosen.nidn = jadwal.kode_dosen', 'left');
		$this->db->order_by("datakrs.mahasiswa","asc");
		$this->db->distinct();
		  
		return parent::find_all();
	}
	public function find_absenku($nim = "",$id = "",$kode_mk="",$kelas="",$kode_prodi="")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.id,nim_mhs as mahasiswa,nama_mahasiswa,datakrs.id as id_krs,harian,normatif,uts,uas,nilai_angka,nilai_huruf');
		}
		$this->db->where('jadwal.id',$id);
		$this->db->where('mastermahasiswa.nim_mhs',$nim);
		//$this->db->join('mastermatakuliah mm', 'mm.kode_mata_kuliah=datakrs.kode_mk', 'left');
		$this->db->where('mastermahasiswa.kode_prodi',$kode_prodi);
		$this->db->where('datakrs.kode_mk',$kode_mk);
		$this->db->join('datakrs', 'datakrs.kode_jadwal = jadwal.id', 'inner');
		$this->db->join('mastermahasiswa', 'mastermahasiswa.nim_mhs = datakrs.mahasiswa', 'left');
		$this->db->join('masterdosen', 'masterdosen.nidn = jadwal.kode_dosen', 'left');
		$this->db->order_by("datakrs.mahasiswa","asc");
		$this->db->distinct();
		  
		return parent::find_all();
	}
	
	public function getjadwalkaprodi($tahunakademik = "",$kode_prodi = "",$kode_mk = "",$dosen = "")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_dosen,gelar_akademik,nama_mata_kuliah,simak_mastermatakuliah.sks,(select max(pertemuan) from simak_materi_pertemuan where kode_jadwal = simak_jadwal.id) as maxpertemuan');
		}
		if ($kode_mk != "")
		{
			$this->db->where('kode_mk',$kode_mk);
		}
		if ($kode_prodi != "")
		{
			$this->db->where('prodi',$kode_prodi);
		} 
		if ($tahunakademik != "")
		{
			$this->db->where('simak_jadwal.tahun_akademik',$tahunakademik);
		} 
		if ($dosen != "")
		{
			$this->db->where('kode_dosen',$dosen);
		} 
		$this->db->where('status_mata_kuliah',"A");
		//$this->db->where('simak_mastermatakuliah.tahun_akademik = simak_jadwal.tahun_akademik'); // tambahan supaya tahun akademik diikutsertakan
		$this->db->where('simak_mastermatakuliah.kode_prodi = simak_jadwal.prodi');
		$this->db->group_by("jadwal.id");
		$this->db->join('masterdosen', 'masterdosen.id = jadwal.kode_dosen', 'inner'); 
		$this->db->join('mastermatakuliah', 'mastermatakuliah.kode_mata_kuliah = jadwal.kode_mk', 'left');  
		
		return parent::find_all();

	}
	public function nilaiperdosen($tahunakademik = "",$dosen = "")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_dosen,gelar_akademik,nama_mata_kuliah,simak_mastermatakuliah.sks,avg(jawaban) as ratarata');
		}
		 
		if ($tahunakademik != "")
		{
			$this->db->where('simak_jadwal.tahun_akademik',$tahunakademik);
		} 
		if ($dosen != "")
		{
			$this->db->where('kode_dosen',$dosen);
		} 
		$this->db->where('status_mata_kuliah',"A");
		
		$this->db->where('simak_mastermatakuliah.kode_prodi = simak_jadwal.prodi');
		$this->db->join('masterdosen', 'masterdosen.id = jadwal.kode_dosen', 'inner'); 
		$this->db->join('mastermatakuliah', 'mastermatakuliah.kode_mata_kuliah = jadwal.kode_mk', 'left');  
		$this->db->join('kuesioner_jawaban', 'jadwal.id = kuesioner_jawaban.kode_jadwal', 'left'); 
		$this->db->group_by("jadwal.kode_mk");
		return parent::find_all();

	}
	public function dosenmengajar($tahunakademik = "",$kode_prodi = "",$kode_mk = "")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.kode_dosen,nama_dosen,gelar_akademik,avg(jawaban) as ratarata');
		}
		if ($kode_mk != "")
		{
			$this->db->where('kode_mk',$kode_mk);
		}
		if ($kode_prodi != "")
		{
			$this->db->where('prodi',$kode_prodi);
		} 
		if ($tahunakademik != "")
		{
			$this->db->where('simak_jadwal.tahun_akademik',$tahunakademik);
		} 
		
		
		$this->db->join('masterdosen', 'masterdosen.id = jadwal.kode_dosen', 'inner'); 
		$this->db->join('kuesioner_jawaban', 'jadwal.id = kuesioner_jawaban.kode_jadwal', 'left'); 
		$this->db->group_by("jadwal.kode_dosen");
		return parent::find_all();

	}
	public function jumlahjadwal($tahunakademik = "",$kode_prodi = "")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_dosen,gelar_akademik');
		}
		if ($kode_prodi != "")
		{
			$this->db->where('prodi',$kode_prodi);
		} 
		if ($tahunakademik != "")
		{
			$this->db->where('simak_jadwal.tahun_akademik',$tahunakademik);
		} 
		$this->db->join('masterdosen', 'masterdosen.id = jadwal.kode_dosen', 'inner'); 
		
		return parent::count_all();

	}
	public function jmldosen($tahunakademik = "",$kode_prodi = "")
	{
		if (empty($this->selects))
		{
			$this->select('count(distinct kode_dosen) as jml_dosen');
		}
		if ($kode_prodi != "")
		{
			$this->db->where('prodi',$kode_prodi);
		} 
		if ($tahunakademik != "")
		{
			$this->db->where('simak_jadwal.tahun_akademik',$tahunakademik);
		} 
		$this->db->join('masterdosen', 'masterdosen.id = jadwal.kode_dosen', 'inner'); 
		
		return parent::find_all();

	}

}
