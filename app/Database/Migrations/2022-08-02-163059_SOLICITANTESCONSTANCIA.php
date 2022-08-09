<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SOLICITANTESCONSTANCIA extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'SOLICITANTEID' => [
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
			'FECHANACIMIENTO' => [
				'type' => 'DATE',
			],
			'SEXO' => [
				'type' => 'CHAR',
				'constraint' => '1',
			],
			'TELEFONO' => [
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => TRUE
			],
			'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('SOLICITANTEID', TRUE);
		$this->forge->createTable('SOLICITANTESCONSTANCIA');
	}

	public function down()
	{
		$this->forge->dropTable('DENUNCIANTES');
	}
}
