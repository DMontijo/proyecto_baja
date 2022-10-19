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
			'TITULO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'DESCRIPCION' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'PLACEHOLDER' => [
				'type' => 'TEXT',
			],
			'TEXTO' => [
				'type' => 'TEXT',
			],
			'PLANTILLAJUSTICIAID' => [
				'type' => 'INT',
				'null' => TRUE,
			],
			'CLASIFICACIONDOCTOID' => [
				'type' => 'INT',
				'null' => TRUE,
			],
		]);
		$this->forge->addKey('ID', TRUE);
		$this->forge->createTable('PLANTILLAS');
	}

	public function down()
	{
		$this->forge->dropTable('PLANTILLAS');
	}
}
