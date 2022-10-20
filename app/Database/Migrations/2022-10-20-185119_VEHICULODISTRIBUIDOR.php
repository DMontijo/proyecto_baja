<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VEHICULODISTRIBUIDOR extends Migration
{
   
    public function up()
    {
        $this->forge->addField([
			'VEHICULODISTRIBUIDORID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
            'VEHICULODISTRIBUIDORDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
          

        ]);
		$this->forge->addKey('VEHICULODISTRIBUIDORID', TRUE);
       
		$this->forge->createTable('VEHICULODISTRIBUIDOR');
	
    }

    public function down()
    {
        $this->forge->dropTable('VEHICULODISTRIBUIDOR');

    }
}
