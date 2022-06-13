<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIODENUNCIA extends Migration
{
    public function up()
	{
		$this->forge->addField([
			'ID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
			],
			'FOLIOID' => [
				'type' => 'VARCHAR',
				'constraint' => '16',
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
			'COLONIA' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'COLONIADESCR' => [
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
				'type' => 'CHAR',
				'constraint' => '2',
			],
			'DESCRIPCION_BREVE' => [
				'type' => 'VARCHAR',
				'constraint' => '300',
			],
			'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('ID', TRUE);
		$this->forge->createTable('DATOS_DEL_DELITO');
	}

	public function down()
	{
		$this->forge->dropTable('DATOS_DEL_DELITO');
	}
}
