<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PERSONAIDIOMA extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'PERSONAIDIOMAID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'PERSONAIDIOMADESCR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            
        ]);
        $this->forge->addKey('PERSONAIDIOMAID', TRUE);
        $this->forge->createTable('CATEGORIA_PERSONAIDIOMA');
    }

    public function down()
    {
        $this->forge->dropTable('CATEGORIA_PERSONAIDIOMA');
    }
}
