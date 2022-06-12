<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DATOSADULTOACOMPANANTE extends Migration
{
    public function up()
	{

		$this->forge->addField([
			'ID_ACOMPANANTE' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
				'unique' => TRUE,
			],
			'NOMBRE' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'APE_PATERNO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'APE_MATERNO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'PAIS' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'ESTADO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'MUNICIPIO' => [
				'type' => 'VARCHAR',
                'constraint' => '100',
				'null' => TRUE,
			],
			'CALLE' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'NO_EXTERIOR' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => TRUE,
			],
			'NO_INTERIOR' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => TRUE,
			],
            'CP' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => TRUE,
			],
            'FECHA_NACIMIENTO' => [
				'type' => 'DATE',
				'null' => TRUE,
			],
            'EDAD' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => TRUE,
			],

			'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('ID_ACOMPANANTE', TRUE);
		$this->forge->createTable('DATOS_ADULTO_ACOMPANANTE');
	}

	public function down()
	{
		$this->forge->dropTable('DATOS_ADULTO_ACOMPANANTE');
	}
}
