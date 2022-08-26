<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DIENTETIPO extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'DIENTETIPOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'DIENTETIPODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('DIENTETIPOID', true);
		$this->forge->createTable('DIENTETIPO', true);
    }

    public function down()
    {
        $this->forge->dropTable('DIENTETIPO', true);
    }
}
