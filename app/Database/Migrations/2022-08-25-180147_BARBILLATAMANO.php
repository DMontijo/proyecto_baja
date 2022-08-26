<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BARBILLATAMANO extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'BARBILLATAMANOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'BARBILLATAMANODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('BARBILLATAMANOID', true);
		$this->forge->createTable('BARBILLATAMANO', true);
    }

    public function down()
    {
        $this->forge->dropTable('BARBILLATAMANO', true);
    }
}
