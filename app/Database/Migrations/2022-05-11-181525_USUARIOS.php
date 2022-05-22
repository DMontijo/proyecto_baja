<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class USUARIOS extends Migration
{
	public function up()
	{

		$this->forge->addField([
			'ID_USUARIO'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE,
			],
			'ID_ROL'       => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
			],
			'ID_ZONA'       => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
			],
			'ID_PERFIL'       => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
			],
			'NOMBRE'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'APELLIDO_PATERNO'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'APELLIDO_MATERNO'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
				'null' => TRUE,
			],
			'SEXO'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '10',
			],
			'CORREO'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'PASSWORD'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'HUELLA_DIGITAL'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'FIRMA_DIGITAL'       => [
				'type'           => 'TEXT',
			],
		]);
		$this->forge->addKey('ID_USUARIO', TRUE);
		$this->forge->createTable('USUARIOS');
	}

	public function down()
	{
		$this->forge->dropTable('USUARIOS');
	}
}
