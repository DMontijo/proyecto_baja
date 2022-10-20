<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VEHICULOSERVICIO extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'VEHICULOSERVICIOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
            'VEHICULOSERVICIODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
          

        ]);
		$this->forge->addKey('VEHICULOSERVICIOID', TRUE);
		$this->forge->createTable('VEHICULOSERVICIO');
    }

    public function down()
    {
        $this->forge->dropTable('VEHICULOSERVICIO');

    }
}
