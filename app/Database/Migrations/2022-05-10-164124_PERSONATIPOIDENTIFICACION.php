<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PERSONATIPOIDENTIFICACION extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'PERSONATIPOIDENTIFICACIONID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'PERSONATIPOIDENTIFICACIONDESCR' => [
				'type' => 'VARCHAR',
				'constraint' => '200',
			],
			'FORMATOCAPTURA' => [
				'type' => 'VARCHAR',
				'constraint' => '200',
			],
			'IDENTIFICACIONPREDETERMINADA' => [
				'type' => 'VARCHAR',
				'constraint' => '200',
			],
			'EXPRESIONREGULAR' => [
				'type' => 'VARCHAR',
				'constraint' => '200',
			],
		]);
		$this->forge->addKey('PERSONATIPOIDENTIFICACIONID', TRUE);
		$this->forge->createTable('PERSONATIPOIDENTIFICACION');
	}

	public function down()
	{
		$this->forge->dropTable('PERSONATIPOIDENTIFICACION');
	}
}
