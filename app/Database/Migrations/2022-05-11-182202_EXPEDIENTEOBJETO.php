<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EXPEDIENTEOBJETO extends Migration
{
    public function up()
    {
       
        $this->forge->addField([
            'OBJETOID'          => [
                'type'           => 'INT',
                'auto_increment' => TRUE
            ],
            'EXPEDIENTEID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'SITUACION'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'CLASIFICACIONID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'SUBCLASIFICACIONID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'MARCA'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'NUMEROSERIE'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'null'=>TRUE,
            ],
            'CANTIDAD'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'VALOR'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'null'=>TRUE,
            ],
            'TIPOMONEDAID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'DESCRIPCION'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'DESCRIPCIONDETALLADA'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '500',
                'null'=>TRUE,
            ],
            'PERSONAFISICAIDPROPIETARIO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'PERSONAMORALIDPROPIETARIO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
        /*    'FOTO'          => [
                'type'           => 'BLOB',
                'null'=>TRUE,
            ],*/
            'PARTICIPAESTADO'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'N',
                'null'=>TRUE,
            ],
            'FECHAREGISTRO'       => [
                'type'           => 'DATE',
                'null'=>TRUE,
            ],
        ]);
        $this->forge->addKey('OBJETOID', TRUE);
        $this->forge->addForeignKey('EXPEDIENTEID', 'EXPEDIENTE', 'EXPEDIENTEID');
       /*  $this->forge->addForeignKey('CLASIFICACIONID', '', '');
        $this->forge->addForeignKey('SUBCLASIFICACIONID', '', '');
        $this->forge->addForeignKey('TIPOMONEDAID', '', '');
        $this->forge->addForeignKey('PERSONAFISICAIDPROPIETARIO', '', '');
        $this->forge->addForeignKey('PERSONAMORALIDPROPIETARIO', '', '');
        */ $this->forge->createTable('EXPEDIENTEOBJETO');
    }

    public function down()
    {
        $this->forge->dropTable('EXPEDIENTEOBJETO');
    }
}
