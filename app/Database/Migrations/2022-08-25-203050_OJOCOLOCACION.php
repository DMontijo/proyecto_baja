<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OJOCOLOCACION extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'OJOCOLOCACIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'OJOCOLOCACIONDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('OJOCOLOCACIONID', true);
		$this->forge->createTable('OJOCOLOCACION', true);
    }

    public function down()
    {
        $this->forge->dropTable('OJOCOLOCACION', true);
    }
}
