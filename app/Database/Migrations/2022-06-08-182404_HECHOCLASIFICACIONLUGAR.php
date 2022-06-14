<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HECHOCLASIFICACIONLUGAR extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'HECHOCLASIFICACIONLUGARID'          => [
                'type'           => 'INT',
                'constraint'     => '3',
            ],
            'HECHOCLASIFICACIONLUGARDESCR'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'HECHOLUGARID'       => [
                'type'           => 'INT',
                'constraint'     => '5',
            ],
        ]);
        $this->forge->addKey('HECHOCLASIFICACIONLUGARID', TRUE);
        $this->forge->createTable('HECHOCLASIFICACIONLUGAR');
    }

    public function down()
    {
        $this->forge->dropTable('HECHOCLASIFICACIONLUGAR');
    }
}
