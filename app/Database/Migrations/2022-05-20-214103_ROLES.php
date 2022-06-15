<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ROLES extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
			],
			'NOMBRE_ROL' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
		]);
		$this->forge->addKey('ID', TRUE);
		$this->forge->createTable('ROLES', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('ROLES', TRUE);
	}
}
