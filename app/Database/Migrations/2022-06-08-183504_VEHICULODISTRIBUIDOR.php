<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VEHICULODISTRIBUIDOR extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'VEHICULODISTRIBUIDORID'          => [
                'type'           => 'INT',
                'constraint'     => '2',
            ],
            'VEHICULODISTRIBUIDORDESCR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'null' => TRUE,
            ],
        ]);
        $this->forge->addKey('VEHICULODISTRIBUIDORID', TRUE);
        $this->forge->createTable('VEHICULODISTRIBUIDOR');
    }

    public function down()
    {
        $this->forge->dropTable('VEHICULODISTRIBUIDOR');
    }
}
