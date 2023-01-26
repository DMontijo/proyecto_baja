<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BANDEJARAC extends Migration
{

    public function up()
    {
        $this->forge->addField([
            'FOLIOID' => [
                'type' => 'INT',
                'unsigned' => TRUE,
            ],
            'ANO' => [
                'type' => 'INT',
                'constraint' => '4',
            ],
            'EXPEDIENTEID' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'TIPOPROCEDIMIENTOID' => [
                'type' => 'INT',
                'constraint' => '10',
            ],
            
            'MODULOID' => [
                'type' => 'INT',
                'constraint' => '10',
            ],
            'MEDIADORID' => [
                'type' => 'INT',
                'constraint' => '10',
            ],
        ]);
        $this->forge->addKey('FOLIOID', TRUE);
        $this->forge->addKey('ANO', TRUE);
        $this->forge->addKey('EXPEDIENTEID', TRUE);
        $this->forge->createTable('BANDEJARAC');
    }

    public function down()
    {
        $this->forge->dropTable('BANDEJARAC');
    }
}
