<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OREJALOBULO extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'OREJALOBULOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'OREJALOBULODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('OREJALOBULOID', true);
		$this->forge->createTable('OREJALOBULO', true);
    }

    public function down()
    {
        $this->forge->dropTable('OREJALOBULO', true);
    }
}
