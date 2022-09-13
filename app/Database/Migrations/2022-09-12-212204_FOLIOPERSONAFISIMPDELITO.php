<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIOPERSONAFISIMPDELITO extends Migration
{
    public function up()
    {
    $this->forge->addField([
        'FOLIOID' => [
            'type' => 'INT',
            'unsigned' => true,
        ],
        'ANO' => [
            'type' => 'INT',
            'constraint' => '4',
        ],
        'PERSONAFISICAID' => [
            'type' => 'INT',
            'unsigned' => true,
        ],
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
    $this->forge->addKey('FOLIOID', true);
    $this->forge->addKey('ANO', true);
    $this->forge->addKey('PERSONAFISICAID', true);
    $this->forge->addKey('DELITOMODALIDADID', true);

    $this->forge->createTable('FOLIOPERSONAFISIMPDELITO');
    }

public function down()
{
    $this->forge->dropTable('FOLIOPERSONAFISIMPDELITO');

}
}
