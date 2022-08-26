<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CEJAGROSOR extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'CEJAGROSORID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'CEJAGROSORDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('CEJAGROSORID', true);
		$this->forge->createTable('CEJAGROSOR', true);
    }

    public function down()
    {
        $this->forge->dropTable('CEJAGROSOR', true);
    }
}
