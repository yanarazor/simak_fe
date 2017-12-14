<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Konfirmasipembayaran_model extends BF_Model {

	protected $table_name	= "konfirmasipembayaran";
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
			"field"		=> "konfirmasipembayaran_nim",
			"label"		=> "Nim Mahasiswa",
			"rules"		=> "required|max_length[20]"
		),
		array(
			"field"		=> "konfirmasipembayaran_pembayaran",
			"label"		=> "Untuk Pembayaran",
			"rules"		=> "max_length[30]"
		),
		array(
			"field"		=> "konfirmasipembayaran_semester",
			"label"		=> "Semester",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "konfirmasipembayaran_jumlah",
			"label"		=> "Jumlah Bayar",
			"rules"		=> "required|max_length[20]"
		),
		array(
			"field"		=> "konfirmasipembayaran_tanggal",
			"label"		=> "Tanggal Bayar",
			"rules"		=> ""
		),
		array(
			"field"		=> "konfirmasipembayaran_bank",
			"label"		=> "Bank",
			"rules"		=> "max_length[20]"
		),
		array(
			"field"		=> "konfirmasipembayaran_file",
			"label"		=> "Bukti Pembayaran",
			"rules"		=> ""
		),
		array(
			"field"		=> "konfirmasipembayaran_keterangan",
			"label"		=> "Keterangan",
			"rules"		=> ""
		),
		array(
			"field"		=> "konfirmasipembayaran_date_created",
			"label"		=> "Date Created",
			"rules"		=> ""
		),
	);
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= TRUE;

	//--------------------------------------------------------------------
	public function find_all($nim="",$fillnama="",$fakultas="",$filljurusan,$sms="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_fakultas,nama_prodi,nama_mahasiswa');
		}
		if ($nim != "")
		{
			$this->db->like('nim_mhs',$nim);
		}
		if ($fakultas != "")
		{
			$this->db->where('mastermahasiswa.kode_fakultas',$fakultas);
		} 
		 
		if ($fillnama != "")
		{
			$this->db->like('nama_mahasiswa',$fillnama);
		}
		if ($filljurusan != "")
		{
			$this->db->where('mastermahasiswa.kode_prodi',$filljurusan);
		} 
		if ($sms != "")
		{
			$this->db->where('konfirmasipembayaran.semester',$sms);
		} 
		$this->db->join('mastermahasiswa', 'mastermahasiswa.nim_mhs = konfirmasipembayaran.nim', 'left'); 
		$this->db->join('masterfakultas', 'masterfakultas.id = mastermahasiswa.kode_fakultas', 'left'); 
		$this->db->join('masterprogramstudi', 'masterprogramstudi.id = mastermahasiswa.kode_prodi', 'left');  
		$this->db->order_by('konfirmasipembayaran.id',"desc");
		return parent::find_all();

	}
	//--------------------------------------------------------------------
	public function count_all($nim="",$fillnama="",$fakultas="",$filljurusan="",$sms="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_fakultas,nama_prodi');
		}
		if ($nim != "")
		{
			$this->db->like('nim_mhs',$nim);
		}
		if ($fakultas != "")
		{
			$this->db->where('mastermahasiswa.kode_fakultas',$fakultas);
		} 
		 
		if ($fillnama != "")
		{
			$this->db->like('nama_mahasiswa',$fillnama);
		}
		if ($filljurusan != "")
		{
			$this->db->where('mastermahasiswa.kode_prodi',$filljurusan);
		} 
		if ($sms != "")
		{
			$this->db->where('mastermahasiswa.semester',$sms);
		} 
		$this->db->join('mastermahasiswa', 'mastermahasiswa.nim_mhs = konfirmasipembayaran.nim', 'left'); 
		$this->db->join('masterfakultas', 'masterfakultas.id = mastermahasiswa.kode_fakultas', 'left'); 
		$this->db->join('masterprogramstudi', 'masterprogramstudi.id = mastermahasiswa.kode_prodi', 'left');  
		return parent::count_all();

	}
	//--------------------------------------------------------------------
	public function get_nover($nim="",$fillnama="",$fakultas="",$filljurusan,$sms="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_fakultas,nama_prodi,nama_mahasiswa');
		}
		if ($nim != "")
		{
			$this->db->like('nim_mhs',$nim);
		}
		if ($fakultas != "")
		{
			$this->db->where('mastermahasiswa.kode_fakultas',$fakultas);
		} 
		 
		if ($fillnama != "")
		{
			$this->db->like('nama_mahasiswa',$fillnama);
		}
		if ($filljurusan != "")
		{
			$this->db->where('mastermahasiswa.kode_prodi',$filljurusan);
		} 
		if ($sms != "")
		{
			$this->db->where('mastermahasiswa.semester',$sms);
		} 
		$this->db->or_where('status IS NULL');
		$this->db->or_where('status',"0");
		$this->db->join('mastermahasiswa', 'mastermahasiswa.nim_mhs = konfirmasipembayaran.nim', 'left'); 
		$this->db->join('masterfakultas', 'masterfakultas.id = mastermahasiswa.kode_fakultas', 'left'); 
		$this->db->join('masterprogramstudi', 'masterprogramstudi.id = mastermahasiswa.kode_prodi', 'left');  
		return parent::find_all();

	}
	public function count_nover($nim="",$fillnama="",$fakultas="",$filljurusan,$sms="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,nama_fakultas,nama_prodi,nama_mahasiswa');
		}
		if ($nim != "")
		{
			$this->db->like('nim_mhs',$nim);
		}
		if ($fakultas != "")
		{
			$this->db->where('mastermahasiswa.kode_fakultas',$fakultas);
		} 
		 
		if ($fillnama != "")
		{
			$this->db->like('nama_mahasiswa',$fillnama);
		}
		if ($filljurusan != "")
		{
			$this->db->where('mastermahasiswa.kode_prodi',$filljurusan);
		} 
		if ($sms != "")
		{
			$this->db->where('mastermahasiswa.semester',$sms);
		} 
		$this->db->or_where('status IS NULL');
		$this->db->or_where('status',"0");
		$this->db->join('mastermahasiswa', 'mastermahasiswa.nim_mhs = konfirmasipembayaran.nim', 'left'); 
		$this->db->join('masterfakultas', 'masterfakultas.id = mastermahasiswa.kode_fakultas', 'left'); 
		$this->db->join('masterprogramstudi', 'masterprogramstudi.id = mastermahasiswa.kode_prodi', 'left');  
		return parent::count_all();

	}
	public function cekpembayaran($sms="",$nim)
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		 
		$this->db->where('nim',$nim);
		$this->db->where('semester',$sms);
		$this->db->where('status',"1");
		
		return parent::count_all();

	}
	public function getjumlah_konfirmasi($tahun="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		if ($tahun != "")
		{
			$this->db->like('tanggal',$tahun);
		}
		$this->db->or_where('status IS NULL');
		$this->db->or_where('status',"0");
		return parent::count_all();

	}

}
