<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BIGOTEFORMA extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'BIGOTEFORMAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'BIGOTEFORMADESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('BIGOTEFORMAID', true);
		$this->forge->createTable('BIGOTEFORMA', true);
    }

    public function down()
    {
        $this->forge->dropTable('BIGOTEFORMA', true);
    }
}
