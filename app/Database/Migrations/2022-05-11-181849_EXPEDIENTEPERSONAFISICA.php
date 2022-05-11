<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EXPEDIENTEPERSONAFISICA extends Migration
{
    public function up()
    {
       
        $this->forge->addField([
            'EXPEDIENTEPFID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'EXPEDIENTEID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE
            ],
            'PERSONAFISICAID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'CALIDADJURIDICAID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'RESERVARIDENTIDAD'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'N',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'DENUNCIANTE'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'N',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'VIVA'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'S',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'TIPOIDENTIFICACIONID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'NUMEROIDENTIFICACION'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '20',
                'null'=>TRUE,
            ],
            'NOMBRE'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'PRIMERAPELLIDO'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '50',
                'null'=>TRUE,
            ],
            'SEGUNDOAPELLIDO'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '50',
                'null'=>TRUE,
            ],
            'NUMEROIDENTIDAD'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '30',
                'null'=>TRUE,
            ],
            'ESTADOORIGENID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'MUNICIPIOORIGENID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'FECHANACIMIENTO'          => [
                'type'           => 'DATE',
                'unsigned'       => TRUE,
            ],
            'SEXO'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'TELEFONO'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'CORREO'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'EDADCANTIDAD'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'constraint'     => '5',
                'null'=>TRUE,
            ],
            'EDADTIEMPO'       => [
                'type'           => 'CHAR',
                'unsigned'       => TRUE,
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'NACIONALIDADID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'constraint'     => '5',
                'null'=>TRUE,
            ],
            'ESTADOCIVILID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'constraint'     => '5',
                'null'=>TRUE,
            ],
            'APODO'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'FOTO'       => [
                'type'           => 'BLOB',
                'unsigned'       => TRUE,
                'constraint'     => '30',
                'null'=>TRUE,
            ],
            'ESTADOJURIDICOIMPUTADOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'HECHOMUNICIPIOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'DESAPARECIDA'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
            ],
            'PERSONATIPOMUERTEID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PERSONARELIGIONID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'TIPOVIVIENDAID'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
            ],
            'LUGARFRECUENTA'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '200',
                'null'=>TRUE,
            ],
            'VESTUARIO'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'AFECTOBEBIDA'       => [
                'type'           => 'CHAR',
                'unsigned'       => TRUE,
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'BEBIDAS'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'AFECTODROGA'       => [
                'type'           => 'CHAR',
                'unsigned'       => TRUE,
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'DROGAS'       => [
                'type'           => 'VARCHAR',
                'unsigned'       => TRUE,
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'FECHAREGISTRO'       => [
                'type'           => 'DATE',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'SOLICITANTEASESORIA'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' =>'N',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'INGRESOS'       => [
                'type'           => 'DECIMAL(12,2)',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'PERSONAIDIOMAID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'=>TRUE,
            ],
            'TIEMPORESIDEANOS'       => [
                'type'           => 'int',
                'unsigned'       => TRUE,
                'constraint'     => '3',
                'null'=>TRUE,
            ],
            'TIEMPORESIDEMESES'       => [
                'type'           => 'int',
                'unsigned'       => TRUE,
                'constraint'     => '3',
                'null'=>TRUE,
            ],
            'TIEMPORESIDEDIAS'       => [
                'type'           => 'int',
                'unsigned'       => TRUE,
                'constraint'     => '3',
                'null'=>TRUE,
            ],
        ]);
        $this->forge->addKey('EXPEDIENTEPFID', TRUE);
        $this->forge->addForeignKey('EXPEDIENTEID', '', '');
        $this->forge->addForeignKey('PERSONAFISICAID', '', '');
        $this->forge->addForeignKey('CALIDADJURIDICAID', '', '');
        $this->forge->addForeignKey('TIPOIDENTIFICACIONID', '', '');
        $this->forge->addForeignKey('ESTADOORIGENID', '', '');
        $this->forge->addForeignKey('MUNICIPIOORIGENID', '', '');
        $this->forge->addForeignKey('NACIONALIDADID', '', '');
        $this->forge->addForeignKey('ESTADOCIVILID', '', '');
        $this->forge->addForeignKey('ESTADOJURIDICOIMPUTADOID', '', '');
        $this->forge->addForeignKey('PERSONATIPOMUERTEID', '', '');
        $this->forge->addForeignKey('PERSONARELIGIONID', '', '');
        $this->forge->addForeignKey('TIPOVIVIENDAID', '', '');
        $this->forge->createTable('EXPEDIENTEPERSONAFISICA');
    }

    public function down()
    {
         $this->forge->dropTable('EXPEDIENTEPERSONAFISICA');
    }
}
