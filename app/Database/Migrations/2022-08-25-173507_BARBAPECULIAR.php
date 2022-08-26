<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BARBAPECULIAR extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'BARBAPECULIARID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'BARBAPECULIARDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('BARBAPECULIARID', true);
		$this->forge->createTable('BARBAPECULIAR', true);
    }

    public function down()
    {
        $this->forge->dropTable('BARBAPECULIAR', true);
    }
}
