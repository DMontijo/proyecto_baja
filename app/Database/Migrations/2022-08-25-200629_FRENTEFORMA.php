<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FRENTEFORMA extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'FRENTEFORMAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'FRENTEFORMADESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('FRENTEFORMAID', true);
		$this->forge->createTable('FRENTEFORMA', true);
    }

    public function down()
    {
        $this->forge->dropTable('FRENTEFORMA', true);
    }
}
