<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CATEGORIALOCALIDAD extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ID'          => [
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
			'LOCALIDADID'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
			],
			'LOCALIDADDESCR'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'ZONA'       => [
				'type'           => 'CHAR',
				'constraint'     => '1',
				'null' => TRUE,
			],
			'LOCALIDADIDEXTERNO'       => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
				'null' => TRUE,
			]
		]);
		$this->forge->addKey('ID', TRUE);
		$this->forge->createTable('CATEGORIA_LOCALIDAD');
	}

	public function down()
	{
		$this->forge->dropTable('CATEGORIA_LOCALIDAD');
	}
}
