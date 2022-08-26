<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PERSONAETNIA extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'PERSONAETNIAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'PERSONAETNIADESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('PERSONAETNIAID', true);
		$this->forge->createTable('PERSONAETNIA', true);
    }

    public function down()
    {
        $this->forge->dropTable('PERSONAETNIA', true);
    }
}
