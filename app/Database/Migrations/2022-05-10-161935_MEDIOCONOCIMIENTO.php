<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MEDIOCONOCIMIENTO extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'MEDIOCONOCIMIENTOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'MEDIOCONOCIMIENTODESCR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'COMPORTAMIENTO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ]
        ]);
        $this->forge->addKey('MEDIOCONOCIMIENTOID', TRUE);
        $this->forge->createTable('CATEGORIA_MEDIOCONOCIMIENTO');
    }

    public function down()
    {
        $this->forge->dropTable('CATEGORIA_MEDIOCONOCIMIENTO');
    }
}
