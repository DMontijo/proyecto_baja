<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DOCUMENTOSEXTRAVIOTIPO extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'DOCUMENTOEXTRAVIOTIPOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'DOCUMENTOEXTRAVIOTIPODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			'VISIBLE' => [
				'type' => 'TINYINT',
				'constraint' => 1,
				'default' => 1,
				'null' => TRUE,
			],
		]);

		$this->forge->addKey('DOCUMENTOEXTRAVIOTIPOID', true);
		$this->forge->createTable('DOCUMENTOSEXTRAVIOTIPO', true);
	}

	public function down()
	{
		$this->forge->dropTable('DOCUMENTOSEXTRAVIOTIPO', true);
	}
}
