<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EXPEDIENTEVEHICULO extends Migration
{
    public function up()
    {
     
        $this->forge->addField([
            'EXPEDIENTEVID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'EXPEDIENTEID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
            'VEHICULOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'SITUACION'       => [
                'type'           => 'INT',
                'constraint'     => '2',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'TIPOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'MARCAID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'MARCADESCR'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'MODELOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'MODELODESCR'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'ANO'          => [
                'type'           => 'INT',
                'constraint'     => '4',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PLACAS'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'NUMEROSERIE'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'NUMEROMOTOR'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'NUMEROCHASIS'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
          
            'TRANSMISION'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'TRACCION'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PRIMERCOLORID'       => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'SEGUNDOCOLORID'       => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'SENASPARTICULARES'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '500',
                'null'=>TRUE,
            ],
            'PERSONAFISICAIDPROPIETARIO'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PERSONAMORALIDPROPIETARIO'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'FOTO'       => [
                'type'           => 'BLOB',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PARTICIPAESTADO'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'N',
                'unsigned'       => TRUE,
                'constraint'     => '10',
                'null'=>TRUE,
            ],
            'TIPOPLACA'       => [
                'type'           => 'CHAR',
                'unsigned'       => TRUE,
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'ESTADOIDPLACA'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'ESTADOEXTRANJEROIDPLACA'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'VEHICULODISTRIBUIDORID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'VEHICULOVERSIONID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'VEHICULOSERVICIOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'VEHICULOSTATUSID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'FECHAREGISTRO'       => [
                'type'           => 'DATE',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PROVIENEPADRON'       => [
                'type'           => 'CHAR',
                'unsigned'       => TRUE,
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'SEGUROVIGENTE'       => [
                'type'           => 'CHAR',
                'unsigned'       => TRUE,
                'constraint'     => '1',
                'null'=>TRUE,
            ],
          
        ]);
        $this->forge->addKey('EXPEDIENTEVID', TRUE);
        $this->forge->addForeignKey('EXPEDIENTEID', '', '');
        $this->forge->addForeignKey('VEHICULOID', '', '');
        $this->forge->addForeignKey('TIPOID', '', '');
        $this->forge->addForeignKey('MARCAID', '', '');
        $this->forge->addForeignKey('MODELOID', '', '');
        $this->forge->addForeignKey('PRIMERCOLORID', '', '');
        $this->forge->addForeignKey('SEGUNDOCOLORID', '', '');
        $this->forge->addForeignKey('PERSONAFISICAIDPROPIETARIO', '', '');
        $this->forge->addForeignKey('PERSONAMORALIDPROPIETARIO', '', '');
        $this->forge->addForeignKey('ESTADOIDPLACA', '', '');
        $this->forge->addForeignKey('ESTADOEXTRANJEROIDPLACA', '', '');
        $this->forge->addForeignKey('VEHICULOVERSIONID', '', '');
        $this->forge->addForeignKey('VEHICULOSERVICIOID', '', '');
        $this->forge->addForeignKey('VEHICULOSTATUSID', '', '');
        $this->forge->createTable('EXPEDIENTEVEHICULO');
    }

    public function down()
    {
          $this->forge->dropTable('EXPEDIENTEVEHICULO');
    }
}
