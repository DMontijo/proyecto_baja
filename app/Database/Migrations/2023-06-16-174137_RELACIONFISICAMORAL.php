<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RELACIONFISICAMORAL extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
                'auto_increment' => TRUE
			],
            'DENUNCIANTEID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
            'PERSONAMORALID' => [
                'type' => 'INT',
				'unsigned' => TRUE,
			],
            'RELACIONAR' => [
			    'type' => 'CHAR',
                'constraint' => '1',
                'default'=>'N',
			],
            'USUARIOIDRELACION' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,

            ],
            'RECHAZAR' => [
                'type' => 'CHAR',
                'constraint' => '1',
                'null' => true,
            ],
            'USUARIOIDRECHAZO' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,

            ],
            'PODERVOLUMEN' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
                'null' => true,

            ],
            'PODERNONOTARIO' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
                'null' => true,
            ],
            'PODERNOPODER' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
                'null' => true,
            ],
            'PODERARCHIVO' => [
                'type' => 'LONGBLOB',
            ],
            'FECHAINICIOPODER' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'FECHAFINPODER' => [
                'type' => 'DATE',
                'null' => true,
            ],

            'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',
        ]);
        $this->forge->addKey('ID', true);
        $this->forge->addKey('DENUNCIANTEID', true);
        $this->forge->addKey('PERSONAMORALID', true);
        $this->forge->createTable('RELACIONFISICAMORAL');
    }

    public function down()
    {
        $this->forge->dropTable('RELACIONFISICAMORAL');
    }
}
