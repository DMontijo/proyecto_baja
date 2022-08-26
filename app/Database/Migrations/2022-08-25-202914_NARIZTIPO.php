<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NARIZTIPO extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'NARIZTIPOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'NARIZTIPODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('NARIZTIPOID', true);
		$this->forge->createTable('NARIZTIPO', true);
    }

    public function down()
    {
        $this->forge->dropTable('NARIZTIPO', true);
    }
}
