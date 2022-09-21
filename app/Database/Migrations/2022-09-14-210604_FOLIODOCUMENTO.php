<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIODOCUMENTO extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'FOLIOID' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'ANO' => [
                'type' => 'INT',
                'constraint' => '4',
            ],
            'EXPEDIENTEDOCTOID' => [
                'type' => 'INT',
                'constraint' => '4',
            ],
            'DOCTODESCR' => [
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => true,
            ],
            'DOCUMENTO' => [
				'type' => 'LONGBLOB',
				'null' => TRUE,
			],
            'FECHAIMPRESODEFINITIVA' => [
				'type' => 'DATE',
				'null' => TRUE,
			],
            'CLASIFICACIONDOCTOID' => [
                'type' => 'INT',
                'constraint' => '5',
            ],
            'AUTOR' => [
                'type' => 'INT',
                'constraint' => '5',
            ],
            'OFICINAIDAUTOR' => [
                'type' => 'INT',
                'constraint' => '5',
            ],
            'STATUSDOCUMENTOID' => [
                'type' => 'INT',
                'constraint' => '5',
            ],
            'PLANTILLAID' => [
                'type' => 'INT',
                'constraint' => '10',
            ],
            'CALIFICACION' => [
                'type' => 'CHAR',
                'constraint' => '1',
            ],
            'ESTADOACCESO' => [
                'type' => 'CHAR',
                'constraint' => '1',
            ],
            'EMPLEADORESPONSABLE' => [
                'type' => 'INT',
                'constraint' => '5',
            ],
            'EXPAREAIDRESPONSABLE' => [
                'type' => 'INT',
                'constraint' => '5',
            ],
            'EXPEMPIDRESPONSABLE' => [
                'type' => 'INT',
                'constraint' => '5',
            ],
            'PUBLICADO' => [
                'type' => 'CHAR',
                'constraint' => '1',
            ],
            'RUTAALMACENAMIENTOID' => [
                'type' => 'INT',
                'constraint' => '2',
            ],
            'STATUSALMACENID' => [
                'type' => 'INT',
                'constraint' => '2',
            ],
            'EXPORTAR' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
            ],
            'FECHACREACION DATETIME DEFAULT CURRENT_TIMESTAMP',
            'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',

        ]);
        $this->forge->addKey('FOLIOID', true);
        $this->forge->addKey('ANO', true);
        $this->forge->addKey('EXPEDIENTEDOCTOID', true);

        $this->forge->createTable('FOLIODOCUMENTO');
    }

    public function down()
    {
        $this->forge->dropTable('FOLIODOCUMENTO');
    }
}
