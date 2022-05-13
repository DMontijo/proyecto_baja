<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EXPEDIENTEDOCUMENTO extends Migration
{
    public function up()
    {
        
        $this->forge->addField([
            'EXPEDIENTEDOCTOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE,
            ],
            'EXPEDIENTEID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'DOCTODESCR'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'=>TRUE,
            ],
           /* 'DOCUMENTO'          => [
                'type'           => 'BLOB',
                'null'=>TRUE,
            ],*/
            'FECHAACTUALIZACION'          => [
                'type'           => 'DATE',
                'null'=>TRUE,
            ],
         
            'FECHACREACION DATETIME DEFAULT CURRENT_TIMESTAMP',
            'FECHAIMPRESODEFINITIVA'          => [
                'type'           => 'DATE',
                'null'=>TRUE,
            ],
            'CLASIFICACIONDOCTOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'AUTOR'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'null'=>TRUE,
            ],
            'OFICINAIDAUTOR'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'STATUSDOCUMENTOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'PLANTILLAID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'CALIFICACION'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'ESTADOACCESO'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'M',
                'null'=>TRUE,
            ],
            'EMPLEADORESPONSABLE'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'null'=>TRUE,
            ],
            'EXPAREAIDRESPONSABLE'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'EXPEMPIDRESPONSABLE'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'PUBLICADO'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'N',
                'null'=>TRUE,
            ],
            'RUTAALMACENAMIENTOID'       => [
                'type'           => 'INT',
                'null'=>TRUE,
            ],
            'STATUSALMACENID'       => [
                'type'           => 'INT',
                'null'=>TRUE,
            ],
            'EXPORTAR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
                'null'=>TRUE,
            ],
         
        ]);
        $this->forge->addKey('EXPEDIENTEDOCTOID', TRUE);
       $this->forge->addForeignKey('EXPEDIENTEID', 'EXPEDIENTE', 'EXPEDIENTEID');
        $this->forge->addForeignKey('CLASIFICACIONDOCTOID', 'CLASIFICACIONDOCTO', 'CLASIFICACIONDOCTOID');
        $this->forge->addForeignKey('OFICINAIDAUTOR', 'OFICINA', 'OFICINAID');
       // $this->forge->addForeignKey('STATUSDOCUMENTOID', '', '');
        $this->forge->addForeignKey('PLANTILLAID', 'PLANTILLA', 'PLANTILLAID');
      /*   $this->forge->addForeignKey('EXPAREAIDRESPONSABLE', '', '');
        $this->forge->addForeignKey('EXPEMPIDRESPONSABLE', '', '');
        $this->forge->addForeignKey('RUTAALMACENAMIENTOID', '', '');
        $this->forge->addForeignKey('STATUSALMACENID', '', '');
       */  $this->forge->createTable('EXPEDIENTEDOCUMENTO');
    }

    public function down()
    {
        $this->forge->dropTable('EXPEDIENTEDOCUMENTO');
    }
}
