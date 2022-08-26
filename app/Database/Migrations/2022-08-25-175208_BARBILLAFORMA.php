<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BARBILLAFORMA extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'BARBILLAFORMAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'BARBILLAFORMADESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('BARBILLAFORMAID', true);
		$this->forge->createTable('BARBILLAFORMA', true);
    }

    public function down()
    {
        $this->forge->dropTable('BARBILLAFORMA', true);

    }
}
