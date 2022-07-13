<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ROLESPERMISOS extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'ROLID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'PERMISO' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'FECHA DATETIME DEFAULT CURRENT_TIMESTAMP',
		]);

		$this->forge->addKey('ID', TRUE);
		$this->forge->createTable('ROLESPERMISOS');
	}

	public function down()
	{
		$this->forge->dropTable('ROLESPERMISOS');
	}
}
