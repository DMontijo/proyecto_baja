<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DELITOMODALIDAD extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'DELITOMODALIDADID' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'DELITOMODALIDADDESCR' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'DELITOMODALIDADARTICULO' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'DELITOCAPITULOID' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'DELITOCLASIFICACION' => [
                'type' => 'CHAR',
                'constraint' => '1',
                'null' => true,
            ],
            'DELITOPERSONAL' => [
                'type' => 'CHAR',
                'constraint' => '1',
                'null' => true,
            ],
            'HABILITADO' => [
                'type' => 'CHAR',
                'constraint' => '1',
                'null' => true,
            ],
            'DELITOPESO' => [
                'type' => 'CHAR',
                'constraint' => '1',
                'null' => true,
            ],
            'INTENCIONALIDADID' => [
                'type' => 'CHAR',
                'constraint' => '1',
                'null' => true,
            ],
            'TIPOQUERELLA' => [
                'type' => 'CHAR',
                'constraint' => '1',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('DELITOMODALIDADID', true);
        $this->forge->createTable('DELITOMODALIDAD');
    }

    public function down()
    {
        $this->forge->dropTable('DELITOMODALIDAD');

    }
}
