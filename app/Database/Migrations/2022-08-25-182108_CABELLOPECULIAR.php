<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CABELLOPECULIAR extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'CABELLOPECULIARID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'CABELLOPECULIARDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('CABELLOPECULIARID', true);
		$this->forge->createTable('CABELLOPECULIAR', true);
    }

    public function down()
    {
        $this->forge->dropTable('CABELLOPECULIAR', true);
    }
}
