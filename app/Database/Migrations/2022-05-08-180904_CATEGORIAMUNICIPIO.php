<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CATEGORIAMUNICIPIO extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ID'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
			],
			'MUNICIPIOID'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
			],
			'MUNICIPIODESCR'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'ESTADOID'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE
			],
			'SECUENCIAEXPEDIENTE'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE
			],
		]);
		$this->forge->addKey('ID', TRUE);
		$this->forge->createTable('CATEGORIA_MUNICIPIO');
	}

	public function down()
	{
		$this->forge->dropTable('CATEGORIA_MUNICIPIO');
	}
}
