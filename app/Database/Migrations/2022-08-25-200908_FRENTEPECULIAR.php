<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FRENTEPECULIAR extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'FRENTEPECULIARID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'FRENTEPECULIARDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('FRENTEPECULIARID', true);
		$this->forge->createTable('FRENTEPECULIAR', true);
    }

    public function down()
    {
        $this->forge->dropTable('FRENTEPECULIAR', true);
    }
}
