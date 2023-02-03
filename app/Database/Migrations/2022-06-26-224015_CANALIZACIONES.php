<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CANALIZACIONES extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'INSTITUCIONREMISIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'INSTITUCIONREMISIONDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE,
			],
			'MUNICIPIOID' => [
				'type' => 'INT',
			],
			'DOMICILIO' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE,
			],
			'TELEFONO' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE,
			],
		]);
		
		$this->forge->addKey('INSTITUCIONREMISIONID', TRUE);
		$this->forge->createTable('CANALIZACIONES');
	}

	public function down()
	{
		$this->forge->dropTable('CANALIZACIONES');
	}
}
