<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LABIOPOSICION extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'LABIOPOSICIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'LABIOPOSICIONDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('LABIOPOSICIONID', true);
		$this->forge->createTable('LABIOPOSICION', true);
    }

    public function down()
    {
        $this->forge->dropTable('LABIOPOSICION', true);
    }
}
