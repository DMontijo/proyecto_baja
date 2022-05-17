<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CLASIFICACIONDOCTO extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'CLASIFICACIONDOCTOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'CLASIFICACIONDOCTODESCR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '200',
            ],
            'HOJA'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'CLASIFICACIONDOCTOIDPADRE'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'INSTITUCIONID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'AGENDAR'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'DOCUMENTOREMISION'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'ENVIARBANDEJASALIDA'          => [
                'type'           => 'CHAR',
                'default' => 'N',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'CAPTURASENTENCIA'          => [
                'type'           => 'CHAR',
                'default' => 'N',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'CAPTURARECURSO'          => [
                'type'           => 'CHAR',
                'default' => 'N',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'ENVIARRECEPTORIA'          => [
                'type'           => 'CHAR',
                'default' => 'N',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'CAPTURACOMPUTOPENA'          => [
                'type'           => 'CHAR',
                'default' => 'N',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'REGISTRABITACORADETENIDO'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'REGISTRALIBERADETENIDO'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'ENVIARSOLICITUD'          => [
                'type'           => 'CHAR',
                'default' => 'N',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'ENVIARRESPUESTASOLICITUD'          => [
                'type'           => 'CHAR',
                'default' => 'N',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'CONCLUIRENAPELACION'          => [
                'type'           => 'CHAR',
                'default' => 'N',
                'constraint'     => '1',
               
                'null' => TRUE,
            ],
            'REGISTRAORDENCAPTURA'          => [
                'type'           => 'CHAR',
                'default' => 'N',
                'constraint'     => '1',
             
                'null' => TRUE,
            ],
            'RESUELVEIMPUTADO'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'CAPTURACONVENIO'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'SOLICITAORDENINVESTIGACION'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'REGISTRASOLICITUDPERICIAL'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'TIPODOCUMENTO'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'ACUMULACION'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'ENVIAREVISIONSOLICITUD'          => [
                'type'           => 'CHAR',
                'default' => 'N',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'MARCARTIPODETENCION'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'CAPTURARDATOSCATEO'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'CAPTURASEGUIMIENTONOTIFICACION'          => [
                'type'           => 'CHAR',
                'default' => 'N',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'CAPTURARFECHAPRESCRIPCION'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'ACCESODEFENSOR'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'DETERMINACION'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'ASIGNASOLICITUDSECUENCIAL'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ], 
            'ENVIANOTIFICACIONSEJAP'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'CONTESTANOTIFICACIONUI'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'SELECCIONAUDIENCIAPREVIA'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'DECLARACIONIMPUTADO'          => [
                'type'           => 'CHAR',
                'default' => 'N',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'DICTAMENPERICIAL'          => [
                'type'           => 'CHAR',
                'default' => 'N',
                'constraint'     => '1',
                'null' => TRUE,
            ],

        ]);
        $this->forge->addKey('CLASIFICACIONDOCTOID', TRUE);
        /* $this->forge->addForeignKey('CLASIFICACIONDOCTOIDPADRE', '', '');
        $this->forge->addForeignKey('INSTITUCIONID', '', '');
         */$this->forge->createTable('CLASIFICACIONDOCTO');
    }

    public function down()
    {
        $this->forge->dropTable('CLASIFICACIONDOCTO');
    }
}
