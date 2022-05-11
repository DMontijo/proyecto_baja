<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EXPEDIENTEDOCUMENTO extends Migration
{
    public function up()
    {
        
        $this->forge->addField([
            'EXPEDIENTEDID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'EXPEDIENTEID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
            'EXPEDIENTEDOCTOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'DOCTODESCR'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'DOCUMENTO'          => [
                'type'           => 'BLOB',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'FECHAACTUALIZACION'          => [
                'type'           => 'DATE',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'FECHACREACION'          => [
                'type'           => 'DATE',
                'default' =>'CURRENT_TIMESTAMP',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'FECHAIMPRESODEFINITIVA'          => [
                'type'           => 'DATE',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'CLASIFICACIONDOCTOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'AUTOR'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'OFICINAIDAUTOR'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'STATUSDOCUMENTOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PLANTILLAID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'CALIFICACION'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'ESTADOACCESO'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'M',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'EMPLEADORESPONSABLE'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'EXPAREAIDRESPONSABLE'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'EXPEMPIDRESPONSABLE'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PUBLICADO'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'N',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'RUTAALMACENAMIENTOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'STATUSALMACENID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'EXPORTAR'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '10',
                'null'=>TRUE,
            ],
         
        ]);
        $this->forge->addKey('EXPEDIENTEDID', TRUE);
        $this->forge->addForeignKey('EXPEDIENTEID', '', '');
        $this->forge->addForeignKey('EXPEDIENTEDOCTOID', '', '');
        $this->forge->addForeignKey('CLASIFICACIONDOCTOID', '', '');
        $this->forge->addForeignKey('OFICINAIDAUTOR', '', '');
        $this->forge->addForeignKey('STATUSDOCUMENTOID', '', '');
        $this->forge->addForeignKey('PLANTILLAID', '', '');
        $this->forge->addForeignKey('EXPAREAIDRESPONSABLE', '', '');
        $this->forge->addForeignKey('EXPEMPIDRESPONSABLE', '', '');
        $this->forge->addForeignKey('RUTAALMACENAMIENTOID', '', '');
        $this->forge->addForeignKey('STATUSALMACENID', '', '');
        $this->forge->createTable('EXPEDIENTEDOCUMENTO');
    }

    public function down()
    {
        $this->forge->dropTable('EXPEDIENTEDOCUMENTO');
    }
}
