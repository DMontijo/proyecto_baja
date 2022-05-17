<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CATEGORIACOLONIA extends Migration
{
    public function up()
    {
      
        $this->forge->addField([
            'COLONIAID'          => [
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
            'LOCALIDADID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'ZONA'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
            ],
            'DELEGACIONID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'COLONIADESCR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '200',
            ]
        ]);
        $this->forge->addKey('COLONIAID', TRUE);
        $this->forge->addPrimaryKey('ESTADOID');
        $this->forge->addPrimaryKey('MUNICIPIOID');
        $this->forge->addPrimaryKey('LOCALIDADID');
        $this->forge->addForeignKey('ESTADOID', 'CATEGORIA_ESTADO', 'ESTADOID');
        $this->forge->addForeignKey('MUNICIPIOID', 'CATEGORIA_MUNICIPIO', 'MUNICIPIOID');
        $this->forge->addForeignKey('LOCALIDADID', 'CATEGORIA_LOCALIDAD', 'LOCALIDADID');
      //  $this->forge->addForeignKey('DELEGACIONID', '', '');
        $this->forge->createTable('CATEGORIA_COLONIA');
    }

    public function down()
    {
        $this->forge->dropTable('CATEGORIA_COLONIA');
    }
}
