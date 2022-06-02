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
			],
			'APE_PATERNO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'APE_MATERNO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'PAIS' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
			'ESTADO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
			'MUNICIPIO' => [
				'type' => 'VARCHAR',
                'constraint' => '100',
			],
			'CALLE' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'NO_EXTERIOR' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
			],
			'NO_INTERIOR' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
			],
            'CP' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
			],
            'FECHA_NACIMIENTO' => [
				'type' => 'DATE',
			],
            'EDAD' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
			],

			'CREADO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'ACTUALIZADO DATETIME ON UPDATE CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('ID_ACOMPANANTE', TRUE);
		$this->forge->createTable('DATOS_ADULTO_ACOMPANANTE');
	}

	public function down()
	{
		$this->forge->dropTable('DATOS_ADULTO_ACOMPANANTE');
	}
}
