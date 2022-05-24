<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VEHICULOMODELO extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'VEHICULODISTRIBUIDORID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'VEHICULOMARCAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'VEHICULOMODELOID'   => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'VEHICULOMODELODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
		]);
		$this->forge->addKey('ID', TRUE);
		$this->forge->createTable('CATEGORIA_VEHICULOMODELO');
	}

	public function down()
	{
		$this->forge->dropTable('CATEGORIA_VEHICULOMODELO');
	}
}
