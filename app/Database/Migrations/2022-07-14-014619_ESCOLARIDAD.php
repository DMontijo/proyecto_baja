<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ESCOLARIDAD extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'PERSONAESCOLARIDADID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'PERSONAESCOLARIDADDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
			],
		]);

		$this->forge->addKey('PERSONAESCOLARIDADID', true);
		$this->forge->createTable('ESCOLARIDAD', true);
	}

	public function down()
	{
		$this->forge->dropTable('ESCOLARIDAD', true);
	}
}
