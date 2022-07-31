<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PERSONAEDOCIVIL extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'PERSONAESTADOCIVILID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'PERSONAESTADOCIVILDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '200',
			],

		]);
		$this->forge->addKey('PERSONAESTADOCIVILID', TRUE);
		$this->forge->createTable('PERSONAEDOCIVIL');
	}

	public function down()
	{
		$this->forge->dropTable('PERSONAEDOCIVIL');
	}
}
