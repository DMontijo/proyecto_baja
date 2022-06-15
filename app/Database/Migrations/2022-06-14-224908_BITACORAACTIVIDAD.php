<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BITACORAACTIVIDAD extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'USUARIOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'ACCION' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'NOTAS' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'FECHA DATETIME DEFAULT CURRENT_TIMESTAMP',
		]);

		$this->forge->addKey('ID', TRUE);
		$this->forge->createTable('BITACORAACTIVIDAD');
	}

	public function down()
	{
		$this->forge->dropTable('BITACORAACTIVIDAD');
	}
}
