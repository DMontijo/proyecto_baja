<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PERMISOS extends Migration
{
    public function up()
	{
		$this->forge->addField([
			'PERMISOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'PERMISODESCR' => [
				'type' => 'VARCHAR',
                'constraint'=>'100'
    			],
		]);

		$this->forge->addKey('PERMISOID', TRUE);

		$this->forge->createTable('PERMISOS');
	}

	public function down()
	{
		$this->forge->dropTable('PERMISOS');
	}
}
