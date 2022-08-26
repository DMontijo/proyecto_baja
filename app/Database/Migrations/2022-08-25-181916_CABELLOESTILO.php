<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CABELLOESTILO extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'CABELLOESTILOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'CABELLOESTILODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('CABELLOESTILOID', true);
		$this->forge->createTable('CABELLOESTILO', true);
    }

    public function down()
    {
        $this->forge->dropTable('CABELLOESTILO', true);
    }
}
