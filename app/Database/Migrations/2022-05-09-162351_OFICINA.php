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
				'unsigned'       => TRUE,
			],
			'OFICINADESCR'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '500',
			],
			'ESTADOID'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
			],
			'MUNICIPIOID'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
			],
		]);
		$this->forge->addKey('OFICINAID', TRUE);
		$this->forge->addKey('MUNICIPIOID', TRUE);
		$this->forge->createTable('OFICINA');
	}

	public function down()
	{
		$this->forge->dropTable('OFICINA');
	}
}
