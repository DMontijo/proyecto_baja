<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PIELCOLOR extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'PIELCOLORID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'PIELCOLORDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('PIELCOLORID', true);
		$this->forge->createTable('PIELCOLOR', true);
    }

    public function down()
    {
        $this->forge->dropTable('PIELCOLOR', true);
    }
}
