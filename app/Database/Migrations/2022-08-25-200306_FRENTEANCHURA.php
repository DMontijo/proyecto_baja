<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FRENTEANCHURA extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'FRENTEANCHURAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'FRENTEANCHURADESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('FRENTEANCHURAID', true);
		$this->forge->createTable('FRENTEANCHURA', true);
    }

    public function down()
    {
        $this->forge->dropTable('FRENTEANCHURA', true);
    }
}
