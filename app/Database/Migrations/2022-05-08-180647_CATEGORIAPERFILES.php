<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CATEGORIAPERFILES extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'IDCATPERFILES'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'NOMBRE_PERFIL'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
        ]);
        $this->forge->addKey('IDCATPERFILES', TRUE);
        $this->forge->createTable('CATEGORIA_PERFILES');
    }

    public function down()
    {
        $this->forge->dropTable('CATEGORIA_PERFILES');
    }
}
