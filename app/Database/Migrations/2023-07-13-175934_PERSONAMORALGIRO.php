<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PERSONAMORALGIRO extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'PERSONAMORALGIROID' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'PERSONAMORALGIRODESCR' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],

        ]);
        $this->forge->addKey('PERSONAMORALGIROID', true);
    

        $this->forge->createTable('PERSONAMORALGIRO');
    }

    public function down()
    {
        $this->forge->dropTable('PERSONAMORALGIRO');
    }
}
