<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VEHICULOVERSION extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'VEHICULODISTRIBUIDORID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'VEHICULOMARCAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'VEHICULOMODELOID' => [
				'type' => 'INT',
				'constraint' => '4',
			],
            'VEHICULOVERSIONID' => [ 
				'type' => 'INT',
				'unsigned' => TRUE,
			],
           
            'VEHICULOVERSIONDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE,
			],
          

        ]);
		$this->forge->addKey('VEHICULODISTRIBUIDORID', TRUE);
        $this->forge->addKey('VEHICULOMARCAID', TRUE);
		$this->forge->addKey('VEHICULOMODELOID', TRUE);
        $this->forge->addKey('VEHICULOVERSIONID', TRUE);
		$this->forge->createTable('VEHICULOVERSION');
	
    }

    public function down()
    {
        $this->forge->dropTable('VEHICULOVERSION');

    }
}
