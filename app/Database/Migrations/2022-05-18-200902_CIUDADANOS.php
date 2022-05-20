<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CIUDADANOS extends Migration
{
	public function up()
	{

		$this->forge->addField([
			'ID' => [
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
			'PERFIL' => [
				'type' => 'ENUM',
				'constraint' => ['ciudadano', 'admin'],
				'default' => 'ciudadano',
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
		$this->forge->addKey('ID', TRUE);
		$this->forge->createTable('CIUDADANOS');
	}

	public function down()
	{
		$this->forge->dropTable('CIUDADANOS');
	}
}
