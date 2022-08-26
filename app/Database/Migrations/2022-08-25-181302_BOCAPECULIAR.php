<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BOCAPECULIAR extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'BOCAPECULIARID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'BOCAPECULIARDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('BOCAPECULIARID', true);
		$this->forge->createTable('BOCAPECULIAR', true);
    }

    public function down()
    {
        $this->forge->dropTable('BOCAPECULIAR', true);
    }
}
