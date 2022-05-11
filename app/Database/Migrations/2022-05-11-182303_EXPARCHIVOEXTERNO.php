<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EXPARCHIVOEXTERNO extends Migration
{
    public function up()
    {
      
        $this->forge->addField([
            'EXPEDIENTEAEID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'EXPEDIENTEID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
            'EXPEDIENTEARCHIVOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'ARCHIVODESCR'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '200',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'CLASIFICACIONID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'ARCHIVO'          => [
                'type'           => 'BLOB',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'EXTENSION'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'FECHAACTUALIZACION'          => [
                'type'           => 'DATE',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'AUTOR'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'OFICINAIDAUTOR'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'CLASIFICACIONDOCTOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'ESTADOACCESO'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'M',
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
                'constraint'     => '10',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
        ]);
        $this->forge->addKey('EXPEDIENTEAEID', TRUE);
        $this->forge->addForeignKey('EXPEDIENTEID', '', '');
        $this->forge->addForeignKey('EXPEDIENTEARCHIVOID', '', '');
        $this->forge->addForeignKey('OFICINAIDAUTOR', '', '');
        $this->forge->addForeignKey('CLASIFICACIONDOCTOID', '', '');
        $this->forge->addForeignKey('RUTAALMACENAMIENTOID', '', '');
        $this->forge->addForeignKey('STATUSALMACENID', '', '');
        $this->forge->createTable('EXPARCHIVOEXTERNO');
    }

    public function down()
    {
        $this->forge->dropTable('EXPARCHIVOEXTERNO');
    }
}
