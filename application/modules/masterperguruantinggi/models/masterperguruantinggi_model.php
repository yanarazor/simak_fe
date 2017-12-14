<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Masterperguruantinggi_model extends BF_Model {

	protected $table_name	= "masterperguruantinggi";
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
			"field"		=> "masterperguruantinggi_kode_badan_hukum",
			"label"		=> "Kode Badan Hukum",
			"rules"		=> "required|max_length[7]"
		),
		array(
			"field"		=> "masterperguruantinggi_kode_pt",
			"label"		=> "Kode Perguruan Tinggi",
			"rules"		=> "required|max_length[6]"
		),
		array(
			"field"		=> "masterperguruantinggi_nama_pt",
			"label"		=> "Nama Perguruan Tinggi",
			"rules"		=> "required|max_length[100]"
		),
		array(
			"field"		=> "masterperguruantinggi_alamat_pt_1",
			"label"		=> "Alamat 1",
			"rules"		=> "required|max_length[255]"
		),
		array(
			"field"		=> "masterperguruantinggi_alamat_pt_2",
			"label"		=> "Alamat 2",
			"rules"		=> "max_length[255]"
		),
		array(
			"field"		=> "masterperguruantinggi_kota_pt",
			"label"		=> "Kota",
			"rules"		=> "max_length[50]"
		),
		array(
			"field"		=> "masterperguruantinggi_kodepos_pt",
			"label"		=> "Kode Pos",
			"rules"		=> "max_length[5]"
		),
		array(
			"field"		=> "masterperguruantinggi_telepon_pt",
			"label"		=> "Telepon",
			"rules"		=> "max_length[25]"
		),
		array(
			"field"		=> "masterperguruantinggi_fax_pt",
			"label"		=> "Faksimili",
			"rules"		=> "max_length[25]"
		),
		array(
			"field"		=> "masterperguruantinggi_tgl_akta_pt",
			"label"		=> "Tanggal Akta Perguruan Tinggi",
			"rules"		=> ""
		),
		array(
			"field"		=> "masterperguruantinggi_no_akta_pt",
			"label"		=> "No Akta Perguruan Tinggi",
			"rules"		=> "max_length[50]"
		),
		array(
			"field"		=> "masterperguruantinggi_email_pt",
			"label"		=> "E-Mail Perguruan Tinggi",
			"rules"		=> "required|max_length[255]"
		),
		array(
			"field"		=> "masterperguruantinggi_website_pt",
			"label"		=> "Website Perguruan Tinggi",
			"rules"		=> "max_length[255]"
		),
		array(
			"field"		=> "masterperguruantinggi_tgl_pendirian_pt",
			"label"		=> "Tanggal Pendirian Perguruan Tinggi",
			"rules"		=> ""
		),
	);
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= FALSE;

	//--------------------------------------------------------------------

}
