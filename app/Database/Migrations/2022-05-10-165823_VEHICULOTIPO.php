<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VEHICULOTIPO extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'VEHICULOTIPOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'VEHICULOTIPODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
		]);
		$this->forge->addKey('VEHICULOTIPOID', TRUE);
		$this->forge->createTable('VEHICULOTIPO');
	}

	public function down()
	{
		$this->forge->dropTable('VEHICULOTIPO');
	}
}
