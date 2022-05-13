<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ATENCIONCIUDADANO extends Migration
{
    public function up()
    {
        
        $this->forge->addField([
            'IDATENCION'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'FOLIO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
            'FECHA_HORA'       => [
                'type'           => 'DATETIME',
            ],
            'IDMUNICIPIO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'IDCIUDADANO'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'IDEXPEDIENTE'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'IDDERIVACION'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'IDAGENTE'          => [
                'type'           => 'INT',
               'unsigned'       => TRUE,
            ],
            'ID_MODULO_SEJAP'       => [
                'type'           => 'INT',
              //  'unsigned'       => TRUE,
            ],
            'NOTAS'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '200',
            ],

        ]);
        $this->forge->addKey('IDATENCION', TRUE);
        $this->forge->addForeignKey('IDMUNICIPIO', 'CATEGORIA_MUNICIPIO', 'MUNICIPIOID');
        $this->forge->addForeignKey('IDCIUDADANO', 'DENUNCIANTE', 'IDDENUNCIANTE');
     /*   $this->forge->addForeignKey('IDEXPEDIENTE', 'EXPEDIENTE', 'EXPEDIENTEID');
        $this->forge->addForeignKey('IDDERIVACION', 'DERIVACION', 'IDDERIVACION');
        $this->forge->addForeignKey('IDAGENTE', 'USUARIOS', 'IDUSUARIO');
      */ //  $this->forge->addForeignKey('ID_MODULO_SEJAP', '', '');
        $this->forge->createTable('ATENCION_CIUDADANO');
    }

    public function down()
    {
        $this->forge->dropTable('ATENCION_CIUDADANO');
    }
}
