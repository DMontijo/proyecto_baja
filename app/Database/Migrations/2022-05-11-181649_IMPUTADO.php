<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class IMPUTADO extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'IDIMPUTADO'          => [
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
                'null' => TRUE,
            ],
            'SEXO_BIOLOGICO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
                'null' => TRUE,
            ],
            'MUNICIPIOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null' => TRUE,
            ],
            'LOCALIDADID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null' => TRUE,
            ],
            'COLONIAID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null' => TRUE,
            ],
            'CALLE_AVENIDA'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '200',
                'null' => TRUE,
            ],
            'NUM_EXTERIOR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'null' => TRUE,
            ],
            'TELEFONO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '12',
                'null' => TRUE,
            ],
            'ESCOLARIDAD'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null' => TRUE,
            ],

        ]);
        $this->forge->addKey('IDIMPUTADO', TRUE);
        $this->forge->addForeignKey('MUNICIPIOID', 'CATEGORIA_MUNICIPIO', 'MUNICIPIOID');
        $this->forge->addForeignKey('LOCALIDADID', 'CATEGORIA_LOCALIDAD', 'LOCALIDADID');
        $this->forge->addForeignKey('COLONIAID', 'CATEGORIA_COLONIA', 'COLONIAID');
        $this->forge->createTable('IMPUTADO');

    }

    public function down()
    {
        $this->forge->dropTable('IMPUTADO');
    }
}
