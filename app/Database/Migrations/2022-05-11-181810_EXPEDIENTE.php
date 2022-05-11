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
                'null'=>TRUE,
            ],
            'MUNICIPIOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'ANO'          => [
                'type'           => 'INT',
                'constraint'     => '4',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'CORRELATIVO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'FECHAREGISTRO'          => [
                'type'           => 'DATE',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'HECHOMEDIOCONOCIMIENTOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'HECHOFECHA'          => [
                'type'           => 'DATE',
                'unsigned'       => TRUE,
            ],
            'HECHOLUGARID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'HECHOESTADOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'HECHOMUNICIPIOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'HECHOLOCALIDADID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'HECHODELEGACIONID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'HECHOZONA'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
            ],
            'HECHOCOLONIAID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'HECHOCOLONIADESCR'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'HECHOCALLE'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'HECHONUMEROCASA'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '10',
                'null'=>TRUE,
            ],
            'HECHONUMEROCASAINT'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '10',
                'null'=>TRUE,
            ],
            'HECHOREFERENCIA'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '300',
                'null'=>TRUE,
            ],
            'HECHONARRACION'       => [
                'type'           => 'BLOB',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'TIPOEXPEDIENTEID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PARTICIPAESTADO'       => [
                'type'           => 'CHAR',
                'unsigned'       => TRUE,
                'default' => 'N',
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'EMPLEADOIDREGISTRO'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'OFICINAIDRESPONSABLE'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'CONFIDENCIAL'       => [
                'type'           => 'CHAR',
                'unsigned'       => TRUE,
                'default' => 'N',
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'ESTADOJURIDICOEXPEDIENTEID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'RELACIONDOCUMENTOS'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '500',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'HECHOCOORDENADAX'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'HECHOCOORDENADAY'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PARTENUMERO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PARTEFECHA'       => [
                'type'           => 'DATE',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PARTEAUTORIDADID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PARTEAREADOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PARTEEMPLEADOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'EXHORTONUMERO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'EXHORTOESTADOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'EXHORTOMUNICIPIOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'EXHORTOOFICINAID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'AREAIDREGISTRO'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'AREAIDRESPONSABLE'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'LOCALIZACIONPERSONA'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'N',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'CONCLUIDO'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'N',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'EXHORTOAUTORIDADID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'HECHOCLASIFICACIONLUGARID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'HECHOVIALIDADID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],

        ]);
        $this->forge->addKey('EXPEDIENTEID', TRUE);
        $this->forge->addForeignKey('ESTADOID', 'CATEGORIA_ESTADO', 'IDESTADO');
        $this->forge->addForeignKey('MUNICIPIOID', 'CATEGORIA_MUNICIPIO', 'IDMUNICIPIO');
        $this->forge->addForeignKey('HECHOMEDIOCONOCIMIENTOID', '', '');
        $this->forge->addForeignKey('HECHOLUGARID', '', '');
        $this->forge->addForeignKey('HECHOESTADOID', '', '');
        $this->forge->addForeignKey('HECHOMUNICIPIOID', '', '');
        $this->forge->addForeignKey('HECHOLOCALIDADID', '', '');
        $this->forge->addForeignKey('HECHODELEGACIONID', '', '');
        $this->forge->addForeignKey('HECHOCOLONIAID', '', '');
        $this->forge->addForeignKey('TIPOEXPEDIENTEID', '', '');
        $this->forge->addForeignKey('EMPLEADOIDREGISTRO', '', '');
        $this->forge->addForeignKey('OFICINAIDRESPONSABLE', '', '');
        $this->forge->addForeignKey('ESTADOJURIDICOEXPEDIENTEID', '', '');
        $this->forge->addForeignKey('PARTEAUTORIDADID', '', '');
        $this->forge->addForeignKey('PARTEAREADOID', '', '');
        $this->forge->addForeignKey('PARTEEMPLEADOID', '', '');
        $this->forge->addForeignKey('EXHORTOESTADOID', '', '');
        $this->forge->addForeignKey('EXHORTOMUNICIPIOID', '', '');
        $this->forge->addForeignKey('EXHORTOOFICINAID', '', '');
        $this->forge->addForeignKey('AREAIDREGISTRO', '', '');
        $this->forge->addForeignKey('AREAIDRESPONSABLE', '', '');
        $this->forge->addForeignKey('EXHORTOAUTORIDADID', '', '');
        $this->forge->addForeignKey('HECHOCLASIFICACIONLUGARID', '', '');
        $this->forge->addForeignKey('HECHOVIALIDADID', '', '');
        $this->forge->createTable('EXPEDIENTE');
    
    }

    public function down()
    {
        $this->forge->dropTable('EXPEDIENTE');
    }
}
