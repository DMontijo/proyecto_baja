<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIO extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'FOLIOID' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'ANO' => [
                'type' => 'INT',
                'constraint' => '4',
            ],
            'EXPEDIENTEID' => [
                'type' => 'VARCHAR',
                'constraint' => '16',
                'null' => true,
            ],
            'DENUNCIANTEID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'AGENTEATENCIONID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'MUNICIPIOASIGNADOID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'AGENTEFIRMAID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'STATUS' => [
                'type' => 'VARCHAR',
                'constraint' => '200',
                'default' => 'ABIERTO',
            ],
            'NOTASAGENTE' => [
                'type' => 'TEXT',
                'constraint' => '300',
                'null' => true,
            ],
            'TIPOEXPEDIENTEID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'TIPODENUNCIA' => [
                'type' => 'VARCHAR',
                'constraint' => '2',
                'null' => true,
            ],
            'ESTADOID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'MUNICIPIOID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'HECHODELITO' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'HECHOMEDIOCONOCIMIENTOID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'HECHOFECHA' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'HECHOHORA' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'HECHOLUGARID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'HECHOESTADOID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'HECHOMUNICIPIOID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'HECHOLOCALIDADID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'HECHODELEGACIONID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'HECHOZONA' => [
                'type' => 'CHAR',
                'constraint' => '1',
                'null' => true,
            ],
            'HECHOCOLONIAID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'HECHOCOLONIADESCR' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'HECHOCALLE' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'HECHONUMEROCASA' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => true,
            ],
            'HECHONUMEROCASAINT' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => true,
            ],
            'HECHOREFERENCIA' => [
                'type' => 'TEXT',
                'constraint' => '300',
                'null' => true,
            ],
            'HECHONARRACION' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'HECHOCOORDENADAX' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
            ],
            'HECHOCOORDENADAY' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
            ],
            'HECHOCLASIFICACIONLUGARID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'HECHOVIALIDADID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'LOCALIZACIONPERSONA' => [
                'type' => 'CHAR',
                'constraint' => '1',
                'default' => 'N',
            ],
            'DERECHOSOFENDIDO' => [
                'type' => 'CHAR',
                'constraint' => '1',
                'default' => 'S',
            ],
            'LOCALIZACIONPERSONAMEDIOS' => [
                'type' => 'CHAR',
                'constraint' => '1',
                'default' => 'N',
            ],
            'FECHASALIDA' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP',
            'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',
        ]);
        $this->forge->addKey('FOLIOID', true);
        $this->forge->addKey('ANO', true);
        $this->forge->createTable('FOLIO');
    }

    public function down()
    {
        $this->forge->dropTable('FOLIO');
    }
}
