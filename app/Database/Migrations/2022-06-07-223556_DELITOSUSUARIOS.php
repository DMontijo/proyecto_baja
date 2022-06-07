<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DELITOSUSUARIOS extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ID'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			],
			'DELITO'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '250',
			],
			'IMPORTANCIA'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '1',
			],
			'CREADO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'ACTUALIZADO DATETIME ON UPDATE CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('ID', TRUE);
		$this->forge->createTable('DELITOS_USUARIOS');
	}

	public function down()
	{
		$this->forge->dropTable('DELITOS_USUARIOS');
	}
}
