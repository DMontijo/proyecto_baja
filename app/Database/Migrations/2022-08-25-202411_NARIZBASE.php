<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NARIZBASE extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'NARIZBASEID' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'NARIZBASEDESCR' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => TRUE,
            ],

        ]);

        $this->forge->addKey('NARIZBASEID', true);
        $this->forge->createTable('NARIZBASE', true);
    }

    public function down()
    {
        $this->forge->dropTable('NARIZBASE', true);
    }
}
