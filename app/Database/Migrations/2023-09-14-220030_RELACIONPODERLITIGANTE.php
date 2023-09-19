<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RELACIONPODERLITIGANTE extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'PODERID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],

            'PERSONAMORALID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
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
            'NOMBREARCHIVO' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'PODERARCHIVO' => [
                'type' => 'LONGBLOB',
                'null' => true,
            ],
            'FECHAINICIOPODER' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'FECHAFINPODER' => [
                'type' => 'DATE',
                'null' => true,
            ],
            //1 = ACTIVO 0= NO ACTIVO
            'ACTIVO' => [
                'type' => 'CHAR',
                'constraint' => '1',
                'null' => true,
            ],
            'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL',
			'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',
        ]);
        $this->forge->addKey('PODERID', TRUE);
        $this->forge->addKey('PERSONAMORALID', TRUE);

        $this->forge->createTable('RELACIONPODERLITIGANTE');
    }

    public function down()
    {
        $this->forge->dropTable('RELACIONPODERLITIGANTE');

    }
}
