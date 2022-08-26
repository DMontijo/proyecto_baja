<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FRENTEALTURA extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'FRENTEALTURAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'FRENTEALTURADESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('FRENTEALTURAID', true);
		$this->forge->createTable('FRENTEALTURA', true);
    }

    public function down()
    {
        $this->forge->dropTable('FRENTEALTURA', true);
    }
}
