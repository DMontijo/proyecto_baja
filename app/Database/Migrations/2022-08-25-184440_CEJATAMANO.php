<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CEJATAMANO extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'CEJATAMANOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'CEJATAMANODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('CEJATAMANOID', true);
		$this->forge->createTable('CEJATAMANO', true);
    }

    public function down()
    {
        $this->forge->dropTable('CEJATAMANO', true);
    }
}
