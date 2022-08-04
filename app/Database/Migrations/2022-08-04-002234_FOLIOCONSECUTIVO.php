<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIOCONSECUTIVO extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ANO' => [
				'type' => 'INT',
				'constraint' => '4',
				'unsigned' => TRUE,
			],
			'CONSECUTIVO' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
		]);
		$this->forge->addKey('ANO', TRUE);
		$this->forge->createTable('FOLIOCONSECUTIVO');
	}

	public function down()
	{
		$this->forge->dropTable('FOLIOCONSECUTIVO');
	}
}
