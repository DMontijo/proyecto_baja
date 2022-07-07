<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CONEXIONESDB extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'TYPE' => [
				'type'       => 'ENUM',
				'constraint' => ['development', 'production'],
				'default'    => 'development',
			],
			'ESTADOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'default'    => 2,
			],
			'MUNICIPIOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'USER' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
			],
			'PASSWORD' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
			],
			'IP' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
			],
			'INSTANCE' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
			],
			'SCHEMA' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
			],
		]);

		$this->forge->addKey('ID', true);
		$this->forge->createTable('CONEXIONESDB', true);
	}

	public function down()
	{
		$this->forge->dropTable('CONEXIONESDB', true);
	}
}
