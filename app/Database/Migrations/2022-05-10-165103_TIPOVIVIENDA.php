<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TIPOVIVIENDA extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'TIPOVIVIENDAID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'TIPOVIVIENDADESCR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
        ]);
        $this->forge->addKey('TIPOVIVIENDAID', TRUE);
        $this->forge->createTable('CATEGORIA_TIPOVIVIENDA');
    }

    public function down()
    {
        $this->forge->dropTable('CATEGORIA_TIPOVIVIENDA');
    }
}
