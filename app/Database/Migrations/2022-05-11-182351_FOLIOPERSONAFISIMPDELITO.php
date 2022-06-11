<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIOPERSONAFISIMPDELITO extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
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
		$this->forge->addKey('ID', TRUE);
		$this->forge->createTable('FOLIOPERSONAFISIMPDELITO');
	}

	public function down()
	{
		$this->forge->dropTable('FOLIOPERSONAFISIMPDELITO');
	}
}
