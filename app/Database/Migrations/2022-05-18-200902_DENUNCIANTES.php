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
			'CORREO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'unique' => TRUE,
			],
			'PASSWORD' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'FECHA_DE_NACIMIENTO' => [
				'type' => 'DATE',
			],
			'EDAD' => [
				'type' => 'TINYINT',
			],
			'SEXO' => [
				'type' => 'VARCHAR',
				'constraint' => '6',
			],
			'CODIGO_POSTAL' => [
				'type' => 'INT',
				'constraint' => '10',
				'null' => TRUE
			],
			'PAIS_ID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'ESTADO_ID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'MUNICIPIO_ID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'LOCALIDAD_ID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE
			],
			'COLONIA' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'CALLE' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'NUM_EXT' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
			],
			'NUM_INT' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => TRUE
			],
			'TELEFONO' => [
				'type' => 'VARCHAR',
				'constraint' => '20',
			],
			'TELEFONO2' => [
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => TRUE
			],
			'CODIGO_PAIS' => [
				'type' => 'VARCHAR',
				'constraint' => '3',
			],
			'CODIGO_PAIS2' => [
				'type' => 'VARCHAR',
				'constraint' => '3',
				'null' => TRUE
			],
			'TIPO_DE_IDENTIFICACION' => [
				'type' => 'VARCHAR',
				'constraint' => '80',
			],
			'NUMERO_DE_IDENTIFICACION' => [
				'type' => 'VARCHAR',
				'constraint' => '80',
				'null' => TRUE
			],
			'ESTADO_CIVIL' => [
				'type' => 'VARCHAR',
				'constraint' => '20',
			],
			'OCUPACION' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE
			],
			'IDENTIDAD_DE_GENERO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE
			],
			'DISCAPACIDAD' => [
				'type' => 'VARCHAR',
				'constraint' => '40',
			],
			'NACIONALIDAD_ID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'ESCOLARIDAD' => [
				'type' => 'VARCHAR',
				'constraint' => '30',
			],
			'IDIOMA_ID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'DOCUMENTO' => [
				'type' => 'BLOB',
			],
			'FIRMA' => [
				'type' => 'BLOB',
			],
			'NOTIFICACIONES' => [
				'type' => 'TINYINT',
				'constraint' => '1',
			],
			'CREADO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'ACTUALIZADO DATETIME ON UPDATE CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('ID_DENUNCIANTE', TRUE);
		$this->forge->createTable('DENUNCIANTES');
	}

	public function down()
	{
		$this->forge->dropTable('DENUNCIANTES');
	}
}
