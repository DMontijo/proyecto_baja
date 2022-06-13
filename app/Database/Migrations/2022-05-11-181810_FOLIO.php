<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIO extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'FOLIOID' => [
                'type' => 'VARCHAR',
                'constraint' => '16',
            ],
            'DENUNCIANTEID' => [
                'type' => 'INT',
                'unsigned' => TRUE,
            ],
            'AGENTEATENCIONID' => [
                'type' => 'INT',
                'unsigned' => TRUE,
            ],
            'AGENTEFIRMAID' => [
                'type' => 'INT',
                'unsigned' => TRUE,
            ],
            'STATUS' => [
                'type' => 'VARCHAR',
                'constraint' => '200',
                'default' => 'ABIERTO',
            ],
            'NOTAS' => [
                'type' => 'VARCHAR',
                'constraint' => '300',
                'default' => 'SIN NOTAS',
            ],
            'ESTADOID' => [
                'type' => 'INT',
                'unsigned' => TRUE,
            ],
            'MUNICIPIOID' => [
                'type' => 'INT',
                'unsigned' => TRUE,
            ],
            'ANO' => [
                'type' => 'INT',
                'constraint' => '4',
                'null' => TRUE,
            ],
            'CORRELATIVO' => [
                'type' => 'INT',
                'null' => TRUE,
            ],
            'HECHOMEDIOCONOCIMIENTOID' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'HECHOFECHA' => [
                'type' => 'DATE',
                'null' => TRUE,
            ],
			'HECHOHORA' => [
                'type' => 'TIME',
                'null' => TRUE,
            ],
            'HECHOLUGARID' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'HECHOESTADOID' => [
                'type' => 'INT',
                'null' => TRUE,
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'HECHOMUNICIPIOID' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'HECHOLOCALIDADID' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'HECHODELEGACIONID' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'HECHOZONA' => [
                'type' => 'CHAR',
                'constraint' => '1',
                'null' => TRUE,
            ],
            'HECHOCOLONIAID' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'HECHOCOLONIADESCR' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ],
            'HECHOCALLE' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ],
            'HECHONUMEROCASA' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => TRUE,
            ],
            'HECHONUMEROCASAINT' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => TRUE,
            ],
            'HECHOREFERENCIA' => [
                'type' => 'VARCHAR',
                'constraint' => '300',
                'null' => TRUE,
            ],
            'HECHONARRACION' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
            'TIPOEXPEDIENTEID' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'PARTICIPAESTADO' => [
                'type' => 'CHAR',
                'default' => 'N',
                'constraint' => '1',
            ],
            'EMPLEADOIDREGISTRO' => [
                'type' => 'INT',
                'null' => TRUE,
            ],
            'OFICINAIDRESPONSABLE' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'CONFIDENCIAL' => [
                'type' => 'CHAR',
                'default' => 'N',
                'constraint' => '1',
                'null' => TRUE,
            ],
            'ESTADOJURIDICOEXPEDIENTEID' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'RELACIONDOCUMENTOS' => [
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => TRUE,
            ],
            'HECHOCOORDENADAX' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => TRUE,
            ],
            'HECHOCOORDENADAY' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => TRUE,
            ],
            'PARTENUMERO' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => TRUE,
            ],
            'PARTEFECHA' => [
                'type' => 'DATE',
                'null' => TRUE,
            ],
            'PARTEAUTORIDADID' => [
                'type' => 'INT',
                'null' => TRUE,
                'unsigned' => TRUE,
            ],
            'PARTEAREADOID' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'PARTEEMPLEADOID' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'EXHORTONUMERO' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => TRUE,
            ],
            'EXHORTOESTADOID' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'EXHORTOMUNICIPIOID' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'EXHORTOOFICINAID' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'AREAIDREGISTRO' => [
                'type' => 'INT',
                'null' => TRUE,
                'null' => TRUE,
            ],
            'AREAIDRESPONSABLE' => [
                'type' => 'INT',
                'null' => TRUE,
                'null' => TRUE,
            ],
            'LOCALIZACIONPERSONA' => [
                'type' => 'CHAR',
                'constraint' => '1',
                'default' => 'N',
            ],
            'CONCLUIDO' => [
                'type' => 'CHAR',
                'constraint' => '1',
                'default' => 'N',
            ],
            'EXHORTOAUTORIDADID' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'HECHOCLASIFICACIONLUGARID' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'HECHOVIALIDADID' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
			'DELITODENUNCIA' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
            'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP',
            'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',
        ]);
        $this->forge->addKey('ID', TRUE);
        $this->forge->createTable('FOLIO');
    }

    public function down()
    {
        $this->forge->dropTable('FOLIO');
    }
}
