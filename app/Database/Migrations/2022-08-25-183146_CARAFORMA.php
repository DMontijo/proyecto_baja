<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CARAFORMA extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'CARAFORMAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'CARAFORMADESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('CARAFORMAID', true);
		$this->forge->createTable('CARAFORMA', true);
    }

    public function down()
    {
        $this->forge->dropTable('CARAFORMA', true);
    }
}
