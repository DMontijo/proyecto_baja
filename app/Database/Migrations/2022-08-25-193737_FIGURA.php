<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FIGURA extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'FIGURAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'FIGURADESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('FIGURAID', true);
		$this->forge->createTable('FIGURA', true);
    }

    public function down()
    {
        $this->forge->dropTable('FIGURA', true);
    }
}
