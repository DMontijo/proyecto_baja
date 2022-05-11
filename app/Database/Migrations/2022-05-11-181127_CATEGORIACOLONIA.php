<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CATEGORIACOLONIA extends Migration
{
    public function up()
    {
      
        $this->forge->addField([
            'IDCOLONIA'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'NOMBRE_COLONIA'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ]
        ]);
        $this->forge->addKey('IDCOLONIA', TRUE);
        $this->forge->createTable('CATEGORIA_COLONIA');
    }

    public function down()
    {
        $this->forge->dropTable('CATEGORIA_COLONIA');
    }
}
