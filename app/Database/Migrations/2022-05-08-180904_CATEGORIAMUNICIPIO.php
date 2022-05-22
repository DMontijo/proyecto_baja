<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CATEGORIAMUNICIPIO extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'MUNICIPIOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'MUNICIPIODESCR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'ESTADOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
            'SECUENCIAEXPEDIENTE'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
        ]);
        $this->forge->addKey('MUNICIPIOID', TRUE);
        // $this->forge->addForeignKey('ESTADOID', 'CATEGORIA_ESTADO', 'ESTADOID');
        $this->forge->createTable('CATEGORIA_MUNICIPIO');
    }

    public function down()
    {
        $this->forge->dropTable('CATEGORIA_MUNICIPIO');
    }
}
