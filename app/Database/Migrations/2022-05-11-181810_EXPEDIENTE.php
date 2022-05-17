<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EXPEDIENTE extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'EXPEDIENTEID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'ESTADOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'MUNICIPIOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'ANO'          => [
                'type'           => 'INT',
                'constraint'     => '4',
                'null'=>TRUE,
            ],
            'CORRELATIVO'          => [
                'type'           => 'INT',
                'null'=>TRUE,
            ],
            'FECHAREGISTRO'          => [
                'type'           => 'DATE',
                'null'=>TRUE,
            ],
            'HECHOMEDIOCONOCIMIENTOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'HECHOFECHA'          => [
                'type'           => 'DATE',
            ],
            'HECHOLUGARID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'HECHOESTADOID'       => [
                'type'           => 'INT',
                'null'=>TRUE,
                'unsigned'       => TRUE,
            ],
            'HECHOMUNICIPIOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'HECHOLOCALIDADID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'HECHODELEGACIONID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'HECHOZONA'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
            ],
            'HECHOCOLONIAID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'HECHOCOLONIADESCR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'HECHOCALLE'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'HECHONUMEROCASA'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
                'null'=>TRUE,
            ],
            'HECHONUMEROCASAINT'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
                'null'=>TRUE,
            ],
            'HECHOREFERENCIA'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '300',
                'null'=>TRUE,
            ],
            'HECHONARRACION'       => [
                'type'           => 'BLOB',
                'null'=>TRUE,
            ],
            'TIPOEXPEDIENTEID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'PARTICIPAESTADO'       => [
                'type'           => 'CHAR',
                'default' => 'N',
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'EMPLEADOIDREGISTRO'       => [
                'type'           => 'INT',
                'null'=>TRUE,
            ],
            'OFICINAIDRESPONSABLE'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'CONFIDENCIAL'       => [
                'type'           => 'CHAR',
                'default' => 'N',
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'ESTADOJURIDICOEXPEDIENTEID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'RELACIONDOCUMENTOS'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '500',
                'null'=>TRUE,
            ],
            'HECHOCOORDENADAX'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'null'=>TRUE,
            ],
            'HECHOCOORDENADAY'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'null'=>TRUE,
            ],
            'PARTENUMERO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
                'null'=>TRUE,
            ],
            'PARTEFECHA'       => [
                'type'           => 'DATE',
                'null'=>TRUE,
            ],
            'PARTEAUTORIDADID'       => [
                'type'           => 'INT',
                'null'=>TRUE,
                'unsigned'       => TRUE,
            ],
            'PARTEAREADOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'PARTEEMPLEADOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'EXHORTONUMERO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
                'null'=>TRUE,
            ],
            'EXHORTOESTADOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'EXHORTOMUNICIPIOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'EXHORTOOFICINAID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'AREAIDREGISTRO'       => [
                'type'           => 'INT',
                'null'=>TRUE,
            ],
            'AREAIDRESPONSABLE'       => [
                'type'           => 'INT',
                'null'=>TRUE,
            ],
            'LOCALIZACIONPERSONA'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'N',
                'null'=>TRUE,
            ],
            'CONCLUIDO'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'N',
            ],
            'EXHORTOAUTORIDADID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'HECHOCLASIFICACIONLUGARID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'HECHOVIALIDADID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],

        ]);
        $this->forge->addKey('EXPEDIENTEID', TRUE);
       $this->forge->addForeignKey('ESTADOID', 'CATEGORIA_ESTADO', 'ESTADOID');
        $this->forge->addForeignKey('MUNICIPIOID', 'CATEGORIA_MUNICIPIO', 'MUNICIPIOID');
        $this->forge->addForeignKey('HECHOMEDIOCONOCIMIENTOID', 'CATEGORIA_MEDIOCONOCIMIENTO', 'MEDIOCONOCIMIENTOID');
        $this->forge->addForeignKey('HECHOLUGARID', 'CATEGORIA_HECHOLUGAR', 'HECHOLUGARID');
       $this->forge->addForeignKey('HECHOESTADOID', 'CATEGORIA_ESTADO', 'ESTADOID');
        $this->forge->addForeignKey('HECHOMUNICIPIOID', 'CATEGORIA_MUNICIPIO', 'MUNICIPIOID');
        $this->forge->addForeignKey('HECHOLOCALIDADID', 'CATEGORIA_LOCALIDAD', 'LOCALIDADID');
        //$this->forge->addForeignKey('HECHODELEGACIONID', '', '');
        $this->forge->addForeignKey('HECHOCOLONIAID', 'CATEGORIA_COLONIA', 'COLONIAID');
        $this->forge->addForeignKey('TIPOEXPEDIENTEID', 'CATEGORIA_TIPOEXPEDIENTE', 'TIPOEXPEDIENTEID');
        //$this->forge->addForeignKey('EMPLEADOIDREGISTRO', '', '');
       $this->forge->addForeignKey('OFICINAIDRESPONSABLE', 'OFICINA', 'OFICINAID');
        /*$this->forge->addForeignKey('ESTADOJURIDICOEXPEDIENTEID', '', '');
        $this->forge->addForeignKey('PARTEAUTORIDADID', '', '');
        $this->forge->addForeignKey('PARTEAREADOID', '', '');
        $this->forge->addForeignKey('PARTEEMPLEADOID', '', '');*/
      /*  $this->forge->addForeignKey('EXHORTOESTADOID', 'CATEGORIA_ESTADO', 'ESTADOID');
        $this->forge->addForeignKey('EXHORTOMUNICIPIOID', 'CATEGORIA_MUNICIPIO', 'MUNICIPIOID');
        $this->forge->addForeignKey('EXHORTOOFICINAID', 'OFICINA', 'OFICINAID');
       /* $this->forge->addForeignKey('AREAIDREGISTRO', '', '');
        $this->forge->addForeignKey('AREAIDRESPONSABLE', '', '');
        $this->forge->addForeignKey('EXHORTOAUTORIDADID', '', '');
        $this->forge->addForeignKey('HECHOCLASIFICACIONLUGARID', '', '');
        $this->forge->addForeignKey('HECHOVIALIDADID', '', '');*/
        $this->forge->createTable('EXPEDIENTE');
    
    }

    public function down()
    {
        $this->forge->dropTable('EXPEDIENTE');
    }
}
