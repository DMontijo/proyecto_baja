<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TIPOVIVIENDA extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'TIPOVIVIENDAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'TIPOVIVIENDADESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
		]);
		$this->forge->addKey('TIPOVIVIENDAID', TRUE);
		$this->forge->createTable('TIPOVIVIENDA');
	}

	public function down()
	{
		$this->forge->dropTable('TIPOVIVIENDA');
	}
}
