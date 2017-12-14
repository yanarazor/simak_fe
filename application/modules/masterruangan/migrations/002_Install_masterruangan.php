<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_masterruangan extends Migration
{
	/**
	 * The name of the database table
	 *
	 * @var String
	 */
	private $table_name = 'masterruangan';

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
		'tahun_akademik' => array(
			'type' => 'VARCHAR',
			'constraint' => 5,
			'null' => FALSE,
		),
		'kode_ruangan' => array(
			'type' => 'VARCHAR',
			'constraint' => 5,
			'null' => FALSE,
		),
		'Nama_ruangan' => array(
			'type' => 'VARCHAR',
			'constraint' => 50,
			'null' => FALSE,
		),
		'status' => array(
			'type' => 'VARCHAR',
			'constraint' => 5,
			'null' => FALSE,
		),
		'waktu_awal' => array(
			'type' => 'VARCHAR',
			'constraint' => 10,
			'null' => FALSE,
		),
		'waktu_akhir' => array(
			'type' => 'VARCHAR',
			'constraint' => 10,
			'null' => FALSE,
		),
		'sesi' => array(
			'type' => 'VARCHAR',
			'constraint' => 5,
			'null' => FALSE,
		),
		'keterangan' => array(
			'type' => 'VARCHAR',
			'constraint' => 255,
			'null' => FALSE,
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