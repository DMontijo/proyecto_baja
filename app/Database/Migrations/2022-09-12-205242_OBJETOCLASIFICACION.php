<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OBJETOCLASIFICACION extends Migration
{    public function up()
    {
        $this->forge->addField([
            'OBJETOCLASIFICACIONID' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment'=>true,
            ],
            'OBJETOCLASIFICACIONDESCR' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('OBJETOCLASIFICACIONID', true);
        $this->forge->createTable('OBJETOCLASIFICACION');
    }

    public function down()
    {
        $this->forge->dropTable('OBJETOCLASIFICACION');

    }
}
