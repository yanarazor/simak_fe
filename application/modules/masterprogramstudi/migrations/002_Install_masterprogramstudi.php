<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_masterprogramstudi extends Migration
{
	/**
	 * The name of the database table
	 *
	 * @var String
	 */
	private $table_name = 'masterprogramstudi';

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
		'kode_fakultas' => array(
			'type' => 'VARCHAR',
			'constraint' => 5,
			'null' => FALSE,
		),
		'kode_prodi' => array(
			'type' => 'VARCHAR',
			'constraint' => 15,
			'null' => FALSE,
		),
		'kode_jenjang_studi' => array(
			'type' => 'VARCHAR',
			'constraint' => 5,
			'null' => FALSE,
		),
		'nama_prodi' => array(
			'type' => 'VARCHAR',
			'constraint' => 50,
			'null' => FALSE,
		),
		'semester_awal' => array(
			'type' => 'VARCHAR',
			'constraint' => 5,
			'null' => FALSE,
		),
		'no_sk_dikti' => array(
			'type' => 'VARCHAR',
			'constraint' => 50,
			'null' => FALSE,
		),
		'tgl_sk_dikti' => array(
			'type' => 'DATE',
			'null' => FALSE,
			'default' => '0000-00-00',
		),
		'tgl_akhir_sk_dikti' => array(
			'type' => 'DATE',
			'null' => FALSE,
			'default' => '0000-00-00',
		),
		'jml_sks_lulus' => array(
			'type' => 'VARCHAR',
			'constraint' => 5,
			'null' => FALSE,
		),
		'kode_status' => array(
			'type' => 'VARCHAR',
			'constraint' => 5,
			'null' => FALSE,
		),
		'tahun_semester_mulai' => array(
			'type' => 'VARCHAR',
			'constraint' => 5,
			'null' => FALSE,
		),
		'email_prodi' => array(
			'type' => 'VARCHAR',
			'constraint' => 50,
			'null' => FALSE,
		),
		'tgl_pendirian_program_studi' => array(
			'type' => 'DATE',
			'null' => FALSE,
			'default' => '0000-00-00',
		),
		'no_sk_akreditasi' => array(
			'type' => 'VARCHAR',
			'constraint' => 25,
			'null' => FALSE,
		),
		'tgl_sk_akreditasi' => array(
			'type' => 'DATE',
			'null' => FALSE,
			'default' => '0000-00-00',
		),
		'tgl_akhir_sk_akreditasi' => array(
			'type' => 'DATE',
			'null' => FALSE,
			'default' => '0000-00-00',
		),
		'kode_status_akreditasi' => array(
			'type' => 'VARCHAR',
			'constraint' => 5,
			'null' => FALSE,
		),
		'frekuensi_kurikulum' => array(
			'type' => 'VARCHAR',
			'constraint' => 10,
			'null' => FALSE,
		),
		'pelaksanaan_kurikulum' => array(
			'type' => 'VARCHAR',
			'constraint' => 10,
			'null' => FALSE,
		),
		'nidn_ketua_prodi' => array(
			'type' => 'VARCHAR',
			'constraint' => 25,
			'null' => FALSE,
		),
		'telp_ketua_prodi' => array(
			'type' => 'VARCHAR',
			'constraint' => 25,
			'null' => FALSE,
		),
		'fax_prodi' => array(
			'type' => 'VARCHAR',
			'constraint' => 25,
			'null' => FALSE,
		),
		'nama_operator' => array(
			'type' => 'VARCHAR',
			'constraint' => 50,
			'null' => FALSE,
		),
		'hp_operator' => array(
			'type' => 'VARCHAR',
			'constraint' => 25,
			'null' => FALSE,
		),
		'telepon_program_studi' => array(
			'type' => 'VARCHAR',
			'constraint' => 25,
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