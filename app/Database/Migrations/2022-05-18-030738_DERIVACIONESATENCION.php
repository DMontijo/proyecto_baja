<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DERIVACIONESATENCION extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ID'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			],
			'MUNICIPIO'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '250',
			],
			'INSTITUCIONREMISIONID'          => [
				'type'           => 'SMALLINT',
				'constrait'		 => '3',
			],
			'INSTITUCIONREMISIONDESCR'       => [
				'type'        => 'VARCHAR',
				'constraint'  => '50',
			],
			'DOMICILIO'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '250',
			],
			'TELEFONO'          => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
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
