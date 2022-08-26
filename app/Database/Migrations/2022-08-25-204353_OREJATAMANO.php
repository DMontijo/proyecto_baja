<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OREJATAMANO extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'OREJATAMANOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'OREJATAMANODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('OREJATAMANOID', true);
		$this->forge->createTable('OREJATAMANO', true);
    }

    public function down()
    {
        $this->forge->dropTable('OREJATAMANO', true);
    }
}
