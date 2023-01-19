<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DERIVACIONESATENCION extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'MUNICIPIOID' => [
				'type' => 'INT',
				'null' => TRUE,
			],
			'INSTITUCIONREMISIONID' => [
				'type' => 'SMALLINT',
				'constrait'		 => '3',
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
		$this->forge->addKey('ID', TRUE);
		$this->forge->createTable('DERIVACIONES_ATENCION');
	}

	public function down()
	{
		$this->forge->dropTable('DERIVACIONES_ATENCION');
	}
}
