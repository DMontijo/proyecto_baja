<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIOCORRELATIVO extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'CORRELATIVO' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'ESTADOID' => [
				'type' => 'INT',
				'constraint' => '5',
			],
			'MUNICIPIOID' => [
				'type' => 'INT',
				'constraint' => '5',
			],
			'TIPOEXPEDIENTEID' => [
				'type' => 'INT',
				'constraint' => '5',
			],
			'ANO' => [
				'type' => 'INT',
				'constraint' => '4',
			],
		]);

		$this->forge->addKey('TIPOEXPEDIENTEID', TRUE);
		$this->forge->addKey('ESTADOID', TRUE);
		$this->forge->addKey('MUNICIPIOID', TRUE);
		$this->forge->addKey('ANO', TRUE);
		$this->forge->addKey('CORRELATIVO', TRUE);
		$this->forge->createTable('FOLIOCORRELATIVO');
	}

	public function down()
	{
		$this->forge->dropTable('FOLIOCORRELATIVO');
	}
}
