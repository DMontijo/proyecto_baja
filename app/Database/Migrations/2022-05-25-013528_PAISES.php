<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PAISES extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ID_PAIS'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE,
			],
			'ISO_2'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '2',
			],
			'ISO_3'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '3',
			],
			'NAME'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'PHONE_CODE'       => [
				'type'           => 'INT',
				'constraint'     => '3',
			],
		]);
		$this->forge->addKey('ID_PAIS', TRUE);
		$this->forge->createTable('PAISES', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('PAISES', TRUE);
	}
}
