<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIOPERSONAFISDOMICILIO extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'FOLIOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'PERSONAFISICAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'DOMICILIOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'ANO' => [
				'type' => 'INT',
				'constraint' => '4',
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
				'null' => TRUE,
			],
			'PAIS' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'ESTADOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'MUNICIPIOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'LOCALIDADID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'DELEGACIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'ZONA' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'U',
				'null' => TRUE,
			],
			'COLONIAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'COLONIADESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'CALLE' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'NUMEROCASA' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => TRUE,
			],
			'NUMEROINTERIOR' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => TRUE,
			],
			'REFERENCIA' => [
				'type' => 'VARCHAR',
				'constraint' => '300',
				'null' => TRUE,
			],
		]);
		$this->forge->addKey('FOLIOID', TRUE);
		$this->forge->addKey('PERSONAFISICAID', TRUE);
		$this->forge->addKey('DOMICILIOID', TRUE);
		$this->forge->addKey('ANO', TRUE);
		$this->forge->createTable('FOLIOPERSONAFISDOMICILIO');
	}

	public function down()
	{
		$this->forge->dropTable('FOLIOPERSONAFISDOMICILIO');
	}
}
