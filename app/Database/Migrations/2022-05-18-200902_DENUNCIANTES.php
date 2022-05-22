<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DENUNCIANTES extends Migration
{
	public function up()
	{

		$this->forge->addField([
			'ID_DENUNCIANTE' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
				'unique' => TRUE,
				'null' => FALSE
			],
			'NOMBRE' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => FALSE
			],
			'APELLIDO_PATERNO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => FALSE
			],
			'APELLIDO_MATERNO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'CORREO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'unique' => TRUE,
				'null' => FALSE,
			],
			'PASSWORD' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => FALSE
			],
			'CREADO' => [
				'type' => 'DATETIME',
				'null' => TRUE
			],
			'ACTUALIZADO' => [
				'type' => 'DATETIME',
				'null' => TRUE
			],
			'ELIMINADO' => [
				'type' => 'DATETIME',
				'null' => TRUE
			],
		]);
		$this->forge->addKey('ID_DENUNCIANTE', TRUE);
		$this->forge->createTable('DENUNCIANTES');
	}

	public function down()
	{
		$this->forge->dropTable('DENUNCIANTES');
	}
}
