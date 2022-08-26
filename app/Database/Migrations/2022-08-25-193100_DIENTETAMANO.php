<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DIENTETAMANO extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'DIENTETAMANOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'DIENTETAMANODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('DIENTETAMANOID', true);
		$this->forge->createTable('DIENTETAMANO', true);
    }

    public function down()
    {
        $this->forge->dropTable('DIENTETAMANO', true);
    }
}
