<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DERIVACIONES extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'MUNICIPIOID' => [
				'type' => 'INT',
			],
			'INSTITUCIONREMISIONID' => [
				'type' => 'SMALLINT',
				'constrait' => '3',
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
		$this->forge->createTable('DERIVACIONES');
	}

	public function down()
	{
		$this->forge->dropTable('DERIVACIONES');
	}
}
