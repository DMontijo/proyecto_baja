<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CATEGORIADELITOS extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'IDDELITO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'NOMBRE_DELITO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
        ]);
        $this->forge->addKey('IDDELITO', TRUE);
        $this->forge->createTable('CATEGORIA_DELITOS');
    }

    public function down()
    {
        $this->forge->dropTable('CATEGORIA_DELITOS');
    }
}
