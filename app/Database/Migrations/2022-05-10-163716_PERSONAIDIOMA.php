<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PERSONAIDIOMA extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'PERSONAIDIOMAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'PERSONAIDIOMADESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],

		]);
		$this->forge->addKey('PERSONAIDIOMAID', TRUE);
		$this->forge->createTable('PERSONAIDIOMA');
	}

	public function down()
	{
		$this->forge->dropTable('PERSONAIDIOMA');
	}
}
