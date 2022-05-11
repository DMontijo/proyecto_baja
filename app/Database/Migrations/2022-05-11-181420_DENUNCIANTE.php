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
            'IDMUNICIPIO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
            'IDLOCALIDAD'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
            'IDCOLONIA'          => [
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
        $this->forge->addForeignKey('IDMUNICIPIO', 'CATEGORIA_MUNICIPIO', 'IDMUNICIPIO');
        $this->forge->addForeignKey('IDLOCALIDAD', 'CATEGORIA_LOCALIDAD', 'IDLOCALIDAD');
        $this->forge->addForeignKey('IDCOLONIA', 'CATEGORIA_COLONIA', 'IDCOLONIA');
        $this->forge->createTable('DENUNCIANTE');
    }

    public function down()
    {
        $this->forge->dropTable('DENUNCIANTE');
    }
}
