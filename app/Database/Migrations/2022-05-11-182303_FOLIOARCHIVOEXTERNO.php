<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIOARCHIVOEXTERNO extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'FOLIOID' => [
				'type' => 'VARCHAR',
				'constraint' => '16',
			],
			'FOLIOARCHIVOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'ARCHIVODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '200',
				'null' => TRUE,
			],
			'CLASIFICACIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'ARCHIVO' => [
				'type' => 'TEXT',
				'null' => TRUE,
			],
			'EXTENSION' => [
				'type' => 'VARCHAR',
				'constraint' => '5',
				'null' => TRUE,
			],
			'FECHAACTUALIZACION' => [
				'type' => 'DATE',
				'null' => TRUE,
			],
			'AUTOR' => [
				'type' => 'INT',
				'null' => TRUE,
			],
			'OFICINAIDAUTOR' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'CLASIFICACIONDOCTOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'ESTADOACCESO' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'M',
				'null' => TRUE,
			],
			'PUBLICADO' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'N',
				'null' => TRUE,
			],
			'RUTAALMACENAMIENTOID' => [
				'type' => 'INT',
				'null' => TRUE,
			],
			'STATUSALMACENID' => [
				'type' => 'INT',
				'null' => TRUE,
			],
			'EXPORTAR' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => TRUE,
			],
		]);
		$this->forge->addKey('FOLIOID', TRUE);
		$this->forge->addKey('FOLIOARCHIVOID', TRUE);
		$this->forge->createTable('FOLIOARCHIVOEXTERNO');
	}

	public function down()
	{
		$this->forge->dropTable('FOLIOARCHIVOEXTERNO');
	}
}
