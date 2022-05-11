<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CATEGORIAMUNICIPIO extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'IDMUNICIPIO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'NOMBRE_MUNICIPIO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'IDPERFIL'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
        ]);
        $this->forge->addKey('IDMUNICIPIO', TRUE);
        $this->forge->createTable('CATEGORIA_MUNICIPIO');
    }

    public function down()
    {
        $this->forge->dropTable('CATEGORIA_MUNICIPIO');
    }
}
