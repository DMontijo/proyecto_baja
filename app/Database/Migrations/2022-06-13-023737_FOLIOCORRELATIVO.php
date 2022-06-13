<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIOCORRELATIVO extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
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

		$this->forge->addKey('ID', TRUE);
		$this->forge->createTable('FOLIOCORRELATIVO');
	}

	public function down()
	{
		$this->forge->dropTable('FOLIOCORRELATIVO');
	}
}
