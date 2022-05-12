<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PRIVILEGIOS extends Migration
{
    public function up()
    {
      
        $this->forge->addField([
            'IDPRIVILEGIO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'NOMBRE_PRIVILEGIO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'IDPERFIL'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
        ]);
        $this->forge->addKey('IDPRIVILEGIO', TRUE);
        $this->forge->addForeignKey('IDPERFIL', 'CATEGORIA_PERFILES', 'IDCATPERFILES');
        $this->forge->createTable('PRIVILEGIOS');
    }

    public function down()
    {
        $this->forge->dropTable('PRIVILEGIOS');
    }
}
