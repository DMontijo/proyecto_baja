<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ROLESPERMISOS extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ROLID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'PERMISOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'FECHA DATETIME DEFAULT CURRENT_TIMESTAMP',
		]);

		$this->forge->addKey('ROLID', TRUE);
		$this->forge->addKey('PERMISOID', TRUE);

		$this->forge->createTable('ROLESPERMISOS');
	}

	public function down()
	{
		$this->forge->dropTable('ROLESPERMISOS');
	}
}
