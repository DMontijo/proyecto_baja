<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ROLESUSUARIOS extends Migration
{
    public function up()
	{

		$this->forge->addField([
			'ID_ROL'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE,
			],
			'NOMBRE_ROL'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
		]);
		$this->forge->addKey('ID_ROL', TRUE);
		$this->forge->createTable('ROLES_USUARIOS',TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('ROLES_USUARIOS',TRUE);
	}
}
