<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NARIZTAMANO extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'NARIZTAMANOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'NARIZTAMANODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('NARIZTAMANOID', true);
		$this->forge->createTable('NARIZTAMANO', true);
    }

    public function down()
    {
        $this->forge->dropTable('NARIZTAMANO', true);
    }
}
