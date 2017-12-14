<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Informasi_dan_berita_model extends BF_Model {

	protected $table_name	= "mod_informasi";
	protected $key			= "id_berita";
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
			"field"		=> "informasi_dan_berita_judul",
			"label"		=> "Judul",
			"rules"		=> "required|max_length[100]"
		),
		array(
			"field"		=> "informasi_dan_berita_headline",
			"label"		=> "Headline",
			"rules"		=> "required|max_length[255]"
		),
		array(
			"field"		=> "informasi_dan_berita_id_category",
			"label"		=> "Kategori",
			"rules"		=> "max_length[3]"
		),
		array(
			"field"		=> "informasi_dan_berita_content",
			"label"		=> "Content",
			"rules"		=> ""
		),
		array(
			"field"		=> "informasi_dan_berita_createdby",
			"label"		=> "Createdby",
			"rules"		=> "max_length[25]"
		),
		array(
			"field"		=> "informasi_dan_berita_tgl_create",
			"label"		=> "Tgl Create",
			"rules"		=> ""
		),
		array(
			"field"		=> "informasi_dan_berita_foto",
			"label"		=> "Foto",
			"rules"		=> "max_length[100]"
		),
		array(
			"field"		=> "informasi_dan_berita_jam",
			"label"		=> "Jam",
			"rules"		=> ""
		),
		array(
			"field"		=> "informasi_dan_berita_auth_komen",
			"label"		=> "Auth Komen",
			"rules"		=> ""
		),
		array(
			"field"		=> "informasi_dan_berita_jml_dilihat",
			"label"		=> "Jml Dilihat",
			"rules"		=> "max_length[11]"
		),
	);
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= FALSE;

	//--------------------------------------------------------------------
	public function find_all($kat="",$title="")
	{
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*,category');
		}
		$this->db->join('mod_informasi_category', 'mod_informasi.id_category=mod_informasi_category.id', 'left');
		if($title!=""){
			$this->db->where('judul like "%'.$title.'%"');
		}
		if($kat!=""){
			$this->db->where('id_category',$kat);
		}
		$this->db->order_by('id_berita','desc');
		return parent::find_all();
	}
	public function find_all_withhout($kat="",$title="",$id_berita="")
	{
		if(empty($this->selects))
		{
			$this->select($this->table_name .'.*,category');
		}
		$this->db->join('mod_informasi_category', 'mod_informasi.id_category=mod_informasi_category.id', 'left');
		if($title!=""){
			$this->db->where('judul like "%'.$title.'%"');
		}
		if($kat!=""){
			$this->db->where('id_category',$kat);
		}
		if($id_berita!=""){
			$this->db->where('id_berita != "'.$id_berita.'"');
		}
		$this->db->order_by('id_berita','desc');
		return parent::find_all();
	}

}
