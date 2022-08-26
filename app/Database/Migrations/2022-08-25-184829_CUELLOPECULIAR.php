<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CUELLOPECULIAR extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'CUELLOPECULIARID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'CUELLOPECULIARDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('CUELLOPECULIARID', true);
		$this->forge->createTable('CUELLOPECULIAR', true);
    }

    public function down()
    {
        $this->forge->dropTable('CUELLOPECULIAR', true);
    }
}
