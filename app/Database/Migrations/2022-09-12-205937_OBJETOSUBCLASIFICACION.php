<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OBJETOSUBCLASIFICACION extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'OBJETOCLASIFICACIONID' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'OBJETOSUBCLASIFICACIONID' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'OBJETOSUBCLASIFICACIONDESCR' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('OBJETOCLASIFICACIONID', true);
        $this->forge->addKey('OBJETOSUBCLASIFICACIONID', true);

        $this->forge->createTable('OBJETOSUBCLASIFICACION');
    }

    public function down()
    {
        $this->forge->dropTable('OBJETOSUBCLASIFICACION');

    }
}
