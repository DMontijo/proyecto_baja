<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VEHICULOMARCA extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'VEHICULOMARCAID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'VEHICULOMARCADESCR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'VEHICULODISTRIBUIDORID'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
               // 'unsigned'       => TRUE,
            ],
        ]);
        $this->forge->addKey('VEHICULOMARCAID', TRUE);
        $this->forge->createTable('CATEGORIA_VEHICULOMARCA');
    }

    public function down()
    {
        $this->forge->dropTable('CATEGORIA_VEHICULOMARCA');
    }
}
