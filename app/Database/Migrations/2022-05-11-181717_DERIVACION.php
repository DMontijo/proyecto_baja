<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DERIVACION extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'IDDERIVACION'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'IDATENCIONC'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'IDDEPDERIVACION'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
        ]);
        $this->forge->addKey('IDDERIVACION', TRUE);
        $this->forge->addForeignKey('IDDEPDERIVACION', 'CATEGORIA_DERIVACION', 'IDCATDERIVACION');
        $this->forge->createTable('DERIVACION');
    }

    public function down()
    {
        $this->forge->dropTable('DERIVACION');
    }
}
