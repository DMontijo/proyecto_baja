<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DENUNCIANTE extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'IDDENUNCIANTE'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'NOMBRE'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'APELLIDO_PATERNO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'APELLIDO_MATERNO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null' => TRUE,
            ],
            'FECHA_NACIMIENTO'       => [
                'type'           => 'DATE',
            ],
            'SEXO_BIOLOGICO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
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
            'PASSWORD'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'TIPO_DOCUMENTO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'ARCHIVO_DOCUMENTO'       => [
                'type'           => 'TEXT',
            ],

        ]);
        $this->forge->addKey('IDDENUNCIANTE', TRUE);
        $this->forge->addForeignKey('MUNICIPIOID', 'CATEGORIA_MUNICIPIO', 'MUNICIPIOID');
        $this->forge->addForeignKey('LOCALIDADID', 'CATEGORIA_LOCALIDAD', 'LOCALIDADID');
        $this->forge->addForeignKey('COLONIAID', 'CATEGORIA_COLONIA', 'COLONIAID');
        $this->forge->createTable('DENUNCIANTE');
    }

    public function down()
    {
        $this->forge->dropTable('DENUNCIANTE');
    }
}
