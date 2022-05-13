<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CATEGORIAESTADO extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ESTADOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'ESTADODESCR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
        ]);
        $this->forge->addKey('ESTADOID', TRUE);
        $this->forge->createTable('CATEGORIA_ESTADO');
    }

    public function down()
    {
        $this->forge->dropTable('CATEGORIA_ESTADO');
    }
}
