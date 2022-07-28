<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OTP extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'IDOTP' => [
				'type' => 'BIGINT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'CODIGO_OTP' => [
				'type' => 'INT',
				'constraint' => '50',
			],
			'CORREO' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'FECHAREGISTRO DATETIME DEFAULT CURRENT_TIMESTAMP',
			'VENCIMIENTO DATETIME',

		]);
		$this->forge->addKey('IDOTP', TRUE);
		$this->forge->createTable('OTP');
	}

	public function down()
	{
		$this->forge->dropTable('OTP');
	}
}
