<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PERSONACALIDADJURIDICA extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'PERSONACALIDADJURIDICAID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'PERSONACALIDADJURIDICADESCR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '200',
            ],
            'COMPORTAMIENTO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
            
        ]);
        $this->forge->addKey('PERSONACALIDADJURIDICAID', TRUE);
        $this->forge->createTable('CATEGORIA_PERSONACALIDADJURIDICA');
    }

    public function down()
    {
        $this->forge->dropTable('CATEGORIA_PERSONACALIDADJURIDICA');
    }
}
