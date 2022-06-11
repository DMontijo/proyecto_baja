<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PERSONACALIDADJURIDICA extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'PERSONACALIDADJURIDICAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'PERSONACALIDADJURIDICADESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'COMPORTAMIENTO' => [
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => TRUE,
			],
		]);
		$this->forge->addKey('PERSONACALIDADJURIDICAID', TRUE);
		$this->forge->createTable('PERSONACALIDADJURIDICA');
	}

	public function down()
	{
		$this->forge->dropTable('PERSONACALIDADJURIDICA');
	}
}
