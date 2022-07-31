<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LOCALIDAD extends Migration
{
	public function up()
	{
		$this->forge->addField([
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
			'LOCALIDADDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'ZONA' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'null' => TRUE,
			],
			'LOCALIDADIDEXTERNO' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			]
		]);
		$this->forge->addKey('ESTADOID', TRUE);
		$this->forge->addKey('MUNICIPIOID', TRUE);
		$this->forge->addKey('LOCALIDADID', TRUE);
		$this->forge->createTable('LOCALIDAD');
	}

	public function down()
	{
		$this->forge->dropTable('LOCALIDAD');
	}
}
