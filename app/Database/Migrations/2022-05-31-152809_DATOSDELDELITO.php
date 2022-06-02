<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DATOSDELDELITO extends Migration
{
    public function up()
	{

		$this->forge->addField([
			'ID_DELITO' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
				'unique' => TRUE,
			],
			'DELITO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
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
				'null' => TRUE,
			],
			'COLONIA' => [
				'type' => 'VARCHAR',
                'constraint' => '100',
			],
			'LUGAR' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'CLASIFICACION' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'FECHA' => [
				'type' => 'DATE',
			],
			'HORA' => [
				'type' => 'TIME',
			],
			'RESPONSABLE' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
			'CREADO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'ACTUALIZADO DATETIME ON UPDATE CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('ID_DELITO', TRUE);
		$this->forge->createTable('DATOS_DEL_DELITO');
	}

	public function down()
	{
		$this->forge->dropTable('DATOS_DEL_DELITO');
	}
}
