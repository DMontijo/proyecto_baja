<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VEHICULOMODELO extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'VEHICULODISTRIBUIDORID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'VEHICULOMARCAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'VEHICULOMODELOID' => [
				'type' => 'INT',
				'constraint' => '4',
			],
			'VEHICULOMODELODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE,
			],
		]);
		$this->forge->addKey('VEHICULODISTRIBUIDORID', TRUE);
		$this->forge->addKey('VEHICULOMARCAID', TRUE);
		$this->forge->addKey('VEHICULOMODELOID', TRUE);
		$this->forge->createTable('VEHICULOMODELO');
	}

	public function down()
	{
		$this->forge->dropTable('VEHICULOMODELO');
	}
}
