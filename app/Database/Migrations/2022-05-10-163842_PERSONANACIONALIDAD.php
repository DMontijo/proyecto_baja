<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PERSONANACIONALIDAD extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'PERSONANACIONALIDADID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'PERSONANACIONALIDADDESCR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            
        ]);
        $this->forge->addKey('PERSONANACIONALIDADID', TRUE);
        $this->forge->createTable('PERSONANACIONALIDAD');
    }

    public function down()
    {
        $this->forge->dropTable('PERSONANACIONALIDAD');
    }
}
