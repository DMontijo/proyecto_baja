<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIOPERSONAFISIMPDELITO extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'FOLIOID' => [
				'type' => 'VARCHAR',
				'constraint' => '16',
			],
			'PERSONAFISICAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'DELITOMODALIDADID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'DELITOCARACTERISTICAID' => [
				'type' => 'INT',
				'null' => TRUE,
			],
			'TENTATIVA' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'N',
			],
		]);
		$this->forge->addKey('FOLIOID', TRUE);
		$this->forge->addKey('PERSONAFISICAID', TRUE);
		$this->forge->addKey('DELITOMODALIDADID', TRUE);
		$this->forge->createTable('FOLIOPERSONAFISIMPDELITO');
	}

	public function down()
	{
		$this->forge->dropTable('FOLIOPERSONAFISIMPDELITO');
	}
}
