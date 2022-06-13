<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FOLIOPREGUNTASDENUNCIA extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
			],
			'FOLIOID' => [
				'type' => 'VARCHAR',
				'constraint' => '16',
			],
			'ES_MENOR' => [
				'type' => 'CHAR',
				'constraint' => '2',
			],
			'ERES_TU' => [
				'type' => 'CHAR',
				'constraint' => '2',
			],
			'ES_TERCERA_EDAD' => [
				'type' => 'CHAR',
				'constraint' => '2',
			],
			'TIENE_DISCAPACIDAD' => [
				'type' => 'CHAR',
				'constraint' => '2',
			],
			'FUE_CON_ARMA' => [
				'type' => 'CHAR',
				'constraint' => '2',
			],
			'ESTA_DESAPARECIDO' => [
				'type' => 'CHAR',
				'constraint' => '2',
			],
			'LESIONES' => [
				'type' => 'CHAR',
				'constraint' => '2',
			],
			'LESIONES_VISIBLES' => [
				'type' => 'CHAR',
				'constraint' => '2',
			],
			'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'FECHAACTUALIZACION DATETIME ON UPDATE CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('ID', TRUE);
		$this->forge->createTable('FOLIOPREGUNTASDENUNCIA');
	}

	public function down()
	{
		$this->forge->dropTable('FOLIOPREGUNTASDENUNCIA');
	}
}
