<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CUELLOTAMANO extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'CUELLOTAMANOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'CUELLOTAMANODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('CUELLOTAMANOID', true);
		$this->forge->createTable('CUELLOTAMANO', true);
    }

    public function down()
    {
        $this->forge->dropTable('CUELLOTAMANO', true);
    }
}
