<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AREA extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'AREAID'          => [
                'type'           => 'INT',
               
                'auto_increment' => TRUE,
            ],
            'AREADESCR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '200',
            ],
            'DEPENDEAREA'       => [
                'type'           => 'INT',
               
                'null' => TRUE,
            ],
            'OFICINAID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'EMPLEADOIDRESPONSABLEAREA'          => [
                'type'           => 'INT',
               
                'null' => TRUE,
            ],
            'RESPONSABLEDEOFICINA'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
              
                'null' => TRUE,
            ],
            'AGENDARALASIGNAR'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ],
        ]);
        $this->forge->addKey('AREAID', TRUE);
        $this->forge->addForeignKey('OFICINAID', 'OFICINA', 'OFICINAID');
        $this->forge->createTable('AREA');
    }

    public function down()
    {
        $this->forge->dropTable('AREA');
    }
}
