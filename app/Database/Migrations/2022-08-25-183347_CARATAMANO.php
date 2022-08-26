<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CARATAMANO extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'CARATAMANOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'CARATAMANODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('CARATAMANOID', true);
		$this->forge->createTable('CARATAMANO', true);
    }

    public function down()
    {
        $this->forge->dropTable('CARATAMANO', true);
    }
}
