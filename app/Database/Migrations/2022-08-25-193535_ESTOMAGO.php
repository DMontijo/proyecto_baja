<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ESTOMAGO extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'ESTOMAGOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'ESTOMAGODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('ESTOMAGOID', true);
		$this->forge->createTable('ESTOMAGO', true);
    }

    public function down()
    {
        $this->forge->dropTable('ESTOMAGO', true);
    }
}
