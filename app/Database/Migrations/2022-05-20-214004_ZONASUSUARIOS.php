<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ZONASUSUARIOS extends Migration
{
	public function up()
	{

		$this->forge->addField([
			'ID_ZONA'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE,
			],
			'NOMBRE_ZONA'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
		]);
		$this->forge->addKey('ID_ZONA', TRUE);
		$this->forge->createTable('ZONAS_USUARIOS', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('ZONAS_USUARIOS', TRUE);
	}
}
