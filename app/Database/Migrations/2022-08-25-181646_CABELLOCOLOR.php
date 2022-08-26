<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CABELLOCOLOR extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'CABELLOCOLORID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'CABELLOCOLORDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('CABELLOCOLORID', true);
		$this->forge->createTable('CABELLOCOLOR', true);
    }

    public function down()
    {
        $this->forge->dropTable('CABELLOCOLOR', true);
    }
}
