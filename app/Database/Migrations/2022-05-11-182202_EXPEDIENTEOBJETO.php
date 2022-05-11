<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EXPEDIENTEOBJETO extends Migration
{
    public function up()
    {
       
        $this->forge->addField([
            'EXPEDIENTEOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'EXPEDIENTEID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
            'OBJETOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'SITUACION'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'CLASIFICACIONID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'SUBCLASIFICACIONID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'MARCA'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'NUMEROSERIE'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'CANTIDAD'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'VALOR'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'TIPOMONEDAID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'DESCRIPCION'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'DESCRIPCIONDETALLADA'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '500',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PERSONAFISICAIDPROPIETARIO'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PERSONAMORALIDPROPIETARIO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'FOTO'          => [
                'type'           => 'BLOB',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PARTICIPAESTADO'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'N',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'FECHAREGISTRO'       => [
                'type'           => 'DATE',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
        ]);
        $this->forge->addKey('EXPEDIENTEOID', TRUE);
        $this->forge->addForeignKey('EXPEDIENTEID', '', '');
        $this->forge->addForeignKey('OBJETOID', '', '');
        $this->forge->addForeignKey('CLASIFICACIONID', '', '');
        $this->forge->addForeignKey('SUBCLASIFICACIONID', '', '');
        $this->forge->addForeignKey('TIPOMONEDAID', '', '');
        $this->forge->addForeignKey('PERSONAFISICAIDPROPIETARIO', '', '');
        $this->forge->addForeignKey('PERSONAMORALIDPROPIETARIO', '', '');
        $this->forge->createTable('EXPEDIENTEOBJETO');
    }

    public function down()
    {
        $this->forge->dropTable('EXPEDIENTEOBJETO');
    }
}
