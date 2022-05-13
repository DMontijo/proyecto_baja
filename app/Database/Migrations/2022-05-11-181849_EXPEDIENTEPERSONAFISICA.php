<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EXPEDIENTEPERSONAFISICA extends Migration
{
    public function up()
    {
       
        $this->forge->addField([
            'PERSONAFISICAID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'EXPEDIENTEID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'CALIDADJURIDICAID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'RESERVARIDENTIDAD'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'N',
            ],
            'DENUNCIANTE'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'N',
            ],
            'VIVA'          => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' => 'S',
            ],
            'TIPOIDENTIFICACIONID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'NUMEROIDENTIFICACION'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'null'=>TRUE,
            ],
            'NOMBRE'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'PRIMERAPELLIDO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'null'=>TRUE,
            ],
            'SEGUNDOAPELLIDO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'null'=>TRUE,
            ],
            'NUMEROIDENTIDAD'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '30',
                'null'=>TRUE,
            ],
            'ESTADOORIGENID'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'MUNICIPIOORIGENID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'FECHANACIMIENTO'          => [
                'type'           => 'DATE',
            ],
            'SEXO'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'TELEFONO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'CORREO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'EDADCANTIDAD'       => [
                'type'           => 'INT',
                'constraint'     => '5',
                'null'=>TRUE,
            ],
            'EDADTIEMPO'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'NACIONALIDADID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'ESTADOCIVILID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'APODO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'FOTO'       => [
                'type'           => 'BLOB',
                'constraint'     => '30',
                'null'=>TRUE,
            ],
            'ESTADOJURIDICOIMPUTADOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'HECHOMUNICIPIOID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'DESAPARECIDA'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
            ],
            'PERSONATIPOMUERTEID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'PERSONARELIGIONID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'TIPOVIVIENDAID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'LUGARFRECUENTA'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '200',
                'null'=>TRUE,
            ],
            'VESTUARIO'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'AFECTOBEBIDA'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'BEBIDAS'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'AFECTODROGA'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'null'=>TRUE,
            ],
            'DROGAS'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'=>TRUE,
            ],
            'FECHAREGISTRO'       => [
                'type'           => 'DATE',
                'null'=>TRUE,
            ],
            'SOLICITANTEASESORIA'       => [
                'type'           => 'CHAR',
                'constraint'     => '1',
                'default' =>'N',
            ],
            'INGRESOS'       => [
                'type'           => 'DECIMAL(12,2)',
                'null'=>TRUE,
            ],
            'PERSONAIDIOMAID'       => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'TIEMPORESIDEANOS'       => [
                'type'           => 'INT',
                'constraint'     => '3',
                'null'=>TRUE,
            ],
            'TIEMPORESIDEMESES'       => [
                'type'           => 'INT',
                'constraint'     => '3',
                'null'=>TRUE,
            ],
            'TIEMPORESIDEDIAS'       => [
                'type'           => 'INT',
                'constraint'     => '3',
                'null'=>TRUE,
            ],
        ]);
        $this->forge->addKey('PERSONAFISICAID', TRUE);
        $this->forge->addForeignKey('EXPEDIENTEID', 'EXPEDIENTE', 'EXPEDIENTEID');
        $this->forge->addForeignKey('CALIDADJURIDICAID', 'CATEGORIA_PERSONACALIDADJURIDICA', 'PERSONACALIDADJURIDICAID');
        $this->forge->addForeignKey('TIPOIDENTIFICACIONID', 'CATEGORIA_PERSONATIPOIDENTIFICACION', 'PERSONATIPOIDENTIFICACIONID');
        $this->forge->addForeignKey('ESTADOORIGENID', 'CATEGORIA_ESTADO', 'ESTADOID');
        $this->forge->addForeignKey('MUNICIPIOORIGENID',  'CATEGORIA_MUNICIPIO', 'MUNICIPIOID');
        $this->forge->addForeignKey('NACIONALIDADID', 'CATEGORIA_PERSONANACIONALIDAD', 'PERSONANACIONALIDADID');
        $this->forge->addForeignKey('ESTADOCIVILID', 'CATEGORIA_PERSONAEDOCIVIL', 'PERSONAESTADOCIVILID');
      /*  $this->forge->addForeignKey('ESTADOJURIDICOIMPUTADOID', '', '');
        $this->forge->addForeignKey('PERSONATIPOMUERTEID', '', '');*/
     $this->forge->addForeignKey('PERSONARELIGIONID', 'CATEGORIA_PERSONARELIGION', 'PERSONARELIGIONID');
        $this->forge->addForeignKey('TIPOVIVIENDAID', 'CATEGORIA_TIPOVIVIENDA', 'TIPOVIVIENDAID');
        $this->forge->createTable('EXPEDIENTEPERSONAFISICA');
    }

    public function down()
    {
         $this->forge->dropTable('EXPEDIENTEPERSONAFISICA');
    }
}
