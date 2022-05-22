<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PERFILESUSUARIOS extends Migration
{
	public function up()
	{

		$this->forge->addField([
			'ID_PERFIL'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE,
			],
			'NOMBRE_PERFIL'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
		]);
		$this->forge->addKey('ID_PERFIL', TRUE);
		$this->forge->createTable('PERFILES_USUARIOS', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('PERFILES_USUARIOS', TRUE);
	}
}
