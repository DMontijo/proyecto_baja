<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIORELACIONMORALFIS extends Migration
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
            'PERSONAMORALIDVICTIMA' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'DELITOMODALIDADID' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'PERSONAFISICAIDIMPUTADO' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'GRADOPARTICIPACIONID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'TENTATIVA' => [
                'type' => 'CHAR',
                'constraint' => '1',
                'null' => true,
            ],
            'CONVIOLENCIA' => [
                'type' => 'CHAR',
                'constraint' => '1',
                'null' => true,
            ],

        ]);
        $this->forge->addKey('FOLIOID', true);
        $this->forge->addKey('ANO', true);
        $this->forge->addKey('PERSONAFISICAIDVICTIMA', true);
        $this->forge->addKey('DELITOMODALIDADID', true);
        $this->forge->addKey('PERSONAFISICAIDIMPUTADO', true);

        $this->forge->createTable('FOLIORELACIONMORALFIS');
    }

    public function down()
    {
        $this->forge->dropTable('FOLIORELACIONMORALFIS');
    }
}
