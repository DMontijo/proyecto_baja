<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class USUARIOS extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
			],
			'NOMBRE' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'APELLIDO_PATERNO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'APELLIDO_MATERNO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'SEXO' => [
				'type' => 'CHAR',
				'constraint' => '1',
			],
			'CORREO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'unique' => TRUE,
			],
			'PASSWORD' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'ROLID' => [
				'type' => 'INT',
			],
			'ZONAID' => [
				'type' => 'INT',
			],
			'MUNICIPIOID' => [
				'type' => 'INT',
				'null' => TRUE,
			],
			'OFICINAID' => [
				'type' => 'INT',
				'null' => TRUE,
			],
			'MUNICIPIOSOFICINASID' => [
				'type' => 'LONGTEXT',
				'null' => TRUE,
			],
			'TOKENVIDEO' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE,
			],
		]);
		$this->forge->addKey('ID', TRUE);
		$this->forge->createTable('USUARIOS');
	}

	public function down()
	{
		$this->forge->dropTable('USUARIOS');
	}
}
