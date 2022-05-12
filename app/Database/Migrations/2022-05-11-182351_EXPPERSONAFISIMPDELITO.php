<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EXPPERSONAFISIMPDELITO extends Migration
{
    public function up()
    {
       
        $this->forge->addField([
            'EXPEDIENTEPFIMID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'EXPEDIENTEID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
            'PERSONAFISICAID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'DELITOMODALIDADID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'DELITOCARACTERISTICAID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'TENTATIVA'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'M',
                'null'=>TRUE,
            ],
        ]);
        $this->forge->addKey('EXPEDIENTEPFIMID', TRUE);
        $this->forge->addForeignKey('EXPEDIENTEID', 'EXPEDIENTE', 'EXPEDIENTEID');
      /*   $this->forge->addForeignKey('PERSONAFISICAID', '', '');
        $this->forge->addForeignKey('DELITOMODALIDADID', '', '');
        $this->forge->addForeignKey('DELITOCARACTERISTICAID', '', '');
       */  $this->forge->createTable('EXPPERSONAFISIMPDELITO');
    }

    public function down()
    {
        $this->forge->dropTable('EXPPERSONAFISIMPDELITO');
    }
}
