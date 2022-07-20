<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIO extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'FOLIOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
			],
			'ANO' => [
				'type' => 'INT',
				'constraint' => '4',
			],
			'EXPEDIENTEID' => [
				'type' => 'VARCHAR',
				'constraint' => '16',
				'null' => TRUE,
			],
			'DENUNCIANTEID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'AGENTEATENCIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'AGENTEFIRMAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'STATUS' => [
				'type' => 'VARCHAR',
				'constraint' => '200',
				'default' => 'ABIERTO',
			],
			'NOTASAGENTE' => [
				'type' => 'TEXT',
				'constraint' => '300',
				'null' => TRUE,
			],
			'HECHODELITO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'HECHOMEDIOCONOCIMIENTOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'HECHOFECHA' => [
				'type' => 'DATE',
				'null' => TRUE,
			],
			'HECHOHORA' => [
				'type' => 'TIME',
				'null' => TRUE,
			],
			'HECHOLUGARID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'HECHOESTADOID' => [
				'type' => 'INT',
				'null' => TRUE,
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'HECHOMUNICIPIOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'HECHOLOCALIDADID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'HECHODELEGACIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'HECHOZONA' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'null' => TRUE,
			],
			'HECHOCOLONIAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'HECHOCOLONIADESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'HECHOCALLE' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'HECHONUMEROCASA' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => TRUE,
			],
			'HECHONUMEROCASAINT' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => TRUE,
			],
			'HECHOREFERENCIA' => [
				'type' => 'TEXT',
				'constraint' => '300',
				'null' => TRUE,
			],
			'HECHONARRACION' => [
				'type' => 'TEXT',
				'null' => TRUE,
			],
			'HECHOCOORDENADAX' => [
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => TRUE,
			],
			'HECHOCOORDENADAY' => [
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => TRUE,
			],
			'DERECHOS' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'S'
			],
			'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('FOLIOID', TRUE);
		$this->forge->addKey('ANO', TRUE);
		$this->forge->createTable('FOLIO');
	}

	public function down()
	{
		$this->forge->dropTable('FOLIO');
	}
}
