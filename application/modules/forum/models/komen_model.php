<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Komen_model extends BF_Model {

	protected $table_name	= "komen";
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
			"field"		=> "forum_judul",
			"label"		=> "Judul",
			"rules"		=> "required"
		),
		array(
			"field"		=> "forum_isi",
			"label"		=> "Isi",
			"rules"		=> ""
		),
		array(
			"field"		=> "forum_usr_id",
			"label"		=> "Usr Id",
			"rules"		=> "max_length[11]"
		),
		array(
			"field"		=> "forum_tanggal",
			"label"		=> "Tanggal",
			"rules"		=> ""
		),
	);
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= true;

	//--------------------------------------------------------------------
	public function find_all($kode_pesan ="")
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,u.display_name as user');
		}
		if($kode_pesan!=""){
			$this->db->where('id_berita',$kode_pesan);
		}
		 
		$this->db->join('users u', 'komen.usr_id = u.id', 'left'); 
		
		$this->db->order_by('id',"desc");
		return parent::find_all();

	} 
	public function getbyforum($id_forum)
	{
		if (empty($this->selects))
		{
			$this->select($this->table_name .'.*,isi,u.display_name as user');
		}
		$this->db->where('id_berita',$id_forum);
		 
		 
		$this->db->order_by('komen.id',"desc"); 
		$this->db->join('users u', 'komen.usr_id = u.id', 'left');
		return parent::find_all();

	}
	

}
