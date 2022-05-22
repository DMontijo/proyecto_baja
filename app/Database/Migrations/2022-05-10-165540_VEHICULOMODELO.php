<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VEHICULOMODELO extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'VEHICULOMODELOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'VEHICULOMODELODESCR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'VEHICULOMARCAID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'VEHICULODISTRIBUIDORID'       => [
                'type'           => 'INT',
               // 'unsigned'       => TRUE,
            ],
        ]);
        $this->forge->addKey('VEHICULOMODELOID', TRUE);
        $this->forge->createTable('CATEGORIA_VEHICULOMODELO');
    }

    public function down()
    {
        $this->forge->dropTable('CATEGORIA_VEHICULOMODELO');
    }
}
