<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EMPLEADOS extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'EMPLEADOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'NOMBRE' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'PRIMERAPELLIDO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'SEGUNDOAPELLIDO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			],
			'MUNICIPIOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'ESTADOID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'OFICINAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'AREAID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'FECHA DATETIME DEFAULT CURRENT_TIMESTAMP',
		]);

		$this->forge->addKey('EMPLEADOID', TRUE);
		$this->forge->addKey('MUNICIPIOID', TRUE);
		$this->forge->createTable('EMPLEADOS');
	}

	public function down()
	{
		$this->forge->dropTable('EMPLEADOS');
	}
}
