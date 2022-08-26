<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OJOFORMA extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'OJOFORMAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'OJOFORMADESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('OJOFORMAID', true);
		$this->forge->createTable('OJOFORMA', true);
    }

    public function down()
    {
        $this->forge->dropTable('OJOFORMA', true);
    }
}
