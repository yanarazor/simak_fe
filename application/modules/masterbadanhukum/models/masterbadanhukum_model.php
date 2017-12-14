<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Masterbadanhukum_model extends BF_Model {

	protected $table_name	= "masterbadanhukum";
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
			"field"		=> "masterbadanhukum_kode_badan_hukum",
			"label"		=> "Kode Badan Hukum",
			"rules"		=> "required|max_length[7]"
		),
		array(
			"field"		=> "masterbadanhukum_nama_badan_hukum",
			"label"		=> "Nama Badan Hukum",
			"rules"		=> "required|max_length[75]"
		),
		array(
			"field"		=> "masterbadanhukum_alamat1",
			"label"		=> "Alamat 1",
			"rules"		=> "max_length[255]"
		),
		array(
			"field"		=> "masterbadanhukum_alamat2",
			"label"		=> "Alamat 2",
			"rules"		=> "max_length[255]"
		),
		array(
			"field"		=> "masterbadanhukum_kota",
			"label"		=> "Kota",
			"rules"		=> "max_length[25]"
		),
		array(
			"field"		=> "masterbadanhukum_kode_pos",
			"label"		=> "Kode Pos",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "masterbadanhukum_telepon",
			"label"		=> "Telepon",
			"rules"		=> "max_length[25]"
		),
		array(
			"field"		=> "masterbadanhukum_fax",
			"label"		=> "Fax",
			"rules"		=> "max_length[25]"
		),
		array(
			"field"		=> "masterbadanhukum_tgl_akta",
			"label"		=> "Tanggal Akta",
			"rules"		=> ""
		),
		array(
			"field"		=> "masterbadanhukum_no_akta",
			"label"		=> "No Akta",
			"rules"		=> "max_length[50]"
		),
		array(
			"field"		=> "masterbadanhukum_tgl_pengesahan",
			"label"		=> "Tanggal Pengesahan",
			"rules"		=> ""
		),
		array(
			"field"		=> "masterbadanhukum_no_pengesahan",
			"label"		=> "No Pengesahan",
			"rules"		=> "max_length[50]"
		),
		array(
			"field"		=> "masterbadanhukum_email_badan_hukum",
			"label"		=> "E-Mail",
			"rules"		=> "max_length[50]"
		),
		array(
			"field"		=> "masterbadanhukum_website_badan_hukum",
			"label"		=> "Website Badan Hukum",
			"rules"		=> "max_length[50]"
		),
		array(
			"field"		=> "masterbadanhukum_tgl_pendirian",
			"label"		=> "Tanggal Pendirian",
			"rules"		=> ""
		),
	);
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= FALSE;

	//--------------------------------------------------------------------

}
