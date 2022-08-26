<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HOMBROLONGITUD extends Migration
{

    public function up()
    {
        $this->forge->addField([
			'HOMBROLONGITUDID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'HOMBROLONGITUDDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => 200,
				'null' => TRUE,
			],
			
		]);

		$this->forge->addKey('HOMBROLONGITUDID', true);
		$this->forge->createTable('HOMBROLONGITUD', true);
    }

    public function down()
    {
        $this->forge->dropTable('HOMBROLONGITUD', true);
    }
}
