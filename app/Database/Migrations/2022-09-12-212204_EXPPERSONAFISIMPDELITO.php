<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EXPPERSONAFISIMPDELITO extends Migration
{
    public function up()
    {
    $this->forge->addField([
        'DELITOMODALIDADID' => [
            'type' => 'INT',
            'unsigned' => true,
        ],
        'DELITOCARACTERISTICAID' => [
            'type' => 'INT',
            'unsigned' => true,
        ],
        'TENTATIVA' => [
            'type' => 'CHAR',
            'constraint' => '1',
            'null' => true,
        ],
       
    ]);
    $this->forge->addKey('DELITOMODALIDADID', true);

    $this->forge->createTable('EXPPERSONAFISIMPDELITO');
    }

public function down()
{
    $this->forge->dropTable('EXPPERSONAFISIMPDELITO');

}
}
