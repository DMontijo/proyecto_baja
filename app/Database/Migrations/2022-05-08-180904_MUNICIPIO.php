<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MUNICIPIO extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ESTADOID' => [
				'type' => 'INT',
				'unsigned' => TRUE
			],
			'MUNICIPIOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'MUNICIPIODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
		]);
		$this->forge->addKey('ESTADOID', TRUE);
		$this->forge->addKey('MUNICIPIOID', TRUE);
		$this->forge->createTable('MUNICIPIO');
	}

	public function down()
	{
		$this->forge->dropTable('MUNICIPIO');
	}
}
