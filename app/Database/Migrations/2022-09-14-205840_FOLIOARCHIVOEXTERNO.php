<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIOARCHIVOEXTERNO extends Migration
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
            'FOLIOARCHIVOID' => [
                'type' => 'INT',
                'constraint' => '4',
            ],
            'ARCHIVODESCR' => [
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => true,
            ],
            'ARCHIVO' => [
				'type' => 'LONGBLOB',
				'null' => TRUE,
			],
            'EXTENSION' => [
                'type' => 'VARCHAR',
                'constraint' => '16',
                'null' => true,
            ],
            'AUTOR' => [
                'type' => 'INT',
                'constraint' => '5',
            ],
            'OFICINAIDAUTOR' => [
                'type' => 'INT',
                'constraint' => '5',
            ],
            'CLASIFICACIONDOCTOID' => [
                'type' => 'INT',
                'constraint' => '5',
            ],
            'ESTADOACCESO' => [
                'type' => 'CHAR',
                'constraint' => '1',
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
            'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP',
            'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',
        ]);
        $this->forge->addKey('FOLIOID', true);
        $this->forge->addKey('ANO', true);
        $this->forge->addKey('FOLIOARCHIVOID', true);

        $this->forge->createTable('FOLIOARCHIVOEXTERNO');
    }

    public function down()
    {
        $this->forge->dropTable('FOLIOARCHIVOEXTERNO');

    }
}
