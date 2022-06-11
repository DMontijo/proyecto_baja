<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TIPOEXPEDIENTE extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'TIPOEXPEDIENTEID' => [
				'type' => 'INT',
			],
			'TIPOEXPEDIENTEDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'TIPOEXPEDIENTECLAVE' => [
				'type' => 'CHAR',
				'constraint' => '3',
				'null' => TRUE,
			],
			'EDOJURIDICOIMPINICIALID' => [
				'type' => 'INT',
				'null' => TRUE,
			],
			'PERMITECONCLUIR' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'N',
			]
		]);

		$this->forge->addKey('TIPOEXPEDIENTEID', TRUE);
		$this->forge->createTable('TIPOEXPEDIENTE');
	}

	public function down()
	{
		$this->forge->dropTable('TIPOEXPEDIENTE');
	}
}
