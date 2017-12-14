<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_masterbadanhukum extends Migration
{
	/**
	 * The name of the database table
	 *
	 * @var String
	 */
	private $table_name = 'masterbadanhukum';

	/**
	 * The table's fields
	 *
	 * @var Array
	 */
	private $fields = array(
		'id' => array(
			'type' => 'INT',
			'constraint' => 11,
			'auto_increment' => TRUE,
		),
		'kode_badan_hukum' => array(
			'type' => 'VARCHAR',
			'constraint' => 7,
			'null' => FALSE,
		),
		'nama_badan_hukum' => array(
			'type' => 'VARCHAR',
			'constraint' => 75,
			'null' => FALSE,
		),
		'alamat1' => array(
			'type' => 'VARCHAR',
			'constraint' => 255,
			'null' => FALSE,
		),
		'alamat2' => array(
			'type' => 'VARCHAR',
			'constraint' => 255,
			'null' => FALSE,
		),
		'kota' => array(
			'type' => 'VARCHAR',
			'constraint' => 25,
			'null' => FALSE,
		),
		'kode_pos' => array(
			'type' => 'VARCHAR',
			'constraint' => 5,
			'null' => FALSE,
		),
		'telepon' => array(
			'type' => 'VARCHAR',
			'constraint' => 25,
			'null' => FALSE,
		),
		'fax' => array(
			'type' => 'VARCHAR',
			'constraint' => 25,
			'null' => FALSE,
		),
		'tgl_akta' => array(
			'type' => 'DATE',
			'null' => FALSE,
			'default' => '0000-00-00',
		),
		'no_akta' => array(
			'type' => 'VARCHAR',
			'constraint' => 50,
			'null' => FALSE,
		),
		'tgl_pengesahan' => array(
			'type' => 'DATE',
			'null' => FALSE,
			'default' => '0000-00-00',
		),
		'no_pengesahan' => array(
			'type' => 'VARCHAR',
			'constraint' => 50,
			'null' => FALSE,
		),
		'email_badan_hukum' => array(
			'type' => 'VARCHAR',
			'constraint' => 50,
			'null' => FALSE,
		),
		'website_badan_hukum' => array(
			'type' => 'VARCHAR',
			'constraint' => 50,
			'null' => FALSE,
		),
		'tgl_pendirian' => array(
			'type' => 'DATE',
			'null' => FALSE,
			'default' => '0000-00-00',
		),
	);

	/**
	 * Install this migration
	 *
	 * @return void
	 */
	public function up()
	{
		$this->dbforge->add_field($this->fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table($this->table_name);
	}

	//--------------------------------------------------------------------

	/**
	 * Uninstall this migration
	 *
	 * @return void
	 */
	public function down()
	{
		$this->dbforge->drop_table($this->table_name);
	}

	//--------------------------------------------------------------------

}