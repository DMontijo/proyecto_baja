<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OREJAFORMA extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'OREJAFORMAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'OREJAFORMADESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('OREJAFORMAID', true);
		$this->forge->createTable('OREJAFORMA', true);
    }

    public function down()
    {
        $this->forge->dropTable('OREJAFORMA', true);
    }
}
