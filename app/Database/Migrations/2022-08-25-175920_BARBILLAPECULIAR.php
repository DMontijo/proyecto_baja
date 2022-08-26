<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BARBILLAPECULIAR extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'BARBILLAPECULIARID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'BARBILLAPECULIARDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('BARBILLAPECULIARID', true);
		$this->forge->createTable('BARBILLAPECULIAR', true);
    }

    public function down()
    {
        $this->forge->dropTable('BARBILLAPECULIAR', true);
    }
}
