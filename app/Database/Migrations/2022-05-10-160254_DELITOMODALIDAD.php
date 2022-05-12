<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DELITOMODALIDAD extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'DELITOMODALIDADID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'DELITOMODALIDADDESCR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '800',
                'null' => TRUE,
            ],
            'DELITOMODALIDADARTICULO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null' => TRUE,
            ],
            'DELITOCAPITULOID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null' => TRUE,
            ],
            'DELITOCLASIFICACION'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'DELITOPERSONAL'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'HABILITADO'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'DELITOPESO'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'INTENCIONALIDADID'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ],
            'TIPOQUERELLA'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null' => TRUE,
            ],
        ]);
        $this->forge->addKey('DELITOMODALIDADID', TRUE);
     /*    $this->forge->addForeignKey('DELITOCAPITULOID', '', '');
        $this->forge->addForeignKey('INTENCIONALIDADID', '', '');
      */   $this->forge->createTable('DELITOMODALIDAD');
    }

    public function down()
    {
        $this->forge->dropTable('DELITOMODALIDAD');
    }

}
