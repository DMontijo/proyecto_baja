<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BIGOTETAMANO extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'BIGOTETAMANOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'BIGOTETAMANODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('BIGOTETAMANOID', true);
		$this->forge->createTable('BIGOTETAMANO', true);
    }

    public function down()
    {
        $this->forge->dropTable('BIGOTETAMANO', true);
    }
}
