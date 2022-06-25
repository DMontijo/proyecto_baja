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
				'type' => 'CHAR',
				'constraint' => '1',
			],
			'CODIGO_POSTAL' => [
				'type' => 'INT',
				'constraint' => '10',
				'null' => TRUE
			],
			'PAIS' => [
				'type' => 'CHAR',
				'constraint' => '2',
				'null' => TRUE
			],
			'ESTADOID' => [
				'type' => 'INT',
				'null' => TRUE
			],
			'MUNICIPIOID' => [
				'type' => 'INT',
				'null' => TRUE
			],
			'LOCALIDADID' => [
				'type' => 'INT',
				'null' => TRUE
			],
			'COLONIAID' => [
				'type' => 'INT',
				'null' => TRUE
			],
			'COLONIA' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE
			],
			'CALLE' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE
			],
			'NUM_EXT' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => TRUE
			],
			'NUM_INT' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => TRUE
			],
			'TELEFONO' => [
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => TRUE
			],
			'TELEFONO2' => [
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => TRUE
			],
			'CODIGO_PAIS' => [
				'type' => 'VARCHAR',
				'constraint' => '3',
				'null' => TRUE
			],
			'CODIGO_PAIS2' => [
				'type' => 'VARCHAR',
				'constraint' => '3',
				'null' => TRUE
			],
			'TIPO_DE_IDENTIFICACION' => [
				'type' => 'VARCHAR',
				'constraint' => '80',
				'null' => TRUE
			],
			'NUMERO_DE_IDENTIFICACION' => [
				'type' => 'VARCHAR',
				'constraint' => '80',
				'null' => TRUE
			],
			'ESTADO_CIVIL' => [
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => TRUE
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
				'constraint' => '100',
				'null' => TRUE
			],
			'NACIONALIDAD_ID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'ESCOLARIDAD' => [
				'type' => 'VARCHAR',
				'constraint' => '30',
				'null' => TRUE
			],
			'FACEBOOK' => [
				'type' => 'VARCHAR',
				'constraint' => '250',
				'null' => TRUE
			],
			'INSTAGRAM' => [
				'type' => 'VARCHAR',
				'constraint' => '250',
				'null' => TRUE
			],
			'TWITTER' => [
				'type' => 'VARCHAR',
				'constraint' => '250',
				'null' => TRUE
			],
			'IDIOMAID' => [
				'type' => 'INT',
				'null' => TRUE
			],
			'DOCUMENTO' => [
				'type' => 'BLOB',
				'null' => TRUE
			],
			'FIRMA' => [
				'type' => 'BLOB',
				'null' => TRUE
			],
			'NOTIFICACIONES' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'S',
			],
			'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('ID_DENUNCIANTE', TRUE);
		$this->forge->createTable('DENUNCIANTES');
	}

	public function down()
	{
		$this->forge->dropTable('DENUNCIANTES');
	}
}
