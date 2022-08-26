<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LABIOLONGITUD extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'LABIOLONGITUDID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'LABIOLONGITUDDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('LABIOLONGITUDID', true);
		$this->forge->createTable('LABIOLONGITUD', true);
    }

    public function down()
    {
        $this->forge->dropTable('LABIOLONGITUD', true);
    }
}
