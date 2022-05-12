<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DENUNCIA extends Migration
{
    public function up()
    {
        
        $this->forge->addField([
            'IDDENUNCIA'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'IDDELITO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'IDSUBDELITO'          => [
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
            'COLONIAID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
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
            'LUGAR_DELITO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'CLASIFICACION_LUGAR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null' => TRUE,
            ],
            'FECHA_HORA'       => [
                'type'           => 'DATETIME',
            ],
            'DESC_OBJETOI'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
            ],
            'NARRACION'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '200',
            ],
            'IDENTIFICACION_IMPUTADO'       => [
                'type'           => 'BOOLEAN',
                'null' => TRUE,
            ],
        ]);
        $this->forge->addKey('IDDENUNCIA', TRUE);
        $this->forge->addForeignKey('IDDELITO', 'CATEGORIA_DELITOS', 'IDDELITO');
        $this->forge->addForeignKey('IDSUBDELITO', 'SUBCATEGORIA_DELITOS', 'IDSUBDELITO');
        $this->forge->addForeignKey('MUNICIPIOID', 'CATEGORIA_MUNICIPIO', 'MUNICIPIOID');
        $this->forge->addForeignKey('LOCALIDADID', 'CATEGORIA_LOCALIDAD', 'LOCALIDADID');
        $this->forge->addForeignKey('COLONIAID', 'CATEGORIA_COLONIA', 'COLONIAID');
        $this->forge->createTable('DENUNCIA');
    }

    public function down()
    {
        $this->forge->dropTable('DENUNCIA');
    }
}
