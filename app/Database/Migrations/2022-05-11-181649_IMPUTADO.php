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
            'IDMUNICIPIO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null' => TRUE,
            ],
            'IDLOCALIDAD'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null' => TRUE,
            ],
            'IDCOLONIA'          => [
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
        $this->forge->addForeignKey('IDMUNICIPIO', 'CATEGORIA_MUNICIPIO', 'IDMUNICIPIO');
        $this->forge->addForeignKey('IDLOCALIDAD', 'CATEGORIA_LOCALIDAD', 'IDLOCALIDAD');
        $this->forge->addForeignKey('IDCOLONIA', 'CATEGORIA_COLONIA', 'IDCOLONIA');
        $this->forge->createTable('IMPUTADO');

    }

    public function down()
    {
        $this->forge->dropTable('IMPUTADO');
    }
}
