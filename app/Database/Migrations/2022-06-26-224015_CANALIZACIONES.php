<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CANALIZACIONES extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'MUNICIPIOID' => [
				'type' => 'INT',
				'null' => TRUE,
			],
			'INSTITUCIONREMISIONID' => [
				'type' => 'SMALLINT',
				'constrait' => '3',
				'null' => TRUE,
			],
			'INSTITUCIONREMISIONDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
			'DOMICILIO' => [
				'type' => 'VARCHAR',
				'constraint' => '250',
				'null' => TRUE,
			],
			'TELEFONO' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE,
			],
		]);
		$this->forge->addKey('MUNICIPIOID', TRUE);
		$this->forge->addKey('INSTITUCIONREMISIONID', TRUE);
		$this->forge->createTable('CANALIZACIONES');
	}

	public function down()
	{
		$this->forge->dropTable('CANALIZACIONES');
	}
}
