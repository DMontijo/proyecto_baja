<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CATEGORIALOCALIDAD extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'LOCALIDADID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
              //  'auto_increment' => TRUE
            ],
            'ESTADOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'MUNICIPIOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'LOCALIDADDESCR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'ZONA'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ]
        ]);
        $this->forge->addKey('LOCALIDADID', TRUE);
        
        $this->forge->addPrimaryKey('ESTADOID');
        $this->forge->addPrimaryKey('MUNICIPIOID');
        $this->forge->addForeignKey('ESTADOID', 'CATEGORIA_ESTADO', 'ESTADOID');
        $this->forge->addForeignKey('MUNICIPIOID', 'CATEGORIA_MUNICIPIO', 'MUNICIPIOID');
        $this->forge->createTable('CATEGORIA_LOCALIDAD');
    }

    public function down()
    {
        $this->forge->dropTable('CATEGORIA_LOCALIDAD');
    }
}
