<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIOPERSONAFISDOMICILIO extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'FOLIOID' => [
				'type' => 'VARCHAR',
				'constraint' => '16',
			],
			'PERSONAFISICAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'DOMICILIOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'CP' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => TRUE,
			],
			'TIPODOMICILIO' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'R',
			],
			'ESTADOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'MUNICIPIOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'LOCALIDADID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'DELEGACIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'ZONA' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'U',
			],
			'COLONIAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'COLONIADESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'ESTADOJURIDICOIMPUTADOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'default' => 1,
			],
			'CALLE' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'NUMEROCASA' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
			],
			'NUMEROINTERIOR' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
			],
			'REFERENCIA' => [
				'type' => 'VARCHAR',
				'constraint' => '300',
			],
		]);
		$this->forge->addKey('ID', TRUE);
		$this->forge->createTable('FOLIOPERSONAFISDOMICILIO');
	}

	public function down()
	{
		$this->forge->dropTable('FOLIOPERSONAFISDOMICILIO');
	}
}
