<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VEHICULOPAIS extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'PAISID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'PAISDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
		]);
		$this->forge->addKey('PAISID', TRUE);
		$this->forge->createTable('VEHICULOPAIS');
	}

	public function down()
	{
		$this->forge->dropTable('VEHICULOPAIS');
	}
}
