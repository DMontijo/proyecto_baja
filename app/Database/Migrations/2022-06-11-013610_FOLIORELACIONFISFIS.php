<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIORELACIONFISFIS extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'FOLIOID' => [
				'type' => 'VARCHAR',
				'constraint' => '16',
			],
			'PERSONAFISICAIDVICTIMA' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'DELITOMODALIDADID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'PERSONAFISICAIDIMPUTADO' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'GRADOPARTICIPACIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
			'TENTATIVA' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'N',
			],
			'CONVIOLENCIA' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'null' => TRUE,
			]
		]);

		$this->forge->addKey('FOLIOID', TRUE);
		$this->forge->addKey('PERSONAFISICAIDVICTIMA', TRUE);
		$this->forge->addKey('DELITOMODALIDADID', TRUE);
		$this->forge->addKey('PERSONAFISICAIDIMPUTADO', TRUE);
		$this->forge->createTable('FOLIORELACIONFISFIS');
	}

	public function down()
	{
		$this->forge->dropTable('FOLIORELACIONFISFIS');
	}
}
