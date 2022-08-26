<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OJOCOLOR extends Migration
{ 
    public function up()
    {
        $this->forge->addField([
			'OJOCOLORID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'OJOCOLORDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('OJOCOLORID', true);
		$this->forge->createTable('OJOCOLOR', true);
    }

    public function down()
    {
        $this->forge->dropTable('OJOCOLOR', true);
    }
}
