<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OFICINA extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'OFICINAID'          => [
				'type'           => 'INT',
				// 'auto_increment' => TRUE,
				'unsigned'       => TRUE,
			],
			'OFICINADESCR'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '500',
			],
			'INSTITUCIONID'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
			],
			'ESTADOID'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
			],
			'MUNICIPIOID'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
			],
			'OFICINATIPOID'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
			],
			'LOCALIDADID'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
				'null' => TRUE,
			],
			'DOMICILIO'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '500',
			],
			'TELEFONO'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '200',
			],
			'INICIADENUNCIAENATENCIU'       => [
				'type'           => 'CHAR',
				'constraint'     => '1',
				'null' => TRUE,
			],
			'ABREVIATURA'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
			],
			'ASIGNASECUENCIAL'       => [
				'type'           => 'CHAR',
				'constraint'     => '1',
				'null' => TRUE,
			],
			'AGENDARALASIGNAR'       => [
				'type'           => 'CHAR',
				'constraint'     => '1',
				'null' => TRUE,
			],
			'COORDINACIONID'       => [
				'type'           => 'INT',
				'null' => TRUE,
				'unsigned'       => TRUE,
			],
			'REASIGNARENCAMBIOTURNO'       => [
				'type'           => 'CHAR',
				'default' => 'N',
				'constraint'     => '1',
				'null' => TRUE,
			],
			'TIPOCAMBIOTURNO'       => [
				'type'           => 'CHAR',
				'constraint'     => '1',
				'null' => TRUE,
			],
			'AUTENTIFICARCONHUELLA'       => [
				'type'           => 'CHAR',
				'constraint'     => '1',
				'null' => TRUE,
			],
		]);
		$this->forge->addKey('OFICINAID', TRUE);
		// $this->forge->addForeignKey('INSTITUCIONID', '', '');
        // $this->forge->addForeignKey('OFICINATIPOID', '', '');
        // $this->forge->addForeignKey('COORDINACIONID', '', '');
		// $this->forge->addForeignKey('ESTADOID', 'CATEGORIA_ESTADO', 'ESTADOID');
		// $this->forge->addForeignKey('MUNICIPIOID', 'CATEGORIA_MUNICIPIO', 'MUNICIPIOID');
		// $this->forge->addForeignKey('LOCALIDADID', 'CATEGORIA_LOCALIDAD', 'LOCALIDADID');
		$this->forge->createTable('OFICINA');
	}

	public function down()
	{
		$this->forge->dropTable('OFICINA');
	}
}
