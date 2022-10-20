<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ESTADOEXTRANJERO extends Migration
{
   
    public function up()
    {
        $this->forge->addField([
			'ESTADOEXTRANJEROID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'PAISID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
            'ESTADOEXTRANJERODESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
          

        ]);
		$this->forge->addKey('ESTADOEXTRANJEROID', TRUE);
        $this->forge->addKey('PAISID', TRUE);
		$this->forge->createTable('ESTADOEXTRANJERO');
	
    }

    public function down()
    {
        $this->forge->dropTable('ESTADOEXTRANJERO');

    }
}
