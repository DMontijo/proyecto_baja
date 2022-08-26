<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BIGOTEPECULIAR extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'BIGOTEPECULIARID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'BIGOTEPECULIARDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('BIGOTEPECULIARID', true);
		$this->forge->createTable('BIGOTEPECULIAR', true);
    }

    public function down()
    {
        $this->forge->dropTable('BIGOTEPECULIAR', true);
   }
}
