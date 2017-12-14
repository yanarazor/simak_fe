<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Transkip_model extends BF_Model {

	protected $table_name	= "transkip";
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
			"field"		=> "predikat_ipk_dari",
			"label"		=> "IPK Dari",
			"rules"		=> "required|max_length[10]"
		),
		array(
			"field"		=> "predikat_ipk_sampai",
			"label"		=> "IPK Sampai",
			"rules"		=> "required|max_length[10]"
		),
		array(
			"field"		=> "predikat_predikat",
			"label"		=> "Predikat",
			"rules"		=> "required|max_length[50]"
		),
	);
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= true;

	//--------------------------------------------------------------------
	public function find_all($nim='',$mk="")
	{
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		if($nim!=""){
			$this->db->where('nim',$nim);
		}
		$this->db->distinct(); 
		return parent::find_all();
	}
	public function find_transkip($nim='',$mk="",$nilai="")
	{
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		 
		$this->db->where('nim',$nim);
		if($nilai==""){
			$this->db->where("nilai_huruf != 'E'");
			$this->db->where("nilai_huruf != '-'");
		}
		if($nilai=="0"){
			$this->db->where("nilai_huruf != 'E'");
			$this->db->where("nilai_huruf != '-'");
		}
		
		$this->db->order_by("semester","asc");
		$this->db->distinct();  
		return parent::find_all();
	}
	public function cekuniq($nim="",$mk="")
	{
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		$this->db->where('nim',$nim);
		$this->db->where('kode_mk',$mk);
		return parent::count_all()>0;
	}
	function update_nama_matakuliah($kode_mk, $nama_mk, $prodi){
        $data = array(
            'nama_mk'=>$nama_mk
            );
        $this->db->where('kode_mk', $kode_mk);
        $this->db->where('nim in (select nim_mhs from simak_mastermahasiswa where kode_prodi = "'.$prodi.'")');
        $this->db->update($this->table_name, $data);
    }
	public function isuniq($nim="",$mk="")
	{
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*');
		}
		$this->db->where('nim',$nim);
		$this->db->where('kode_mk',$mk);
		return parent::find_all();
	}
	public function getjumlahsks($mhs="")
	{
		
		if(empty($this->selects))
		{
			$this->select('sum(sks) as jumlahsks');
		}
		 
		//if($mhs!=""){
			$this->db->where('nim',$mhs);
		//}
		$this->db->where('nilai_huruf != ""');
		//$this->db->order_by("datakrs.semester","asc");
		//$this->db->distinct("");
		  
		return parent::find_all();
	}

}
