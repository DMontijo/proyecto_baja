<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VEHICULOCOLOR extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'VEHICULOCOLORID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'VEHICULOCOLORDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
		]);
		$this->forge->addKey('VEHICULOCOLORID', TRUE);
		$this->forge->createTable('VEHICULOCOLOR');
	}

	public function down()
	{
		$this->forge->dropTable('VEHICULOCOLOR');
	}
}
