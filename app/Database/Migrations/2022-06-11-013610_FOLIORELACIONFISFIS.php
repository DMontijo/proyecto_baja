<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIORELACIONFISFIS extends Migration
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

		$this->forge->addKey('ID', TRUE);
		$this->forge->createTable('FOLIORELACIONFISFIS');
	}

	public function down()
	{
		$this->forge->dropTable('FOLIORELACIONFISFIS');
	}
}
