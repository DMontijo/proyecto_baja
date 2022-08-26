<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BARBATAMANO extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'BARBATAMANOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'BARBATAMANODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('BARBATAMANOID', true);
		$this->forge->createTable('BARBATAMANO', true);
    }

    public function down()
    {
        $this->forge->dropTable('BARBATAMANO', true);

    }
}
