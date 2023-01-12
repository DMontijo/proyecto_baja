<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DENUNCIANTES extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'DENUNCIANTEID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'NOMBRE' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE
			],
			'APELLIDO_PATERNO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE
			],
			'APELLIDO_MATERNO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE
			],
			'CORREO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'unique' => TRUE,
				'null' => TRUE
			],
			'PASSWORD' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE
			],
			'FECHANACIMIENTO' => [
				'type' => 'DATE',
				'null' => TRUE
			],
			'SEXO' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'null' => TRUE
			],
			'CODIGOPOSTAL' => [
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
			'ESTADOORIGENID' => [
				'type' => 'INT',
				'null' => TRUE
			],
			'MUNICIPIOID' => [
				'type' => 'INT',
				'null' => TRUE
			],
			'MUNICIPIOORIGENID' => [
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
			'TIPOIDENTIFICACIONID' => [
				'type' => 'VARCHAR',
				'constraint' => '80',
				'null' => TRUE
			],
			'NUMEROIDENTIFICACION' => [
				'type' => 'VARCHAR',
				'constraint' => '80',
				'null' => TRUE
			],
			'ESTADOCIVILID' => [
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => TRUE
			],
			'IDENTIDADGENERO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE
			],
			'DISCAPACIDAD' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE
			],
			'NACIONALIDADID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE
			],
			'ESCOLARIDADID' => [
				'type' => 'INT',
				'null' => TRUE
			],
			'OCUPACIONID' => [
				'type' => 'INT',
				'null' => TRUE
			],
			'OCUPACIONDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
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
				'type' => 'LONGBLOB',
				'null' => TRUE
			],
			'FIRMA' => [
				'type' => 'LONGBLOB',
				'null' => TRUE
			],
			'NOTIFICACIONES' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'S',
				'null' => TRUE
			],
			'LEER' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'S',
				'null' => TRUE
			],
			'ESCRIBIR' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'S',
				'null' => TRUE
			],
			'APOYO' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'N',
				'null' => TRUE
			],
			'TIPO' => [
				'type' => 'TINYINT',
				'constraint' => '1',
				'null' => TRUE
			],
			'MANZANA' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],'LOTE' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('DENUNCIANTEID', TRUE);
		$this->forge->createTable('DENUNCIANTES');
	}

	public function down()
	{
		$this->forge->dropTable('DENUNCIANTES');
	}
}
