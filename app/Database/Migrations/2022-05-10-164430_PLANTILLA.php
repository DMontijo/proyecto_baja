<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PLANTILLA extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'PLANTILLAID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'PLANTILLADESCR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '600',
            ],
            'EMPLEADOIDAUTOR'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => '1',
            ],
            'FECHACREACION'       => [
                'type'           => 'DATE',
            ],
            'EMPLEADOIDMODIFICO'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => '1',
            ],
            'FECHAMODIFICACION'       => [
                'type'           => 'DATE',
            ],
            'PLANTILLAENCABEZADOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null' => TRUE,
            ],
        ]);
        $this->forge->addKey('PLANTILLAID', TRUE);
        $this->forge->createTable('PLANTILLA');
    }

    public function down()
    {
        $this->forge->dropTable('PLANTILLA');
    }
}
