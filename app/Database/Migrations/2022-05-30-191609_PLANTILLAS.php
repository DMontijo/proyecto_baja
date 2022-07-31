<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PLANTILLAS extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'DESCRIPCION' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'TITULO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'PLACEHOLDER' => [
				'type' => 'TEXT',
			],
			'TEXTO' => [
				'type' => 'TEXT',
			]
		]);
		$this->forge->addKey('ID', TRUE);
		$this->forge->createTable('PLANTILLAS');
	}

	public function down()
	{
		$this->forge->dropTable('PLANTILLAS');
	}
}
