<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BARBILLAINCLINACION extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'BARBILLAINCLINACIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'BARBILLAINCLINACIONDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('BARBILLAINCLINACIONID', true);
		$this->forge->createTable('BARBILLAINCLINACION', true);
    
    }

    public function down()
    {
        $this->forge->dropTable('BARBILLAINCLINACION', true);
    }
}
