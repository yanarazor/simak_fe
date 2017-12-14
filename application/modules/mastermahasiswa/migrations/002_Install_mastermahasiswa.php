<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_mastermahasiswa extends Migration
{
	/**
	 * The name of the database table
	 *
	 * @var String
	 */
	private $table_name = 'mastermahasiswa';

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
		'kode_pt' => array(
			'type' => 'VARCHAR',
			'constraint' => 6,
			'null' => FALSE,
		),
		'kode_fakultas' => array(
			'type' => 'VARCHAR',
			'constraint' => 5,
			'null' => FALSE,
		),
		'kode_prodi' => array(
			'type' => 'VARCHAR',
			'constraint' => 5,
			'null' => FALSE,
		),
		'kode_jenjang_studi' => array(
			'type' => 'VARCHAR',
			'constraint' => 5,
			'null' => FALSE,
		),
		'nim_mhs' => array(
			'type' => 'VARCHAR',
			'constraint' => 25,
			'null' => FALSE,
		),
		'nama_mahasiswa' => array(
			'type' => 'VARCHAR',
			'constraint' => 50,
			'null' => FALSE,
		),
		'tempat_lahir' => array(
			'type' => 'VARCHAR',
			'constraint' => 50,
			'null' => FALSE,
		),
		'tgl_lahir' => array(
			'type' => 'DATE',
			'null' => FALSE,
			'default' => '0000-00-00',
		),
		'jenis_kelamin' => array(
			'type' => 'VARCHAR',
			'constraint' => 5,
			'null' => FALSE,
		),
		'tahun_masuk' => array(
			'type' => 'VARCHAR',
			'constraint' => 5,
			'null' => FALSE,
		),
		'semester_awal' => array(
			'type' => 'VARCHAR',
			'constraint' => 5,
			'null' => FALSE,
		),
		'semester' => array(
			'type' => 'VARCHAR',
			'constraint' => 5,
			'null' => FALSE,
		),
		'batas_studi' => array(
			'type' => 'VARCHAR',
			'constraint' => 5,
			'null' => FALSE,
		),
		'asal_propinsi' => array(
			'type' => 'VARCHAR',
			'constraint' => 50,
			'null' => FALSE,
		),
		'tgl_masuk' => array(
			'type' => 'DATE',
			'null' => FALSE,
			'default' => '0000-00-00',
		),
		'tgl_lulus' => array(
			'type' => 'DATE',
			'null' => FALSE,
			'default' => '0000-00-00',
		),
		'status_aktivitas' => array(
			'type' => 'VARCHAR',
			'constraint' => 50,
			'null' => FALSE,
		),
		'status_awal' => array(
			'type' => 'VARCHAR',
			'constraint' => 5,
			'null' => FALSE,
		),
		'jml_sks_diakui' => array(
			'type' => 'VARCHAR',
			'constraint' => 45,
			'null' => FALSE,
		),
		'nim_asal' => array(
			'type' => 'VARCHAR',
			'constraint' => 55,
			'null' => FALSE,
		),
		'asal_pt' => array(
			'type' => 'VARCHAR',
			'constraint' => 30,
			'null' => FALSE,
		),
		'asal_jenjang_studi' => array(
			'type' => 'VARCHAR',
			'constraint' => 5,
			'null' => FALSE,
		),
		'asal_prodi' => array(
			'type' => 'VARCHAR',
			'constraint' => 6,
			'null' => FALSE,
		),
		'kode_biaya_studi' => array(
			'type' => 'VARCHAR',
			'constraint' => 55,
			'null' => FALSE,
		),
		'kode_pekerjaan' => array(
			'type' => 'VARCHAR',
			'constraint' => 55,
			'null' => FALSE,
		),
		'tempat_kerja' => array(
			'type' => 'VARCHAR',
			'constraint' => 55,
			'null' => FALSE,
		),
		'kode_pt_kerja' => array(
			'type' => 'VARCHAR',
			'constraint' => 55,
			'null' => FALSE,
		),
		'kode_ps_kerja' => array(
			'type' => 'VARCHAR',
			'constraint' => 44,
			'null' => FALSE,
		),
		'nip_promotor' => array(
			'type' => 'VARCHAR',
			'constraint' => 44,
			'null' => FALSE,
		),
		'nip_co_promotor1' => array(
			'type' => 'VARCHAR',
			'constraint' => 11,
			'null' => FALSE,
		),
		'nip_co_promotor2' => array(
			'type' => 'VARCHAR',
			'constraint' => 12,
			'null' => FALSE,
		),
		'nip_co_promotor3' => array(
			'type' => 'VARCHAR',
			'constraint' => 33,
			'null' => FALSE,
		),
		'nip_co_promotor4' => array(
			'type' => 'VARCHAR',
			'constraint' => 44,
			'null' => FALSE,
		),
		'photo_mahasiswa' => array(
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