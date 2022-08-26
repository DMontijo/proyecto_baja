<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CEJACONTEXTURA extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'CONTEXTURAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'CONTEXTURADESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('CONTEXTURAID', true);
		$this->forge->createTable('CEJACONTEXTURA', true);
    }

    public function down()
    {
        $this->forge->dropTable('CEJACONTEXTURA', true);
    }
}
