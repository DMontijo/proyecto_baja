<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SESIONESDENUNCIANTES extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'ID' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => false
			],
			'ID_DENUNCIANTE' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => false
			],
			'IP_DENUNCIANTE' => [
				'type' => 'VARCHAR',
				'constraint' => '45',
				'null' => false
			],
			'IP_PUBLICA' => [
				'type' => 'VARCHAR',
				'constraint' => '45',
				'null' => false
			],
			'DENUNCIANTE_HTTP' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => false
			],
			'DENUNCIANTE_SO' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => false
			],
			'DENUNCIANTE_MOBILE' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => false
			],
			'ACTIVO' => [
				'type' => 'INT',
				'constraint' => '8',
				'null' => false
			],
			'FECHAINICIO timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL',
			'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',
		]);

		$this->forge->addKey('ID', true);
		$this->forge->addKey('FECHAINICIO');
		$this->forge->createTable('SESIONESDENUNCIANTES', true);
    }

    public function down()
    {
		$this->forge->dropTable('SESIONESDENUNCIANTES', true);
    }
}
