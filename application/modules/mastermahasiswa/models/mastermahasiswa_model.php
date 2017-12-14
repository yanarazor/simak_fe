<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mastermahasiswa_model extends BF_Model {

	protected $table_name	= "mastermahasiswa";
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
			"field"		=> "mastermahasiswa_kode_pt",
			"label"		=> "Kode Perguruan Tinggi",
			"rules"		=> "max_length[40]"
		),
		array(
			"field"		=> "mastermahasiswa_kode_fakultas",
			"label"		=> "Kode Fakultas",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "mastermahasiswa_kode_prodi",
			"label"		=> "Kode Program Studi",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "mastermahasiswa_kode_jenjang_studi",
			"label"		=> "Kode Jenjang Studi",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "mastermahasiswa_nim_mhs",
			"label"		=> "NIM Mahasiswa",
			"rules"		=> "max_length[25]"
		),
		array(
			"field"		=> "mastermahasiswa_nama_mahasiswa",
			"label"		=> "Nama Mahasiswa",
			"rules"		=> "max_length[50]"
		),
		array(
			"field"		=> "mastermahasiswa_tempat_lahir",
			"label"		=> "Tempat Lahir",
			"rules"		=> "max_length[50]"
		),
		array(
			"field"		=> "mastermahasiswa_tgl_lahir",
			"label"		=> "Tanggal Lahir",
			"rules"		=> ""
		),
		array(
			"field"		=> "mastermahasiswa_jenis_kelamin",
			"label"		=> "Jenis Kelamin",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "mastermahasiswa_tahun_masuk",
			"label"		=> "Tahun Masuk",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "mastermahasiswa_semester_awal",
			"label"		=> "Semester Awal",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "mastermahasiswa_batas_studi",
			"label"		=> "Batas Studi",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "mastermahasiswa_asal_propinsi",
			"label"		=> "Kode Asal Propinsi",
			"rules"		=> "max_length[50]"
		),
		array(
			"field"		=> "mastermahasiswa_tgl_masuk",
			"label"		=> "Tanggal Masuk",
			"rules"		=> ""
		),
		array(
			"field"		=> "mastermahasiswa_tgl_lulus",
			"label"		=> "Tanggal Lulus",
			"rules"		=> ""
		),
		array(
			"field"		=> "mastermahasiswa_status_aktivitas",
			"label"		=> "Status Aktivitas",
			"rules"		=> "max_length[50]"
		),
		array(
			"field"		=> "mastermahasiswa_status_awal",
			"label"		=> "Status Awal",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "mastermahasiswa_jml_sks_diakui",
			"label"		=> "Jumlah SKS Diakui",
			"rules"		=> "max_length[45]"
		),
		array(
			"field"		=> "mastermahasiswa_nim_asal",
			"label"		=> "NIM ASAL",
			"rules"		=> "max_length[55]"
		),
		array(
			"field"		=> "mastermahasiswa_asal_pt",
			"label"		=> "Asal Perguruan Tinggi",
			"rules"		=> "max_length[30]"
		),
		array(
			"field"		=> "mastermahasiswa_asal_jenjang_studi",
			"label"		=> "Asal Jenjang Studi",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "mastermahasiswa_asal_prodi",
			"label"		=> "Asal Prodi",
			"rules"		=> "max_length[6]"
		),
		array(
			"field"		=> "mastermahasiswa_kode_biaya_studi",
			"label"		=> "Kode Biaya Studi",
			"rules"		=> "max_length[55]"
		),
		array(
			"field"		=> "mastermahasiswa_kode_pekerjaan",
			"label"		=> "Kode Pekerjaan",
			"rules"		=> "max_length[55]"
		),
		array(
			"field"		=> "mastermahasiswa_tempat_kerja",
			"label"		=> "Tempat Pekerjaan",
			"rules"		=> "max_length[55]"
		),
		array(
			"field"		=> "mastermahasiswa_kode_pt_kerja",
			"label"		=> "Kode PT Kerja",
			"rules"		=> "max_length[55]"
		),
		array(
			"field"		=> "mastermahasiswa_kode_ps_kerja",
			"label"		=> "Kode PS Kerja",
			"rules"		=> "max_length[44]"
		),
		array(
			"field"		=> "mastermahasiswa_nip_promotor",
			"label"		=> "NIP Promotor",
			"rules"		=> "max_length[44]"
		),
		array(
			"field"		=> "mastermahasiswa_nip_co_promotor1",
			"label"		=> "NIP Co - Promotor 1",
			"rules"		=> "max_length[11]"
		),
		array(
			"field"		=> "mastermahasiswa_nip_co_promotor2",
			"label"		=> "NIP Co - Promotor 2",
			"rules"		=> "max_length[12]"
		),
		array(
			"field"		=> "mastermahasiswa_nip_co_promotor3",
			"label"		=> "NIP Co - Promotor 3",
			"rules"		=> "max_length[33]"
		),
		array(
			"field"		=> "mastermahasiswa_nip_co_promotor4",
			"label"		=> "NIP Co - Promotor 4",
			"rules"		=> "max_length[44]"
		),
		array(
			"field"		=> "mastermahasiswa_photo_mahasiswa",
			"label"		=> "Foto Mahasiswa",
			"rules"		=> "max_length[255]"
		),
	);
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= TRUE;

	//--------------------------------------------------------------------
	
	public function find_all($nim="",$fillnama="",$fakultas="",$filljurusan)
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_fakultas,nama_prodi');
		}
		if ($nim != "")
		{
			$this->db->where('nim_mhs like "%'.$nim.'%"');
		}
		if ($fakultas != "")
		{
			$this->db->where('mastermahasiswa.kode_fakultas',$fakultas);
		} 
		 
		if ($fillnama != "")
		{
			$this->db->where('nama_mahasiswa like "%'.$fillnama.'%"');
		}
		if ($filljurusan != "")
		{
			$this->db->where('mastermahasiswa.kode_prodi',$filljurusan);
		} 
		$this->db->join('masterfakultas', 'masterfakultas.id = mastermahasiswa.kode_fakultas', 'left'); 
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = mastermahasiswa.kode_prodi', 'left');  
		return parent::find_all();

	}
	public function count_all($nim="",$fillnama="",$fakultas="",$filljurusan="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_fakultas,nama_prodi');
		}
		if ($nim != "")
		{
			$this->db->where('nim_mhs like "%'.$nim.'%"');
		}
		if ($fakultas != "")
		{
			$this->db->where('mastermahasiswa.kode_fakultas',$fakultas);
		} 
		 
		if ($fillnama != "")
		{
			$this->db->where('nama_mahasiswa like "%'.$fillnama.'%"');
		}
		if ($filljurusan != "")
		{
			$this->db->where('mastermahasiswa.kode_prodi',$filljurusan);
		} 
		$this->db->join('masterfakultas', 'masterfakultas.id = mastermahasiswa.kode_fakultas', 'left'); 
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = mastermahasiswa.kode_prodi', 'left');  
		return parent::count_all();

	}
	public function get_by_nim($nim="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		if ($nim != "")
		{
			$this->db->where('nim_mhs',$nim);
		}
		 
		return parent::find_all();

	}
	public function groupby_tahunmasuk($tahun="",$status="")
	{
		$tahunsebelumnya = (int)date("Y")-10;
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.tahun_masuk,count(*) as jumlah');
		}
		if ($tahun != "")
		{
			$this->db->where('tahun_masuk',$tahun);
		}
		if ($status != "")
		{
			$this->db->where('status_mahasiswa',$status);
		}
		$this->db->where('tahun_masuk > '.$tahunsebelumnya.'');
		$this->db->group_by('tahun_masuk');
		return parent::find_all();

	}
	public function grupby_tahunnstatus($tahun="",$status="",$fakultas = "",$prodi = "")
	{
		$tahunsebelumnya = (int)date("Y")-10;
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.tahun_masuk,count(distinct mahasiswa) as jumlah');
		}
		if ($tahun != "")
		{
			$this->db->where("tahun_masuk",$tahun);
		}
		if ($status != "")
		{
			$this->db->where("status_mahasiswa",$status);
		}
		if ($fakultas != "")
		{
			$this->db->where("kode_fakultas",$fakultas);
		}
		if ($prodi != "")
		{
			$this->db->where("kode_prodi",$prodi);
		}
		$this->db->where('tahun_akademik',$this->settings_lib->item('site.tahun'));
		$this->db->where('tahun_masuk > '.$tahunsebelumnya.'');
		$this->db->where('tahun_masuk <= '.(int)date("Y").'');
		
		$this->db->join('datakrs', 'datakrs.mahasiswa = mastermahasiswa.nim_mhs', 'inner');  
		
		$this->db->group_by('tahun_masuk');
		return parent::find_all();

	}
	public function getcountmahasiswaAktif($tahun="",$status="",$fakultas = "",$prodi = "")
	{
		$tahunsebelumnya = (int)date("Y")-10;
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.tahun_masuk,count(distinct nim_mhs) as jumlah');
		}
		if ($tahun != "")
		{
			$this->db->where("tahun_masuk",$tahun);
		}
		if ($status != "")
		{
			$this->db->where("status_mahasiswa",$status);
		}
		if ($fakultas != "")
		{
			$this->db->where("kode_fakultas",$fakultas);
		}
		if ($prodi != "")
		{
			$this->db->where("kode_prodi",$prodi);
		}
		$this->db->where('status_aktivitas',"A");
		$this->db->where('tahun_masuk > '.$tahunsebelumnya.'');
		$this->db->where('tahun_masuk <= '.(int)date("Y").'');
		$this->db->group_by('tahun_masuk');
		return parent::find_all();

	}
	public function getcountmahasiswatdkAktif($tahun="",$status="",$fakultas = "",$prodi = "")
	{
		$tahunsebelumnya = (int)date("Y")-10;
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.tahun_masuk,count(distinct nim_mhs) as jumlah');
		}
		if ($tahun != "")
		{
			$this->db->where("tahun_masuk",$tahun);
		}
		if ($status != "")
		{
			$this->db->where("status_mahasiswa",$status);
		}
		if ($fakultas != "")
		{
			$this->db->where("kode_fakultas",$fakultas);
		}
		if ($prodi != "")
		{
			$this->db->where("kode_prodi",$prodi);
		}
		$this->db->where('status_aktivitas != "A"');
		$this->db->where('tahun_masuk > '.$tahunsebelumnya.'');
		$this->db->where('tahun_masuk <= '.(int)date("Y").'');
		$this->db->group_by('tahun_masuk');
		return parent::find_all();

	}
	public function gettahunAktif($status="",$fakultas = "",$prodi = "")
	{
		 
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.tahun_masuk');
		}
		if ($status != "")
		{
			$this->db->where("status_mahasiswa",$status);
		}
		if ($fakultas != "")
		{
			$this->db->where("kode_fakultas",$fakultas);
		}
		if ($prodi != "")
		{
			$this->db->where("kode_prodi",$prodi);
		}
		$this->db->where("status_aktivitas is not null");
		$this->db->where("tahun_masuk != ''");
		$this->db->where("tahun_masuk != '0'");
		$this->db->where("tahun_masuk > '2007'");
		$this->db->group_by('tahun_masuk');
		return parent::find_all();

	}
	public function find_detil($nim="")
	{
		if (empty($this->selects))
		{
			$this->select('nim_mhs,nama_mahasiswa,nama_prodi,mastermahasiswa.kode_prodi,nama_fakultas,nama_dosen,tempat_lahir,tgl_lahir,mastermahasiswa.kode_jenjang_studi,dekan');
		}
		$this->db->where('nim_mhs',$nim);
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = mastermahasiswa.kode_prodi', 'left');  
		$this->db->join('masterfakultas', 'masterfakultas.kode_fakultas = mastermahasiswa.kode_fakultas', 'left'); 
		$this->db->join('masterdosen', 'mastermahasiswa.nip_promotor = masterdosen.id', 'left'); 
		return parent::find_all();

	}
	public function find_detilbytahunmasuk($tahun_masuk = "",$status_mahasiswa="")
	{
		if (empty($this->selects))
		{
			$this->select('nim_mhs,nama_mahasiswa,nama_prodi,nama_fakultas,nama_dosen');
		}
		$this->db->distinct('nim_mhs');
		$this->db->where('tahun_masuk',$tahun_masuk);
		$this->db->where('tahun_akademik',$this->settings_lib->item('site.tahun'));
		$this->db->where('status_mahasiswa',$status_mahasiswa);
		 
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = mastermahasiswa.kode_prodi', 'left');  
		$this->db->join('masterfakultas', 'masterfakultas.kode_fakultas = mastermahasiswa.kode_fakultas', 'left'); 
		$this->db->join('masterdosen', 'mastermahasiswa.nip_promotor = masterdosen.id', 'left'); 
		$this->db->join('datakrs', 'datakrs.mahasiswa = mastermahasiswa.nim_mhs', 'inner');
		return parent::find_all();

	}
	 
	public function Mhsaktif_all($tahun_masuk="",$fakultas = "",$prodi = "",$status = "")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_fakultas,nama_prodi,gelar_akademik,nama_dosen');
		}
		 
		 
		if ($fakultas != "")
		{
			$this->db->where("mastermahasiswa.kode_fakultas",$fakultas);
		}
		if ($prodi != "")
		{
			$this->db->where("mastermahasiswa.kode_prodi",$prodi);
		}
		if ($tahun_masuk != "")
		{
			$this->db->where("tahun_masuk",$tahun_masuk);
		}
		if ($status != "")
		{
			$this->db->where("status_mahasiswa",$status);
		}
		$this->db->where('status_aktivitas',"A");
		$this->db->join('masterfakultas', 'masterfakultas.id = mastermahasiswa.kode_fakultas', 'left'); 
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = mastermahasiswa.kode_prodi', 'left');  
		$this->db->join('masterdosen', 'mastermahasiswa.nip_promotor = masterdosen.id', 'left'); 
		return parent::find_all();

	}
	public function MhsNonaktif_all($tahun_masuk="",$fakultas = "",$prodi = "",$status = "")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_fakultas,nama_prodi,gelar_akademik,nama_dosen');
		}
		 
		 
		if ($fakultas != "")
		{
			$this->db->where("mastermahasiswa.kode_fakultas",$fakultas);
		}
		if ($prodi != "")
		{
			$this->db->where("mastermahasiswa.kode_prodi",$prodi);
		}
		if ($tahun_masuk != "")
		{
			$this->db->where("tahun_masuk",$tahun_masuk);
		}
		if ($status != "")
		{
			$this->db->where("status_mahasiswa",$status);
		}
		$this->db->where('status_aktivitas != "A"');
		$this->db->join('masterfakultas', 'masterfakultas.id = mastermahasiswa.kode_fakultas', 'left'); 
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = mastermahasiswa.kode_prodi', 'left');  
		$this->db->join('masterdosen', 'mastermahasiswa.nip_promotor = masterdosen.id', 'left'); 
		return parent::find_all();

	}
	public function CountMhsaktif_all($tahun_masuk="",$fakultas = "",$prodi = "",$status = "")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_fakultas,nama_prodi');
		}
		if ($fakultas != "")
		{
			$this->db->where("mastermahasiswa.kode_fakultas",$fakultas);
		}
		if ($prodi != "")
		{
			$this->db->where("mastermahasiswa.kode_prodi",$prodi);
		}
		if ($tahun_masuk != "")
		{
			$this->db->where("tahun_masuk",$tahun_masuk);
		}
		if ($status != "")
		{
			$this->db->where("status_mahasiswa",$status);
		}
		$this->db->where('status_aktivitas = "A"');
		$this->db->join('masterfakultas', 'masterfakultas.id = mastermahasiswa.kode_fakultas', 'left'); 
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = mastermahasiswa.kode_prodi', 'left');  
		return parent::count_all();
	}
	public function CountNonMhsaktif_all($tahun_masuk="",$fakultas = "",$prodi = "",$status = "")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_fakultas,nama_prodi');
		}
		if ($fakultas != "")
		{
			$this->db->where("mastermahasiswa.kode_fakultas",$fakultas);
		}
		if ($prodi != "")
		{
			$this->db->where("mastermahasiswa.kode_prodi",$prodi);
		}
		if ($tahun_masuk != "")
		{
			$this->db->where("tahun_masuk",$tahun_masuk);
		}
		if ($status != "")
		{
			$this->db->where("status_mahasiswa",$status);
		}
		$this->db->where('status_aktivitas != "A"');
		$this->db->join('masterfakultas', 'masterfakultas.id = mastermahasiswa.kode_fakultas', 'left'); 
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = mastermahasiswa.kode_prodi', 'left');  
		return parent::count_all();
	}
	public function GetMahasiswaIsiKrs($tahun_masuk="",$fakultas = "",$prodi = "",$status = "")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_fakultas,nama_prodi,gelar_akademik,nama_dosen');
		}
		if ($tahun_masuk != "")
		{
			$this->db->where("tahun_masuk",$tahun_masuk);
		}
		if ($status != "")
		{
			$this->db->where("status_mahasiswa",$status);
		}
		if ($fakultas != "")
		{
			$this->db->where("mastermahasiswa.kode_fakultas",$fakultas);
		}
		if ($prodi != "")
		{
			$this->db->where("mastermahasiswa.kode_prodi",$prodi);
		}
		$this->db->where('tahun_akademik',$this->settings_lib->item('site.tahun'));
		$this->db->join('datakrs', 'datakrs.mahasiswa = mastermahasiswa.nim_mhs', 'inner');  
		$this->db->join('masterfakultas', 'masterfakultas.id = mastermahasiswa.kode_fakultas', 'left'); 
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = mastermahasiswa.kode_prodi', 'left');  
		$this->db->join('masterdosen', 'mastermahasiswa.nip_promotor = masterdosen.id', 'left'); 
		$this->db->group_by('nim_mhs');
		return parent::find_all();

	}
	public function GetCountMahasiswaIsiKrs($tahun_masuk="",$fakultas = "",$prodi = "",$status = "")
	{
		if (empty($this->selects))
		{
			$this->select('nim_mhs');
		}
		if ($tahun_masuk != "")
		{
			$this->db->where("tahun_masuk",$tahun_masuk);
		}
		if ($status != "")
		{
			$this->db->where("status_mahasiswa",$status);
		}
		if ($fakultas != "")
		{
			$this->db->where("mastermahasiswa.kode_fakultas",$fakultas);
		}
		if ($prodi != "")
		{
			$this->db->where("mastermahasiswa.kode_prodi",$prodi);
		}
		$this->db->where('tahun_akademik',$this->settings_lib->item('site.tahun'));
		$this->db->join('datakrs', 'datakrs.mahasiswa = mastermahasiswa.nim_mhs', 'inner');  
		$this->db->distinct('nim_mhs');
		return parent::find_all();

	}
	public function cekuniq($nim="")
	{
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
			$this->db->where('nim_mhs',$nim);
		return parent::count_all()>0;
	}
	public function find_all_dosen($dosen="",$filljurusan)
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_fakultas,nama_prodi');
		}
		 
		if ($dosen != "")
		{
			$this->db->where('nip_promotor',$dosen);
		}
		if ($filljurusan != "")
		{
			$this->db->where('mastermahasiswa.kode_prodi',$filljurusan);
		} 
		$this->db->join('masterfakultas', 'masterfakultas.id = mastermahasiswa.kode_fakultas', 'left'); 
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = mastermahasiswa.kode_prodi', 'left');  
		return parent::find_all();

	}
	public function count_all_dosen($dosen="",$filljurusan)
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_fakultas,nama_prodi');
		}
		 
		if ($dosen != "")
		{
			$this->db->where('nip_promotor',$dosen);
		}
		if ($filljurusan != "")
		{
			$this->db->where('mastermahasiswa.kode_prodi',$filljurusan);
		} 
		$this->db->join('masterfakultas', 'masterfakultas.id = mastermahasiswa.kode_fakultas', 'left'); 
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = mastermahasiswa.kode_prodi', 'left');  
		return parent::count_all();

	}
	public function find_detilbytahunmasukandprodi($tahun_masuk = "",$status_mahasiswa="",$prodi = "")
	{
		if (empty($this->selects))
		{
			$this->select('nim_mhs,nama_mahasiswa,nama_prodi,nama_fakultas,nama_dosen');
		}
		$this->db->distinct('nim_mhs');
		$this->db->where('tahun_masuk',$tahun_masuk);
		$this->db->where('tahun_akademik',$this->settings_lib->item('site.tahun'));
		$this->db->where('status_mahasiswa',$status_mahasiswa);
		$this->db->where('mastermahasiswa.kode_prodi',$prodi);
		 
		$this->db->join('masterprogramstudi', 'masterprogramstudi.kode_prodi = mastermahasiswa.kode_prodi', 'left');  
		$this->db->join('masterfakultas', 'masterfakultas.kode_fakultas = mastermahasiswa.kode_fakultas', 'left'); 
		$this->db->join('masterdosen', 'mastermahasiswa.nip_promotor = masterdosen.id', 'left'); 
		$this->db->join('datakrs', 'datakrs.mahasiswa = mastermahasiswa.nim_mhs', 'inner');
		$this->db->order_by('nim_mhs',"ASC");
		return parent::find_all();

	}
	 
}
