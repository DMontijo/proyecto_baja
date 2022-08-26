<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CABEZATAMANO extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'CABEZATAMANOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'CABEZATAMANODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('CABEZATAMANOID', true);
		$this->forge->createTable('CABEZATAMANO', true);
    }

    public function down()
    {
        $this->forge->dropTable('CABEZATAMANO', true);
    }

}
