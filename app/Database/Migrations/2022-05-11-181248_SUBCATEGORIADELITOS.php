<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SUBCATEGORIADELITOS extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'IDSUBDELITO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'NOMBRE_SUBDELITO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'IDDELITO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
        ]);
        $this->forge->addKey('IDDELITO', TRUE);
        $this->forge->addForeignKey('IDDELITO', 'CATEGORIA_DELITOS', 'IDDELITO');
        $this->forge->createTable('SUBCATEGORIA_DELITOS');
    }

    public function down()
    {
        $this->forge->dropTable('SUBCATEGORIA_DELITOS');
    }
}
