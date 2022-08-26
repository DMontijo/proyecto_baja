<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NARIZPECULIAR extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'NARIZPECULIARID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'NARIZPECULIARDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('NARIZPECULIARID', true);
		$this->forge->createTable('NARIZPECULIAR', true);
    }

    public function down()
    {
        $this->forge->dropTable('NARIZPECULIAR', true);
    }
}
