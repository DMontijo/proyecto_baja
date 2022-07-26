<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DELITOSVIDEODENUNCIA extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ID'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			],
			'DELITO'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '250',
			],
			'IMPORTANCIA'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '1',
			],
			'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('ID', TRUE);
		$this->forge->createTable('DELITOSVIDEODENUNCIA');
	}

	public function down()
	{
		$this->forge->dropTable('DELITOSVIDEODENUNCIA');
	}
}
