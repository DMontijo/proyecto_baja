<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EXPEDIENTEVEHICULO extends Migration
{
    public function up()
    {
     
        $this->forge->addField([
            'VEHICULOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'EXPEDIENTEID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
           'SITUACION'       => [
                'type'           => 'INT',
                'constraint'     => '2',
                'null'=>TRUE,
            ],
            'TIPOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'MARCAID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'MARCADESCR'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'null'=>TRUE,
            ],
            'MODELOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'MODELODESCR'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'null'=>TRUE,
            ],
            'ANO'          => [
                'type'           => 'INT',
                'constraint'     => '4',
                'null'=>TRUE,
            ],
            'PLACAS'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
                'null'=>TRUE,
            ],
            'NUMEROSERIE'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'null'=>TRUE,
            ],
            'NUMEROMOTOR'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'null'=>TRUE,
            ],
            'NUMEROCHASIS'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'null'=>TRUE,
            ],
          
            'TRANSMISION'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'TRACCION'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'PRIMERCOLORID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'SEGUNDOCOLORID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'SENASPARTICULARES'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '500',
                'null'=>TRUE,
            ],
           'PERSONAFISICAIDPROPIETARIO'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
           'PERSONAMORALIDPROPIETARIO'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
         /* 'FOTO'       => [
                'type'           => 'VARCHAR',
            ],*/
           'PARTICIPAESTADO'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'N',
            ],
            'TIPOPLACA'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'ESTADOIDPLACA'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'ESTADOEXTRANJEROIDPLACA'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
               // 'null'=>TRUE,
            ],
            'VEHICULODISTRIBUIDORID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'VEHICULOVERSIONID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'VEHICULOSERVICIOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'VEHICULOSTATUSID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'FECHAREGISTRO'       => [
                'type'           => 'DATE',
                'null'=>TRUE,
            ],
            'PROVIENEPADRON'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'SEGUROVIGENTE'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null'=>TRUE,
            ],
          
        ]);
        $this->forge->addKey('VEHICULOID', TRUE);
        $this->forge->addForeignKey('EXPEDIENTEID', 'EXPEDIENTE', 'EXPEDIENTEID');
        $this->forge->addForeignKey('TIPOID', 'CATEGORIA_VEHICULOTIPO', 'VEHICULOTIPOID');
       $this->forge->addForeignKey('MARCAID', 'CATEGORIA_VEHICULOMARCA', 'VEHICULOMARCAID');
         $this->forge->addForeignKey('MODELOID', 'CATEGORIA_VEHICULOMODELO', 'VEHICULOMODELOID');
        $this->forge->addForeignKey('PRIMERCOLORID', 'CATEGORIA_VEHICULOCOLOR', 'VEHICULOCOLORID');
        //$this->forge->addForeignKey('SEGUNDOCOLORID', 'CATEGORIA_VEHICULOCOLOR', 'VEHICULOCOLORID');
       /* $this->forge->addForeignKey('PERSONAFISICAIDPROPIETARIO', '', '');
        $this->forge->addForeignKey('PERSONAMORALIDPROPIETARIO', '', '');*/
    //   $this->forge->addForeignKey('ESTADOIDPLACA', 'CATEGORIA_ESTADO', 'ESTADOID');
      /*   $this->forge->addForeignKey('ESTADOEXTRANJEROIDPLACA', '', '');
        $this->forge->addForeignKey('VEHICULOVERSIONID', '', '');
        $this->forge->addForeignKey('VEHICULOSERVICIOID', '', '');
        $this->forge->addForeignKey('VEHICULOSTATUSID', '', '');
       */  $this->forge->createTable('EXPEDIENTEVEHICULO');
    }

    public function down()
    {
          $this->forge->dropTable('EXPEDIENTEVEHICULO');
    }
}
