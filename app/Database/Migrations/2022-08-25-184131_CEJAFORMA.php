<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CEJAFORMA extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'CEJAFORMAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'CEJAFORMADESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('CEJAFORMAID', true);
		$this->forge->createTable('CEJAFORMA', true);
    }

    public function down()
    {
        $this->forge->dropTable('CEJAFORMA', true);
    }
}
