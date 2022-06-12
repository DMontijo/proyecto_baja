<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VEHICULOVERSION extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
			],
            'VEHICULODISTRIBUIDORID'          => [
                'type'           => 'INT',
                'constraint'     => '2',
            ],
            'VEHICULOMARCAID'       => [
                'type'           => 'INT',
                'constraint'     => '5',
            ],
            'VEHICULOMODELOID'       => [
                'type'           => 'INT',
                'constraint'     => '5',
            ],
            'VEHICULOVERSIONID'       => [
                'type'           => 'INT',
                'constraint'     => '5',
            ],
            'VEHICULOVERSIONDESCR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
        ]);
        $this->forge->addKey('ID', TRUE);
        $this->forge->createTable('VEHICULOVERSION');
    }

    public function down()
    {
        $this->forge->dropTable('VEHICULOVERSION');
    }
}
