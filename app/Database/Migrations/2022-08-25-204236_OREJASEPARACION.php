<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OREJASEPARACION extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'OREJASEPARACIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'OREJASEPARACIONDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('OREJASEPARACIONID', true);
		$this->forge->createTable('OREJASEPARACION', true);
    }

    public function down()
    {
        $this->forge->dropTable('OREJASEPARACION', true);
    }
}
