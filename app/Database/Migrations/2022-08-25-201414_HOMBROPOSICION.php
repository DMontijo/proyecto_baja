<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HOMBROPOSICION extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'HOMBROPOSICIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'HOMBROPOSICIONDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('HOMBROPOSICIONID', true);
		$this->forge->createTable('HOMBROPOSICION', true);
    }

    public function down()
    {
        $this->forge->dropTable('HOMBROPOSICION', true);
    }
}
