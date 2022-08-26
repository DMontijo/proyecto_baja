<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CUELLOGROSOR extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'CUELLOGROSORID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'CUELLOGROSORDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('CUELLOGROSORID', true);
		$this->forge->createTable('CUELLOGROSOR', true);
    }

    public function down()
    {
        $this->forge->dropTable('CUELLOGROSOR', true);
    }
}
