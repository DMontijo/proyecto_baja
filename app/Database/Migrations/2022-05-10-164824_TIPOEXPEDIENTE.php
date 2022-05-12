<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TIPOEXPEDIENTE extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'TIPOEXPEDIENTEID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'TIPOEXPEDIENTEDESCR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'TIPOEXPEDIENTECLAVE'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'EDOJURIDICOIMPINICIALID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'PERMITECONCLUIR'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
            ],
        ]);
        $this->forge->addKey('TIPOEXPEDIENTEID', TRUE);
      //  $this->forge->addForeignKey('EDOJURIDICOIMPINICIALID', '', '');
        $this->forge->createTable('CATEGORIA_TIPOEXPEDIENTE');
    }

    public function down()
    {
        $this->forge->dropTable('CATEGORIA_TIPOEXPEDIENTE');
    }
}
