<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OJOPECULIAR extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'OJOPECULIARID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'OJOPECULIARDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('OJOPECULIARID', true);
		$this->forge->createTable('OJOPECULIAR', true);
    }

    public function down()
    {
        $this->forge->dropTable('OJOPECULIAR', true);
    }
}
