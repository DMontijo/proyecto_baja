<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VEHICULOSITUACION extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'VEHICULOSITUACIONID' => [ 
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => TRUE,
			],
           
            'VEHICULOSITUACIONDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE,
			],
            'VEHICULOSITUACIONACCION' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'null' => TRUE,
			],
          
        ]);
        $this->forge->addKey('VEHICULOSITUACIONID', TRUE);
        $this->forge->createTable('VEHICULOSITUACION');
      

    }

    public function down()
    {
        $this->forge->dropTable('VEHICULOSITUACION');

    }
}
