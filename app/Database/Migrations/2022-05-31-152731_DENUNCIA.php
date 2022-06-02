<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DENUNCIA extends Migration
{
    public function up()
	{

		$this->forge->addField([
			'ID_DENUNCIA' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
				'unique' => TRUE,
			],
			'ES_MENOR' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
			],
			'ERES_TU' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
			],
            'ES_TERCERA_EDAD' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
			],
			'TIENE_DISCAPACIDAD' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
			],
            'FUE_CON_ARMA' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
			],
            'ESTA_DESAPARECIDO' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
			],

			'CREADO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'ACTUALIZADO DATETIME ON UPDATE CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('ID_DENUNCIA', TRUE);
		$this->forge->createTable('DENUNCIA');
	}

	public function down()
	{
		$this->forge->dropTable('DENUNCIA');
	}
}
