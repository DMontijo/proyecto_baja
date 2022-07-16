<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ESTADO extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ESTADOID'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			],
			'ESTADODESCR'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
		]);
		$this->forge->addKey('ESTADOID', TRUE);
		$this->forge->createTable('ESTADO');
	}

	public function down()
	{
		$this->forge->dropTable('ESTADO');
	}
}
