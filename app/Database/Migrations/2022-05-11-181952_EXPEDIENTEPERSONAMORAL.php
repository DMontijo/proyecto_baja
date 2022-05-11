<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EXPEDIENTEPERSONAMORAL extends Migration
{
    public function up()
    {
      
        $this->forge->addField([
            'EXPEDIENTEPMID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'EXPEDIENTEID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
            'PERSONAMORALID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'CALIDADJURIDICAID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'DENOMINACION'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '500',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'ESTADOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'MUNICIPIOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'LOCALIDADID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'DELEGACIONID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'ZONA'       => [
                'type'           => 'CHAR',
                'unsigned'       => TRUE,
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'COLONIAID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'COLONIADESCR'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'CALLE'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'NUMERO'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '10',
                'null'=>TRUE,
            ],
            'NUMEROINTERIOR'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '10',
                'null'=>TRUE,
            ],
            'REFERENCIA'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '300',
                'null'=>TRUE,
            ],
            'TELEFONO'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'CORREO'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'PERSONAMORALGIROID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PODERVOLUMEN'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '15',
                'null'=>TRUE,
            ],
           
            'PODERNONOTARIO'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '15',
                'null'=>TRUE,
            ],
            'PODERNOPODER'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '15',
                'null'=>TRUE,
            ],
            'FECHAREGISTRO'          => [
                'type'           => 'DATE',
                'unsigned'       => TRUE,
            ],
        ]);
        $this->forge->addKey('EXPEDIENTEPMID', TRUE);
        $this->forge->addForeignKey('EXPEDIENTEID', '', '');
        $this->forge->addForeignKey('PERSONAMORALID', '', '');
        $this->forge->addForeignKey('CALIDADJURIDICAID', '', '');
        $this->forge->addForeignKey('ESTADOID', '', '');
        $this->forge->addForeignKey('MUNICIPIOID', '', '');
        $this->forge->addForeignKey('LOCALIDADID', '', '');
        $this->forge->addForeignKey('DELEGACIONID', '', '');
        $this->forge->addForeignKey('COLONIAID', '', '');
        $this->forge->createTable('EXPEDIENTEPERSONAMORAL');
    }

    public function down()
    {
        $this->forge->dropTable('EXPEDIENTEPERSONAMORAL');
    }
}
