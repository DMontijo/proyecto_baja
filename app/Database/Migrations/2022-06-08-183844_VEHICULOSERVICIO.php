<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VEHICULOSERVICIO extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'VEHICULOSERVICIOID'          => [
                'type'           => 'INT',
                'constraint'     => '2',
            ],
            'VEHICULOSERVICIODESCR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
        ]);
        $this->forge->addKey('VEHICULOSERVICIOID', TRUE);
        $this->forge->createTable('VEHICULOSERVICIO');
    }

    public function down()
    {
        $this->forge->dropTable('VEHICULOSERVICIO');
    }
}
