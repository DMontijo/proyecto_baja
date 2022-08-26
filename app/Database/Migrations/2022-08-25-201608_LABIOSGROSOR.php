<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LABIOSGROSOR extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'LABIOGROSORID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'LABIOGROSORDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('LABIOGROSORID', true);
		$this->forge->createTable('LABIOGROSOR', true);
    }

    public function down()
    {
        $this->forge->dropTable('LABIOGROSOR', true);
    }
}
