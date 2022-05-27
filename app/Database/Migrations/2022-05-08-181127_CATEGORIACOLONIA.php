<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CATEGORIACOLONIA extends Migration
{
	public function up()
	{

		$this->forge->addField([
			'ID'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
			],
			'COLONIAID'          => [
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
			'ZONA'       => [
				'type'           => 'CHAR',
				'constraint'     => '1',
			],
			'DELEGACIONID'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
			],
			'COLONIADESCR'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '200',
			]
		]);
		$this->forge->addKey('ID', TRUE);
		$this->forge->createTable('CATEGORIA_COLONIA');
	}

	public function down()
	{
		$this->forge->dropTable('CATEGORIA_COLONIA');
	}
}
