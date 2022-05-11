<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class USUARIOS extends Migration
{
    public function up()
    {
      
        $this->forge->addField([
            'IDUSUARIO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'NOMBRE'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'APELLIDO_PATERNO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'APELLIDO_MATERNO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null' => TRUE,
            ],
            'SEXO_BIOLOGICO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
            ],
            'CORREO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'PASSWORD'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'HUELLA_DIGITAL'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'FIRMA_DIGITAL'       => [
                'type'           => 'TEXT',
            ],
            'IDPERFIL'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],

        ]);
        $this->forge->addKey('IDUSUARIO', TRUE);
        $this->forge->addForeignKey('IDPERFIL', 'CATEGORIA_PERFILES', 'IDCATPERFILES');
        $this->forge->createTable('USUARIOS');
    }

    public function down()
    {
        $this->forge->dropTable('USUARIOS');
    }
}
