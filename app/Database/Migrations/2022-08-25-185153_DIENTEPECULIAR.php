<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DIENTEPECULIAR extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'DIENTEPECULIARID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'DIENTEPECULIARDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('DIENTEPECULIARID', true);
		$this->forge->createTable('DIENTEPECULIAR', true);
    }

    public function down()
    {
        $this->forge->dropTable('DIENTEPECULIAR', true);
    }
}
