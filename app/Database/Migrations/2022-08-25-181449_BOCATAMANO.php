<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BOCATAMANO extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'BOCATAMANOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'BOCATAMANODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('BOCATAMANOID', true);
		$this->forge->createTable('BOCATAMANO', true);
    }

    public function down()
    {
        $this->forge->dropTable('BOCATAMANO', true);
    }
}
