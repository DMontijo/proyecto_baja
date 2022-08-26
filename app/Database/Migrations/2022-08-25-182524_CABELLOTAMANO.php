<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CABELLOTAMANO extends Migration
{
    public function up()
    {
    $this->forge->addField([
        'CABELLOTAMANOID' => [
            'type' => 'INT',
            'unsigned' => TRUE,
            'auto_increment' => TRUE
        ],
        'CABELLOTAMANODESCR' => [
            'type' => 'VARCHAR',
            'constraint' => 200,
            'null' => TRUE,
        ],
        
    ]);

    $this->forge->addKey('CABELLOTAMANOID', true);
    $this->forge->createTable('CABELLOTAMANO', true);
}

public function down()
{
    $this->forge->dropTable('CABELLOTAMANO', true);
}
}
