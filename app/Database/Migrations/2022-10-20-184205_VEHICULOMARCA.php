<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VEHICULOMARCA extends Migration
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
			'VEHICULOMARCADESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
		]);
		$this->forge->addKey('VEHICULODISTRIBUIDORID', TRUE);
		$this->forge->addKey('VEHICULOMARCAID', TRUE);
		$this->forge->createTable('VEHICULOMARCA');
	}

	public function down()
	{
		$this->forge->dropTable('VEHICULOMARCA');
	}
}
