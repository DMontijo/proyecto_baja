<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PERSONARELIGION extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'PERSONARELIGIONID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'PERSONARELIGIONDESCR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            
        ]);
        $this->forge->addKey('PERSONARELIGIONID', TRUE);
        $this->forge->createTable('CATEGORIA_PERSONARELIGION');
    }

    public function down()
    {
        $this->forge->dropTable('CATEGORIA_PERSONARELIGION');
    }
}
