<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VEHICULOSTATUS extends Migration
{
    public function up()
    {
        
            $this->forge->addField([
                'VEHICULOSTATUSID' => [
                    'type' => 'INT',
                    'unsigned' => TRUE,
                ],
                'VEHICULOSTATUSDESCR' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => TRUE,
                ],
              
    
            ]);
            $this->forge->addKey('VEHICULOSTATUSID', TRUE);
            $this->forge->createTable('VEHICULOSTATUS');
    }

    public function down()
    {
        $this->forge->dropTable('VEHICULOSTATUS');

    }
}
