<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EXPEDIENTEPERSONAMORAL extends Migration
{
    public function up()
    {
      
        $this->forge->addField([
            'PERSONAMORALID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'EXPEDIENTEID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'CALIDADJURIDICAID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'DENOMINACION'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '500',
                'null'=>TRUE,
            ],
            'ESTADOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'MUNICIPIOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'LOCALIDADID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'DELEGACIONID'       => [
                'type'           => 'INT',
                //'unsigned'       => TRUE,
            ],
            'ZONA'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                //'null'=>TRUE,
            ],
            'COLONIAID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'COLONIADESCR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'CALLE'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'NUMERO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
                'null'=>TRUE,
            ],
            'NUMEROINTERIOR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
                'null'=>TRUE,
            ],
            'REFERENCIA'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '300',
                'null'=>TRUE,
            ],
            'TELEFONO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'CORREO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'PERSONAMORALGIROID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'PODERVOLUMEN'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '15',
                'null'=>TRUE,
            ],
           
            'PODERNONOTARIO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '15',
                'null'=>TRUE,
            ],
            'PODERNOPODER'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '15',
                'null'=>TRUE,
            ],
            'FECHAREGISTRO'          => [
                'type'           => 'DATE',
            ],
        ]);
        $this->forge->addKey('PERSONAMORALID', TRUE);
        $this->forge->addForeignKey('EXPEDIENTEID', 'EXPEDIENTE', 'EXPEDIENTEID');
         $this->forge->addForeignKey('CALIDADJURIDICAID', 'CATEGORIA_PERSONACALIDADJURIDICA', 'PERSONACALIDADJURIDICAID');
        $this->forge->addForeignKey('ESTADOID','CATEGORIA_ESTADO', 'ESTADOID');
        $this->forge->addForeignKey('MUNICIPIOID', 'CATEGORIA_MUNICIPIO', 'MUNICIPIOID');
        $this->forge->addForeignKey('LOCALIDADID',  'CATEGORIA_LOCALIDAD', 'LOCALIDADID');
      //  $this->forge->addForeignKey('DELEGACIONID', '', '');
         $this->forge->addForeignKey('COLONIAID', 'CATEGORIA_COLONIA', 'COLONIAID');
        $this->forge->createTable('EXPEDIENTEPERSONAMORAL');
    }

    public function down()
    {
        $this->forge->dropTable('EXPEDIENTEPERSONAMORAL');
    }
}
