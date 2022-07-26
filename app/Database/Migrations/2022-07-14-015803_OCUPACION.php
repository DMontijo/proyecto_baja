<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OCUPACION extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'PERSONAOCUPACIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'PERSONAOCUPACIONDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
			],
		]);

		$this->forge->addKey('PERSONAOCUPACIONID', true);
		$this->forge->createTable('OCUPACION', true);
	}

	public function down()
	{
		$this->forge->dropTable('OCUPACION', true);
	}
}
