<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CARATEZ extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'CARATEZID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'CARATEZDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('CARATEZID', true);
		$this->forge->createTable('CARATEZ', true);
    }

    public function down()
    {
        $this->forge->dropTable('CARATEZ', true);
    }
}
