<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CATEGORIALOCALIDAD extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'IDLOCALIDAD'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'NOMBRE_LOCALIDAD'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ]
        ]);
        $this->forge->addKey('IDLOCALIDAD', TRUE);
        $this->forge->createTable('CATEGORIA_LOCALIDAD');
    }

    public function down()
    {
        $this->forge->dropTable('CATEGORIA_LOCALIDAD');
    }
}
