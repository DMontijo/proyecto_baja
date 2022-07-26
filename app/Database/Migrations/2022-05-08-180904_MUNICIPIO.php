<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MUNICIPIO extends Migration
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
		$this->forge->createTable('MUNICIPIO');
	}

	public function down()
	{
		$this->forge->dropTable('MUNICIPIO');
	}
}
