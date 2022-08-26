<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HOMBROGROSOR extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'HOMBROGROSORID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'HOMBROGROSORDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('HOMBROGROSORID', true);
		$this->forge->createTable('HOMBROGROSOR', true);
    }

    public function down()
    {
        $this->forge->dropTable('HOMBROGROSOR', true);
    }
}
