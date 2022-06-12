<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIOOBJETO extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'FOLIOID' => [
				'type' => 'VARCHAR',
				'constraint' => '16',
			],
			'OBJETOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'SITUACION' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'null' => TRUE,
			],
			'CLASIFICACIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'SUBCLASIFICACIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'MARCA' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'NUMEROSERIE' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'CANTIDAD' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'VALOR' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'TIPOMONEDAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'DESCRIPCION' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'DESCRIPCIONDETALLADA' => [
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
				'type' => 'TEXT',
				'null' => TRUE,
			],
			'PARTICIPAESTADO' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'N',
				'null' => TRUE,
			],
			'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('ID', TRUE);
		$this->forge->createTable('FOLIOOBJETO');
	}

	public function down()
	{
		$this->forge->dropTable('FOLIOOBJETO');
	}
}
