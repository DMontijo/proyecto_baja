<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIOVEHICULO extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'FOLIOID' => [
				'type' => 'VARCHAR',
				'constraint' => '16',
			],
			'VEHICULOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'SITUACION' => [
				'type' => 'INT',
				'constraint' => '2',
				'null' => TRUE,
			],
			'TIPOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'MARCAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'MARCADESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'MODELOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'MODELODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'ANO' => [
				'type' => 'INT',
				'constraint' => '4',
				'null' => TRUE,
			],
			'PLACAS' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => TRUE,
			],
			'NUMEROSERIE' => [
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => TRUE,
			],
			'NUMEROMOTOR' => [
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => TRUE,
			],
			'NUMEROCHASIS' => [
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => TRUE,
			],
			'TRANSMISION' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'null' => TRUE,
			],
			'TRACCION' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'null' => TRUE,
			],
			'PRIMERCOLORID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'SEGUNDOCOLORID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'SENASPARTICULARES' => [
				'type' => 'VARCHAR',
				'constraint' => '500',
				'null' => TRUE,
			],
			'PERSONAFISICAIDPROPIETARIO' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'PERSONAMORALIDPROPIETARIO' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'FOTO' => [
				'type' => 'BLOB',
				'null' => TRUE,
			],
			'DOCUMENTO' => [
				'type' => 'BLOB',
				'null' => TRUE,
			],
			'PARTICIPAESTADO' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'N',
				'null' => TRUE,
			],
			'TIPOPLACA' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'null' => TRUE,
			],
			'ESTADOIDPLACA' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'ESTADOEXTRANJEROIDPLACA' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'VEHICULODISTRIBUIDORID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'VEHICULOVERSIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'VEHICULOSERVICIOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'VEHICULOSTATUSID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'PROVIENEPADRON' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'null' => TRUE,
				'null' => TRUE,
			],
			'SEGUROVIGENTE' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'null' => TRUE,
			],
			'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('FOLIOID', TRUE);
		$this->forge->addKey('VEHICULOID', TRUE);
		$this->forge->createTable('FOLIOVEHICULO');
	}

	public function down()
	{
		$this->forge->dropTable('FOLIOVEHICULO');
	}
}
