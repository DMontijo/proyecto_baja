<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CABEZAFORMA extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'CABEZAFORMAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'CABEZAFORMADESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('CABEZAFORMAID', true);
		$this->forge->createTable('CABEZAFORMA', true);
    }

    public function down()
    {
        $this->forge->dropTable('CABEZAFORMA', true);
    }
}
