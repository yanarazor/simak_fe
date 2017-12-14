<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pesan_model extends BF_Model {

	protected $table_name	= "pesan";
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
			"field"		=> "pesan_dari",
			"label"		=> "Dari",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "pesan_untuk",
			"label"		=> "Untuk",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "pesan_pesan",
			"label"		=> "Pesan",
			"rules"		=> ""
		),
		array(
			"field"		=> "pesan_id_materi",
			"label"		=> "Id Materi",
			"rules"		=> "max_length[10]"
		),
	);
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= FALSE;

	//--------------------------------------------------------------------
	public function find_all($id_materi = "",$untuk = "")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*,u.display_name as dari_nama');
		}
		if($id_materi != ""){
			$this->db->where('id_materi',$id_materi);
		}
		if($untuk != ""){
			$this->db->where('untuk',$untuk);
		}
		$this->db->join('users u', 'u.id = pesan.dari', 'inner');
		return parent::find_all();
	}
	public function find_blmbaca($id_materi = "",$untuk = "")
	{
		
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*,u.display_name as dari_nama');
		}
		if($id_materi != ""){
			$this->db->where('id_materi',$id_materi);
		}
		if($untuk != ""){
			$this->db->where('untuk',$untuk);
		}
		$this->db->where('status_baca',"0");
		$this->db->join('users u', 'u.id = pesan.dari', 'inner');
		$this->db->order_by('id',"desc");
		return parent::find_all();
	}
}
