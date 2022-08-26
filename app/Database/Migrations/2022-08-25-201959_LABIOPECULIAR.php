<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LABIOPECULIAR extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'LABIOPECULIARID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'LABIOPECULIARDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('LABIOPECULIARID', true);
		$this->forge->createTable('LABIOPECULIAR', true);
    }

    public function down()
    {
        $this->forge->dropTable('LABIOPECULIAR', true);
    }
}
