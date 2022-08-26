<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OJOTAMANO extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'OJOTAMANOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'OJOTAMANODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('OJOTAMANOID', true);
		$this->forge->createTable('OJOTAMANO', true);
    }

    public function down()
    {
        $this->forge->dropTable('OJOTAMANO', true);
    }
}
