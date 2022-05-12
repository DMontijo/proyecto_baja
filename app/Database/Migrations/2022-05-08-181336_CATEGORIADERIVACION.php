<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CATEGORIADERIVACION extends Migration
{
    public function up()
    {
        
        $this->forge->addField([
            'IDCATDERIVACION'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'NOMBRE_DEPARTAMENTO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'MUNICIPIOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
            'LOCALIDADID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
            'COLONIAID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
            'CALLE_AVENIDA'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '200',
            ],
            'NUM_EXTERIOR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
            ],
            'NUM_INTERIOR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'null' => TRUE,
            ],
            'TELEFONO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '12',
            ],
            'CORREO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
        ]);
        $this->forge->addKey('IDCATDERIVACION', TRUE);
        $this->forge->addForeignKey('MUNICIPIOID', 'CATEGORIA_MUNICIPIO', 'MUNICIPIOID');
        $this->forge->addForeignKey('LOCALIDADID', 'CATEGORIA_LOCALIDAD', 'LOCALIDADID');
        $this->forge->addForeignKey('COLONIAID', 'CATEGORIA_COLONIA', 'COLONIAID');
        $this->forge->createTable('CATEGORIA_DERIVACION');
    }

    public function down()
    {
        $this->forge->dropTable('CATEGORIA_DERIVACION');
    }
}
