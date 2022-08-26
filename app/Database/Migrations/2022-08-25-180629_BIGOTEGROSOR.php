<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BIGOTEGROSOR extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'BIGOTEGROSORID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'BIGOTEGROSORDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('BIGOTEGROSORID', true);
		$this->forge->createTable('BIGOTEGROSOR', true);
    }

    public function down()
    {
        $this->forge->dropTable('BIGOTEGROSOR', true);
    }
}
