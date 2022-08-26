<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CEJACOLOCACION extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'CEJACOLOCACIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'CEJACOLOCACIONDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('CEJACOLOCACIONID', true);
		$this->forge->createTable('CEJACOLOCACION', true);
    }

    public function down()
    {
        $this->forge->dropTable('CEJACOLOCACION', true);
    }
}
