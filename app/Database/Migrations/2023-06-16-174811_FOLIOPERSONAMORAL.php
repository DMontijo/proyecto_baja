<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIOPERSONAMORAL extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'FOLIOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
            'ANO' => [
				'type' => 'INT',
				'constraint' => '4',
			],
            'PERSONAMORALID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
            'NOTIFICACIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
            'CALIDADJURIDICAID' => [
				'type' => 'INT',
				'constraint' => '5',
				'null' => TRUE,
			],
            'DENOMINACION' => [
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => true,
            ],
            'MARCACOMERCIAL' => [
                'type' => 'VARCHAR',
                'constraint' => '500',
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
            'LOCALIDADID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,

            ],
            'ZONA' => [
                'type' => 'CHAR',
                'constraint' => '1',
                'null' => true,
            ],
            'COLONIAID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'COLONIADESCR' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'CALLE' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'NUMERO' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
            ],
            'NUMEROINTERIOR' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => true,
            ],
            'REFERENCIA' => [
                'type' => 'TEXT',
                'constraint' => '300',
                'null' => true,
            ],
            'TELEFONO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
            'CORREO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
            'PERSONAMORALGIROID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,

            ],
            'PODERID' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP',
        ]);
    	$this->forge->addKey('FOLIOID', TRUE);
		$this->forge->addKey('ANO', TRUE);
        $this->forge->addKey('PERSONAMORALID', TRUE);
        $this->forge->createTable('FOLIOPERSONAMORAL');
    }

    public function down()
    {
        $this->forge->dropTable('FOLIOPERSONAMORAL');

    }
}
