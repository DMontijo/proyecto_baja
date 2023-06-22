<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PERSONAMORALNOTIFICACIONES extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'NOTIFICACIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,

			],
            'PERSONAMORALID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
            'ESTADOID' => [
                'type' => 'INT',
                'unsigned' => true,

            ],
            'MUNICIPIOID' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'LOCALIDADID' => [
                'type' => 'INT',
                'unsigned' => true,
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
            'TELEFONOADICIONAL' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
            'CORREO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
           
            'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP',
            'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',
        ]);
		$this->forge->addKey('NOTIFICACIONID', TRUE);
        $this->forge->addKey('PERSONAMORALID', TRUE);
        $this->forge->createTable('PERSONAMORALNOTIFICACIONES');
    }

    public function down()
    {
        $this->forge->dropTable('PERSONAMORALNOTIFICACIONES');
    }
}
