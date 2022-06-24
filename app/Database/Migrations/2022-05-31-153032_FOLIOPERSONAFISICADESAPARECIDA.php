<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIOPERSONAFISICADESAPARECIDA extends Migration
{
	public function up()
	{

		$this->forge->addField([
			'FOLIOID' => [
				'type' => 'VARCHAR',
				'constraint' => '16',
			],
			'PERSONAFISICAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'ESTATURA' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'PESO' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => TRUE,
			],
			'COMPLEXION' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => TRUE,
			],
			'COLOR_TEZ' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'SENAS' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'IDENTIDAD' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'COLOR_CABELLO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'TAM_CABELLO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'FORMA_CABELLO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'COLOR_OJOS' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'FRENTE' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'CEJA' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'DISCAPACIDAD' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'ORIGEN' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'DIA_DESAPARICION' => [
				'type' => 'DATE',
				'null' => TRUE,
			],
			'LUGAR_DESAPARICION' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'VESTIMENTA' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'PARENTESCO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'FOTOGRAFIA' => [
				'type' => 'TEXT',
				'null' => TRUE,
			],
			'AUTORIZA_FOTO' => [
				'type' => 'CHAR',
				'constraint' => '1',
				'default' => 'S',
				'null' => TRUE,
			],
			'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('FOLIOID', TRUE);
		$this->forge->addKey('PERSONAFISICAID', TRUE);
		$this->forge->createTable('FOLIOPERSONAFISICADESAPARECIDA');
	}

	public function down()
	{
		$this->forge->dropTable('FOLIOPERSONAFISICADESAPARECIDA');
	}
}
